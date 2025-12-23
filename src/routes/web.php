<?php

use Illuminate\Support\Facades\Route;
use Skygdi\Slack\Http\Controllers\SlackDashboardController;


Route::middleware(['web'])->prefix('slack_dashboard')->group(function () {
    Route::get('/', [SlackDashboardController::class, 'index'])->name('slack_dashboard');
    Route::post('/slack-toggle', [SlackDashboardController::class, 'toggleSlack'])->name('slack_dashboard.slack-toggle');
    Route::post('/inventory-toggle', [SlackDashboardController::class, 'toggleInventory'])->name('slack_dashboard.inventory-toggle');
});