<?php

use App\Http\Controllers\OrderController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/orders/create');
});

Route::get('/orders/create', [OrderController::class, 'create']);

Route::post('/orders', [OrderController::class, 'store']);

Route::get('/schedule', [OrderController::class, 'schedule']);

Route::get('/orders', [OrderController::class, 'store']);


