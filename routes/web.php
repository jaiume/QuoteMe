<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Nova\SuppliersController;
use App\Http\Controllers\RequestController;
use App\Http\Middleware\AttachCustomerToRequest;
use App\Http\Middleware\AuthorizeCustomer;
use App\Http\Middleware\CalculateUnreadRequests;
use App\Http\Middleware\CustomerAuthCheck;
use App\Http\Middleware\DashboardRedirect;
use HTMLMin\HTMLMin\Http\Middleware\MinifyMiddleware;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|

| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group([
    'middleware' => [
        MinifyMiddleware::class,
        AuthorizeCustomer::class,
        AttachCustomerToRequest::class,
        DashboardRedirect::class,
        CalculateUnreadRequests::class
    ],
    'as' => 'customer.'
], function () {
    Route::get('/', [CustomerController::class, 'index'])->name('home');

    Route::get('email-exists', [CustomerController::class, 'checkEmailExists'])->name('check.email');

    Route::get('customer/login', [CustomerController::class, 'login'])->name('login');
    Route::post('customer/login', [CustomerController::class, 'requestAuthLink']);

    Route::get('request', [RequestController::class, 'index'])
         ->middleware(CustomerAuthCheck::class)
         ->name('request.index');

    Route::post('request', [RequestController::class, 'store'])
         ->name('request.store');

    Route::get('request/{id}', [RequestController::class, 'show'])
         ->name('request.show');

    Route::patch('request/{id}', [RequestController::class, 'update'])
         ->middleware('auth')
         ->name('request.update');

    Route::get('request/{request_id}/response/{response_id}', [RequestController::class, 'showResponse'])
         ->name('response.show');
});

Auth::routes(['verify' => true]);

Route::get('/admin/suppliers/csv', [SuppliersController::class, 'downloadCsv'])
     ->name('suppliers.csv-download')
     ->middleware(ValidateSignature::class);
