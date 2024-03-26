<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class CodeForRegister extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        private User $user
    )
    {

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Code For Register',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $randNum = rand(100000, 999999);
        Cache::remember('data-for-register', 60, function () use ($randNum) {
            return [
                      "user" => $this->user,
                      "code" => $randNum
            ];
        });

        return new Content(
            view: 'mail.message',
            with: [
                'name' => $this->user->name,
                'random' => $randNum
            ]
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
