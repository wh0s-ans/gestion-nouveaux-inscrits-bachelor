<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Filiere;

/**
 * Factory pour générer des données d'étudiants de test
 */
class EtudiantFactory extends Factory
{
    /**
     * Définir le modèle par défaut
     *
     * @var string
     */
    protected $model = \App\Models\Etudiant::class;

    /**
     * Définir les attributs du modèle
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuts = ['En attente', 'Validé', 'Rejeté'];

        return [
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'cne' => 'CNE' . $this->faker->unique()->numerify('#########'),
            'cin' => $this->faker->unique()->numerify('##########'),
            'date_naissance' => $this->faker->dateTimeBetween('-25 years', '-18 years'),
            'email' => $this->faker->unique()->safeEmail(),
            'telephone' => $this->faker->phoneNumber(),
            'filiere_id' => Filiere::inRandomOrder()->first()?->id ?? Filiere::first()?->id,
            'statut' => $this->faker->randomElement($statuts),
            'date_inscription' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
