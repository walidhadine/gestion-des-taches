<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('statistiques', function (Blueprint $table) {
            $table->id();
            $table->date('date_jour');
            $table->integer('total_taches')->default(0);
            $table->integer('taches_terminees')->default(0);
            $table->integer('taches_en_cours')->default(0);
            $table->integer('taches_retard')->default(0);
            $table->integer('total_utilisateurs')->default(0);
            $table->decimal('taux_completion', 5, 2)->default(0.00);
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->timestamps();
            
            $table->index('date_jour');
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statistiques');
    }
};

