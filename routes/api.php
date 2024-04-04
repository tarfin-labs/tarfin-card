<?php

declare(strict_types=1);

use App\Http\Controllers\TarfinCardController;
use App\Http\Controllers\TarfinCardTransactionController;
use Illuminate\Support\Facades\Route;

Route::apiResource(
    name: 'tarfin-cards',
    controller: TarfinCardController::class
)->middleware(middleware: 'auth:api');

Route::apiResource(
    name: 'tarfin-cards.tarfin-card-transactions',
    controller: TarfinCardTransactionController::class
)->only(methods: [
    'index',
    'show',
    'store',
])->shallow()
    ->middleware(middleware: 'auth:api');
