<?php

namespace App\Providers;
use App\Models\Pemesanan;
use App\Models\PemesananMenu;
use App\Models\PemesananPaket;
use Illuminate\Support\ServiceProvider;
use App\Observers\ModelLedgerObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Pemesanan::observe(ModelLedgerObserver::class);
        PemesananMenu::observe(ModelLedgerObserver::class);
        PemesananPaket::observe(ModelLedgerObserver::class);
    }
}
