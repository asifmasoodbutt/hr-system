<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Experience;
use App\Models\FamilyDetail;
use App\Models\Job;
use App\Models\JobUser;
use App\Models\PayScale;
use App\Models\Qualification;
use App\Models\User;
use GuzzleHttp\Promise\Create;
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

            storeApiResponseData($request->api_request_id, $employee, 200, true);
            return response()->success($employee);
        } catch (\Exception $e) {
            return throwException($e, 'registerEmployeeApi', $request->api_request_id);
        }
    }
}
