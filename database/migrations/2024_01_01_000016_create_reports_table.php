<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('titre', 255);
            $table->enum('type', ['journalier', 'hebdomadaire', 'mensuel', 'personnalise']);
            $table->foreignId('generated_by')->constrained('users');
            $table->string('fichier_path', 500)->nullable();
            $table->json('parametres')->nullable();
            $table->timestamp('generated_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};

