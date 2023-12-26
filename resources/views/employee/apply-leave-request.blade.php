@extends('layouts.app')

@section('title')
Apply Leave | HRM System
@endsection

@section('heading')
Apply Leave
@endsection

@section('head')
<style>
    .form {
        margin: 0 auto;
        max-width: 500px;
    }

    .redError {
        color: red;
    }

    .hiddenDiv {
        display: none;
    }

    .text-green {
        color: green;
    }

    #apiValidationErrorMessage {
        text-align: center;
    }
</style>
@endsection

@section('main-content')
<p class="mb-4">Here you can apply for leave.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Apply Leave Form</h6>
    </div>
    <div class="card-body">
        <form class="form" id="apply-leave-form">
            <div class="form-group">
                <label>Leave Type</label>
                <select class="form-control input-field" id="leaveTypeId" required></select>
            </div>
            <div class="form-group">
                <label>From Date</label>
                <input type="date" class="form-control input-field" id="fromDate" required />
            </div>
            <div class="form-group">
                <label>To Date</label>
                <input type="date" class="form-control input-field" id="toDate" required />
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" placeholder="Please write the description for leave" id="description" required></textarea>
            </div>
            <button type="submit" id="apply-leave-btn" class="btn btn-primary btn-block">Apply Leave</button>
            <br>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<!-- Page level custom scripts -->
<script>
    const apply_leave_request_endpoint = {!!json_encode(config('constants.APPLY_LEAVE_REQUEST_ENDPOINT'))!!};
    const get_leave_types_endpoint = {!!json_encode(config('constants.GET_LEAVE_TYPES_ENDPOINT'))!!};
</script>
<script src="{{ asset('assets/js/apply-leave-request.js') }}"></script>
<script src="{{ asset('assets/js/side-notification.js') }}"></script>

@endsection