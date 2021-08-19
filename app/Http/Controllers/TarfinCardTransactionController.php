<?php

namespace App\Http\Controllers;

use App\Http\Requests\TarfinCardTransactionCreateRequest;
use App\Http\Requests\TarfinCardTransactionViewAnyRequest;
use App\Http\Resources\TarfinCardTransactionResource;
use App\Models\TarfinCard;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TarfinCardTransactionController extends Controller
{
    /**
     * Display a listing of the TarfinCardTransaction for the given TarfinCard.
     *
     * @param  \App\Http\Requests\TarfinCardTransactionViewAnyRequest  $request
     * @param  \App\Models\TarfinCard                                  $tarfinCard
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(TarfinCardTransactionViewAnyRequest $request, TarfinCard $tarfinCard): AnonymousResourceCollection
    {
        return TarfinCardTransactionResource::collection($tarfinCard->transactions);
    }

    /**
     * Store a newly created TarfinCardTransaction in storage.
     *
     * @param  \App\Http\Requests\TarfinCardTransactionCreateRequest  $request
     * @param  \App\Models\TarfinCard                                 $tarfinCard
     *
     * @return \App\Http\Resources\TarfinCardTransactionResource
     */
    public function store(TarfinCardTransactionCreateRequest $request, TarfinCard $tarfinCard): TarfinCardTransactionResource
    {
        $newTarfinCardTransaction = $tarfinCard->transactions()->create($request->validated());

        return new TarfinCardTransactionResource($newTarfinCardTransaction);
    }
}
