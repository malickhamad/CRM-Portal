<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewSubscriptionMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $planName,
        public float $amount,
        public string $userName
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Subscription Confirmation - ' . config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email_templates.backend.new_subscription',
            with: [
                'planName' => $this->planName,
                'amount' => $this->amount,
                'userName' => $this->userName,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
