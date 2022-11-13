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

    Route::controller(SettingsController::class)->group(function () {
        Route::get('settings', 'index');
    });
});

require __DIR__.'/auth.php';
