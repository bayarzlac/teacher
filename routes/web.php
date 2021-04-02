<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\TeacherAuthController;

use App\Http\Controllers\Teacher\TeacherController;

use App\Http\Controllers\Teacher\TeachersController;
use App\Http\Controllers\Teacher\StudentsController;

use App\Http\Controllers\Teacher\HicheelController;
use App\Http\Controllers\Teacher\AguulgaController;
use App\Http\Controllers\Teacher\DaalgavarController;

use App\Http\Controllers\Teacher\HuvaariController;
use App\Http\Controllers\Teacher\IrtsController;
use App\Http\Controllers\Teacher\MergejilController;
use App\Http\Controllers\Teacher\MergejilBagshController;
use App\Http\Controllers\Teacher\TenhimController;
use App\Http\Controllers\Teacher\SettingsController;
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

Auth::routes();

/****************************************************************************/
/********************************** TEACHER *********************************/
/****************************************************************************/

// Teacher Login
Route::get('teacher', [TeacherAuthController::class, 'teacherGet'])->name('teacherLogin');
Route::get('teacher/login', [TeacherAuthController::class, 'teacherGetLogin'])->name('teacherLogin');
Route::post('teacher/login', [TeacherAuthController::class, 'teacherLogin'])->name('teacherLoginPost');
Route::get('teacher/logout', [TeacherAuthController::class, 'teacherLogout'])->name('logout');

Route::group(['prefix' => 'teacher','middleware' => 'teacherauth'], function () {
	// teacher Dashboard
	Route::get('dashboard',[TeacherController::class, 'dashboard'])->name('teacher-dashboard');	

	// Hicheel
	Route::get('hicheel',[HicheelController::class, 'index'])->name('teacher-hicheel');
	Route::get('hicheel/add',[HicheelController::class, 'add'])->name('teacher-hicheel-add');
	Route::get('hicheel/edit/{id}',[HicheelController::class, 'edit'])->name('hicheel-edit');

	Route::post('hicheel/add',[HicheelController::class, 'store'])->name('teacher-hicheel-save');
	Route::post('hicheel/edit/{id}',[HicheelController::class, 'update'])->name('teacher-hicheel-edit');
	Route::post('hicheel/delete/',[HicheelController::class, 'delete'])->name('teacher-hicheel-delete-ajax');

	Route::delete('hicheel/delete/{id}',[HicheelController::class, 'destroy'])->name('teacher-hicheel-delete');

	// Students
	Route::get('students',[StudentsController::class, 'index'])->name('teacher-students');
	Route::get('students/add',[StudentsController::class, 'add'])->name('teacher-students-add');
	Route::get('students/edit/{id}',[StudentsController::class, 'edit'])->name('students-edit');

	Route::post('students/add',[StudentsController::class, 'store'])->name('teacher-students-save');
	Route::post('students/edit/{id}',[StudentsController::class, 'update'])->name('teacher-students-edit');
	Route::post('students/delete/',[StudentsController::class, 'delete'])->name('teacher-students-delete-ajax');
	
	// Huvaari
	Route::get('huvaari',[HuvaariController::class, 'index'])->name('teacher-huvaari');
	Route::get('huvaari/bagsh/{bagshId}',[HuvaariController::class, 'bagsh'])->name('teacher-huvaari-bagsh');

	// irts, yavtsiin dun
	Route::get('irts', [IrtsController::class, 'index'])->name('teacher-irts');
    Route::post('irts', [IrtsController::class, 'save'])->name('teacher-irts-save');

	// Bagshiin hicheel
	Route::get('hicheel', [HicheelController::class, 'index'])->name('teacher-hicheel');
	
	Route::get('aguulga/{id}', [AguulgaController::class, 'index'])->name('teacher-aguulga');
	Route::get('aguulga/add/{id}', [AguulgaController::class, 'add'])->name('teacher-aguulga-add');
	Route::get('aguulga/edit/{id}', [AguulgaController::class, 'edit'])->name('aguulga-edit');

	Route::post('aguulga/add', [AguulgaController::class, 'store'])->name('teacher-aguulga-save');
	Route::post('aguulga/edit/{id}', [AguulgaController::class, 'update'])->name('teacher-aguulga-update');
	Route::post('aguulga/delete/', [AguulgaController::class, 'delete'])->name('teacher-aguulga-delete-ajax');

	Route::delete('aguulga/delete/{id}', [AguulgaController::class, 'destroy'])->name('teacher-aguulga-delete');

	Route::get('daalgavar/{id}', [DaalgavarController::class, 'index'])->name('teacher-daalgavar');
	Route::get('daalgavar/add/{id}', [DaalgavarController::class, 'add'])->name('teacher-daalgavar-add');

	Route::post('daalgavar/add', [DaalgavarController::class, 'store'])->name('teacher-daalgavar-save');

	// Settings
	Route::get('settings',[SettingsController::class, 'index'])->name('teacher-settings');
	Route::get('settings/password',[SettingsController::class, 'password'])->name('teacher-settings-password');
	Route::get('settings/huvaari',[SettingsController::class, 'huvaari'])->name('teacher-settings-huvaari');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
