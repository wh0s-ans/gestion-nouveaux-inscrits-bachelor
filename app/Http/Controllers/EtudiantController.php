<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Filiere;
use App\Exports\EtudiantsExport;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * EtudiantController
 * 
 * Gère les opérations CRUD pour les étudiants
 */
class EtudiantController extends Controller
{
    /**
     * Afficher la liste des étudiants avec pagination et filtres
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = Etudiant::query();

        // Filtrer par filière
        if ($request->filled('filiere')) {
            $query->where('filiere_id', $request->input('filiere'));
        }

        // Filtrer par statut
        if ($request->filled('statut')) {
            $query->where('statut', $request->input('statut'));
        }

        // Recherche par nom, prénom ou email
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', "%$search%")
                  ->orWhere('prenom', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('cne', 'like', "%$search%");
            });
        }

        $etudiants = $query->paginate(15);
        $filieres = Filiere::all();

        return view('etudiants.index', [
            'etudiants' => $etudiants,
            'filieres' => $filieres,
        ]);
    }

    /**
     * Afficher le formulaire de création
     *
     * @return View
     */
    public function create(): View
    {
        $filieres = Filiere::all();
        return view('etudiants.create', ['filieres' => $filieres]);
    }

    /**
     * Enregistrer un nouvel étudiant
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'cne' => 'required|string|unique:etudiants,cne',
            'cin' => 'required|string|unique:etudiants,cin',
            'date_naissance' => 'required|date',
            'email' => 'required|email|unique:etudiants,email',
            'telephone' => 'required|string|max:20',
            'filiere_id' => 'required|exists:filieres,id',
        ], [
            'nom.required' => 'Le nom est requis',
            'prenom.required' => 'Le prénom est requis',
            'cne.required' => 'Le CNE est requis',
            'cne.unique' => 'Ce CNE existe déjà',
            'cin.required' => 'La CIN est requise',
            'cin.unique' => 'Cette CIN existe déjà',
            'email.required' => 'L\'email est requis',
            'email.unique' => 'Cet email existe déjà',
            'email.email' => 'L\'email doit être valide',
            'telephone.required' => 'Le téléphone est requis',
            'filiere_id.required' => 'La filière est requise',
        ]);

        Etudiant::create($validated);

        return redirect()
            ->route('etudiants.index')
            ->with('success', 'L\'étudiant a été ajouté avec succès');
    }

    /**
     * Afficher les détails d'un étudiant
     *
     * @param Etudiant $etudiant
     * @return View
     */
    public function show(Etudiant $etudiant): View
    {
        return view('etudiants.show', ['etudiant' => $etudiant]);
    }

    /**
     * Afficher le formulaire d'édition
     *
     * @param Etudiant $etudiant
     * @return View
     */
    public function edit(Etudiant $etudiant): View
    {
        $filieres = Filiere::all();
        return view('etudiants.edit', [
            'etudiant' => $etudiant,
            'filieres' => $filieres,
        ]);
    }

    /**
     * Mettre à jour un étudiant
     *
     * @param Request $request
     * @param Etudiant $etudiant
     * @return RedirectResponse
     */
    public function update(Request $request, Etudiant $etudiant): RedirectResponse
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'cne' => 'required|string|unique:etudiants,cne,' . $etudiant->id,
            'cin' => 'required|string|unique:etudiants,cin,' . $etudiant->id,
            'date_naissance' => 'required|date',
            'email' => 'required|email|unique:etudiants,email,' . $etudiant->id,
            'telephone' => 'required|string|max:20',
            'filiere_id' => 'required|exists:filieres,id',
            'statut' => 'required|in:En attente,Validé,Rejeté',
        ]);

        $etudiant->update($validated);

        return redirect()
            ->route('etudiants.show', $etudiant)
            ->with('success', 'L\'étudiant a été modifié avec succès');
    }

    /**
     * Supprimer un étudiant
     *
     * @param Etudiant $etudiant
     * @return RedirectResponse
     */
    public function destroy(Etudiant $etudiant): RedirectResponse
    {
        $etudiant->delete();

        return redirect()
            ->route('etudiants.index')
            ->with('success', 'L\'étudiant a été supprimé avec succès');
    }

    /**
     * Changer le statut d'un étudiant
     *
     * @param Request $request
     * @param Etudiant $etudiant
     * @return RedirectResponse
     */
    public function changerStatut(Request $request, Etudiant $etudiant): RedirectResponse
    {
        $validated = $request->validate([
            'statut' => 'required|in:En attente,Validé,Rejeté',
        ]);

        $etudiant->update($validated);

        return back()->with('success', 'Le statut a été modifié avec succès');
    }

    /**
     * Exporter les étudiants en CSV
     *
     * @param Request $request
     * @return StreamedResponse
     */
    public function exportExcel(Request $request)
    {
        $export = new EtudiantsExport($request);
        $data = $export->generate();
        
        $fileName = 'Etudiants_' . now()->format('d-m-Y_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];
        
        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            
            // Écrire le BOM UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // En-têtes
            fputcsv($file, $data['headers'], ';', '"');
            
            // Lignes de données
            foreach ($data['rows'] as $row) {
                fputcsv($file, $row, ';', '"');
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}