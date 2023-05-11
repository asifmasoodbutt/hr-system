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
        <form id="register-employee-form">
            <h3>General Details</h3>
            <br>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">First Name <span class="required"></span></label>
                        <input type="text" name="first_name" class="form-control input-field" maxlength="50" required placeholder="Enter employee's first name" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Last Name <span class="required"></span></label>
                        <input type="text" name="last_name" class="form-control input-field" maxlength="50" required placeholder="Enter employee's last name" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Gender <span class="required"></span></label>
                        <select name="gender_id" class="form-control input-field" id="select-gender" required>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                            <option value="3">Other</option>
                        </select>
                        <div class="validation-error"></div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Date of Birth <span class="required"></span></label>
                        <input type="date" name="dob" class="form-control input-field" required placeholder="Enter employee's date of birth" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Email <span class="required"></span></label>
                        <input type="email" name="email" class="form-control input-field" maxlength="100" required placeholder="Enter employee's email" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Password <span class="required"></span></label>
                        <input type="password" name="password" class="form-control input-field" maxlength="40" required placeholder="Enter employee's password" />
                        <div class="validation-error"></div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Father Name <span class="required"></span></label>
                        <input type="text" name="father_name" class="form-control input-field" maxlength="50" required placeholder="Enter employee's father name" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">CNIC Number <span class="required"></span></label>
                        <input type="number" maxlength="15" class="form-control input-field" name="cnic_number" required placeholder="Enter employee's cnic number without -" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Mobile Number <span class="required"></span></label>
                        <input type="number" class="form-control input-field" name="mobile_number" maxlength="15" required placeholder="Enter employee's mobile number" />
                        <div class="validation-error"></div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Current Address <span class="required"></span></label>
                        <input type="text" class="form-control input-field" name="current_address" maxlength="255" required placeholder="Enter employee's current address" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Permanent Address <span class="required"></span></label>
                        <input type="text" class="form-control input-field" name="permanent_address" maxlength="255" required placeholder="Enter employee's permanent address" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Department <span class="required"></span></label>
                        <select class="form-control input-field" id="select-department" name="department_id" required></select>
                        <div class="validation-error"></div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Bank Name <span class="required"></span></label>
                        <input type="text" class="form-control input-field" name="bank_name" maxlength="50" required placeholder="Enter employee's bank name" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Bank Account Number <span class="required"></span></label>
                        <input type="text" class="form-control input-field" name="bank_account_number" maxlength="50" required placeholder="Enter employee's bank account number" />
                        <div class="validation-error"></div>
                    </div>
                </div>
            </div>
            <h3>Qualification Details</h3>
            <br>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Degree Level <span class="required"></span></label>
                        <select class="form-control input-field" id="select-degree-levels" name="degree_level_id" required></select>
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Institute <span class="required"></span></label>
                        <input type="text" class="form-control input-field" maxlength="100" required placeholder="Enter employee's institute" name="institute" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Graduation Year <span class="required"></span></label>
                        <input type="number" class="form-control input-field" maxlength="4" required placeholder="Enter employee's grduation year" name="graduation_year" />
                        <div class="validation-error"></div>
                    </div>
                </div>
            </div>
            <h3>Job Details</h3>
            <br>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Pay Scale <span class="required"></span></label>
                        <select class="form-control input-field" id="select-pay-scales" required name="pay_scale_id"></select>
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Position <span class="required"></span></label>
                        <input type="text" class="form-control input-field" name="position" maxlength="50" required placeholder="Enter employee's position" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Job Description <span class="required"></span></label>
                        <input type="text" class="form-control input-field" name="job_description" maxlength="255" required placeholder="Enter employee's job description" />
                        <div class="validation-error"></div>
                    </div>
                </div>
            </div>
            <h3>Contract Details</h3>
            <br>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Contract Type <span class="required"></span></label>
                        <select class="form-control input-field" name="contract_type_id" id="select-contract-types" required></select>
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Start Date <span class="required"></span></label>
                        <input type="date" class="form-control input-field" name="start_date" required placeholder="Enter employee's joining date" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">End Date</label>
                        <input type="date" class="form-control input-field" name="end_date" placeholder="Enter employee's ending date" />
                        <div class="validation-error"></div>
                    </div>
                </div>
            </div>
            <h3>Experiences</h3>
            <br>
            <div class="row row-cols-md-4 mb-4 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Company Name <span class="required"></span></label>
                        <input type="text" class="form-control input-field" name="company_name" maxlength="50" required placeholder="Enter employee's company name" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Latest Position <span class="required"></span></label>
                        <input type="text" class="form-control input-field" name="latest_position" maxlength="50" required placeholder="Enter employee's latest position" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Start Date <span class="required"></span></label>
                        <input type="date" class="form-control input-field" name="company_start_date" required placeholder="Enter employee's joining date" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">End Date <span class="required"></span></label>
                        <input type="date" class="form-control input-field" name="company_end_date" required placeholder="Enter employee's ending date" />
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
                        <input type="text" class="form-control input-field" name="spouse_name" maxlength="50" placeholder="Enter employee's spouse name" />
                        <div class="validation-error"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Number of children</label>
                        <input type="number" maxlength="2" class="form-control input-field" name="no_of_children" placeholder="Enter employee's no. of children" />
                        <div class="validation-error"></div>
                    </div>
                </div>
            </div>
            <div class="button-container">
                <button type="submit" class="btn btn-primary" id="register-employee-btn">
                    <span class="icon"><i class="fas fa-user-plus"></i></span> Register Employee
                </button>
                <button type="reset" class="btn btn-danger">
                    <span class="icon"><i class="fas fa-times-circle"></i></span> Reset Form
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')

<!-- Page level custom scripts -->
<script>
    const get_departments_url = {!!json_encode(config('constants.GET_DEPARTMENTS_ENDPOINT')) !!};
    const get_degree_levels_url = {!!json_encode(config('constants.GET_DEGREE_LEVELS_ENDPOINT')) !!};
    const get_pay_scales_url = {!!json_encode(config('constants.GET_PAY_SCALES_ENDPOINT')) !!};
    const get_contract_types_url = {!!json_encode(config('constants.GET_CONTRACT_TYPES_ENDPOINT')) !!};
    const register_employee_url = {!!json_encode(config('constants.REGISTER_EMPLOYEE_ENDPOINT')) !!};
</script>
<script src="{{ asset('assets/js/register-employee.js') }}"></script>

@endsection