<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fichiers', function (Blueprint $table) {
            $table->id();
            $table->string('nom_original', 255);
            $table->string('nom_stockage', 255);
            $table->string('chemin', 500);
            $table->string('type_mime', 100)->nullable();
            $table->bigInteger('taille')->nullable();
            $table->foreignId('uploaded_by')->constrained('users');
            $table->foreignId('task_id')->nullable()->constrained('tasks')->onDelete('cascade');
            $table->foreignId('message_id')->nullable()->constrained('messages')->onDelete('cascade');
            $table->timestamp('uploaded_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fichiers');
    }
};

