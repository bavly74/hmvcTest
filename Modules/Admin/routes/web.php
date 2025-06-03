<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\CourseController;
use Modules\Admin\Http\Controllers\PostController;
use Modules\Admin\Http\Controllers\UserController;
use Modules\Admin\Http\Controllers\CompanyController;



Route::prefix('dashboard')->middleware(['auth','verified'])->group(function () {
    Route::resource('admins', AdminController::class)->names('admin');

    //CRUD users
    Route::prefix('users')->group(function(){
        Route::get('/',[UserController::class,'index'])->name('users.index');
        Route::get('/create',[UserController::class,'create'])->name('users.create');
        Route::post('/store',[UserController::class,'store'])->name('users.store');
        Route::get('/edit/{id}',[UserController::class,'edit'])->name('users.edit');
        Route::put('/update/{id}',[UserController::class,'update'])->name('users.update');
        Route::delete('/destroy/{id}',[UserController::class,'destroy'])->name('users.destroy');
    });

    //CRUD posts
    Route::prefix('posts')->group(function(){
        Route::get('/',[PostController::class,'index'])->name('posts.index');
        Route::get('/create',[PostController::class,'create'])->name('posts.create');
        Route::post('/store',[PostController::class,'store'])->name('posts.store');
        Route::get('/edit/{id}',[PostController::class,'edit'])->name('posts.edit');
        Route::put('/update/{id}',[PostController::class,'update'])->name('posts.update');
        Route::delete('/destroy/{id}',[PostController::class,'destroy'])->name('posts.destroy');
    });

    //CRUD courses
    Route::prefix('courses')->group(function(){
        Route::get('/',[CourseController::class,'index'])->name('admin.courses.index');
        Route::get('/create',[CourseController::class,'create'])->name('courses.create');
        Route::post('/store',[CourseController::class,'store'])->name('courses.store');
        Route::get('/edit/{id}',[CourseController::class,'edit'])->name('courses.edit');
        Route::put('/update/{id}',[CourseController::class,'update'])->name('courses.update');
        Route::delete('/destroy/{id}',[CourseController::class,'destroy'])->name('courses.destroy');
    });

    //CRUD companies
    Route::prefix('companies')->group(function(){
        Route::get('/',[CompanyController::class,'index'])->name('companies.index');
        Route::get('/create',[CompanyController::class,'create'])->name('companies.create');
        Route::post('/store',[CompanyController::class,'store'])->name('companies.store');
        Route::get('/edit/{id}',[CompanyController::class,'edit'])->name('companies.edit');
        Route::put('/update/{id}',[CompanyController::class,'update'])->name('companies.update');
        Route::delete('/destroy/{id}',[CompanyController::class,'destroy'])->name('companies.destroy');
    });

});
