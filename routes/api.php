<?php

use App\Http\Controllers\ApiControllers\AuthController;
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

Route::get('/authenticated/{page}', [AuthController::class, 'checkLoggedIn']);
Route::post('/verify/{token}', [AuthController::class, 'verifyEmail'])->name('verify');

Route::post('/register', [AuthController::class, 'register'])->name('registration');
Route::post('/login', [AuthController::class, 'login'])->name('login.user');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout.user');
