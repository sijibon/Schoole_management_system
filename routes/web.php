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
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RollGenerateController;
use App\Http\Controllers\RegFeeController;
use App\Http\Controllers\MonthlyFeeController;
use App\Http\Controllers\ExamFeeController;


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



Route::prefix('setup')->group(function(){
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
});

//student registrations 

Route::resource('student/registration', StudentController::class);
Route::get('student/yearSearch', [StudentController::class,'yearSearch'])->name('yearSearch');
Route::get('student/promotion/{student_id}', [StudentController::class,'promotion'])->name('promotion');
Route::post('student/promotion/{student_id}', [StudentController::class,'promotionStore'])->name('student.promotion');
Route::get('student/details/{student_id}', [StudentController::class,'details'])->name('student.details');

Route::resource('student/roll_generate', RollGenerateController::class);
Route::get('student/get', [RollGenerateController::class,'get_student'])->name('get.student');
Route::post('student/roll/store', [RollGenerateController::class,'store'])->name('roll.store');


//student registrations fee
Route::get('reg/fee/view', [RegFeeController::class,'index'])->name('student.reg.fee');
Route::get('student/reg/fee/get-student/', [RegFeeController::class,'get_student'])->name('student.reg.fee.get-student');
Route::get('student/reg/fee/payslip/', [RegFeeController::class,'paySlip'])->name('student.reg.fee.slip');

//student monthly fee
Route::get('monthly/fee/view', [MonthlyFeeController::class,'index'])->name('student.monthly.fee');
Route::get('student/monthly/fee/get-student/', [MonthlyFeeController::class,'get_student'])->name('student.monthly.fee.get-student');
Route::get('student/monthly/fee/payslip/', [MonthlyFeeController::class,'paySlip'])->name('student.monthly.fee.slip');

//student exam fee
Route::get('exam/fee/view', [ExamFeeController::class,'index'])->name('student.exam.fee');
Route::get('student/exam/fee/get-student/', [ExamFeeController::class,'get_student'])->name('student.exam.fee.get-student');
Route::get('student/exam/fee/payslip/', [ExamFeeController::class,'paySlip'])->name('student.exam.fee-slip');

});


