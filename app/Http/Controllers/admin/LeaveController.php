<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Leave\ApproveDisapproveLeaveRequest;
use App\Models\LeaveRequest;
use Auth;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function getLeaveRequests()
    {
        return view("main.employees-leave-requests");
    }

    public function getEmployeesLeaveRequests(Request $request)
    {
        try {
            $leave_requests = LeaveRequest::with(['employee:id,first_name,last_name', 'leaveType:id,leave_type'])->get();
            $message = 'No leave requests found!';
            if ($leave_requests->isNotEmpty()) {
                $message = 'Leave requests fetched successfully!';
                storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
                return response()->success($leave_requests, $message);
            }
            storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
            return response()->success([], $message);
        } catch (\Exception $e) {
            return throwException($e, 'getEmployeesLeaveRequests', $request->api_request_id);
        }
    }

    public function approveDisapproveLeaveRequest(ApproveDisapproveLeaveRequest $request)
    {
        try {
            LeaveRequest::where('id', $request->leave_request_id)->update([
                'status' => $request->status,
                'approved_by' => Auth::id()
            ]);

            if ($request->status == 'approved') {
                $message = 'Leave request has been approved successfully!';
            } else if ($request->status == 'not-approved') {
                $message = 'Leave request has been disapproved successfully!';
            }

            storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
            return response()->success([], $message);
        } catch (\Exception $e) {
            return throwException($e, 'approveDisapproveLeaveRequest', $request->api_request_id);
        }
    }
}