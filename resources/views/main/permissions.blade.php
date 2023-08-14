@extends('layouts.app')

@section('title')
Permissions | HRM System
@endsection

@section('head')
<link href="{{ asset('assets/css/departments-page.css') }}" rel="stylesheet">
@endsection

@section('heading')
Permissions
@endsection

@section('main-content')

<div class="d-flex justify-content-between align-items-center">
    <p class="mb-4">Here is the permissions management section.</p>

    <button type="button" class="btn btn-primary" id="create-role-btn" data-toggle="modal" data-target="#createPermissionModal">
        <span class="icon"><i class="fas fa-user-gear"></i></span> Create Permission
    </button>
</div>

<!-- Permissions DataTale -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Permissions List</h6>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="permissions-table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Permission Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create permission dialog modal -->
<div class="modal fade" id="createPermissionModal" tabindex="-1" role="dialog" aria-labelledby="createPermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPermissionModalLabel">Create Permission</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row row-cols-md-12 mb-12 text-center">
                    <div class="col themed-grid-col">
                        <div class="form-group text-left">
                            <label class="font-weight-bolder">Permission Name <span class="required"></span></label>
                            <input type="text" name="permission_name" class="form-control input-field" maxlength="50" required placeholder="Enter permission's name" />
                            <div id="permissionNameErrorDiv" style="display: none;" class="message"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="modal-create-btn">Create</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete permission dialog modal -->
<div class="modal fade" id="deletePermissionModal" tabindex="-1" role="dialog" aria-labelledby="deletePermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePermissionModalLabel">Delete Permission</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this permission?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="modal-delete-btn">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit permission dialog modal -->
<div class="modal fade" id="editPermissionModal" tabindex="-1" role="dialog" aria-labelledby="editPermssionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPermssionModalLabel">Edit Permission</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row row-cols-md-12 mb-12 text-center">
                    <div class="col themed-grid-col">
                        <div class="form-group text-left">
                            <label class="font-weight-bolder">Permission Name <span class="required"></span></label>
                            <input type="text" name="permission_name" id="permission_name" class="form-control input-field" maxlength="20" required placeholder="Enter permission's name" />
                            <div id="permissionNameErrorDiv" style="display: none;" class="message"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="modal-edit-btn">Edit</button>
            </div>
        </div>
    </div>
</div>

<!-- Show Roles dialog modal -->
<div class="modal fade" id="showRolesModal" tabindex="-1" role="dialog" aria-labelledby="showRolesModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showRolesModalLabel">Assigned to the Roles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="roles-table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Role Name</th>
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
    const get_permissions_url = {!!json_encode(config('constants.GET_PERMISSIONS_ENDPOINT')) !!};
    const create_permission_url = {!!json_encode(config('constants.CREATE_PERMISSION_ENDPOINT')) !!};
    const delete_permission_url = {!!json_encode(config('constants.DELETE_PERMISSION_ENDPOINT')) !!};
    const edit_permission_url = {!!json_encode(config('constants.EDIT_PERMISSION_ENDPOINT')) !!};
    const get_permission_with_roles_url = {!!json_encode(config('constants.GET_PERMISSION_WITH_ROLES_ENDPOINT')) !!};
</script>
<script src="{{ asset('assets/js/permissions.js') }}"></script>
<script src="{{ asset('assets/js/side-notification.js') }}"></script>

@endsection