<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permissions\AssignPermissionToRole;
use App\Http\Requests\Permissions\CreatePermissionRequest;
use App\Http\Requests\Permissions\DeletePermissionRequest;
use App\Http\Requests\Permissions\EditPermissionRequest;
use App\Http\Requests\Permissions\GetAssignedUnassignedPermissionsRequest;
use App\Http\Requests\Permissions\GetPermissionRolesRequest;
use App\Http\Requests\Roles\CreateRoleRequest;
use App\Http\Requests\Roles\DeleteRoleRequest;
use App\Http\Requests\Roles\EditRoleRequest;
use App\Http\Requests\Roles\ShowRolePermissionsRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RolePermissionController extends Controller
{
    public function roles()
    {
        return view('main.roles');
    }

    public function permissions()
    {
        return view('main.permissions');
    }

    public function assignPermissionsToRole($id)
    {
        $role = Role::find(base64_decode($id));
        return view('main.assign-permissions-to-role')->with(['roleName' => $role->name]);
    }

    public function getRoles(Request $request)
    {
        try {
            $roles = Role::get();
            $message = 'No roles found!';
            if ($roles->isNotEmpty()) {
                $message = 'Roles fetched successfully!';
                storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
                return response()->success($roles, $message);
            }
            storeApiResponseData($request->api_request_id, $message, 404, false);
            return response()->error($message, 404);
        } catch (\Exception $e) {
            return throwException($e, 'getRoles', $request->api_request_id);
        }
    }

    public function createRole(CreateRoleRequest $request)
    {
        try {
            $role = Role::create([
                'name' => $request->name
            ]);
            storeApiResponseData($request->api_request_id, $role, 200, true);
            return response()->success($role, 'New role created successfully!');
        } catch (\Exception $e) {
            return throwException($e, 'createRole', $request->api_request_id);
        }
    }

    public function deleteRole(DeleteRoleRequest $request)
    {
        try {
            Role::where('id', $request->role_id)->delete();
            $message = 'Role deleted successfully!';
            storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
            return response()->success([], $message);
        } catch (\Exception $e) {
            return throwException($e, 'deleteRole', $request->api_request_id);
        }
    }

    public function editRole(EditRoleRequest $request)
    {
        try {
            Role::where('id', $request->role_id)->update(['name' => $request->updated_role_name]);
            $message = 'Role edited successfully!';
            storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
            return response()->success([], $message);
        } catch (\Exception $e) {
            return throwException($e, 'editRole', $request->api_request_id);
        }
    }

    // To display permissions against a specific role
    public function getRoleWithPermissions(ShowRolePermissionsRequest $request)
    {
        try {
            $role_with_permissions = Role::with('permissions:id,name,slug')->select('id', 'name')->where('id', $request->role_id)->first();
            $message = 'Role with permissions fetched successfully!';
            storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
            return response()->success($role_with_permissions, $message);
        } catch (\Exception $e) {
            return throwException($e, 'showRolePermissions', $request->api_request_id);
        }
    }

    public function getPermissions(Request $request)
    {
        try {
            $permissions = Permission::get();
            $message = 'No permissions found!';
            if ($permissions->isNotEmpty()) {
                $message = 'Permissions fetched successfully!';
                storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
                return response()->success($permissions, $message);
            }
            storeApiResponseData($request->api_request_id, $message, 404, false);
            return response()->error($message, 404);
        } catch (\Exception $e) {
            return throwException($e, 'getPermissions', $request->api_request_id);
        }
    }

    public function createPermission(CreatePermissionRequest $request)
    {
        try {
            // Convert to lowercase and replace spaces with hyphens
            $slug = Str::slug(strtolower($request->name), '-');
            $permission = Permission::create([
                'name' => $request->name,
                'slug' => $slug
            ]);
            storeApiResponseData($request->api_request_id, $permission, 200, true);
            return response()->success($permission, 'New permission created successfully!');
        } catch (\Exception $e) {
            return throwException($e, 'createPermission', $request->api_request_id);
        }
    }

    public function editPermission(EditPermissionRequest $request)
    {
        try {
            $permission = Permission::where('id', $request->permission_id)->first();
            $updated_slug = Str::slug(strtolower($request->updated_permission_name), '-');
            $permission->update([
                'name' => $request->updated_permission_name,
                'slug' => $updated_slug,
            ]);
            $message = 'Permission edited successfully!';
            storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
            return response()->success([], $message);
        } catch (\Exception $e) {
            return throwException($e, 'editPermission', $request->api_request_id);
        }
    }

    public function deletePermission(DeletePermissionRequest $request)
    {
        try {
            Permission::where('id', $request->permission_id)->delete();
            $message = 'Permission deleted successfully!';
            storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
            return response()->success([], $message);
        } catch (\Exception $e) {
            return throwException($e, 'deletePermission', $request->api_request_id);
        }
    }

    public function getPermissionWithRole(GetPermissionRolesRequest $request)
    {
        try {
            $permission_with_roles = Permission::with('roles:id,name')->select('id', 'name')->where('id', $request->permission_id)->first();
            $message = 'Permission with roles fetched successfully!';
            storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
            return response()->success($permission_with_roles, $message);
        } catch (\Exception $e) {
            return throwException($e, 'getPermissionWithRole', $request->api_request_id);
        }
    }

    public function getAssignedUnassignedPermissions(GetAssignedUnassignedPermissionsRequest $request)
    {
        try {
            $role_id = base64_decode($request->role_id);
            $role = Role::find($role_id);
            $assignedPermissions = $role->permissions()
                ->select('permissions.id', 'permissions.name')
                ->get();

            $unassignedPermissions = Permission::whereNotIn('permissions.id', $assignedPermissions->pluck('id'))
                ->select('permissions.id', 'permissions.name')
                ->get();

            $response = [
                'assigned_permissions' => $assignedPermissions,
                'unassigned_permissions' => $unassignedPermissions,
            ];

            $message = 'Assigned and unassigned permissions of a role fetched successfully!';
            storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
            return response()->success($response, $message);
        } catch (\Exception $e) {
            return throwException($e, 'getAssignedUnassignedPermissions', $request->api_request_id);
        }
    }

    public function assignPermissionToRole(AssignPermissionToRole $request)
    {
        try {
            $role = Role::find($request->role_id);
            $permission_id = $request->permission_id;
            $message = 'Permission has been assigned to the role successfully!';

            // Check if the role already has the permission
            if ($role->permissions()->where('permissions.id', $permission_id)->exists()) {
                $message = 'Permission is already assigned to the role!';
                storeApiResponseData($request->api_request_id, $message, 422, false);
                return response()->error($message, 422);
            }

            // Attach the permission to the role without detaching
            $role->permissions()->syncWithoutDetaching([$permission_id]);
            storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
            return response()->success([], $message);
        } catch (\Exception $e) {
            return throwException($e, 'assignPermissionToRole', $request->api_request_id);
        }
    }

    public function unassignPermissionFromRole(AssignPermissionToRole $request)
    {
        try {
            $role = Role::find($request->role_id);
            $permission_id = $request->permission_id;
            $message = 'Permission has been removed from the role successfully!';

            // Check if the role has the permission
            if (!$role->permissions()->where('permissions.id', $permission_id)->exists()) {
                $message = 'Permission is not assigned to the role!';
                storeApiResponseData($request->api_request_id, $message, 422, false);
                return response()->error($message, 422);
            }

            // Detach the permission from the role
            $role->permissions()->detach([$permission_id]);
            storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
            return response()->success([], $message);
        } catch (\Exception $e) {
            return throwException($e, 'unassignPermissionFromRole', $request->api_request_id);
        }
    }
}
