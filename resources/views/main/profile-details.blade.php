@extends('layouts.app')

@section('title')
Profile | HRM System
@endsection

@section('heading')
@if (session('role') == 'admin')
Admin Profile
@else
Employee Profile
@endif
@endsection

@section('main-content')
<p class="mb-4">Here is your profile details.</p>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Profile Details</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <h3>General Details</h3>
            <br>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">First Name</label>
                        <p id="first_name"></p>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Last Name</label>
                        <p id="last_name"></p>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Gender</label>
                        <p id="gender"></p>
                    </div>
                </div>
            </div>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Date of Birth</label>
                        <p id="date_of_birth"></p>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Email</label>
                        <p id="email"></p>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Password</label>
                        <p>**********</p>
                    </div>
                </div>
            </div>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Father Name</label>
                        <p id="father_name"></p>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">CNIC Number</label>
                        <p id="cnic"></p>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Mobile Number</label>
                        <p id="mobile_number"></p>
                    </div>
                </div>
            </div>
            @if (session('role') == 'employee')
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Current Address</label>
                        <p id="current_address"></p>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Permanent Address</label>
                        <p id="permanent_address"></p>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Department</label>
                        <p id="department"></p>
                    </div>
                </div>
            </div>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Bank Name</label>
                        <p id="bank_name"></p>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Bank Account Number</label>
                        <p id="bank_account_number"></p>
                    </div>
                </div>
            </div>
            <hr>
            <h3>Qualification Details</h3>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Degree Level</label>
                        <p id="degree_level"></p>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Institute</label>
                        <p id="institution"></p>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Graduation Year</label>
                        <p id="graduation_year"></p>
                    </div>
                </div>
            </div>
            <hr>
            <h3>Job Details</h3>
            <br>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Pay Scale</label>
                        <p id="pay_scale"></p>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Position</label>
                        <p id="position"></p>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Job Description</label>
                        <p id="job_description"></p>
                    </div>
                </div>
            </div>
            <hr>
            <h3>Contract Details</h3>
            <br>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Contract Type</label>
                        <p id="contract_type"></p>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Start Date</label>
                        <p id="start_date"></p>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">End Date</label>
                        <p id="end_date"></p>
                    </div>
                </div>
            </div>
            <hr>
            <h3>Experiences</h3>
            <br>
            <div id="experiences-container"></div>
            <hr>
            <h3>Family Details</h3>
            <br>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Spouse Name</label>
                        <p id="spouse_name"></p>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Number of children</label>
                        <p id="children"></p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')

<!-- Page level custom scripts -->
<script>
    const get_profile_details_url = {!!json_encode(config('constants.GET_PROFILE_DETAILS_ENDPOINT')) !!};
</script>
<script src="{{ asset('assets/js/profile-details.js') }}"></script>

@endsection