<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Filiere;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

/**
 * DashboardController
 * 
 * Gère le tableau de bord avec statistiques et graphiques
 */
class DashboardController extends Controller
{
    /**
     * Afficher le tableau de bord avec toutes les statistiques
     *
     * @return View
     */
    public function index(): View
    {
        // Statistiques numériques
        $totalEtudiants = Etudiant::count();
        $etudinantsValides = Etudiant::countByStatus('Validé');
        $etudinantsEnAttente = Etudiant::countByStatus('En attente');
        $etudinantsRejetes = Etudiant::countByStatus('Rejeté');

        // Répartition par filière
        $filieres = Filiere::all();
        $rePartitionFiliere = [];
        foreach ($filieres as $filiere) {
            $count = Etudiant::where('filiere_id', $filiere->id)->count();
            $rePartitionFiliere[$filiere->nom] = $count;
        }

        // Données pour les graphiques
        $donneesStatut = [
            'Validé' => $etudinantsValides,
            'En attente' => $etudinantsEnAttente,
            'Rejeté' => $etudinantsRejetes,
        ];

        // Inscriptions par mois
        $inscriptionsParMois = $this->getInscriptionsParMois();

        // Inscriptions par année
        $inscriptionsParAnnee = $this->getInscriptionsParAnnee();

        // Top filières
        arsort($rePartitionFiliere);
        $topFilieres = array_slice($rePartitionFiliere, 0, 5);

        return view('dashboard', [
            'totalEtudiants' => $totalEtudiants,
            'etudinantsValides' => $etudinantsValides,
            'etudinantsEnAttente' => $etudinantsEnAttente,
            'etudinantsRejetes' => $etudinantsRejetes,
            'donneesStatut' => $donneesStatut,
            'rePartitionFiliere' => $rePartitionFiliere,
            'inscriptionsParMois' => $inscriptionsParMois,
            'inscriptionsParAnnee' => $inscriptionsParAnnee,
            'topFilieres' => $topFilieres,
            'filieres' => $filieres,
        ]);
    }

    /**
     * Récupérer les inscriptions par mois pour la courbe
     *
     * @return array
     */
    private function getInscriptionsParMois()
    {
        $mois = [
            1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
            5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
            9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'
        ];

        $donnees = Etudiant::selectRaw('MONTH(date_inscription) as mois, COUNT(*) as nombre')
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        $labels = [];
        $values = [];

        for ($i = 1; $i <= 12; $i++) {
            $labels[] = $mois[$i];
            $record = $donnees->firstWhere('mois', $i);
            $values[] = $record ? $record->nombre : 0;
        }

        return [
            'labels' => $labels,
            'values' => $values,
        ];
    }

    /**
     * Récupérer les inscriptions par année universitaire
     *
     * @return array
     */
    private function getInscriptionsParAnnee()
    {
        $donnees = Etudiant::selectRaw('YEAR(date_inscription) as annee, COUNT(*) as nombre')
            ->groupBy('annee')
            ->orderBy('annee')
            ->get();

        $labels = [];
        $values = [];

        foreach ($donnees as $record) {
            $labels[] = $record->annee . '-' . ($record->annee + 1);
            $values[] = $record->nombre;
        }

        return [
            'labels' => $labels,
            'values' => $values,
        ];
    }
}
