@extends('layouts.app')

@section('title')
Leaves Requests | HRM System
@endsection

@section('head')
<style>
    .cancelled {
        background-color: orange;
        color: black;
        border-radius: 5px;
    }

    .pending {
        background-color: yellow;
        color: black;
        border-radius: 5px;
    }

    .approved {
        background-color: green;
        color: white;
        border-radius: 5px;
    }

    .not-approved {
        background-color: red;
        color: white;
        border-radius: 5px;
    }
</style>
@endsection

@section('heading')
Leaves Requests
@endsection

@section('main-content')

<div class="d-flex justify-content-between align-items-center">
    <p class="mb-4">Here is your leaves details.</p>

    <!-- <button type="button" class="btn btn-primary">
        <span class="icon"><i class="fas fa-umbrella-beach"></i> </span>Apply Leave
    </button> -->
    <a href="{{ route('apply-leave-request') }}" class="btn btn-primary btn-icon-split">
        <span class="icon"><i class="fas fa-umbrella-beach"></i></span>
        <span class="text">Apply Leave</span>
    </a>
</div>

<!-- Roles DataTale -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Leaves Requests</h6>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="data-table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Leave Type</th>
                        <th>Status</th>
                        <th>Approved By</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Description</th>
                        <th>Leave Applied Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Cancel leave request consent dialog modal -->
<div class="modal fade" id="cancelLeaveRequestModal" tabindex="-1" role="dialog"
    aria-labelledby="cancelLeaveRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelLeaveRequestModalLabel">Cancel Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to cancel this leave request?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" id="cancel-yes-modal-btn">Yes</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<!-- Page level custom scripts -->
<script>
    const get_employee_leave_requests_url = {!!json_encode(config('constants.GET_EMPLOYEE_LEAVE_REQUESTS_ENDPOINT'))!!};
    const cancel_leave_requests_url = {!!json_encode(config('constants.CANCEL_LEAVE_REQUEST_ENDPOINT'))!!};
</script>
<script src="{{ asset('assets/js/employee-leaves.js') }}"></script>
<script src="{{ asset('assets/js/side-notification.js') }}"></script>

@endsection