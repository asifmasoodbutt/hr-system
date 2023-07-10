@extends('layouts.app')

@section('title')
Register Employee | HRM System
@endsection

@section('head')
<link href="{{ asset('assets/css/register-employee.css') }}" rel="stylesheet">
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
                        <div id="firstNameErrorDiv" style="display: none;" class="message"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Last Name <span class="required"></span></label>
                        <input type="text" name="last_name" class="form-control input-field" maxlength="50" required placeholder="Enter employee's last name" />
                        <div id="lastNameErrorDiv" style="display: none;" class="message"></div>
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
                    </div>
                </div>
            </div>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Date of Birth <span class="required"></span></label>
                        <input type="date" name="dob" class="form-control input-field" min="1980-01-01" required placeholder="Enter employee's date of birth" />
                        <div id="dobErrorDiv" style="display: none;" class="message"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Email <span class="required"></span></label>
                        <input type="email" name="email" class="form-control input-field" maxlength="100" required placeholder="Enter employee's email" />
                        <div id="emailErrorDiv" style="display: none;" class="message"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Password <span class="required"></span></label>
                        <input type="password" name="password" class="form-control input-field" maxlength="40" required placeholder="Enter employee's password" />
                        <div id="passwordErrorDiv" style="display: none;" class="message"></div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Father Name <span class="required"></span></label>
                        <input type="text" name="father_name" class="form-control input-field" maxlength="50" required placeholder="Enter employee's father name" />
                        <div id="fatherNameErrorDiv" style="display: none;" class="message"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">CNIC Number <span class="required"></span></label>
                        <input type="number" id="cnic" class="form-control input-field no-spinner" name="cnic_number" required placeholder="Enter employee's cnic number without -" />
                        <div id="cnicErrorDiv" style="display: none;" class="message"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Mobile Number <span class="required"></span></label>
                        <input type="number" class="form-control input-field no-spinner" name="mobile_number" maxlength="15" required placeholder="Enter employee's mobile number" />
                        <div id="phoneErrorDiv" style="display: none;" class="message"></div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Current Address <span class="required"></span></label>
                        <input type="text" class="form-control input-field" name="current_address" maxlength="255" required placeholder="Enter employee's current address" />
                        <div id="currentAddressErrorDiv" style="display: none;" class="message"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Permanent Address <span class="required"></span></label>
                        <input type="text" class="form-control input-field" name="permanent_address" maxlength="255" required placeholder="Enter employee's permanent address" />
                        <div id="permanentAddressErrorDiv" style="display: none;" class="message"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Department <span class="required"></span></label>
                        <select class="form-control input-field" id="select-department" name="department_id" required></select>
                    </div>
                </div>
            </div>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Bank Name <span class="required"></span></label>
                        <input type="text" class="form-control input-field" name="bank_name" maxlength="50" required placeholder="Enter employee's bank name" />
                        <div id="bankNameErrorDiv" style="display: none;" class="message"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Bank Account Number <span class="required"></span></label>
                        <input type="number" class="form-control input-field no-spinner" name="bank_account_number" required placeholder="Enter employee's bank account number" />
                        <div id="bankAccountErrorDiv" style="display: none;" class="message"></div>
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
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Institute <span class="required"></span></label>
                        <input type="text" class="form-control input-field" maxlength="50" required placeholder="Enter employee's institute" name="institute" />
                        <div id="instituteErrorDiv" style="display: none;" class="message"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Graduation Year <span class="required"></span></label>
                        <input type="number" class="form-control input-field no-spinner" required placeholder="Enter employee's grduation year" name="graduation_year" />
                        <div id="gradYearErrorDiv" style="display: none;" class="message"></div>
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
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Position <span class="required"></span></label>
                        <input type="text" class="form-control input-field" name="position" maxlength="50" required placeholder="Enter employee's position" />
                        <div id="positionErrorDiv" style="display: none;" class="message"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Job Description <span class="required"></span></label>
                        <input type="text" class="form-control input-field" name="job_description" maxlength="255" required placeholder="Enter employee's job description" />
                        <div id="jobDescErrorDiv" style="display: none;" class="message"></div>
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
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Start Date <span class="required"></span></label>
                        <input type="date" class="form-control input-field" name="start_date" required placeholder="Enter employee's joining date" />
                        <div id="startDateErrorDiv" style="display: none;" class="message"></div>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">End Date</label>
                        <input type="date" class="form-control input-field" name="end_date" placeholder="Enter employee's ending date" />
                    </div>
                </div>
            </div>
            <div class="row row-cols-md-2 mb-2 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <h3>Experiences<span class="required"></span></h3>
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="text-right">
                        <a class="btn btn-primary btn-icon-split add-experiences-btn">
                            <span class="icon"><i class="fas fa-plus"></i></span>
                            <span class="text">Add Experiences</span>
                        </a>
                    </div>
                </div>
            </div>
            <br>
            <div id="experiencesContainer">

            </div>
            <h3>Family Details</h3>
            <br>
            <div class="row row-cols-md-3 mb-3 text-center">
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Spouse Name</label>
                        <input type="text" class="form-control input-field" name="spouse_name" maxlength="50" placeholder="Enter employee's spouse name" />
                    </div>
                </div>
                <div class="col themed-grid-col">
                    <div class="form-group text-left">
                        <label class="font-weight-bolder">Number of children</label>
                        <input type="number" class="form-control input-field no-spinner" name="no_of_children" placeholder="Enter employee's no. of children" />
                    </div>
                </div>
            </div>
            <div class="button-container">
                <button type="button" class="btn btn-primary" id="register-employee-btn" data-toggle="modal" data-target="#registerEmployeeConfirmationModal">
                    <span class="icon"><i class="fas fa-user-plus"></i></span> Register Employee
                </button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#formResetConfirmationModal">
                    <span class="icon"><i class="fas fa-times-circle"></i></span>
                    <span class="text">Reset Form</span>
                </button>
            </div>
            <br>
            <div class="d-flex justify-content-center">
                <div class="alert alert-success alert-dismissible fade show text-center" id="register-employee-alert" role="alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Confirm register employee dialog modal -->
<div class="modal fade" id="registerEmployeeConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="registerEmployeeConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerEmployeeConfirmationModalLabel">Confirm Register Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to register new employee?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmRegisterEmployee">Confirm Register</button>
            </div>
        </div>
    </div>
</div>

<!-- Confirm reset form dialog modal -->
<div class="modal fade" id="formResetConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="formResetConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formResetConfirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to reset the form?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmReset">Confirm</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<!-- Page level custom scripts -->
<script>
    $(document).ready(function() {
        $('#confirmReset').click(function() {
            // Reset the form
            $('#register-employee-form')[0].reset();

            // Close the modal
            $('#formResetConfirmationModal').modal('hide');
        });
    });
</script>

<script>
    const get_departments_url = {!!json_encode(config('constants.GET_DEPARTMENTS_ENDPOINT')) !!};
    const get_degree_levels_url = {!!json_encode(config('constants.GET_DEGREE_LEVELS_ENDPOINT')) !!};
    const get_pay_scales_url = {!!json_encode(config('constants.GET_PAY_SCALES_ENDPOINT')) !!};
    const get_contract_types_url = {!!json_encode(config('constants.GET_CONTRACT_TYPES_ENDPOINT')) !!};
    const register_employee_url = {!!json_encode(config('constants.REGISTER_EMPLOYEE_ENDPOINT')) !!};
</script>
<script src="{{ asset('assets/js/register-employee.js') }}"></script>

@endsection