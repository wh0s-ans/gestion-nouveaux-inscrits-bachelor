<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\ImportHistory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ImportController extends Controller
{
    /**
     * Afficher la page d'import
     */
    public function index(): View
    {
        $historique = ImportHistory::latest()->paginate(10);
        $filieres = Filiere::all();

        return view('imports.index', [
            'historique' => $historique,
            'filieres' => $filieres,
        ]);
    }

    /**
     * Traiter le fichier d'import CSV
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'fichier' => 'required|file|mimes:csv,txt',
            'filiere_id' => 'required|exists:filieres,id',
        ]);

        $file = $request->file('fichier');
        $handle = fopen($file->getRealPath(), 'r');

        $erreurs = [];
        $ajouteCount = 0;
        $doublonCount = 0;
        $ligneCourante = 1;

        // Sauter la première ligne (en-têtes)
        fgetcsv($handle, 1024, ',');
        $ligneCourante++;

        while (($ligne = fgetcsv($handle, 1024, ',')) !== false) {
            try {
                // Format: nom, prenom, cne, cin, date_naissance, email, telephone
                if (count($ligne) < 7) {
                    $erreurs[] = "Ligne $ligneCourante: Colonnes insuffisantes";
                    $ligneCourante++;
                    continue;
                }

                $nom = trim($ligne[0]);
                $prenom = trim($ligne[1]);
                $cne = trim($ligne[2]);
                $cin = trim($ligne[3]);
                $date_naissance = trim($ligne[4]);
                $email = trim($ligne[5]);
                $telephone = trim($ligne[6]);

                // Validation basique
                if (empty($nom) || empty($prenom) || empty($email)) {
                    $erreurs[] = "Ligne $ligneCourante: Données manquantes (nom, prenom, email requis)";
                    $ligneCourante++;
                    continue;
                }

                // Vérifier les doublons (CNE ou Email)
                if (Etudiant::where('cne', $cne)->exists() || Etudiant::where('email', $email)->exists()) {
                    $doublonCount++;
                    $ligneCourante++;
                    continue;
                }

                // Valider l'email
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $erreurs[] = "Ligne $ligneCourante: Email invalide ($email)";
                    $ligneCourante++;
                    continue;
                }

                // Valider la date
                $dateObj = \DateTime::createFromFormat('d/m/Y', $date_naissance);
                if (!$dateObj) {
                    $erreurs[] = "Ligne $ligneCourante: Format de date invalide (utiliser dd/mm/yyyy)";
                    $ligneCourante++;
                    continue;
                }

                // Créer l'étudiant
                Etudiant::create([
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'cne' => $cne,
                    'cin' => $cin,
                    'date_naissance' => $dateObj->format('Y-m-d'),
                    'email' => $email,
                    'telephone' => $telephone,
                    'filiere_id' => $request->input('filiere_id'),
                    'statut' => 'En attente',
                    'date_inscription' => now(),
                ]);

                $ajouteCount++;
            } catch (\Exception $e) {
                $erreurs[] = "Ligne $ligneCourante: " . $e->getMessage();
            }

            $ligneCourante++;
        }

        fclose($handle);

        // Enregistrer l'historique
        ImportHistory::create([
            'nom_fichier' => $file->getClientOriginalName(),
            'total_lignes' => $ligneCourante - 2,
            'ajoutes' => $ajouteCount,
            'doublons' => $doublonCount,
            'erreurs' => count($erreurs),
            'details_erreurs' => json_encode($erreurs),
        ]);

        if ($ajouteCount > 0) {
            session()->flash('success', "$ajouteCount étudiant(s) importé(s) avec succès!");
        }
        if ($doublonCount > 0) {
            session()->flash('warning', "$doublonCount doublon(s) détecté(s) et ignoré(s)");
        }
        if (!empty($erreurs)) {
            session()->flash('error_details', $erreurs);
        }

        return redirect()->route('imports.index');
    }

    /**
     * Télécharger le template CSV
     */
    public function telechargerTemplate()
    {
        $contenu = "Nom,Prenom,CNE,CIN,Date_Naissance,Email,Telephone\n";
        $contenu .= "Exemple,Test,CNE123456789,1234567890,01/01/2000,test@exemple.ma,0612345678\n";

        return response()->streamDownload(function () use ($contenu) {
            echo $contenu;
        }, 'template_import.csv');
    }
}
