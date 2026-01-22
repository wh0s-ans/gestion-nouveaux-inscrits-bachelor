<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes d'authentification
|--------------------------------------------------------------------------
|
| Ces routes gèrent l'authentification des utilisateurs de l'application.
|
*/

// Afficher le formulaire de connexion
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login')
    ->middleware('guest');

// Traiter la connexion
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

// Déconnexion
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout')
    ->middleware('auth');
