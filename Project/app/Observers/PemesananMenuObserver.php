<?php

namespace App\Observers;

use App\Models\PemesananMenu;
use App\Services\IntegrityService;

class PemesananMenuObserver
{
    public function created(PemesananMenu $item)
    {
        app(IntegrityService::class)->log([
            'event' => 'created',
            'model' => 'PemesananMenu',
            'data' => $item->toArray(),
        ]);
    }
}
