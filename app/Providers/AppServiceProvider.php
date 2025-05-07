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
        // Storage::extend('google', function ($app) {
        //     // 1. Setup Google Client menggunakan env()
        //     $client = new Google_Client();
        //     $client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
        //     $client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));
        //     $client->refreshToken(env('GOOGLE_DRIVE_REFRESH_TOKEN'));
    
        //     // 2. Buat service Google Drive dan Adapter
        //     $service = new Google_Service_Drive($client);
        //     $adapter = new GoogleDriveAdapter($service, env('GOOGLE_DRIVE_FOLDER_ID'));
    
        //     // 3. Buat instance Flysystem dengan adapter
        //     $filesystem = new Filesystem($adapter);
    
        //     // 4. Kembalikan FilesystemAdapter yang digunakan Laravel untuk Storage
        //     return new FilesystemAdapter($filesystem, $adapter, [
        //         'clientId' => env('GOOGLE_DRIVE_CLIENT_ID'),
        //         'clientSecret' => env('GOOGLE_DRIVE_CLIENT_SECRET'),
        //         'refreshToken' => env('GOOGLE_DRIVE_REFRESH_TOKEN'),
        //         'folderId' => env('GOOGLE_DRIVE_FOLDER_ID'),
        //     ]);
        // });
        
        Notification::extend('whatsapp', function ($app) {
            return new WhatsappChannel();
        });
    }
}
