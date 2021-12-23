<?php

use App\Http\Controllers\loginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\viewController;
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

Route::get('/', [viewController::class, 'index'])->name('home')->middleware('auth');

Route::group(['middleware' => 'guest'], function () {
	Route::get('/login', [loginController::class, 'index'])->name('login');
	Route::get('/register', [RegisterController::class, 'index'])->name('register');
	Route::get('/resetpassword', [ResetPasswordController::class, 'index'])->name('reset.password');
});
