<?php

namespace App\Providers;
use App\Models\Pemesanan;
use App\Models\PemesananMenu;
use App\Models\PemesananPaket;
use Illuminate\Support\ServiceProvider;
use App\Observers\PemesananMenuObserver;
use App\Observers\PemesananObserver;
use App\Observers\PemesananPaketObserver;
use App\Observers\ModelLedgerObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
{
    Pemesanan::observe(PemesananObserver::class);
    PemesananMenu::observe(PemesananMenuObserver::class);
    PemesananPaket::observe(PemesananPaketObserver::class);
    Pemesanan::observe(ModelLedgerObserver::class);
    PemesananMenu::observe(ModelLedgerObserver::class);
    PemesananPaket::observe(ModelLedgerObserver::class);
}
}
