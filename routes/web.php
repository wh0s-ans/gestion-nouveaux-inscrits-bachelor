<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\FilieresController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Ici, vous pouvez enregistrer les routes web de votre application.
| Ces routes sont chargées par le RouteServiceProvider et attribuées
| au groupe middleware "web".
|
*/

// Route d'accueil - redirige vers la connexion
Route::get('/', function () {
    return redirect()->route('login');
});

// Routes protégées par authentification
Route::middleware(['auth'])->group(function () {
    
    // Dashboard - Tableau de bord
    Route::get('/tableau-de-bord', [DashboardController::class, 'index'])->name('dashboard');

    // Gestion des filières (CRUD complet)
    Route::resource('filieres', FilieresController::class);

    // Gestion des étudiants (CRUD complet)
    Route::resource('etudiants', EtudiantController::class);
    
    // Action personnalisée : changer le statut d'un étudiant
    Route::patch('etudiants/{etudiant}/statut', [EtudiantController::class, 'changerStatut'])->name('etudiants.changerStatut');
    
    // Export des étudiants en Excel
    Route::get('etudiants/export/excel', [EtudiantController::class, 'exportExcel'])->name('etudiants.export.excel');
});

// Routes d'authentification (fournies par Laravel Breeze)
require __DIR__.'/auth.php';


