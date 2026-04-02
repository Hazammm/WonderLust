<?php

namespace App\Mail;

use App\Models\Destination;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FeaturedDestinationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Destination $destination)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '✨ New Featured Destination: ' . $this->destination->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.featured-destination',
        );
    }
}
