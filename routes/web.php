<?php

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\DoctorAuthController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\SpecialistController;
use App\Http\Controllers\Site\MainController;
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

//Route::get('/', function () {
//    return view('index');
//})->name('welcome');

// Main site routes
Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/index', [MainController::class, 'index'])->name('index');

Route::get('/register', function () {
    return view('user.auth.register');
});

Route::get('/forgot-password', function () {
    return view('user.auth.forgot-password');
})->name('user.forgot-password');

Route::get('/doctors', function () {
    return view('doctors');
});



Route::get('/create-reservation', function () {
    return view('create-reservation');
});

// Doctor search routes
Route::get('/doctors', [App\Http\Controllers\Site\DoctorController::class, 'search'])->name('doctors.search');
Route::get('/doctor/{id}', [App\Http\Controllers\Site\DoctorController::class, 'show'])->name('doctor.show');
Route::get('/api/doctors/{id}/appointments', [App\Http\Controllers\Site\DoctorController::class, 'getAppointments'])->name('doctor.appointments');
Route::get('/api/specialists', [App\Http\Controllers\Site\DoctorController::class, 'getSpecialists'])->name('api.specialists');
Route::get('/api/governorates', [App\Http\Controllers\Site\DoctorController::class, 'getGovernorates'])->name('api.governorates');

//User auth
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::get('login', [UserAuthController::class, 'showLoginForm'])->name('user.login');
    Route::post('login', [UserAuthController::class, 'login'])->name('user.login.submit');
    Route::get('logout', [UserAuthController::class, 'logout'])->middleware('auth:web')->name('user.logout');
    Route::get('register', [UserAuthController::class, 'showRegistrationForm'])->name('user.register');
    Route::post('register', [UserAuthController::class, 'register'])->name('user.register.submit');
});

//Doctor auth
Route::group(['prefix' => 'auth/doctor/', 'namespace' => 'Auth'], function () {
    Route::get('login', [DoctorAuthController::class, 'showLoginForm'])->name("doctor.login");
    Route::post('login', [DoctorAuthController::class, 'login'])->name('doctor.login.submit');
    Route::get('logout', [DoctorAuthController::class, 'logout'])->middleware('auth:doctor')->name('doctor.logout');
    Route::get('register', [DoctorAuthController::class, 'showRegistrationForm'])->name('doctor.register');
    Route::post('register', [DoctorAuthController::class, 'register'])->name('doctor.register.submit');
});

//Admin auth
Route::group(['prefix' => 'auth/admin/', 'namespace' => 'Auth'], function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name("admin.login")->middleware('guest:admin');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.submit')->middleware('guest:admin');
    Route::get('logout', [AdminAuthController::class, 'logout'])->middleware('auth:admin')->name('admin.logout');
    Route::get('register', [AdminAuthController::class, 'showRegistrationForm'])->name('admin.register')->middleware('guest:admin');
    Route::post('register', [AdminAuthController::class, 'register'])->name('admin.register.submit')->middleware('guest:admin');
});

