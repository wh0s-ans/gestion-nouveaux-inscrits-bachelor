<?php

namespace App\Exports;

use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantsExport
{
    protected $request;

    public function __construct(Request $request = null)
    {
        $this->request = $request;
    }

    /**
     * Générer le contenu CSV avec les filtres appliqués
     */
    public function generate()
    {
        $query = Etudiant::with('filiere');

        // Appliquer les mêmes filtres que la liste affichée
        if ($this->request) {
            if ($this->request->filled('filiere')) {
                $query->where('filiere_id', $this->request->input('filiere'));
            }
            if ($this->request->filled('statut')) {
                $query->where('statut', $this->request->input('statut'));
            }
            if ($this->request->filled('search')) {
                $search = $this->request->input('search');
                $query->where(function ($q) use ($search) {
                    $q->where('nom', 'like', "%$search%")
                      ->orWhere('prenom', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%")
                      ->orWhere('cne', 'like', "%$search%");
                });
            }
        }

        $etudiants = $query->get();
        
        // En-têtes
        $headers = [
            'ID',
            'Nom',
            'Prénom',
            'CNE',
            'CIN',
            'Date de Naissance',
            'Email',
            'Téléphone',
            'Filière',
            'Statut',
            'Date d\'Inscription',
        ];
        
        $rows = [];
        foreach ($etudiants as $etudiant) {
            $rows[] = [
                $etudiant->id,
                $etudiant->nom,
                $etudiant->prenom,
                $etudiant->cne,
                $etudiant->cin,
                $etudiant->date_naissance?->format('d/m/Y'),
                $etudiant->email,
                $etudiant->telephone,
                $etudiant->filiere?->nom ?? 'N/A',
                $etudiant->statut,
                $etudiant->date_inscription?->format('d/m/Y'),
            ];
        }
        
        return [
            'headers' => $headers,
            'rows' => $rows,
        ];
    }
}

