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
        return $this->user()
            ->can(
                abilities: 'view-any',
                arguments: [TarfinCardTransaction::class, $this->route(param: 'tarfin_card')]
            );
    }
}
