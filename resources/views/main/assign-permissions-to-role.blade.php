@extends('layouts.app')

@section('title')
Assign Permissions To Role | HRM System
@endsection

@section('head')
<link href="{{ asset('assets/css/departments-page.css') }}" rel="stylesheet">
<style>
    .scrollable-div {
        border: 1px solid #ccc;
        max-height: 300px;
        /* Set the maximum height for the scrollable div */
        overflow-y: auto;
    }
</style>
@endsection

@section('heading')
Assign Permissions to Role
@endsection

@section('main-content')

<div class="d-flex justify-content-between align-items-center">
    <p class="mb-4">Assign new permissions to a role.</p>
</div>

<!-- Roles DataTale -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Assign Permissions to Role</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <h3>Role: {{$roleName}}</h3>
            <br>
            <div class="row">
                <div class="col-lg-6">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="assignedPermissionsDataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Assigned Permissions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="unassignedPermissionsDataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Unassigned Permissions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<!-- Page level custom scripts -->
<script>
    const get_assigned_unassigned_permissions_url = {!!json_encode(config('constants.GET_ASSIGNED_UNASSIGNED_PERMISSIONS_ENDPOINT')) !!};
    const assign_permissions_to_role_url = {!!json_encode(config('constants.ASSIGN_PERMISSIONS_TO_ROLE_ENDPOINT')) !!};
</script>
<script src="{{ asset('assets/js/assign-permissions-to-role.js') }}"></script>
<script src="{{ asset('assets/js/side-notification.js') }}"></script>

@endsection