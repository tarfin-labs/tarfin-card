<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarfinCard extends Model
{
    use HasFactory;

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
}
