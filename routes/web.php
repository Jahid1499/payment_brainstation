<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\MockController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CallbackController;

Route::post('/mock-response', [MockController::class, 'getResponse']);
Route::post('/make-payment', [PaymentController::class, 'makePayment']);
Route::post('/callback', [CallbackController::class, 'updateTransaction']);
