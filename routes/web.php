<?php

use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\EmployeeController;
use App\Http\Controllers\auth\ForgotpasswordController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\ResetPasswordController;
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
    Route::get('dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('employees', [EmployeeController::class, 'employees'])->name('employees');
    Route::get('departments', [DepartmentController::class, 'departments'])->name('departments');
    Route::get('register-employee', [EmployeeController::class, 'registerEmployee'])->name('register-employee');
});
