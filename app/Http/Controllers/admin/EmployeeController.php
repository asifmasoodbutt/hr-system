<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Experience;
use App\Models\FamilyDetail;
use App\Models\Job;
use App\Models\Qualification;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function employees()
    {
        return view('main.employees');
    }

    public function registerEmployee()
    {
        return view('main.register-employee');
    }

    public function registerEmployeeApi(Request $request)
    {
        try {
            $family_detail_id = $request->has('spouse_name') ?
                FamilyDetail::create([
                    'spouse_name' => $request->spouse_name,
                    'children' => $request->has('no_of_children') ? $request->no_of_children : null
                ])->id : null;

            $qualification_id = Qualification::create([
                'degree_level_id' => $request->degree_level_id,
                'institute' => $request->institute,
                'graduation_year' => $request->graduation_year
            ])->id;

            $contract_id = Contract::create([
                'contract_type_id' => $request->contract_type_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date ?? null
            ])->id;

            $job_id = Job::create([
                'pay_scale_id' => $request->pay_scale_id,
                'position' => $request->position,
                'job_description' => $request->job_description
            ])->id;

            $employee = new User();
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->gender_id = $request->gender_id;
            $employee->date_of_birth = $request->date_of_birth;
            $employee->email = $request->email;
            $employee->password = $request->password;
            $employee->current_address = $request->current_address;
            $employee->permanent_address = $request->permanent_address;
            $employee->phone_no = $request->mobile_number;
            $employee->father_name = $request->father_name;
            $employee->cnic = $request->cnic_number;
            $employee->family_detail_id = $family_detail_id;
            $employee->department_id = $request->department_id;
            $employee->qualification_id = $qualification_id;
            $employee->contract_id = $contract_id;
            $employee->bank_name = $request->bank_name;
            $employee->bank_account_no = $request->bank_account_number;
            $employee->save();

            $employee->jobs()->attach($job_id, ['created_at' => now(), 'updated_at' => now()]);

            Experience::create([
                'user_id' => $employee->id,
                'company_name' => $request->company_name,
                'position' => $request->latest_position,
                'start_date'  => $request->company_start_date,
                'end_date'  => $request->company_end_date
            ]);

            $role = Role::where('name', 'employee')->first();
            $employee->roles()->attach($role->id, ['created_at' => now(), 'updated_at' => now()]);

            storeApiResponseData($request->api_request_id, $employee, 200, true);
            return response()->success($employee);
        } catch (\Exception $e) {
            return throwException($e, 'registerEmployeeApi', $request->api_request_id);
        }
    }

    public function getEmployees(Request $request)
    {
        try {
            $users = User::query()
                ->select('id', 'first_name', 'last_name', 'email', 'department_id', 'contract_id')
                ->whereHas('roles', function ($query) {
                    $query->where('name', 'employee');
                })
                ->with([
                    'roles:id,name',
                    'department:id,name',
                    'jobs:id,pay_scale_id,position',
                    'jobs.payScale:id,basic_salary,allowances,benefits',
                    'contract:id,contract_type_id',
                    'contract.contractType:id,type'
                ])
                ->get();

            if ($users->isEmpty()) {
                $response = 'No employee found!';
                storeApiResponseData($request->api_request_id, ['message' => $response], 404, false);
                return response()->error($response, 404);
            }
            $response = $users->map(function ($user) {
                $total_salary = $user->jobs->sum(function ($job) {
                    return $job->payScale->basic_salary + $job->payScale->allowances + $job->payScale->benefits;
                });
                return [
                    'id' => $user->id,
                    'full_name' => $user->first_name . ' ' . $user->last_name,
                    'email' => $user->email,
                    'department' => $user->department->name,
                    'position' => $user->jobs->isEmpty() ? null : $user->jobs->first()->position,
                    'salary' => $total_salary,
                    'contract' => $user->contract->contractType->type
                ];
            });
            storeApiResponseData($request->api_request_id, ['message' => 'Employees fetched!'], 200, true);
            return response()->success($response);
        } catch (\Exception $e) {
            return throwException($e, 'getEmployees', $request->api_request_id);
        }
    }

    public function employeeDetails($id)
    {
        return view('main.employee-details');
    }
}
