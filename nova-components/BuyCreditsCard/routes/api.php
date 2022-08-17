<?php

use Illuminate\Support\Facades\Route;
use Quoteme\BuyCreditsCard\Http\Controllers\BuyCreditsCardController;

Route::post('/buy', [BuyCreditsCardController::class, 'buy']);
Route::get('/confirm', [BuyCreditsCardController::class, 'confirm'])->name('payment.confirm');
