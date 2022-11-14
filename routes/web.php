<?php

namespace App\Http\Controllers;

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
    
Route::get('/', function () {
    return view('welcome');
});

Route::get('alumni-registration', [DefenceController::class, 'alumniRegistration']);
Route::post('student-alumni-request', [DefenceController::class, 'studentAlumniRequest']);

Route::middleware('auth')->group(function () {
    Route::controller(DashboardController::class)->group(function() {
        Route::get('dashboard', 'index')->name('dashboard');
    });

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('students', StudentController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('batches', BatchController::class);
    Route::resource('sessions', SessionController::class);
    Route::resource('groups', GroupController::class);
    Route::resource('defences', DefenceController::class);
    Route::resource('events', EventController::class);
    Route::resource('notices', NoticeController::class);

    Route::controller(DefenceController::class)->group(function () {
        Route::get('defence-request', 'defenceRequest');
        Route::post('defence-verification', 'defenceVerification');
    });

    Route::controller(SettingsController::class)->group(function () {
        Route::get('settings', 'index');
    });
});

require __DIR__.'/auth.php';
