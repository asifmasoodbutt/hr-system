@extends('layouts.app')

@section('title')
Role and Permissions | HRM System
@endsection

@section('head')
<link href="{{ asset('assets/css/departments-page.css') }}" rel="stylesheet">
@endsection

@section('heading')
Role and Permissions
@endsection

@section('main-content')

<div class="d-flex justify-content-between align-items-center">
    <p class="mb-4">Here is the roles and permissions management section.</p>

    <button type="button" class="btn btn-primary" id="create-role-btn" data-toggle="modal" data-target="#createRoleModal">
        <span class="icon"><i class="fas fa-user-gear"></i></span> Create Role
    </button>
</div>

<!-- Roles DataTale -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Roles List</h6>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="data-table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Role Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create role dialog modal -->
<div class="modal fade" id="createRoleModal" tabindex="-1" role="dialog" aria-labelledby="createRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createRoleModalLabel">Create Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row row-cols-md-12 mb-12 text-center">
                    <div class="col themed-grid-col">
                        <div class="form-group text-left">
                            <label class="font-weight-bolder">Role Name <span class="required"></span></label>
                            <input type="text" name="role_name" class="form-control input-field" maxlength="20" required placeholder="Enter role's name" />
                            <div id="roleNameErrorDiv" style="display: none;" class="message"></div>
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

<!-- Delete role dialog modal -->
<div class="modal fade" id="deleteRoleModal" tabindex="-1" role="dialog" aria-labelledby="deleteRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRoleModalLabel">Delete Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this role?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="modal-delete-btn">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit role dialog modal -->
<div class="modal fade" id="editRoleModal" tabindex="-1" role="dialog" aria-labelledby="editRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRoleModalLabel">Edit Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row row-cols-md-12 mb-12 text-center">
                    <div class="col themed-grid-col">
                        <div class="form-group text-left">
                            <label class="font-weight-bolder">Role Name <span class="required"></span></label>
                            <input type="text" name="role_name" id="role_name" class="form-control input-field" maxlength="20" required placeholder="Enter role's name" />
                            <div id="roleNameErrorDiv" style="display: none;" class="message"></div>
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

@endsection

@section('scripts')

<!-- Page level custom scripts -->
<script>
    const get_roles_url = {!!json_encode(config('constants.GET_ROLES_ENDPOINT')) !!};
    const create_role_url = {!!json_encode(config('constants.CREATE_ROLE_ENDPOINT')) !!};
    const delete_role_url = {!!json_encode(config('constants.DELETE_ROLE_ENDPOINT')) !!};
    const edit_role_url = {!!json_encode(config('constants.EDIT_ROLE_ENDPOINT')) !!};
</script>
<script src="{{ asset('assets/js/roles.js') }}"></script>
<script src="{{ asset('assets/js/side-notification.js') }}"></script>

@endsection