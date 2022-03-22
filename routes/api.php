<?php

use App\Http\Controllers\ApiControllers\AuthController;
use App\Http\Controllers\ApiControllers\ContentController;
use App\Http\Controllers\ApiControllers\ResetPasswordController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
// 	return $request->user();
// });

Route::get('/authenticated/{page}', [AuthController::class, 'checkLoggedIn'])->name('is.authenticated');
Route::post('/verify/{token}', [AuthController::class, 'verifyEmail'])->name('verify');

Route::post('/register', [AuthController::class, 'register'])->name('registration');
Route::post('/login', [AuthController::class, 'login'])->name('login.user');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout.user');

Route::post('/reset-password', [ResetPasswordController::class, 'send'])->name('send.reset-password.email');
Route::post('/update-password', [ResetPasswordController::class, 'update'])->name('update.reset-password');

Route::get('/data', [ContentController::class, 'index'])->name('country.data')->middleware('auth:sanctum');
Route::get('/search', [ContentController::class, 'search'])->name('search.data');
