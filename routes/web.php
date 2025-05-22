<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;

Route::get('/', function () {
    return view('welcome');
});

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

require __DIR__.'/auth.php';
