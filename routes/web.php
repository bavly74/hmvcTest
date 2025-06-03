<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\FatoorahController;

use Illuminate\Support\Facades\DB;

Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('/addFile',function(){
    return view('addFile') ;
})->name('addFile');
Route::post('/storeFile',[HomeController::class,'storeFile'])->name('storeFile');

// Query Builder Joins /////
Route::get('/queryBuilderJoinInner',function(){
    $usersPosts = DB::table('users')
    ->join('posts','users.id','=','posts.created_by')
    ->select('users.name','posts.title') // users.* // posts.*  (return all columns)
    ->get() ;
    dd($usersPosts) ;
})->name('queryBuilderJoinInner');

Route::get('/queryBuilderJoinRight',function(){
    $usersPosts = DB::table('posts')
    ->join('users','users.id','=','posts.created_by')
    ->select('posts.title','users.name') // users.* // posts.*  (return all columns)
    ->get() ;
    dd($usersPosts) ;
})->name('queryBuilderJoinRight');
// End Query Builder Joins /////

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
    Route::get('/apply/{id}',[HomeController::class,'apply'])->name('course.apply') ;
    Route::get('/applyForCourse/{id}',[HomeController::class,'applyForCourse'])->name('course.applyForCourse') ;

    Route::get('fatoorah/pay',[FatoorahController::class,'pay'])->name('myfatoorah.pay');
    Route::get('paypal/pay',[\App\Http\Controllers\PayPalController::class,'pay'])->name('paypal.pay');


    Route::get('myfatoorah-callback',function(){return "done";})->name('myfatoorah.callback');
    Route::get('myfatoorah-error',function(){return "error";})->name('myfatoorah.error');
});


require __DIR__.'/auth.php';
