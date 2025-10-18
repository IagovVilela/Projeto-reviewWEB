<?php

namespace App\Mail;

use App\Models\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NegativeReviewAlert extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Review $review
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "🚨 URGENTE: Avaliação Negativa com Feedback - {$this->review->company->name}",
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.negative-review-alert',
            with: [
                'review' => $this->review,
                'company' => $this->review->company,
            ],
        );
    }
}

