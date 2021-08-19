<?php

use App\Http\Controllers\TarfinCardController;
use App\Http\Controllers\TarfinCardTransactionController;

Route::apiResource('tarfin-cards', TarfinCardController::class);
Route::apiResource('tarfin-cards.tarfin-card-transactions', TarfinCardTransactionController::class)
    ->only(['index', 'show', 'store'])
    ->shallow();
