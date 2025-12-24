<?php

namespace App\Observers;

use App\Models\PemesananPaket;
use App\Services\IntegrityService;

class PemesananPaketObserver
{
    public function created(PemesananPaket $item)
    {
        app(IntegrityService::class)->log([
            'event' => 'created',
            'model' => 'PemesananPaket',
            'data' => $item->toArray(),
        ]);
    }
}
