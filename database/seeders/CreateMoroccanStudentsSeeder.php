<?php

namespace Database\Seeders;

use App\Models\Etudiant;
use App\Models\Filiere;
use Illuminate\Database\Seeder;

class CreateMoroccanStudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Prénoms marocains
        $prenoms = [
            'Ahmed', 'Mohammed', 'Ali', 'Hassan', 'Karim', 'Youssef', 'Abdellah', 'Hamza', 'Omar', 'Ibrahim',
            'Fatima', 'Aisha', 'Zahra', 'Leila', 'Noor', 'Hana', 'Sara', 'Rania', 'Amina', 'Yasmine',
            'Mustafa', 'Tariq', 'Bilal', 'Rashid', 'Samir', 'Khalid', 'Nabil', 'Jamal', 'Ismail', 'Zaki',
            'Maryam', 'Layla', 'Dina', 'Hiba', 'Farah', 'Lina', 'Nadia', 'Selma', 'Wafa', 'Jana',
            'Badr', 'Aziz', 'Essam', 'Faisal', 'Gamal', 'Hani', 'Imran', 'Jaber', 'Karim', 'Latif',
        ];

        // Noms de famille marocains
        $noms = [
            'Bennis', 'Alami', 'Bennani', 'Berrajah', 'Belaid', 'Bensalah', 'Ben Youssef', 'Boujemaa', 'Boukhris', 'Boutaleb',
            'Chabake', 'Chakir', 'Chammah', 'Cheikh', 'Cherif', 'Chikhi', 'Chikh', 'Chouaib', 'Chouaibi', 'Chouraki',
            'Dabbagh', 'Dahhane', 'Dahri', 'Dakiche', 'Dalal', 'Dalali', 'Damiri', 'Daraki', 'Darar', 'Dariss',
            'Ebrahimi', 'Echafiki', 'Echamali', 'Echbarou', 'Echibli', 'Echikh', 'Echikh', 'Eddakhch', 'Eddine', 'Eddrioui',
            'Farah', 'Faraji', 'Faramouri', 'Faraoui', 'Farassa', 'Fariji', 'Farini', 'Farraj', 'Farraj', 'Farsi',
            'Gaddari', 'Gadi', 'Gafar', 'Gafara', 'Gafari', 'Gafoua', 'Gafouri', 'Gagnabi', 'Gaid', 'Gaid',
            'Hachimi', 'Hadadi', 'Hadaji', 'Hadani', 'Hadari', 'Hadarou', 'Haddar', 'Haddi', 'Hadeuf', 'Hadini',
            'Jabrani', 'Jadidi', 'Jafari', 'Jaghouani', 'Jahami', 'Jahani', 'Jahdi', 'Jahia', 'Jahid', 'Jahiri',
            'Kabbaj', 'Kabchi', 'Kabiri', 'Kaced', 'Kachani', 'Kacheui', 'Kachkachi', 'Kachkachi', 'Kachkhachi', 'Kadera',
            'Labib', 'Labidi', 'Labidi', 'Labrini', 'Labrini', 'Labta', 'Labti', 'Labuti', 'Labuti', 'Lachachi',
        ];

        // Supprimer tous les étudiants existants
        Etudiant::truncate();

        // Récupérer les filières
        $filieres = Filiere::all();
        if ($filieres->isEmpty()) {
            $this->command->warn('Aucune filière trouvée! Veuillez d\'abord créer des filières.');
            return;
        }

        $statuts = ['Validé', 'En attente', 'Rejeté'];

        // Générer 70 étudiants marocains
        for ($i = 1; $i <= 70; $i++) {
            $prenom = $prenoms[array_rand($prenoms)];
            $nom = $noms[array_rand($noms)];
            $filiere = $filieres->random();

            Etudiant::create([
                'nom' => $nom,
                'prenom' => $prenom,
                'cne' => 'CNE' . str_pad(rand(100000000, 999999999), 9, '0', STR_PAD_LEFT),
                'cin' => str_pad(rand(100000000, 999999999), 10, '0', STR_PAD_LEFT),
                'date_naissance' => now()->subYears(rand(20, 30))->subDays(rand(0, 365))->format('Y-m-d'),
                'email' => strtolower($prenom . '.' . $nom . '@exemple.ma'),
                'telephone' => '06' . str_pad(rand(10000000, 99999999), 8, '0', STR_PAD_LEFT),
                'filiere_id' => $filiere->id,
                'statut' => $statuts[array_rand($statuts)],
                'date_inscription' => now()->subDays(rand(0, 60))->format('Y-m-d H:i:s'),
            ]);
        }

        $this->command->info('✅ 70 étudiants marocains créés avec succès!');
    }
}
