<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\PayScale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('main.dashboard');
    }

    public function getDashboardData(Request $request)
    {
        try {
            $gender_counts = User::selectRaw('COUNT(*) as count, genders.gender as gender')
                ->join('genders', 'users.gender_id', '=', 'genders.id')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'role_user.role_id', '=', 'roles.id')
                ->whereIn('genders.gender', ['male', 'female', 'other'])
                ->where('roles.name', 'employee')
                ->groupBy('genders.gender')
                ->get()
                ->pluck('count', 'gender');

            $minTotalSalary = PayScale::select(DB::raw('basic_salary + allowances + benefits AS total_salary'))
                ->orderBy('total_salary', 'asc')
                ->value('total_salary');

            $maxTotalSalary = PayScale::select(DB::raw('basic_salary + allowances + benefits AS total_salary'))
                ->orderBy('total_salary', 'desc')
                ->value('total_salary');

            $rangeDifference = 30000; // Adjust as needed

            $salaryRanges = [];
            $userCounts = [];

            for ($salary = $minTotalSalary; $salary <= $maxTotalSalary; $salary += $rangeDifference) {
                $upperLimit = $salary + $rangeDifference;

                $userCount = User::whereHas('jobs', function ($query) use ($salary, $upperLimit) {
                    $query->whereHas('payScale', function ($query) use ($salary, $upperLimit) {
                        $query->whereRaw('basic_salary + allowances + benefits BETWEEN ? AND ?', [$salary, $upperLimit]);
                    });
                })->whereHas('roles', function ($query) {
                    $query->where('name', '!=', 'admin');
                })->count();

                $salaryRanges[] = number_format($salary / 1000, 0) . ' - ' . number_format($upperLimit / 1000, 0) . 'k (pkr)';
                $userCounts[] = $userCount;
            }

            $barchart_data = [
                'labels' => $salaryRanges,
                'data' => $userCounts,
            ];

            $data = [
                'piechart_data' => [$gender_counts['male'], $gender_counts['female'], $gender_counts['other']],
                'barchart_data' => $barchart_data
            ];

            storeApiResponseData($request->api_request_id, $data, 200, true);
            return response()->success($data);
        } catch (\Exception $e) {
            return throwException($e, 'getDashboardData', $request->api_request_id);
        }
    }

    public function forbidden()
    {
        return view('auth.forbidden');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $user = User::where('id', Auth::id())->first();
            if (Hash::check($request->current_password, $user->password)) {
                $user->password = $request->password;
                $user->save();
                $response = ['message' => 'Your password has been changed!'];
                storeApiResponseData($request->api_request_id, $response, 200, true);
                return response()->success($response);
            } else {
                storeApiResponseData($request->api_request_id, 'Current password is incorrect!', 422, false);
                return response()->error('Current password is incorrect!', 422);
            }
        } catch (\Exception $e) {
            return throwException($e, 'changePassword', $request->api_request_id);
        }
    }
}
