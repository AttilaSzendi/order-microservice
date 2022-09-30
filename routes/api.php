<?php

use App\Http\Controllers\Order\OrderIndexController;
use App\Http\Controllers\Order\OrderStoreController;
use App\Http\Controllers\Order\OrderUpdateController;
use Illuminate\Support\Facades\Route;

Route::prefix('/orders')
    ->group(function () {
        Route::post('/index', OrderIndexController::class) // this is why I don't understand the concept of only post actions.
            ->name('order-index');

        Route::post('/', OrderStoreController::class)
            ->name('order-store');

        Route::post('/{order}', OrderUpdateController::class)
            ->name('order-update');
    });
