<?php

declare(strict_types=1);

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
     * Retrieve a collection of Tarfin cards for the authenticated user.
     */
    public function index(TarfinCardViewAnyRequest $request): AnonymousResourceCollection
    {
        $tarfinCards = $request->user()
                               ->tarfinCards()
                               ->active()
                               ->get();

        return TarfinCardResource::collection(resource: $tarfinCards);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TarfinCardCreateRequest $request): TarfinCardResource
    {
        $tarfinCard = $request->user()->tarfinCards()->create([
            'type'            => $request->input('type'),
            'number'          => rand(1000000000000000, 9999999999999999),
            'expiration_date' => Carbon::now()->addYear(),
        ]);

        return new TarfinCardResource($tarfinCard);
    }

    /**
     * Display the specified resource.
     */
    public function show(TarfinCardViewRequest $request, TarfinCard $tarfinCard): TarfinCardResource
    {
        return new TarfinCardResource($tarfinCard);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TarfinCardUpdateRequest $request, TarfinCard $tarfinCard): TarfinCardResource
    {
        $tarfinCard->update([
            'disabled_at' => $request->input('is_active') === true ? null : Carbon::now(),
        ]);

        return new TarfinCardResource($tarfinCard);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TarfinCardDeleteRequest $request, TarfinCard $tarfinCard): TarfinCardResource
    {
        $tarfinCard->delete();

        return new TarfinCardResource($tarfinCard);
    }
}
