<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle Etudiant
 * 
 * Représente un étudiant inscrit au Bachelor
 */
class Etudiant extends Model
{
    use HasFactory;

    /**
     * Les attributs qui ne sont pas assignables en masse
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * Les attributs qui doivent être castés
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_naissance' => 'date',
        'date_inscription' => 'datetime',
    ];

    /**
     * Relation : Un étudiant appartient à une filière
     */
    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    /**
     * Obtenir le nombre d'étudiants par statut
     *
     * @param string $statut
     * @return int
     */
    public static function countByStatus($statut)
    {
        return self::where('statut', $statut)->count();
    }

    /**
     * Obtenir les inscriptions par mois
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getInscriptionsParMois()
    {
        return self::selectRaw('MONTH(date_inscription) as mois, YEAR(date_inscription) as annee, COUNT(*) as nombre')
            ->groupBy('annee', 'mois')
            ->orderBy('annee')
            ->orderBy('mois')
            ->get();
    }
}
