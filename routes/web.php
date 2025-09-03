<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {

    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    $payment_intents = \Stripe\PaymentIntent::all();

    return Inertia::render('Dashboard', [
        'payments' => $payment_intents['data']
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/pay-legal-fees', [\App\Http\Controllers\PaymentController::class, 'showCreateCustomerForm']);
Route::post('/create-customer', [\App\Http\Controllers\PaymentController::class, 'payLegalFees']);
Route::get('/payment-form/{customer_id}', [\App\Http\Controllers\PaymentController::class, 'showPaymentForm']);
Route::post('/payments/{customer}', [\App\Http\Controllers\PaymentController::class, 'createPaymentIntent']);
Route::get('/payments/success', fn() => inertia('Success'))->name('payments.success');
Route::get('/payments/confirmmicrodeposits', fn() => inertia('ConfirmDeposits'))->name('payments.confirm');





require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
