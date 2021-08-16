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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TarfinCardCreateRequest  $request
     *
     * @return \App\Http\Resources\TarfinCardResource
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
     *
     * @param  \App\Http\Requests\TarfinCardViewRequest  $request
     * @param  \App\Models\TarfinCard                    $tarfinCard
     *
     * @return \App\Http\Resources\TarfinCardResource
     */
    public function show(TarfinCardViewRequest $request, TarfinCard $tarfinCard): TarfinCardResource
    {
        return new TarfinCardResource($tarfinCard);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TarfinCardUpdateRequest  $request
     * @param  \App\Models\TarfinCard                      $tarfinCard
     *
     * @return \App\Http\Resources\TarfinCardResource
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
     *
     * @param  \App\Http\Requests\TarfinCardDeleteRequest  $request
     * @param  \App\Models\TarfinCard                      $tarfinCard
     *
     * @return \App\Http\Resources\TarfinCardResource
     */
    public function destroy(TarfinCardDeleteRequest $request, TarfinCard $tarfinCard): TarfinCardResource
    {
        $tarfinCard->delete();

        return new TarfinCardResource($tarfinCard);
    }
}
