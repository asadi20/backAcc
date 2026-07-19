<?php

use App\Http\Controllers\Api\Accounting\Accounts\ChartOfAccountController;
use App\Http\Controllers\Api\Accounting\Accounts\CoaDetailTypeController;
use App\Http\Controllers\Api\Accounting\Accounts\DetailAccountController;
use App\Http\Controllers\Api\Accounting\Accounts\DetailAccountTypeController;
use App\Http\Controllers\Api\Accounting\JournalEntries\JournalEntryController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\RBAC\PermissionController;
use App\Http\Controllers\Api\RBAC\RoleController;
use App\Http\Controllers\Api\RBAC\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'show']);
    Route::get('/dash_stats', [DashboardController::class, 'stats']);

    Route::prefix('accounting/accounts')->group(function () {
        Route::resource('detail-account-types', DetailAccountTypeController::class);
        Route::resource('detail-accounts', DetailAccountController::class);
        //Route::get('sub-ledgers/detail-accounts',[DetailAccountController::class,'getAllSubWithTypeLinks']);
        Route::get('sub-ledgers/{subLedger}/detail-accounts', [DetailAccountController::class, 'getBySubLedger']);
        Route::get('sub-ledgers', [ChartOfAccountController::class, 'getAllSubLedger']);
        // links between sub ledger and detailAccounts
        Route::resource('/sub-ledgers/detail-accounts', CoaDetailTypeController::class);
    });

    Route::prefix('accounting/journal')->group(function () {
        Route::resource('entries', JournalEntryController::class);
    });

    Route::prefix('rbac')->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('users', UserController::class);
        Route::get('/users/{id}/roles', [UserController::class, 'getRolesByUserId']);
        Route::get('/role/{id}/permissions', [RoleController::class, 'getRolePermsByRoleId']);
    });
});

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});
