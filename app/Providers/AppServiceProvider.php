<?php

namespace App\Providers;

use Google_Client;
use Google_Service_Drive;
use League\Flysystem\Filesystem;
use App\Broadcasting\WhatsappChannel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\FilesystemAdapter;
use Masbug\Flysystem\GoogleDriveAdapter;
use Illuminate\Filesystem\FilesystemManager;
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
