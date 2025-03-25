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

    /**
     * Create a new notification instance.
     */
    public function __construct($user, $course, $transaction)
    {
        $this->user = $user;
        $this->course = $course;
        $this->transaction = $transaction;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['whatsapp']; // Tambahkan WhatsApp
    }
    
    /**
     * Kirim Notifikasi ke WhatsApp Admin
     */
    public function toWhatsapp($notifiable)
    {
        $adminPhone = env('ADMIN_WHATSAPP_NUMBER', '081212082958'); 
        $userName = $this->user->name;
        $courseTitle = $this->course->title;
        $orderId = $this->transaction->order_id;
        $amount = number_format($this->transaction->amount);
    
        return [
            'number' => $adminPhone,
            'data'   => "📢 Notifikasi Pembelian Course\n\n"
                      . "📌 User: *$userName*\n"
                      . "📚 Course: *$courseTitle*\n"
                      . "🛒 Order ID: *$orderId*\n"
                      . "💰 Harga: *Rp. $amount*\n\n"
                      . "Silakan cek dashboard admin untuk detail lebih lanjut.",
        ];
    }
    
}
