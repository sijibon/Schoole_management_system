<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\YearController;
use App\Http\Controllers\StudentGroupController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\FeeCategoryController;
use App\Http\Controllers\FeeAmountController;
use App\Http\Controllers\ExamTypeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\AssignSubjectController;
use App\Http\Controllers\DesignationController;


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
    return view('auth.login');
});

Auth::routes();
Route::group(['middleware'=>'auth'], function(){
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::group(['middleware'=>'test'], function(){
        Route::prefix('users')->group(function(){
            Route::get('/view',[UserController::class,'index'])->name('users.view');
            Route::get('/create',[UserController::class,'create'])->name('users.create');
            Route::post('/store',[UserController::class,'store'])->name('users.store');
            Route::get('/edit/{id}',[UserController::class,'edit'])->name('users.edit');
            Route::post('/update/{id}',[UserController::class,'update'])->name('users.update');
            Route::get('/delete/{id}',[UserController::class,'delete'])->name('users.delete');
        });
    });
    
    Route::prefix('profiles')->group(function(){
        Route::get('/view',[ProfileController::class,'index'])->name('profiles.view');
        Route::get('/edit/{id}',[ProfileController::class,'edit'])->name('profiles.edit');
        Route::post('/update/{id}',[ProfileController::class,'update'])->name('profiles.update');
        Route::get('/cpassword',[ProfileController::class,'cpassword'])->name('profiles.cpassword');
        Route::post('/change/password',[ProfileController::class,'changePassword'])->name('profiles.change.password');
    });

});

Route::resource('student/class', StudentClassController::class);
Route::resource('student/year', YearController::class);
Route::resource('student/group', StudentGroupController::class);
Route::resource('student/shift', ShiftController::class);
Route::resource('student/fee', FeeCategoryController::class);
Route::resource('student/fee_amount', FeeAmountController::class);
Route::resource('student/examType', ExamTypeController::class);
Route::resource('student/subject', SubjectController::class);
Route::resource('student/assignSubject', AssignSubjectController::class);
Route::resource('student/designation', DesignationController::class);


