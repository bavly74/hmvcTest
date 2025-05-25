<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\FatoorahController;
use App\Http\Controllers\MyFatoorahController;
Route::get('/',[HomeController::class,'index']);

Route::get('/dashboard', function () {
    if (! (Gate::allows('is_admin') || Gate::allows('is_user'))) {
        abort(403);
    }
    return view('admin::index');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/student', function () {
    if(Gate::allows('is_student')) {
    return view('student::index');
    }else {
        abort(403) ;
    }
})->middleware(['auth', 'verified'])->name('student');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('course')->middleware('auth','can:is_student')->group(function(){
    Route::post('/apply/{id}',[HomeController::class,'applyForCourse'])->name('course.apply') ;
    // Route::get('myfatoorah-checkout',[MyFatoorahController::class,'checkout'])->name('myfatoorah.checkout');
    Route::get('pay',[FatoorahController::class,'pay'])->name('myfatoorah.pay');


    Route::get('myfatoorah-callback',function(){return "done";})->name('myfatoorah.callback');
    Route::get('myfatoorah-error',function(){return "error";})->name('myfatoorah.error');
});


require __DIR__.'/auth.php';
