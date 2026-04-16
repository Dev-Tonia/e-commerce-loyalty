<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PurchaseController;

Route::post('/users/{user}/purchase', [PurchaseController::class, 'store']);
