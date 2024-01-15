<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RoutaeServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('paytest', [PaymentController::class, 'newPayment']);



Route::post('log_test', [PaymentController::class, 'logPayment']);

Route::match(['GET', 'POST'], 'payment/kpay/{id}', [PaymentController::class, 'kpayAck']);

Route::post('/initiate_permit_payment', [PaymentController::class, 'initiate_permit_payment']);

Route::match(['GET', 'POST'], '/kpay_call_back', [PaymentController::class, 'kpay_call_back']);

Route::get('check_transaction', [PaymentController::class, 'check_transaction'])->name('check_transaction');

Route::get('test_status/{refid}', [PaymentController::class, 'test_status']);


