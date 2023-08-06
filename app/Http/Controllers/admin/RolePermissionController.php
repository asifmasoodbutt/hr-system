<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Roles\CreateRoleRequest;
use App\Http\Requests\Roles\DeleteRoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public function rolesPermissions()
    {
        return view('main.roles-permissions');
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
}
