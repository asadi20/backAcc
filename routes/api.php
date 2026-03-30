<?php

use App\Http\Controllers\Api\Accounting\Accounts\DetailAccountController;
use App\Http\Controllers\Api\Accounting\Accounts\DetailAccountTypeController;
use App\Http\Controllers\Api\Accounting\JournalEntries\JournalEntryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('accounting/accounts')->group(function () {
    Route::resource('detail-account-types', DetailAccountTypeController::class);
    Route::resource('detail-accounts', DetailAccountController::class);
});

Route::prefix('accounting/journal')->group(function(){
    Route::resource('entries', JournalEntryController::class);
});