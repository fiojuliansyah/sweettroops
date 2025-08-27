<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CoursePurchasedNotification extends Notification
{
    use Queueable;

    protected $user;
    protected $course;
    protected $transaction;

    public function __construct($user, $course, $transaction)
    {
        $this->user = $user;
        $this->course = $course;
        $this->transaction = $transaction;
    }

    public function via($notifiable)
    {
        return ['whatsapp'];
    }
    
    public function toWhatsapp($notifiable)
    {
        $adminPhone = $this->user->phone;
        $userName = $this->user->name ?? '-';
        $userEmail = $this->user->email ?? '-';
        $userPhone = $this->user->phone ?? '-';
        $courseTitle = $this->course->title;
        $orderId = $this->transaction->order_id;
        $status = $this->transaction->payment_status;
        $amount = number_format($this->transaction->amount);
    
        return [
            'number' => $adminPhone,
            'data'   => "🎉 Hi *$userName*, welcome to SweetTroops! 🎉\n\n"
                      . "Thank you so much for purchasing our *$courseTitle* 🧁✨\nWe’re super excited to have you join this sweet baking adventure.\n\n"
                      . "📂 The recipe file (pdf) will be sent to you manually here on WhatsApp by our team (it won’t be available on the website). Please keep an eye out—we’ll share it with you shortly!\n\n"
                      . "⏰ If you don’t hear back from us within 1x24 hours, please give us a gentle nudge here. Sometimes notifications like to play hide and seek, and we don’t want you to miss out. 💌\n\n"
                      . "Sweetly yours,\n"
                      . "SweetTroops Team 🍪✨",
        ];
    }
    
}
