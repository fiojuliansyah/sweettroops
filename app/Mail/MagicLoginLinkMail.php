<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MagicLoginLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The magic login URL.
     *
     * @var string
     */
    public $loginUrl;
    public $userName;

    public function __construct(string $loginUrl, string $userName) 
    {
        $this->loginUrl = $loginUrl;
        $this->userName = $userName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your SweetTroops Login Link',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // We will create this view next
        return new Content(
            markdown: 'emails.magic-login-link',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}