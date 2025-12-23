<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('titre', 255);
            $table->text('description')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('type', ['tache', 'reunion', 'personnel', 'projet'])->default('tache');
            $table->string('couleur', 7)->default('#3498db');
            $table->foreignId('task_id')->nullable()->constrained('tasks')->onDelete('set null');
            $table->string('lieu', 255)->nullable();
            $table->integer('rappel_minutes')->default(15);
            $table->timestamps();
            
            $table->index('user_id');
            $table->index(['start_date', 'end_date']);
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

