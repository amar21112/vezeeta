<?php

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\DoctorAuthController;
use App\Http\Controllers\Dashboard\SpecialistController;
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
    return view('index');
})->name('welcome');

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
});

Route::get('/doctors', function () {
    return view('doctors');
});

Route::get('/doctor/{id}', function ($id) {
    return view('doctor-profile', ['doctorId' => $id]);
});

Route::get('/create-reservation', function () {
    return view('create-reservation');
});

//User auth
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::get('login', [UserAuthController::class, 'showLoginForm'])->name('user.login');
    Route::post('login', [UserAuthController::class, 'login'])->name('user.login.submit');
    Route::get('logout', [UserAuthController::class, 'logout'])->middleware('auth:sanctum')->name('user.logout');
    Route::get('register', [UserAuthController::class, 'showRegistrationForm'])->name('user.register');
    Route::post('register', [UserAuthController::class, 'register'])->name('user.register.submit');
});

//Doctor auth
Route::group(['prefix' => 'auth/doctor/', 'namespace' => 'Auth'], function () {
    Route::get('login', [DoctorAuthController::class, 'showLoginForm'])->name('login')->name("doctor.login");
    Route::post('login', [DoctorAuthController::class, 'login'])->name('doctor.login.submit');
    Route::get('logout', [DoctorAuthController::class, 'logout'])->middleware('auth:doctor')->name('doctor.logout');
    Route::get('register', [DoctorAuthController::class, 'showRegistrationForm'])->name('doctor.register');
    Route::post('register', [DoctorAuthController::class, 'register'])->name('doctor.register.submit');
});

//Admin auth
Route::group(['prefix' => 'auth/admin/', 'namespace' => 'Auth'], function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login')->name("admin.login");
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::get('logout', [AdminAuthController::class, 'logout'])->middleware('auth:admin')->name('admin.logout');
    Route::get('register', [AdminAuthController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('register', [AdminAuthController::class, 'register'])->name('admin.register.submit');
});

//Admin activity
Route::group(['prefix'=>'dashboard', 'middleware'=>'auth:admin'], function () {
   Route::get('specialists', [SpecialistController::class, 'index'])->name('specialists.index');
   Route::get('add-speciality' , [SpecialistController::class , 'create'])->name('add-speciality');
   Route::post('store-speciality' , [SpecialistController::class , 'store'])->name('speciality.store');

   Route::get('speciality/edit/{id}' , [SpecialistController::class , 'showUpdateForm'])->name('speciality.edit');
   Route::post('speciality/update/{id}' , [SpecialistController::class , 'update'])->name('speciality.update');

   Route::get('speciality/delete/{id}' , [SpecialistController::class , 'destroy'])->name('speciality.delete');
});
