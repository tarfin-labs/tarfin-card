<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TarfinCardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'              => $this->id,
            'number'          => $this->number,
            'type'            => $this->type,
            'expiration_date' => $this->expiration_date,
            'is_active'       => $this->is_active,
        ];
    }
}
