<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TarfinCardTransactionCreateRequest;
use App\Http\Requests\TarfinCardTransactionViewAnyRequest;
use App\Http\Requests\TarfinCardTransactionViewRequest;
use App\Http\Resources\TarfinCardTransactionResource;
use App\Jobs\ProcessTarfinCardTransactionJob;
use App\Models\TarfinCard;
use App\Models\TarfinCardTransaction;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TarfinCardTransactionController extends Controller
{
    /**
     * Display a listing of the TarfinCardTransaction for the given TarfinCard.
     */
    public function index(TarfinCardTransactionViewAnyRequest $request, TarfinCard $tarfinCard): AnonymousResourceCollection
    {
        return TarfinCardTransactionResource::collection($tarfinCard->transactions);
    }

    /**
     * Store a newly created TarfinCardTransaction in storage.
     */
    public function store(TarfinCardTransactionCreateRequest $request, TarfinCard $tarfinCard): TarfinCardTransactionResource
    {
        /** @var \App\Models\TarfinCardTransaction $newTarfinCardTransaction */
        $newTarfinCardTransaction = $tarfinCard->transactions()->create($request->validated());

        ProcessTarfinCardTransactionJob::dispatchAfterResponse($newTarfinCardTransaction->id);

        return new TarfinCardTransactionResource($newTarfinCardTransaction);
    }

    /**
     * Display the specified TarfinCardTransaction.
     */
    public function show(TarfinCardTransactionViewRequest $request, TarfinCardTransaction $tarfinCardTransaction): TarfinCardTransactionResource
    {
        return new TarfinCardTransactionResource($tarfinCardTransaction);
    }
}
