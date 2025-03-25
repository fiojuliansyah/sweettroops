<?php

namespace App\Providers;

use App\Broadcasting\WhatsappChannel;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Notification;

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
        Notification::extend('whatsapp', function ($app) {
            return new WhatsappChannel();
        });
    }
}
