<?php

use App\Http\Controllers\auth\ForgotpasswordController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
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
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});
