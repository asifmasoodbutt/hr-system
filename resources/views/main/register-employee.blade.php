@extends('layouts.app')

@section('title')
Register Employee | HRM System
@endsection

@section('heading')
Register Employee
@endsection

@section('main-content')
<div class="d-flex justify-content-between align-items-center">
    <p class="mb-4">Please enter employee's details to register.</p>
    <a href="{{ route('employees') }}" class="btn btn-primary btn-icon-split reg-employee-btn">
        <span class="icon"><i class="fas fa-users"></i></span>
        <span class="text">Show Employees</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Employee Register Form</h6>
    </div>
    <div class="card-body">
        <form>
            <h3>General Details</h3>
            <br>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">First Name</label>
                        <input type="text" class="form-control" required placeholder="Enter employee's first name" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Last Name</label>
                        <input type="text" class="form-control" required placeholder="Enter employee's last name" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Gender</label>
                        <select class="form-control" id="male" required>
                            <option value="">Select an option</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                        <div class="validation-error"></div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Date of Birth</label>
                        <input type="text" class="form-control" required placeholder="Enter employee's date of birth" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Email</label>
                        <input type="email" class="form-control" required placeholder="Enter employee's email" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Password</label>
                        <input type="password" class="form-control" required placeholder="Enter employee's password" />
                        <div class="validation-error"></div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Father Name</label>
                        <input type="text" class="form-control" required placeholder="Enter employee's father name" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">CNIC Number</label>
                        <input type="email" class="form-control" required placeholder="Enter employee's bank name" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Mobile Number</label>
                        <input type="password" class="form-control" required placeholder="Enter employee's mobile number" />
                        <div class="validation-error"></div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Current Address</label>
                        <input type="text" class="form-control" required placeholder="Enter employee's current address" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Permanent Address</label>
                        <input type="email" class="form-control" required placeholder="Enter employee's permanent address" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Department</label>
                        <select class="form-control" id="select-department" required></select>
                        <div class="validation-error"></div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Bank Name</label>
                        <input type="email" class="form-control" required placeholder="Enter employee's bank name" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Bank Account Number</label>
                        <input type="password" class="form-control" required placeholder="Enter employee's bank account number" />
                        <div class="validation-error"></div>
                    </div>
                </div>
            </div>
            <h3>Qualification Details</h3>
            <br>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Degree Level</label>
                        <select class="form-control" id="select-degree-levels" required></select>
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Institute</label>
                        <input type="email" class="form-control" required placeholder="Enter employee's institute" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Graduation Year</label>
                        <input type="text" class="form-control" required placeholder="Enter employee's grduation year" />
                        <div class="validation-error"></div>
                    </div>
                </div>
            </div>
            <h3>Job Details</h3>
            <br>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Pay Scale</label>
                        <select class="form-control" id="select-pay-scales" required></select>
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Position</label>
                        <input type="email" class="form-control" required placeholder="Enter employee's position" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Job Description</label>
                        <input type="text" class="form-control" required placeholder="Enter employee's job description" />
                        <div class="validation-error"></div>
                    </div>
                </div>
            </div>
            <h3>Contract Details</h3>
            <br>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Contract Type</label>
                        <select class="form-control" id="select-contract-types" required></select>
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Start Date</label>
                        <input type="email" class="form-control" required placeholder="Enter employee's joining date" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">End Date</label>
                        <input type="text" class="form-control" required placeholder="Enter employee's ending date" />
                        <div class="validation-error"></div>
                    </div>
                </div>
            </div>
            <h3>Experiences</h3>
            <br>
            <div class="row row-cols-md-4 mb-4 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Company Name</label>
                        <input type="email" class="form-control" required placeholder="Enter employee's company name" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Latest Position</label>
                        <input type="email" class="form-control" required placeholder="Enter employee's latest position" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Start Date</label>
                        <input type="text" class="form-control" required placeholder="Enter employee's joining date" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">End Date</label>
                        <input type="text" class="form-control" required placeholder="Enter employee's ending date" />
                        <div class="validation-error"></div>
                    </div>
                </div>
            </div>
            <h3>Family Details</h3>
            <br>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Spouse Name</label>
                        <input type="email" class="form-control" required placeholder="Enter employee's spouse name" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Number of children</label>
                        <input type="email" class="form-control" required placeholder="Enter employee's no. of children" />
                        <div class="validation-error"></div>
                    </div>
                </div>
            </div>
            <div class="button-container">
                <a href="#" class="btn btn-primary btn-icon-split">
                    <span class="icon"><i class="fas fa-user-plus"></i></span>
                    <span class="text">Register Employee</span>
                </a>
                <a href="#" class="btn btn-danger btn-icon-split">
                    <span class="icon"><i class="fas fa-times-circle"></i></span>
                    <span class="text">Reset Form</span>
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')

<!-- Page level custom scripts -->
<script>
    const get_departments_url = {!!json_encode(config('constants.GET_DEPARTMENTS_ENDPOINT'))!!};
    const get_degree_levels_url = {!!json_encode(config('constants.GET_DEGREE_LEVELS_ENDPOINT'))!!};
    const get_pay_scales_url = {!!json_encode(config('constants.GET_PAY_SCALES_ENDPOINT'))!!};
    const get_contract_types_url = {!!json_encode(config('constants.GET_CONTRACT_TYPES_ENDPOINT'))!!};
</script>
<script src="{{ asset('assets/js/register-employee.js') }}"></script>

@endsection