<?php

use App\Http\Controllers\Api\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/supplier_check', [CustomerController::class, 'checkSupplierExistsInCategoryAreaPair']);
Route::get('/filter/categories', [CustomerController::class, 'filterCategoriesByAreaId']);
Route::get('/filter/areas', [CustomerController::class, 'filterAreasByCategoryId']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
