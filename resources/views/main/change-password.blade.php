@extends('layouts.app')

@section('title')
Change Password | HRM System
@endsection

@section('heading')
Change Password
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
<p class="mb-4">Here you can change your password by providing specified fields.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Change Password Form</h6>
    </div>
    <div class="card-body">
        <form class="form" id="changePasswordForm">
            <div class="form-group">
                <label for="currentPassword">Current Password</label>
                <input type="password" class="form-control" id="currentPassword" placeholder="Enter current password" required>
                <div class="col-12" id="currentPasswordValidationDiv" class="hiddenDiv">
                    <p id="currentPasswordErrorMessage" class="redError"></p>
                </div>
            </div>
            <div class="form-group">
                <label for="newPassword">New Password</label>
                <input type="password" class="form-control" id="newPassword" placeholder="Enter new password" required>
                <div class="col-12" id="newPasswordValidationDiv" class="hiddenDiv">
                    <p id="newPasswordErrorMessage" class="redError"></p>
                </div>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm new password" required>
                <div class="col-12" id="confirmPasswordValidationDiv" class="hiddenDiv">
                    <p id="confirmPasswordErrorMessage" class="redError"></p>
                </div>
            </div>
            <button type="submit" id="changePasswordBtn" class="btn btn-primary btn-block" disabled>Change Password</button>
            <br>
            <div class="col-12 alert alert-danger hiddenDiv" id="apiValidationErrorBox">
                <p id="apiValidationErrorMessage"></p>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<!-- Page level custom scripts -->
<script>
    const change_password_endpoint = {!!json_encode(config('constants.CHANGE_PASSWORD_ENDPOINT')) !!};
</script>
<script src="{{ asset('assets/js/change-password.js') }}"></script>
@endsection