<?php

namespace App\Http\Controllers;

use App\Http\Requests\TarfinCardTransactionViewAnyRequest;
use App\Http\Resources\TarfinCardTransactionResource;
use App\Models\TarfinCard;
use App\Models\TarfinCardTransaction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TarfinCardTransactionController extends Controller
{
    /**
     * Display a listing of the TarfinCardTransaction for the given TarfinCard.
     *
     * @param  \App\Http\Controllers\TarfinCardTransactionViewAnyRequest  $request
     * @param  \App\Models\TarfinCard                                     $tarfinCard
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(TarfinCardTransactionViewAnyRequest $request, TarfinCard $tarfinCard): AnonymousResourceCollection
    {
        return TarfinCardTransactionResource::collection($tarfinCard->transactions());
    }
}
