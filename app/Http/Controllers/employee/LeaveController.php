<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Leave\ApplyLeaveRequest;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Auth;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function employeeLeaveRequests()
    {
        return view("employee.leave-requests");
    }

    public function getEmployeeLeaveRequestsApi(Request $request)
    {
        try {
            $leave_requests = LeaveRequest::with('leaveType')->where('employee_id', Auth::id())->get();
            $message = 'No leave requests found!';
            if ($leave_requests->isNotEmpty()) {
                $message = 'Leave requests fetched successfully!';
                storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
                return response()->success($leave_requests, $message);
            }
            storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
            return response()->success([], $message);
        } catch (\Exception $e) {
            return throwException($e, 'getEmployeeLeaves', $request->api_request_id);
        }
    }

    public function getLeaveTypes(Request $request)
    {
        try {
            $leave_types = LeaveType::select('id', 'leave_type')->get();
            $message = 'No leave types found!';
            if ($leave_types->isNotEmpty()) {
                $message = 'Leave types fetched successfully!';
                storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
                return response()->success($leave_types, $message);
            }
            storeApiResponseData($request->api_request_id, ['message' => $message], 404, false);
            return response()->error($message, 404);
        } catch (\Exception $e) {
            return throwException($e, 'getLeaveTypes', $request->api_request_id);
        }
    }

    public function cancelLeaveRequest(ApplyLeaveRequest $request)
    {
        try {
            LeaveRequest::where('employee_id', Auth::id())
                ->where('id', $request->leave_request_id)->update([
                        'status' => 'cancelled'
                    ]);
            $message = 'Leave request cancelled successfully!';
            storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
            return response()->success([], $message);
        } catch (\Exception $e) {
            return throwException($e, 'cancelLeaveRequest', $request->api_request_id);
        }
    }

    public function applyLeaveApi(ApplyLeaveRequest $request)
    {
        try {
            $leave_created = LeaveRequest::create([
                'employee_id' => Auth::id(),
                'leave_type_id' => $request->leave_type_id,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'description' => $request->description
            ]);
            $message = 'Leave applied successfully!';
            storeApiResponseData($request->api_request_id, $leave_created, 200, true);
            return response()->success($leave_created, $message);
        } catch (\Exception $e) {
            return throwException($e, 'applyLeave', $request->api_request_id);
        }
    }
}