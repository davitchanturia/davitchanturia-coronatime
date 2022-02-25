<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\viewController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;

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

Route::redirect('/', '/en');

Route::group(['middleware' => 'auth'], function () {
	Route::get('/{lang}', [viewController::class, 'index'])->name('home');
	Route::post('/logout', [loginController::class, 'destroy'])->name('logout');
});

Route::group(['middleware' => 'guest'], function () {
	Route::get('/{lang}/login', [loginController::class, 'index'])->name('login');
	Route::get('/{lang}/register', [RegisterController::class, 'index'])->name('register');

	Route::get('/{lang}/reset-password', [ResetPasswordController::class, 'index'])->name('reset.password');
	Route::post('/{lang}/reset-password', [ResetPasswordController::class, 'send'])->name('send.reset-password');
	Route::get('/reset-password/{token}', [ResetPasswordController::class, 'verify'])->name('password.reset');
	Route::put('/{lang}/update-password', [ResetPasswordController::class, 'update'])->name('update.password');
});
Route::get('/{lang}/send-email', [RegisterController::class, 'show'])->name('send.email');

Route::get('/verify/{token}', [RegisterController::class, 'verify'])->name('verify.email');
