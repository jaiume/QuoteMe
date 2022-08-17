<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Quoteme\SupplierProfileTool\Http\Controllers\SupplierProfileToolController;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/
Route::post('/save', [SupplierProfileToolController::class, 'setUserData']);
Route::get('/user', [SupplierProfileToolController::class, 'getUserData']);
Route::post('/confirm-email', [SupplierProfileToolController::class, 'requestEmailVerifyMessage']);
Route::post('/confirm-phone', [SupplierProfileToolController::class, 'requestPhoneVerifyMessage']);
