<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('titre', 255);
            $table->text('description')->nullable();
            $table->enum('status', ['à faire', 'en cours', 'terminé'])->default('à faire');
            $table->enum('priority', ['faible', 'moyenne', 'élevée', 'urgente'])->default('moyenne');
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->time('heure_debut')->nullable();
            $table->time('heure_fin')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('assigned_to')->constrained('users');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->boolean('is_important')->default(false);
            $table->integer('completion_percentage')->default(0);
            $table->text('notes')->nullable();
            $table->string('fichier_joint', 255)->nullable();
            $table->timestamp('date_creation')->useCurrent();
            $table->timestamp('date_modification')->useCurrent()->useCurrentOnUpdate();
            $table->timestamps();
            
            $table->index('status');
            $table->index('assigned_to');
            $table->index('created_by');
            $table->index(['date_debut', 'date_fin']);
            $table->index('priority');
            $table->index('category_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

