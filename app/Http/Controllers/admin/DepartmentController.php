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
            $departments = Department::select('id', 'name')
                ->with('sections:id,name,department_id')
                ->get();
            $message = 'No departments found!';   
            if ($departments->isNotEmpty()) {
                $message = 'Departments fetched successfully!';
                storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
                return response()->success($departments, $message);
            }
            storeApiResponseData($request->api_request_id, ['message' => $message], 404, false);
            return response()->error($message, 404);
        } catch (\Exception $e) {
            return throwException($e, 'getDepartments', $request->api_request_id);
        }
    }
}
