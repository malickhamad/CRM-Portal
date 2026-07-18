<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        // Debugging: Dump and die to check if data is accessible
        // dd($this->data);

        return $this->subject($this->data['subject'])
                    ->view('email_templates.frontend.contact_us')
                    ->with(['data' => $this->data]);
    }
}
