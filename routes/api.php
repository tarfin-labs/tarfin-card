<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarfinCardController;
use App\Http\Controllers\TarfinCardTransactionController;

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
