<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\CurrencyType;
use App\Models\TarfinCardTransaction;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class TarfinCardTransactionCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()
            ->can(
                abilities: 'create',
                arguments: [TarfinCardTransaction::class, $this->route(param: 'tarfin_card')]
            );
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'amount' => [
                'required',
                'integer',
            ],
            'currency_code' => [
                'required',
                'string', new Enum(type: CurrencyType::class),
            ],
        ];
    }
}
