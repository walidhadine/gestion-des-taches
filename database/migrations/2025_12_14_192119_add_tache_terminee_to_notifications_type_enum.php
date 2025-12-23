<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modifier l'ENUM pour ajouter 'tache_terminee'
        DB::statement("ALTER TABLE notifications MODIFY COLUMN type ENUM('nouvelle_tache', 'message', 'rappel', 'statut_change', 'commentaire', 'echeance', 'tache_terminee')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Retirer 'tache_terminee' de l'ENUM
        DB::statement("ALTER TABLE notifications MODIFY COLUMN type ENUM('nouvelle_tache', 'message', 'rappel', 'statut_change', 'commentaire', 'echeance')");
    }
};
