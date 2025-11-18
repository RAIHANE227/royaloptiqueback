<?php

namespace App\Providers;

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
        // Share settings with all views
        $settings = \App\Models\Setting::first();
        app()->singleton('settings', function () use ($settings) {
            return new class($settings) {
                public function __construct(private ?\App\Models\Setting $settings) {}
                public function get(string $key, $default = null) {
                    return $this->settings?->$key ?? $default;
                }
            };
        });
    }
}
