<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\FatoorahController;
use App\Mail\SendMail;
use Illuminate\Http\Request;
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


// Send Mail Text/////
Route::get('/send-mail-text',function(){
    return view('send-mail-text') ;
}) ;

Route::post('send-mail',function(Request $request){
    Mail::raw($request->message, function ($message) use ($request) {
        $message->from('john@johndoe.com', 'John Doe');
        $message->sender('john@johndoe.com', 'John Doe');
        $message->to($request->email);
        $message->subject('Laravel Test Mail');
        // $message->cc('john@johndoe.com', 'John Doe');
        // $message->bcc('john@johndoe.com', 'John Doe');
        // $message->replyTo('john@johndoe.com', 'John Doe');
        // $message->priority(3);
        // $message->attach('pathToFile');
    });

    dd('Email Sent !') ;
})->name('send-mail.text') ;
// End Send Mail Text/////


// Send Mail HTML View/////
Route::get('/send-mail-view',function(){
    return view('send-mail-view') ;
}) ;

Route::post('/send-mail-view',function(Request $request){
    $data = collect($request->all());
    //   return $data = $request->all();

    Mail::to($data['email'])->send(new SendMail($data)) ;
    dd('Email Sent !') ;
})->name('send-mail.view') ;
// End Send Mail HTML View/////



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
