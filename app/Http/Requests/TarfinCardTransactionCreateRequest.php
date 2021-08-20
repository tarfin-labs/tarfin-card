<?php

namespace App\Http\Requests;

use App\Constants\Currency;
use App\Models\TarfinCardTransaction;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TarfinCardTransactionCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', [TarfinCardTransaction::class, $this->route('tarfin_card')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'amount'        => ['required', 'integer'],
            'currency_code' => ['required', 'string', Rule::in(Currency::ALL)],
        ];
    }
}
