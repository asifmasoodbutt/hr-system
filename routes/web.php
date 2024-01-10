<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\EmployeeController;
use App\Http\Controllers\admin\EventController;
use App\Http\Controllers\admin\RolePermissionController;
use App\Http\Controllers\auth\ForgotpasswordController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\ResetPasswordController;
use App\Http\Controllers\employee\LeaveController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return (!session()->has('logged_in_user')) ? redirect('/login') : redirect('/dashboard');
});

Route::get('login', [LoginController::class, 'login'])->name('login')->middleware('checkNotAuthenticated');
Route::get('forget-password', [ForgotpasswordController::class, 'forgotPassword'])->name('forgotPassword');
Route::get('reset-password/{token}/{email}', [ResetPasswordController::class, 'resetPassword'])->name('resetPassword');

Route::group(['middleware' => ['checkLogin']], function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('checkScreenPermission:view-admin-dashboard-screen');
    Route::get('employees', [EmployeeController::class, 'employees'])->name('employees')->middleware('checkScreenPermission:view-employees-screen');
    Route::get('departments', [DepartmentController::class, 'departments'])->name('departments')->middleware('checkScreenPermission:view-departments-screen');
    Route::get('register-employee', [EmployeeController::class, 'registerEmployee'])->name('register-employee')->middleware('checkScreenPermission:view-register-employee-screen');
    Route::get('employee-details/{id}', [EmployeeController::class, 'employeeDetails'])->name('employee-details')->middleware('checkScreenPermission:view-employee-details-screen');
    Route::get('profile-details', [EmployeeController::class, 'getProfileDetails'])->name('profile-details')->middleware('checkScreenPermission:view-profile-screen');
    Route::get('change-password', [EmployeeController::class, 'changePassword'])->name('change-password')->middleware('checkScreenPermission:view-change-password-screen');

    // Role and Permissions
    Route::get('roles', [RolePermissionController::class, 'roles'])->name('roles');
    Route::get('permissions', [RolePermissionController::class, 'permissions'])->name('permissions');
    Route::get('assign-permissions-to-role/{id}', [RolePermissionController::class, 'assignPermissionsToRole'])->name('assign-permissions-to-role');
    
    // Employee Web Page Routes

    // Leave Routes
    Route::get('employee-leave-requests', [LeaveController::class, 'employeeLeaveRequests'])->name('employee-leave-requests');
    Route::get('apply-leave-request', [LeaveController::class, 'applyLeaveRequest'])->name('apply-leave-request');

    // Event Routes
    Route::get('employee/events', [\App\Http\Controllers\employee\EventController::class, 'events'])->name('employee-events');
    Route::get('employee/participated-events', [\App\Http\Controllers\employee\EventController::class, 'participatedEvents'])->name('participated-events');

    // Admin Web Page Routes

    // Leave Routes
    Route::get('leave-requests', [\App\Http\Controllers\admin\LeaveController::class, 'getLeaveRequests'])->name('leave-requests');

    // Event Routes
    Route::get('events', [EventController::class, 'events'])->name('events');
});
Route::get('forbidden', [DashboardController::class, 'forbidden'])->name('forbidden');