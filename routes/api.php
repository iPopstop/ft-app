<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\StatsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('check', [AuthController::class, 'check']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('admin/dashboard', [StatsController::class, 'index']);
    Route::get('admin/positions/list', [PositionController::class, 'list']);
    Route::get('admin/settings', [CompanyController::class, 'settings']);
    Route::post('admin/settings', [CompanyController::class, 'setSettings']);
    Route::post('admin/reply/{id}', [CommentController::class, 'reply']);
    Route::resource('admin/employees', EmployeeController::class);
    Route::resource('admin/coupons', CouponController::class);
    Route::resource('admin/comments', CommentController::class)->except(['update', 'store']);
    Route::resource('admin/positions', PositionController::class);
    Route::get('admin/tips/{id}', [EmployeeController::class, 'tips']);
});

