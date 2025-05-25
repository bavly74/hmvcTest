<?php

use Illuminate\Support\Facades\Route;
use Modules\Student\Http\Controllers\StudentController;
use App\Http\Controllers\FatoorahController;
use App\Http\Controllers\PayPalController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('students', StudentController::class)->names('student');
});

    Route::post('pay',[FatoorahController::class,'pay'])->name('myfatoorah.pay');
    Route::get('callback',[FatoorahController::class,'callback'])->name('myfatoorah.callback');

    Route::get('error',[FatoorahController::class,'error'])->name('myfatoorah.error');

        Route::post('paypal/pay',[PayPalController::class,'pay'])->name('payPal.pay');
