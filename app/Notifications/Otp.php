<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Otp extends Notification
{
    use Queueable;

    protected $number;
    protected $otp;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($number, $otp)
    {
        $this->number = $number;
        $this->number = $number;
        $this->otp = $otp;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['whatsapp'];
    }

    public function toWhatsapp($notifiable)
    {
        $name = $notifiable->name; 
        
        return [
            'number'    => $this->number,
            'data'      => "Hallo $name,\n\nKode OTP kamu adalah: ".$this->otp."\n\nTolong jangan sebarkan informasi ini kepada siapa pun yaa.",        
        ];
    }
}
