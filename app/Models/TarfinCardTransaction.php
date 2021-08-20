<?php

namespace App\Models;

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

    // region Public Constants

    public const CURRENCY_TRY = 'TRY';
    public const CURRENCY_EUR = 'EUR';
    public const CURRENCY_LEU = 'LEU';
    public const CURRENCY_USD = 'USD';

    public const CURRENCIES = [
        self::CURRENCY_TRY,
        self::CURRENCY_EUR,
        self::CURRENCY_LEU,
        self::CURRENCY_USD,
    ];

    // endregion

    // region Attributes

    protected $fillable = [
        'tarfin_card_id',
        'amount',
        'currency_code',
    ];

    protected $casts = [
        'tarfin_card_id' => 'integer',
        'amount'         => 'integer',
        'currency_code'  => 'string',
    ];

    // endregion

    // region Relations

    public function tarfinCard(): BelongsTo
    {
        return $this->belongsTo(TarfinCard::class);
    }

    // endregion
}
