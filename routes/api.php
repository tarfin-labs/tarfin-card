<?php

declare(strict_types=1);

use App\Http\Controllers\TarfinCardController;
use App\Http\Controllers\TarfinCardTransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

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
