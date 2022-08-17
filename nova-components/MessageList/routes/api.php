<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Quoteme\MessageList\Http\Controllers\MessageListController;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. You're free to add
| as many additional routes to this file as your tool may require.
|
*/

Route::get('/request/{roomId}/messages', [MessageListController::class, 'getMessages'])->name('messages');
Route::get('/request/{roomId}/amounts', [MessageListController::class, 'getAmounts'])->name('amounts');
Route::get('/request/{roomId}/quick_contact', [MessageListController::class, 'getQuickContact']);

Route::post('/request/{roomId}/reply', [MessageListController::class, 'postReply'])->name('reply');
Route::post('/request/{roomId}/quick_contact', [MessageListController::class, 'postQuickContact'])->name('reply');
