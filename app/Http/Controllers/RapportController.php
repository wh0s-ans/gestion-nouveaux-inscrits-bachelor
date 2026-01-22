<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Filiere;
use Illuminate\Http\Request;
use Illuminate\View\View;
use PDF;

class RapportController extends Controller
{
    /**
     * Afficher la page des rapports
     */
    public function index(): View
    {
        $stats = [
            'total_etudiants' => Etudiant::count(),
            'valides' => Etudiant::where('statut', 'Validé')->count(),
            'en_attente' => Etudiant::where('statut', 'En attente')->count(),
            'rejetes' => Etudiant::where('statut', 'Rejeté')->count(),
        ];

        $filieres = Filiere::withCount('etudiants')
            ->orderBy('etudiants_count', 'desc')
            ->get();

        $statistiques_par_filiere = $filieres->map(function ($filiere) {
            return [
                'nom' => $filiere->nom,
                'total' => $filiere->etudiants_count,
                'valides' => $filiere->etudiants()->where('statut', 'Validé')->count(),
                'en_attente' => $filiere->etudiants()->where('statut', 'En attente')->count(),
                'rejetes' => $filiere->etudiants()->where('statut', 'Rejeté')->count(),
            ];
        });

        return view('rapports.index', [
            'stats' => $stats,
            'filieres' => $filieres,
            'statistiques_par_filiere' => $statistiques_par_filiere,
        ]);
    }

    /**
     * Générer un rapport PDF de tous les étudiants
     */
    public function exportPdfEtudiants(Request $request)
    {
        $query = Etudiant::with('filiere');

        // Appliquer les filtres
        if ($request->filled('filiere')) {
            $query->where('filiere_id', $request->input('filiere'));
        }
        if ($request->filled('statut')) {
            $query->where('statut', $request->input('statut'));
        }

        $etudiants = $query->get();
        $stats = [
            'total' => $etudiants->count(),
            'valides' => $etudiants->where('statut', 'Validé')->count(),
            'en_attente' => $etudiants->where('statut', 'En attente')->count(),
            'rejetes' => $etudiants->where('statut', 'Rejeté')->count(),
        ];

        $pdf = PDF::loadView('rapports.pdf.etudiants', [
            'etudiants' => $etudiants,
            'stats' => $stats,
            'date' => now()->format('d/m/Y'),
        ])->setOptions(['defaultFont' => 'Arial']);

        return $pdf->download('Rapport_Etudiants_' . now()->format('d-m-Y') . '.pdf');
    }

    /**
     * Générer un rapport PDF par filière
     */
    public function exportPdfParFiliere($filiere_id)
    {
        $filiere = Filiere::findOrFail($filiere_id);
        $etudiants = $filiere->etudiants()->get();

        $stats = [
            'total' => $etudiants->count(),
            'valides' => $etudiants->where('statut', 'Validé')->count(),
            'en_attente' => $etudiants->where('statut', 'En attente')->count(),
            'rejetes' => $etudiants->where('statut', 'Rejeté')->count(),
        ];

        $pdf = PDF::loadView('rapports.pdf.filiere', [
            'filiere' => $filiere,
            'etudiants' => $etudiants,
            'stats' => $stats,
            'date' => now()->format('d/m/Y'),
        ])->setOptions(['defaultFont' => 'Arial']);

        return $pdf->download('Rapport_' . $filiere->nom . '_' . now()->format('d-m-Y') . '.pdf');
    }

    /**
     * Générer un rapport mensuel
     */
    public function exportPdfMensuel($mois, $annee)
    {
        $etudiants = Etudiant::with('filiere')
            ->whereMonth('date_inscription', $mois)
            ->whereYear('date_inscription', $annee)
            ->get();

        $stats = [
            'total' => $etudiants->count(),
            'valides' => $etudiants->where('statut', 'Validé')->count(),
            'en_attente' => $etudiants->where('statut', 'En attente')->count(),
            'rejetes' => $etudiants->where('statut', 'Rejeté')->count(),
        ];

        $mois_nom = [
            1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
            5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
            9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'
        ];

        $pdf = PDF::loadView('rapports.pdf.mensuel', [
            'etudiants' => $etudiants,
            'stats' => $stats,
            'mois' => $mois_nom[$mois],
            'annee' => $annee,
            'date' => now()->format('d/m/Y'),
        ])->setOptions(['defaultFont' => 'Arial']);

        return $pdf->download('Rapport_' . $mois_nom[$mois] . '_' . $annee . '.pdf');
    }
}
