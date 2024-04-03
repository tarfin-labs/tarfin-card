<?php

declare(strict_types=1);

use App\Http\Controllers\TarfinCardController;
use App\Http\Controllers\TarfinCardTransactionController;

Route::apiResource(
    name: 'tarfin-cards',
    controller: TarfinCardController::class
);

Route::apiResource(
    name: 'tarfin-cards.tarfin-card-transactions',
    controller: TarfinCardTransactionController::class
)->only([
    'index',
    'show',
    'store',
])->shallow();
