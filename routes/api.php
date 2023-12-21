<?php

use App\Http\Controllers\admin\ContractTypeController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\DegreeLevelController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\EmployeeController;
use App\Http\Controllers\admin\PayScaleController;
use App\Http\Controllers\admin\RolePermissionController;
use App\Http\Controllers\auth\ForgotpasswordController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\auth\ResetPasswordController;
use App\Http\Controllers\employee\LeaveController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->middleware(['storeApiRequestData'])->group(function () {
    Route::post('login', [LoginController::class, 'loginApi']);
    Route::post('send-reset-link-mail', [ForgotpasswordController::class, 'sendResetLinkEmail']);
    Route::post('reset-password', [ResetPasswordController::class, 'resetPasswordApi']);
    Route::get('logout', [LogoutController::class, 'logoutApi'])->middleware('auth:api');
});

Route::middleware(['storeApiRequestData', 'auth:api'])->group(function () {

    // dashboard routes
    Route::get('get-dashboard-data', [DashboardController::class, 'getDashboardData']);

    // department routes
    Route::get('get-departments', [DepartmentController::class, 'getDepartments']);

    // degree-level routes
    Route::get('get-degree_levels', [DegreeLevelController::class, 'getDegreeLevels']);

    // pay-scale routes
    Route::get('get-pay-scales', [PayScaleController::class, 'getPayScales']);

    // contract-type routes
    Route::get('get-contract-types', [ContractTypeController::class, 'getContractTypes']);

    // employee routes
    Route::post('register-employee', [EmployeeController::class, 'registerEmployeeApi']);
    Route::get('get-employees', [EmployeeController::class, 'getEmployees']);
    Route::post('get-employee-details', [EmployeeController::class, 'getEmployeeDetailsApi']);

    // profile routes
    Route::get('get-profile-details', [EmployeeController::class, 'getProfileDetailsApi']);
    Route::post('change-password', [DashboardController::class, 'changePassword']);

    // Role routes
    Route::get('get-roles', [RolePermissionController::class, 'getRoles']);
    Route::post('create-role', [RolePermissionController::class, 'createRole']);
    Route::post('delete-role', [RolePermissionController::class, 'deleteRole']);
    Route::post('edit-role', [RolePermissionController::class, 'editRole']);
    Route::post('get-role-with-permissions', [RolePermissionController::class, 'getRoleWithPermissions']);

    // Permission routes
    Route::get('get-permissions', [RolePermissionController::class, 'getPermissions']);
    Route::post('create-permission', [RolePermissionController::class, 'createPermission']);
    Route::post('delete-permission', [RolePermissionController::class, 'deletePermission']);
    Route::post('edit-permission', [RolePermissionController::class, 'editPermission']);
    Route::post('get-permission-with-roles', [RolePermissionController::class, 'getPermissionWithRole']);
    Route::post('get-assigned-unassigned-permissions', [RolePermissionController::class, 'getAssignedUnassignedPermissions']);
    Route::post('assign-permission-to-role', [RolePermissionController::class, 'assignPermissionToRole']);
    Route::post('unassign-permission-from-role', [RolePermissionController::class, 'unassignPermissionFromRole']);

    // Employee side routes
    Route::get('get-leave-types', [LeaveController::class, 'getLeaveTypes']);
    Route::post('apply-leave', [LeaveController::class,'applyLeave']);
});