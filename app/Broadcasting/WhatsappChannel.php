<?php

namespace App\Broadcasting;

use Illuminate\Support\Facades\Http;
use Illuminate\Notifications\Notification;

class WhatsappChannel
{
    public function send($notifiable, Notification $notification)
    {
        if (!method_exists($notification, 'toWhatsapp')) {
            throw new \Exception('toWhatsapp method missing from notification class.');
        }

        $message = $notification->toWhatsapp($notifiable);

        return Http::asJson()
          ->withHeaders([
            'Authorization' => env('FONNTE_TOKEN'),
          ])
          ->post('https://api.fonnte.com/send', [
            'target' => $message['number'],
            'message' => $message['data'],            
          ]);
    }  
}
