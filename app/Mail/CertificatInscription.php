<?php

namespace App\Mail;

use App\Models\Etudiant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use PDF;

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
        // Générer le certificat PDF et l'attacher
        $pdf = PDF::loadView('emails.certificat', [
            'etudiant' => $this->etudiant,
            'date' => now()->format('d/m/Y'),
        ])->output();

        return [
            \Illuminate\Mail\Mailables\Attachment::fromData(
                fn () => $pdf,
                'Certificat_' . $this->etudiant->nom . '_' . $this->etudiant->prenom . '.pdf'
            )->withMime('application/pdf'),
        ];
    }
}