//Admin activity - Comprehensive Dashboard Routes
Route::group(['prefix' => 'admin/dashboard', 'middleware' => 'auth:admin', 'as' => 'admin.'], function () {
    // Dashboard Home
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    
    // Specialists Management
    Route::get('specialists', [SpecialistController::class, 'index'])->name('specialists.index');
    Route::get('specialists/create', [SpecialistController::class, 'create'])->name('specialists.create');
    Route::post('specialists', [SpecialistController::class, 'store'])->name('specialists.store');
    Route::get('specialists/{id}/edit', [SpecialistController::class, 'showUpdateForm'])->name('specialists.edit');
    Route::put('specialists/{id}', [SpecialistController::class, 'update'])->name('specialists.update');
    Route::delete('specialists/{id}', [SpecialistController::class, 'destroy'])->name('specialists.delete');
    
    // Patients Management
    Route::get('patients', [AdminController::class, 'patients'])->name('patients');
    Route::get('patients/{id}', [AdminController::class, 'showPatient'])->name('patients.show');
    
    // Doctors Management
    Route::get('doctors', [AdminController::class, 'doctors'])->name('doctors');
    Route::get('doctors/{id}', [AdminController::class, 'showDoctor'])->name('doctors.show');
    Route::patch('doctors/{id}/toggle-status', [AdminController::class, 'toggleDoctorStatus'])->name('doctors.toggle-status');
    
    // Appointments Management
    Route::get('appointments', [AdminController::class, 'appointments'])->name('appointments');
    Route::get('appointments/{id}', [AdminController::class, 'showAppointment'])->name('appointments.show');
    Route::patch('appointments/{id}/status', [AdminController::class, 'updateAppointmentStatus'])->name('appointments.update-status');
    
    // Admin Profile
    Route::get('profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('profile', [AdminController::class, 'updateProfile'])->name('profile.update');
    Route::put('profile/password', [AdminController::class, 'changePassword'])->name('profile.password');
    
    // System Settings
    Route::get('settings', [AdminController::class, 'settings'])->name('settings');
    
    // Reports & Analytics
    Route::get('reports', [AdminController::class, 'reports'])->name('reports');
    
    // Admin Management
    Route::get('admins', [AdminController::class, 'admins'])->name('admins');
    Route::get('admins/create', [AdminController::class, 'createAdmin'])->name('admins.create');
    Route::post('admins', [AdminController::class, 'storeAdmin'])->name('admins.store');
    Route::get('admins/{id}/edit', [AdminController::class, 'editAdmin'])->name('admins.edit');
    Route::put('admins/{id}', [AdminController::class, 'updateAdmin'])->name('admins.update');
    Route::delete('admins/{id}', [AdminController::class, 'deleteAdmin'])->name('admins.delete');
});

// Legacy admin routes (for backward compatibility)
Route::group(['prefix'=>'dashboard', 'middleware'=>'auth:admin'], function () {
   Route::get('specialists', [SpecialistController::class, 'index'])->name('specialists.index');
   Route::get('add-speciality' , [SpecialistController::class , 'create'])->name('add-speciality');
   Route::post('store-speciality' , [SpecialistController::class , 'store'])->name('speciality.store');

   Route::get('speciality/edit/{id}' , [SpecialistController::class , 'showUpdateForm'])->name('speciality.edit');
   Route::post('speciality/update/{id}' , [SpecialistController::class , 'update'])->name('speciality.update');

   Route::get('speciality/delete/{id}' , [SpecialistController::class , 'destroy'])->name('speciality.delete');
});

Route::group(['prefix' => 'dashboard/doctor/', 'middleware'=>'auth:doctor'], function () {
   route::get('profile' , [DoctorController::class , 'profile'])->name('doctor.profile');
   route::get('select-specialities' , [DoctorController::class ,'addSpecialityForm'])->name('doctor.selectSpecialities');
   route::post('store-speciality' , [DoctorController::class ,'storeSpeciality'])->name('doctor.specialities.store');
   route::get('appointments' , [DoctorController::class ,'doctorAppointments'])->name('doctor.appointments');
   route::get('add-appointment' , [DoctorController::class ,'addAppointmentForm'])->name('doctor.appointments.add');
   route::post('store-appointment' , [DoctorController::class ,'storeAppointment'])->name('doctor.appointments.store');
});

// Patient Dashboard & Activities
Route::middleware('auth:web')->prefix('dashboard/patient')->name('patient.')->group(function () {
    // Dashboard Home
    Route::get('/', [PatientController::class, 'index'])->name('dashboard');
    
    // Profile Management
    Route::get('profile', [PatientController::class, 'profile'])->name('profile');
    Route::put('profile', [PatientController::class, 'updateProfile'])->name('profile.update');
    Route::get('profile/edit', [PatientController::class, 'editProfile'])->name('profile.edit');
    
    // Appointments
    Route::get('appointments', [PatientController::class, 'appointments'])->name('appointments');
    Route::get('appointments/history', [PatientController::class, 'appointmentHistory'])->name('appointments.history');
    Route::post('appointments/book', [PatientController::class, 'bookAppointment'])->name('appointments.book');
    Route::put('appointments/{appointment}/cancel', [PatientController::class, 'cancelAppointment'])->name('appointments.cancel');
    Route::put('appointments/{appointment}/reschedule', [PatientController::class, 'rescheduleAppointment'])->name('appointments.reschedule');
    
    // Medical Records
    Route::get('medical-records', [PatientController::class, 'medicalRecords'])->name('medical-records');
    Route::get('prescriptions', [PatientController::class, 'prescriptions'])->name('prescriptions');
    Route::get('lab-results', [PatientController::class, 'labResults'])->name('lab-results');
    
    // Settings
    Route::get('settings', [PatientController::class, 'settings'])->name('settings');
    Route::get('change-password', [PatientController::class, 'changePasswordForm'])->name('change-password');
    Route::put('change-password', [PatientController::class, 'updatePassword'])->name('change-password.update');
    
    // Notifications
    Route::get('notifications', [PatientController::class, 'notifications'])->name('notifications');
    Route::put('notifications/{notification}/read', [PatientController::class, 'markNotificationRead'])->name('notifications.read');
    
    // Insurance
    Route::get('insurance', [PatientController::class, 'insurance'])->name('insurance');
    Route::post('insurance', [PatientController::class, 'updateInsurance'])->name('insurance.update');
});

// Legacy patient routes (for backward compatibility)
Route::middleware('auth:web')->group(function () {
    Route::get('patient-profile', [PatientController::class, 'profile'])->name('patient.profile.legacy');
    Route::get('dashboard/patient', [PatientController::class, 'index'])->name('dashboard.patient.index');
    Route::get('patient-appointments', [PatientController::class, 'appointments'])->name('patient.appointments.legacy');
    Route::post('patient-book-appointment', [PatientController::class, 'bookAppointment'])->name('patient.book.appointment');
});

Route::get('book', [PatientController::class, 'bladeToPost']); // not use just test you well send request to post method to book

Route::group(['prefix'=> 'vezeeta', 'namespace' => 'Site'], function () {
    route::get('/' ,[MainController::class , 'index'])->name('vezeeta.index');
    route::get('/show-doctor/{id}' ,[MainController::class , 'showDoctor'])->name('vezeeta.showDoctor');
});
