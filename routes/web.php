<?php

use App\Http\Controllers\Auth\DoctorAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
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
    return view('welcome');
})->name('welcome');

Route::group(['prefix' => 'auth' , 'namespace' => 'Auth'], function () {
    Route::get('login', [UserAuthController::class,'showLoginForm'])->name('user.login');
    Route::post('login', [UserAuthController::class,'login'])->name('user.login.submit');
    Route::get('logout', [UserAuthController::class,'logout'])->middleware('auth:sanctum')->name('user.logout');
    Route::get('register', [UserAuthController::class,'showRegistrationForm'])->name('user.register');
    Route::post('register', [UserAuthController::class,'register'])->name('user.register.submit');
});

//Doctor auth
Route::group(['prefix' => 'auth/doctor/' , 'namespace' => 'Auth'], function () {
    Route::get('login', [DoctorAuthController::class, 'showLoginForm'])->name('login')->name("doctor.login");
    Route::post('login', [DoctorAuthController::class, 'login'])->name('doctor.login.submit');
    Route::get('logout', [DoctorAuthController::class, 'logout'])->middleware('auth:doctor')->name('doctor.logout');
    Route::get('register', [DoctorAuthController::class, 'showRegistrationForm'])->name('doctor.register');
    Route::post('register', [DoctorAuthController::class, 'register'])->name('doctor.register.submit');
});
