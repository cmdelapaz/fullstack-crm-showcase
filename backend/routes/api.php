<?php

use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\LeadConversionController;
use App\Http\Controllers\Api\PaymentController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function (): void {
    Route::get('/dashboard', DashboardController::class);

    Route::post(
        '/leads/{lead}/convert',
        LeadConversionController::class
    );

    Route::post(
        '/invoices/{invoice}/payments',
        [PaymentController::class, 'store']
    );
});
