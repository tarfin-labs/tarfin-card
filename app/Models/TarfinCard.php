<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperTarfinCard
 */
class TarfinCard extends Model
{
    use HasFactory;

    use SoftDeletes;

    // region Attributes

    protected $fillable = [
        'user_id',
        'number',
        'type',
        'expiration_date',
        'disabled_at',
    ];

    protected $casts = [
        'user_id'         => 'integer',
        'number'          => 'integer',
        'type'            => 'string',
        'expiration_date' => 'datetime',
        'disabled_at'     => 'datetime',
    ];

    // endregion

    // region Accessors

    /**
     * Convert disabled_at in boolean attribute.
     */
    public function getIsActiveAttribute(): bool
    {
        return is_null($this->disabled_at);
    }

    // endregion

    // region Relations

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(TarfinCardTransaction::class);
    }

    // endregion

    // region Scopes

    /**
     * Scope active Tarfin Cards.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->whereNull('disabled_at');
    }

    // endregion
}
