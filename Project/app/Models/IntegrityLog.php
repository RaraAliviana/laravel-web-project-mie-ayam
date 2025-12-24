<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntegrityLog extends Model
{
    protected $fillable = [
        'payload',
        'hash',
        'previous_hash',
    ];

    protected $casts = [
        'payload' => 'array',
    ];
}

