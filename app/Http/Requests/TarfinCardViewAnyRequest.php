<?php

namespace App\Http\Requests;

use App\Models\TarfinCard;
use Illuminate\Foundation\Http\FormRequest;

class TarfinCardViewAnyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('view-any', TarfinCard::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [];
    }
}
