<?php

namespace App\Providers;

use App\Models\Generation;
use App\Observers\GenerationObserver;
use Illuminate\Support\ServiceProvider;

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
        Generation::observe(GenerationObserver::class);

    }
}
