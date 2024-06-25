<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Payment Data
    Route::get('/payment-data', [App\Http\Controllers\PaymentDataController::class, 'index'])->name('payment.index');
    Route::post('/payment-data', [App\Http\Controllers\PaymentDataController::class, 'store'])->name('payment.store');
    Route::get('/balance-transfer', [App\Http\Controllers\BalanceTransferController::class, 'index'])->name('balance.index');
    Route::post('/balance-transfer', [App\Http\Controllers\BalanceTransferController::class, 'store'])->name('balance.store');

    // Money Demand
    Route::get('/money-demand', [App\Http\Controllers\MoneyDemandController::class, 'index'])->name('demand.index');

    // Support and Help
    Route::get('/support-and-help', [App\Http\Controllers\SupportAndHelpController::class, 'index'])->name('support.index');
    Route::post('/support-and-help', [App\Http\Controllers\SupportAndHelpController::class, 'store'])->name('support.store');
    Route::get('/support-and-help/{id}', [App\Http\Controllers\SupportAndHelpController::class, 'show'])->name('support.show');
    Route::post('/support-and-help/reply/{id}', [App\Http\Controllers\SupportAndHelpController::class, 'reply'])->name('support.reply');
    Route::get('/support-and-help/close/{id}', [App\Http\Controllers\SupportAndHelpController::class, 'close'])->name('support.close');

    // Money Demand
    Route::post('/money-demand', [App\Http\Controllers\MoneyDemandController::class, 'store'])->name('demand.store');

    // Campaigns
    Route::get('/campaigns', [App\Http\Controllers\CampaignController::class, 'index'])->name('merchant.campaign.index');
    Route::get('/campaigns/all', [App\Http\Controllers\CampaignController::class, 'all'])->name('merchant.campaign.all');

    Route::get('/return-request', [App\Http\Controllers\BalanceTransferController::class, 'returnRequest'])->name('returnRequest');

    // User Profile
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/disable', [App\Http\Controllers\ProfileController::class, 'disable'])->name('profile.disable');
    Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // Refresh API Key
    Route::get('/profile/refresh-api-key', [App\Http\Controllers\ProfileController::class, 'refreshApiKey'])->name('profile.refreshApiKey');
});

// General Routes
Route::post('/return', [App\Http\Controllers\BalanceTransferController::class, 'return'])->name('balance.return');

// Referance Routes
Route::get('/ref/{key}/{campaign}', [App\Http\Controllers\ReferanceController::class, 'index'])->name('referance.index');

// Admin Routes
Route::middleware(['auth', 'role.control'])->group(function () {
    // Balance Transfer
    Route::get('/balance-transfer/all', [App\Http\Controllers\Admin\BalanceTransferController::class, 'index'])->name('admin.balance.index');
    Route::get('/balance-transger/approve/{id}', [App\Http\Controllers\Admin\BalanceTransferController::class, 'approve'])->name('admin.balance.approve');
    Route::get('/balance-transger/reject/{id}', [App\Http\Controllers\Admin\BalanceTransferController::class, 'reject'])->name('admin.balance.reject');

    // Money Demand
    Route::get('/money-demand/reject/{id}', [App\Http\Controllers\Admin\MoneyDemandController::class, 'reject'])->name('admin.demand.reject');
    Route::get('/money-demand/approve/{id}', [App\Http\Controllers\Admin\MoneyDemandController::class, 'approve'])->name('admin.demand.approve');

    // Campaigns
    Route::get('/campaigns/approve/{id}', [App\Http\Controllers\Admin\CampaignController::class, 'approve'])->name('admin.campaign.approve');
    Route::get('/campaigns/reject/{id}', [App\Http\Controllers\Admin\CampaignController::class, 'reject'])->name('admin.campaign.reject');

    // Settings
    Route::get('/settings', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('admin.settings.index');
    Route::post('/settings', [App\Http\Controllers\Admin\SettingsController::class, 'store'])->name('admin.settings.store');
    Route::post('/settings/pos', [App\Http\Controllers\Admin\SettingsController::class, 'pos'])->name('admin.settings.pos');

    // Users
    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.user.index');
    Route::get('/users/{id}/block', [App\Http\Controllers\Admin\UserController::class, 'block'])->name('admin.user.block');
    Route::get('/users/{id}/unblock', [App\Http\Controllers\Admin\UserController::class, 'unblock'])->name('admin.user.unblock');
    Route::get('/users/{id}/role-update', [App\Http\Controllers\Admin\UserController::class, 'updateRole'])->name('admin.user.role');
    Route::get('/users/{id}/delete', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.user.delete');
    Route::get('/users/{id}/show', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('admin.user.show');
    Route::post('/users/{id}/update', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.user.update');
});

// Merchant Routes
Route::middleware(['auth', 'merchant.control'])->group(function () {
    // Campaigns
    Route::post('/campaigns/create', [App\Http\Controllers\CampaignController::class, 'store'])->name('merchant.campaign.store');
    Route::get('/campaigns/delete/{id}', [App\Http\Controllers\CampaignController::class, 'delete'])->name('merchant.campaign.delete');

    // Integration
    Route::get('/integration', [App\Http\Controllers\IntegrationController::class, 'index'])->name('merchant.integration.index');
});

// User Routes
Route::middleware(['auth', 'user.control'])->group(function () {
    // Campaigns
    Route::get('/campaigns/{id}/subscribe', [App\Http\Controllers\CampaignController::class, 'subscribe'])->name('user.campaign.subscribe');
    Route::get('/campaigns/{id}/unsubscribe', [App\Http\Controllers\CampaignController::class, 'unsubscribe'])->name('user.campaign.unsubscribe');
});
