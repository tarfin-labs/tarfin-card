<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\TarfinCard;
use App\Http\Resources\TarfinCardResource;
use App\Http\Requests\TarfinCardViewRequest;
use App\Http\Requests\TarfinCardCreateRequest;
use App\Http\Requests\TarfinCardDeleteRequest;
use App\Http\Requests\TarfinCardUpdateRequest;
use App\Http\Requests\TarfinCardViewAnyRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TarfinCardController extends Controller
{
    /**
     * List all active Tarfin Cards.
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
        $tarfinCard = $request->user()
            ->tarfinCards()
            ->create([
                'type'            => $request->string(key: 'type')->trim(),
                'number'          => mt_rand(min: 10000000, max: 99999999).mt_rand(min: 00000000, max: 99999999),
                'expiration_date' => now()->addYear(),
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
            'disabled_at' => $request->boolean(key: 'is_active') === true
                ? null
                : now(),
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
