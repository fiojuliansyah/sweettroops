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
            'number' => $this->number,
            'data'   => "Hi $name, 🍰\n\n"
                . "Psst… here’s your secret code 🤫\n"
                . "OTP: " . $this->otp . " \n\n"
                . "This is a one-time code, just for you.\n"
                . "Please don’t share it with anyone (even fellow bakers 😉).\n\n"
                . "⏰ It’ll expire soon.\n"
                . "📲 This number is OTP-only - for questions or help, chat with our SweetTroops Admin instead.\n"
                . "For classes info: 085311232377\n"
                . "For website: 087889892306\n\n"
                . "See you in class!\n"
                . "SweetTroops Team",
        ];
    }
}
