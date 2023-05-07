<?php

use App\Http\Controllers\admin\ContractTypeController;
use App\Http\Controllers\admin\DegreeLevelController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\PayScaleController;
use App\Http\Controllers\auth\ForgotpasswordController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\auth\ResetPasswordController;
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
    Route::get('get-departments', [DepartmentController::class, 'getDepartments']);
    Route::get('get-degree_levels', [DegreeLevelController::class, 'getDegreeLevels']);
    Route::get('get-pay-scales', [PayScaleController::class, 'getPayScales']);
    Route::get('get-contract-types', [ContractTypeController::class, 'getContractTypes']);
});
