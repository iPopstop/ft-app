<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\TipController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('{any}', [MainController::class, 'index'])->where('any', '^(?!(api|admin)).*$');
Route::get('admin{any?}', [MainController::class, 'admin'])->where('any', '^(?!(api)).*$');

Route::post('send', [TipController::class, 'send']);
Route::post('comment', [CommentController::class, 'store']);

