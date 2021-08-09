<?php

namespace App\Http\Controllers;

use App\Http\Requests\TarfinCardCreateRequest;
use App\Http\Requests\TarfinCardDeleteRequest;
use App\Http\Requests\TarfinCardUpdateRequest;
use App\Http\Requests\TarfinCardViewAnyRequest;
use App\Http\Requests\TarfinCardViewRequest;
use App\Http\Resources\TarfinCardResource;
use App\Models\TarfinCard;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Carbon;

class TarfinCardController extends Controller
{
    /**
     * List all active Tarfin Cards
     *
     * @param  \App\Http\Requests\TarfinCardViewAnyRequest  $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(TarfinCardViewAnyRequest $request): AnonymousResourceCollection
    {
        $tarfinCards = $request->user()
                               ->tarfinCards()
                               ->active()
                               ->get();

        return TarfinCardResource::collection($tarfinCards);
    }
}
