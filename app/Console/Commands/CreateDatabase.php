<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * Commande pour créer la base de données
 */
class CreateDatabase extends Command
{
    /**
     * La signature de la commande
     *
     * @var string
     */
    protected $signature = 'db:create {name?}';

    /**
     * La description de la commande
     *
     * @var string
     */
    protected $description = 'Créer la base de données si elle n\'existe pas';

    /**
     * Exécuter la commande
     */
    public function handle()
    {
        $database = $this->argument('name') ?? config('database.connections.mysql.database');

        try {
            // Créer une connexion temporary sans spécifier de base
            $pdo = new \PDO(
                'mysql:host=127.0.0.1;port=3306',
                'root',
                ''
            );
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            $this->info("Base de données '$database' créée avec succès !");
        } catch (\Exception $e) {
            $this->error("Erreur : " . $e->getMessage());
        }
    }
}
