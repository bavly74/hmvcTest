<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\UserController;


Route::prefix('dashboard')->middleware(['auth','verified'])->group(function () {
    Route::resource('admins', AdminController::class)->names('admin');

    Route::prefix('users')->group(function(){
        Route::get('/',[UserController::class,'index'])->name('users.index');
        Route::get('/create',[UserController::class,'create'])->name('users.create');
        Route::post('/store',[UserController::class,'store'])->name('users.store');
        Route::get('/edit/{id}',[UserController::class,'edit'])->name('users.edit');
        Route::put('/update/{id}',[UserController::class,'update'])->name('users.update');
        Route::delete('/destroy/{id}',[UserController::class,'destroy'])->name('users.destroy');

    });
});
