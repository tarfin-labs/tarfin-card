<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TarfinCardViewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()
                    ->can(
                        abilities: 'view',
                        arguments: $this->route(param: 'tarfin_card')
                    );
    }
}
