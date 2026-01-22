<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * AuthenticatedSessionController
 * 
 * Gère la connexion et la déconnexion des utilisateurs
 */
class AuthenticatedSessionController extends Controller
{
    /**
     * Afficher le formulaire de connexion
     *
     * @return View
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Traiter la tentative de connexion
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'L\'email est requis',
            'email.email' => 'L\'email doit être valide',
            'password.required' => 'Le mot de passe est requis',
        ]);

        // Essayer de se connecter
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()
                ->intended(route('dashboard'))
                ->with('success', 'Connexion réussie !');
        }

        // Connexion échouée
        return back()
            ->withInput($request->only('email'))
            ->with('error', 'Les identifiants fournis ne correspondent pas à nos enregistrements.')
            ->withErrors([
                'email' => 'Email ou mot de passe incorrect.',
            ]);
    }

    /**
     * Déconnecter l'utilisateur
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')
            ->with('success', 'Vous avez été déconnecté avec succès');
    }
}
