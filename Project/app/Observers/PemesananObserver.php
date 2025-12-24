<?php

namespace App\Observers;

use App\Models\Pemesanan;
use App\Services\IntegrityService;

class PemesananObserver
{
    public function created(Pemesanan $pemesanan)
    {
        app(IntegrityService::class)->log([
            'event' => 'created',
            'model' => 'Pemesanan',
            'data' => $pemesanan->toArray(),
        ]);
    }
}
