<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserAchievementController;

Route::post('/users/{user}/purchase', [PurchaseController::class, 'store']);
Route::get('/users/{user}/achievements', [UserAchievementController::class, 'show']);
