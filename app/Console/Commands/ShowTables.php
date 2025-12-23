<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ShowTables extends Command
{
    protected $signature = 'db:tables {--connection=mysql}';
    protected $description = 'Affiche toutes les tables de la base de données';

    public function handle()
    {
        $connection = $this->option('connection');
        
        try {
            $dbName = DB::connection($connection)->getDatabaseName();
            $this->info("Base de données: {$dbName}");
            $this->info("Connexion: {$connection}");
            $this->line('');
            
            // Pour MySQL
            if ($connection === 'mysql') {
                $tables = DB::connection($connection)->select("SHOW TABLES");
                $tableKey = "Tables_in_{$dbName}";
            } else {
                // Pour SQLite
                $tables = DB::connection($connection)->select("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name");
                $tableKey = 'name';
            }
            
            $this->info("Nombre de tables: " . count($tables));
            $this->line('');
            $this->info("Liste des tables:");
            $this->line('');
            
            $tableList = [];
            foreach ($tables as $table) {
                $tableName = is_object($table) ? $table->$tableKey : $table[$tableKey];
                $tableList[] = [$tableName];
            }
            
            $this->table(['Nom de la table'], $tableList);
            
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("Erreur: " . $e->getMessage());
            $this->line('');
            $this->warn("Vérifiez que:");
            $this->line("1. MySQL est démarré (XAMPP Control Panel)");
            $this->line("2. La base de données 'gestion_taches' existe");
            $this->line("3. Le fichier .env est configuré avec:");
            $this->line("   DB_CONNECTION=mysql");
            $this->line("   DB_DATABASE=gestion_taches");
            $this->line("   DB_USERNAME=root");
            $this->line("   DB_PASSWORD=");
            
            return Command::FAILURE;
        }
    }
}

