<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Mail\ConfirmationInscription;
use App\Mail\NotificationStatut;
use App\Mail\CertificatInscription;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Mail;
use PDF;

class EmailController extends Controller
{
    /**
     * Afficher la page de gestion des emails
     */
    public function index(): View
    {
        $etudiants = Etudiant::paginate(15);
        return view('emails.index', ['etudiants' => $etudiants]);
    }

    /**
     * Envoyer un email de confirmation d'inscription
     */
    public function envoyerConfirmation($etudiant_id): RedirectResponse
    {
        $etudiant = Etudiant::findOrFail($etudiant_id);

        try {
            Mail::to($etudiant->email)->send(new ConfirmationInscription($etudiant));
            session()->flash('success', "Email de confirmation envoyé à {$etudiant->email}");
        } catch (\Exception $e) {
            session()->flash('error', "Erreur lors de l'envoi: " . $e->getMessage());
        }

        return back();
    }

    /**
     * Envoyer un email de notification de changement de statut
     */
    public function envoyerNotificationStatut($etudiant_id): RedirectResponse
    {
        $etudiant = Etudiant::findOrFail($etudiant_id);

        try {
            Mail::to($etudiant->email)->send(new NotificationStatut($etudiant));
            session()->flash('success', "Email de notification envoyé à {$etudiant->email}");
        } catch (\Exception $e) {
            session()->flash('error', "Erreur lors de l'envoi: " . $e->getMessage());
        }

        return back();
    }

    /**
     * Envoyer un email avec certificat d'inscription
     */
    public function envoyerCertificat($etudiant_id): RedirectResponse
    {
        $etudiant = Etudiant::findOrFail($etudiant_id);

        try {
            Mail::to($etudiant->email)->send(new CertificatInscription($etudiant));
            session()->flash('success', "Certificat d'inscription envoyé à {$etudiant->email}");
        } catch (\Exception $e) {
            session()->flash('error', "Erreur lors de l'envoi: " . $e->getMessage());
        }

        return back();
    }

    /**
     * Télécharger le certificat d'inscription en PDF
     */
    public function telechargerCertificat($etudiant_id)
    {
        $etudiant = Etudiant::with('filiere')->findOrFail($etudiant_id);

        $pdf = PDF::loadView('emails.certificat', [
            'etudiant' => $etudiant,
            'date' => now()->format('d/m/Y'),
        ])->setOptions(['defaultFont' => 'Arial']);

        return $pdf->download('Certificat_' . $etudiant->nom . '_' . $etudiant->prenom . '.pdf');
    }

    /**
     * Envoyer des emails en masse
     */
    public function envoyerEnMasse(Request $request): RedirectResponse
    {
        $request->validate([
            'type' => 'required|in:confirmation,notification,certificat',
            'statut' => 'nullable|in:Validé,En attente,Rejeté',
            'filiere_id' => 'nullable|exists:filieres,id',
        ]);

        $query = Etudiant::query();

        if ($request->filled('statut')) {
            $query->where('statut', $request->input('statut'));
        }
        if ($request->filled('filiere_id')) {
            $query->where('filiere_id', $request->input('filiere_id'));
        }

        $etudiants = $query->get();
        $count = 0;

        foreach ($etudiants as $etudiant) {
            try {
                switch ($request->input('type')) {
                    case 'confirmation':
                        Mail::to($etudiant->email)->send(new ConfirmationInscription($etudiant));
                        break;
                    case 'notification':
                        Mail::to($etudiant->email)->send(new NotificationStatut($etudiant));
                        break;
                    case 'certificat':
                        Mail::to($etudiant->email)->send(new CertificatInscription($etudiant));
                        break;
                }
                $count++;
            } catch (\Exception $e) {
                \Log::error("Erreur email pour {$etudiant->email}: " . $e->getMessage());
            }
        }

        session()->flash('success', "$count email(s) envoyé(s) avec succès!");

        return redirect()->route('emails.index');
    }
}
