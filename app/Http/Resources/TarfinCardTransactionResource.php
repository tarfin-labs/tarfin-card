<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TarfinCardTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        /* @var \App\Models\TarfinCardTransaction $this */
        return [
            'id'             => $this->id,
            'tarfin_card_id' => $this->tarfin_card_id,
            'amount'         => $this->amount,
            'currency_code'  => $this->currency_code,
        ];
    }
}
