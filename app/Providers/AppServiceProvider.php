<?php

namespace App\Providers;

use Google_Client;
use Aws\S3\S3Client;
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
        $this->app->singleton(S3Client::class, function ($app) {
            return new S3Client([
                'version' => 'latest',
                'region'  => config('filesystems.disks.s3.region'),
                'credentials' => [
                    'key' => config('filesystems.disks.s3.key'),
                    'secret' => config('filesystems.disks.s3.secret'),
                ],
            ]);
        });
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
