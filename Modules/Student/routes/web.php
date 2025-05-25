<?php


use Illuminate\Support\Facades\Route;
use Modules\Student\Http\Controllers\CourseController;
use Modules\Student\Http\Controllers\StudentController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('students', StudentController::class)->names('student');
});

Route::prefix('student')->middleware(['auth', 'verified'])->group(function(){
    Route::get('my-courses',[CourseController::class,'index'])->name('courses.index');
});

