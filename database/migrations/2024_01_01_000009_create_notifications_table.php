<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->enum('type', ['nouvelle_tache', 'message', 'rappel', 'statut_change', 'commentaire', 'echeance']);
            $table->string('titre', 255);
            $table->text('contenu');
            $table->string('lien', 255)->nullable();
            $table->boolean('vue')->default(false);
            $table->json('data')->nullable();
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('vue');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};

