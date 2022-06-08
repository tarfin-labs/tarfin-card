<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\TarfinCardTransaction;
use Illuminate\Foundation\Http\FormRequest;

class TarfinCardTransactionViewAnyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('view-any', [TarfinCardTransaction::class, $this->route('tarfin_card')]);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [];
    }
}
