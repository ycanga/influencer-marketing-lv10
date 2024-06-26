<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Campaign Purchase
Route::post('/campaigns/purchase/success', [App\Http\Controllers\Api\CampaignController::class, 'purchase'])->name('api.campaign.purchase')->middleware('api.token.control');

// Weekly Report for Merchant
Route::get('/{userId}/weekly-report/{date?}', [App\Http\Controllers\HomeController::class, 'weeklyRevenue'])->name('weekly.get');

// Weekly Report for Influencer
Route::get('/{userId}/weekly-report-inf/{date?}', [App\Http\Controllers\HomeController::class, 'infWeeklyRevenue'])->name('inf.weekly.get');

// Weekly Report for Admin
Route::get('/weekly-report-admin/{date?}', [App\Http\Controllers\HomeController::class, 'adminWeeklyRevenue'])->name('admin.weekly.get');