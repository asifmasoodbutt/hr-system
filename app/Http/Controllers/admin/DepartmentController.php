<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function departments()
    {
        return view('main.departments');
    }

    public function getDepartments(Request $request)
    {
        try {
            $departments = Department::get();
            if ($departments->isNotEmpty()) {
                storeApiResponseData($request->api_request_id, $departments, 200, true);
                return response()->success($departments);
            }
            storeApiResponseData($request->api_request_id, 'No departments found!', 404, false);
            return response()->error('No departments found!', 404);
        } catch (\Exception $e) {
            return throwException($e, 'getDepartments', $request->api_request_id);
        }
    }
}
