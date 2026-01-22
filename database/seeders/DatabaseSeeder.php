<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Etudiant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder de la base de données
 * 
 * Injecte les données initiales de test
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Exécuter les seeders de la base de données
     */
    public function run(): void
    {
        // Créer un administrateur par défaut si pas déjà existant
        User::firstOrCreate(
            ['email' => 'admin@gestion-inscrits.local'],
            [
                'name' => 'Administrateur',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => null,
            ]
        );

        // Créer 100 étudiants avec données réalistes si la table est vide
        if (Etudiant::count() === 0) {
            Etudiant::factory(100)->create();

            // S'assurer qu'on a un bon mix de statuts
            $etudiants = Etudiant::all();
            foreach ($etudiants as $index => $etudiant) {
                if ($index % 3 == 0) {
                    $etudiant->statut = 'Validé';
                } elseif ($index % 3 == 1) {
                    $etudiant->statut = 'En attente';
                } else {
                    $etudiant->statut = 'Rejeté';
                }
                $etudiant->save();
            }
        }
    }
}
