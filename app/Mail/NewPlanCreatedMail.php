<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewPlanCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $plan;

    public function __construct($plan)
    {
        $this->plan = $plan;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Plan Created Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email_templates.backend.new_plan_created',
            with: [
                'plan' => $this->plan,
            ],

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
