<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TarfinCardUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()
                    ->can(
                        abilities: 'update',
                        arguments: $this->route(param: 'tarfin_card')
                    );
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'is_active' => [
                'required',
                'boolean'
            ],
        ];
    }
}
