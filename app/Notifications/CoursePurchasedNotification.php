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
        $adminPhone = env('ADMIN_WHATSAPP_NUMBER', '081212082958'); 
        $userName = $this->user->name ?? '-';
        $userEmail = $this->user->email ?? '-';
        $userPhone = $this->user->phone ?? '-';
        $courseTitle = $this->course->title;
        $orderId = $this->transaction->order_id;
        $status = $this->transaction->payment_status;
        $amount = number_format($this->transaction->amount);
    
        return [
            'number' => $adminPhone,
            'data'   => "📢 Notifikasi Pembelian Course\n\n"
                      . "📌 User: *$userName*\n"
                      . "✉️ Email: *$userEmail*\n"
                      . "📞 Phone: *$userPhone*\n"
                      . "📚 Course: *$courseTitle*\n"
                      . "🛒 Order ID: *$orderId*\n"
                      . "💰 Harga: *Rp. $amount*\n\n"
                      . "Status: *$status*\n\n"
                      . "Silakan cek dashboard admin untuk detail lebih lanjut.",
        ];
    }
    
}
