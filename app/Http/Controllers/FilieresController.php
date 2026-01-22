<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use Illuminate\Http\Request;

class FilieresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filieres = Filiere::paginate(10);
        return view('filieres.index', compact('filieres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('filieres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:filieres',
            'description' => 'nullable|string',
            'categorie' => 'nullable|string',
        ]);

        Filiere::create($validated);

        return redirect()->route('filieres.index')->with('success', 'Filière créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Filiere $filiere)
    {
        return view('filieres.show', compact('filiere'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Filiere $filiere)
    {
        return view('filieres.edit', compact('filiere'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Filiere $filiere)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:filieres,nom,' . $filiere->id,
            'description' => 'nullable|string',
            'categorie' => 'nullable|string',
        ]);

        $filiere->update($validated);

        return redirect()->route('filieres.index')->with('success', 'Filière mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Filiere $filiere)
    {
        $filiere->delete();
        return redirect()->route('filieres.index')->with('success', 'Filière supprimée avec succès');
    }
}
