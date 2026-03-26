<?php

use App\Http\Controllers\Api\Accounting\Accounts\DetailAccountTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('accounting')->group(function () {
    Route::resource('detail-account-types', DetailAccountTypeController::class);
});