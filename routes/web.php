<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\FilieresController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\EmailController;

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

    // Rapports & Analytics
    Route::get('rapports', [RapportController::class, 'index'])->name('rapports.index');
    Route::get('rapports/export-pdf-etudiants', [RapportController::class, 'exportPdfEtudiants'])->name('rapports.export-pdf-etudiants');
    Route::get('rapports/export-pdf-filiere/{filiere_id}', [RapportController::class, 'exportPdfParFiliere'])->name('rapports.export-pdf-filiere');
    Route::get('rapports/export-pdf-mensuel/{mois}/{annee}', [RapportController::class, 'exportPdfMensuel'])->name('rapports.export-pdf-mensuel');

    // Importation d'étudiants
    Route::get('imports', [ImportController::class, 'index'])->name('imports.index');
    Route::post('imports', [ImportController::class, 'store'])->name('imports.store');
    Route::get('imports/telecharger-template', [ImportController::class, 'telechargerTemplate'])->name('imports.telecharger-template');

    // Communications - Emails
    Route::get('emails', [EmailController::class, 'index'])->name('emails.index');
    Route::post('emails/envoyer-en-masse', [EmailController::class, 'envoyerEnMasse'])->name('emails.envoyer-en-masse');
    Route::get('emails/{etudiant}/confirmation', [EmailController::class, 'envoyerConfirmation'])->name('emails.envoyer-confirmation');
    Route::get('emails/{etudiant}/notification', [EmailController::class, 'envoyerNotificationStatut'])->name('emails.envoyer-notification');
    Route::get('emails/{etudiant}/certificat/download', [EmailController::class, 'telechargerCertificat'])->name('emails.telecharger-certificat');
    Route::get('emails/{etudiant}/certificat/send', [EmailController::class, 'envoyerCertificat'])->name('emails.envoyer-certificat');
});

// Routes d'authentification (fournies par Laravel Breeze)
require __DIR__.'/auth.php';


