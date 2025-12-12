<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlockLedger extends Model
{
    protected $table = 'block_ledgers';

    protected $fillable = [
        'data',
        'block_timestamp',
        'previous_hash',
        'current_hash',
        'model_id',
        'model_type',
    ];

    protected $casts = [
        'data' => 'array',
        'block_timestamp' => 'datetime',
    ];
}
