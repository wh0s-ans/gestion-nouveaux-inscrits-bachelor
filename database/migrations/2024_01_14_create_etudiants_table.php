<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Créer la table des étudiants
     */
    public function up(): void
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('cne')->unique();
            $table->string('cin')->unique();
            $table->date('date_naissance');
            $table->string('email')->unique();
            $table->string('telephone');
            $table->string('filiere'); // Licence Informatique, Licence Gestion, etc.
            $table->enum('statut', ['En attente', 'Validé', 'Rejeté'])->default('En attente');
            $table->timestamp('date_inscription')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Annuler la migration
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
