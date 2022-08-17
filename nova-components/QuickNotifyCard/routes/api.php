<?php

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Card API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your card. These routes
| are loaded by the ServiceProvider of your card. You're free to add
| as many additional routes to this file as your card may require.
|
*/

Route::get('/status', function (Request $request) {
    $supplier = Supplier::find($request->user()->id);

    if ($supplier) {
        return response()->json([
            'code' => '200',
            'message' => 'QuickNotify status',
            'status' => $supplier->quick_notify,
        ]);
    }

    return response()->json([
        'code' => '403',
        'message' => 'You haven\'t enough permissions to perform this action',
    ], 403);
});

Route::post('/toggle', function (Request $request) {
    $supplier = Supplier::find($request->user()->id);

    if ($supplier) {
        /* @var Supplier $supplier */
        $supplier->quick_notify = !$supplier->quick_notify;

        if ($supplier->save()) {
            return response()->json([
                'code' => '200',
                'message' => 'QuickNotify status',
                'status' => $supplier->quick_notify,
            ]);
        }
    }

    return response()->json([
        'code' => '403',
        'message' => 'You haven\'t enough permissions to perform this action',
    ], 403);
});
