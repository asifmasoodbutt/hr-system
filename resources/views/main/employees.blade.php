@extends('layouts.app')

@section('title')
Employees | HRM System
@endsection

@section('heading')
Employees
@endsection

@section('main-content')
<div class="d-flex justify-content-between align-items-center">
    <p class="mb-4">All the employees are listed below.</p>
    <a href="{{ route('register-employee') }}" class="btn btn-primary btn-icon-split reg-employee-btn">
        <span class="icon"><i class="fas fa-user-plus"></i></span>
        <span class="text">Register New Employee</span>
    </a>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th>Contract</th>
                        <th>Salary</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<!-- Page level custom scripts -->
<script>
    const get_employees_url = {!!json_encode(config('constants.GET_EMPLOYEES_ENDPOINT')) !!};
    const employee_details_url = {!!json_encode(config('constants.SHOW_EMPLOYEE_DETAILS_PAGE')) !!};
</script>
<script src="{{ asset('assets/js/employees.js') }}"></script>

@endsection