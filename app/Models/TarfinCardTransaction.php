<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\CurrencyType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperTarfinCardTransaction
 */
class TarfinCardTransaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    // region Attributes

    protected $fillable = [
        'tarfin_card_id',
        'amount',
        'currency_code',
    ];

    protected $casts = [
        'tarfin_card_id' => 'integer',
        'amount'         => 'integer',
        'currency_code'  => CurrencyType::class,
    ];

    // endregion

    // region Relations

    public function tarfinCard(): BelongsTo
    {
        return $this->belongsTo(related: TarfinCard::class);
    }

    // endregion
}
