<?php

namespace App\Mail;

use App\Models\Etudiant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CertificatInscription extends Mailable
{
    use Queueable, SerializesModels;

    public $etudiant;

    public function __construct(Etudiant $etudiant)
    {
        $this->etudiant = $etudiant;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Certificat d\'inscription - Bachelor',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.certificat-inscription',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
