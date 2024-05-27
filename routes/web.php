<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Payment Data
    Route::get('/payment-data', [App\Http\Controllers\PaymentDataController::class, 'index'])->name('payment.index');
    Route::post('/payment-data', [App\Http\Controllers\PaymentDataController::class, 'store'])->name('payment.store');
    Route::get('/balance-transfer', [App\Http\Controllers\BalanceTransferController::class, 'index'])->name('balance.index');
    Route::post('/balance-transfer', [App\Http\Controllers\BalanceTransferController::class, 'store'])->name('balance.store');

    // Support and Help
    Route::get('/support-and-help', [App\Http\Controllers\SupportAndHelpController::class, 'index'])->name('support.index');
    Route::post('/support-and-help', [App\Http\Controllers\SupportAndHelpController::class, 'store'])->name('support.store');
    Route::get('/support-and-help/{id}', [App\Http\Controllers\SupportAndHelpController::class, 'show'])->name('support.show');
    Route::post('/support-and-help/reply/{id}', [App\Http\Controllers\SupportAndHelpController::class, 'reply'])->name('support.reply');
    Route::get('/support-and-help/close/{id}', [App\Http\Controllers\SupportAndHelpController::class, 'close'])->name('support.close');
});

// General Routes
Route::post('/return', [App\Http\Controllers\BalanceTransferController::class, 'return'])->name('balance.return');

// Admin Routes
Route::middleware(['auth', 'role.control'])->group(function () {
    Route::get('/balance-transfer/all', [App\Http\Controllers\Admin\BalanceTransferController::class, 'index'])->name('admin.balance.index');
    Route::get('/balance-transger/approve/{id}', [App\Http\Controllers\Admin\BalanceTransferController::class, 'approve'])->name('admin.balance.approve');
    Route::get('/balance-transger/reject/{id}', [App\Http\Controllers\Admin\BalanceTransferController::class, 'reject'])->name('admin.balance.reject');
});
