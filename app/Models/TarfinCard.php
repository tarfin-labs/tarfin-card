<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Observers\TarfinCardObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([TarfinCardObserver::class])]
class TarfinCard extends Model
{
    use HasFactory;
    use SoftDeletes;

    // region Attributes

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'number',
        'type',
        'expiration_date',
        'disabled_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
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
     * Return if the Tarfin Card is active.
     */
    public function isActive(): Attribute
    {
        return Attribute::make(
            get: static function (?Carbon $value, array $attributes): bool {
                return is_null(value: $attributes['disabled_at'] ?? null);
            },
        );
    }

    // endregion

    // region Relations

    /**
     * A Tarfin Card belongs to a User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(related: User::class);
    }

    /**
     * A Tarfin Card has many Tarfin Card Transactions.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(related: TarfinCardTransaction::class);
    }

    // endregion

    // region Scopes

    /**
     * Scope the query to only include active records.
     */
    public function scopeActive(Builder $query): void
    {
        $query->whereNull(columns: 'disabled_at');
    }

    // endregion
}
