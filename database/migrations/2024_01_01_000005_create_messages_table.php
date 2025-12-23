<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expediteur_id')->constrained('users');
            $table->foreignId('destinataire_id')->constrained('users');
            $table->foreignId('task_id')->nullable()->constrained('tasks')->onDelete('set null');
            $table->string('sujet', 255)->nullable();
            $table->text('message');
            $table->boolean('lu')->default(false);
            $table->timestamp('date_envoi')->useCurrent();
            $table->boolean('is_archived_exp')->default(false);
            $table->boolean('is_archived_dest')->default(false);
            $table->timestamps();
            
            $table->index('expediteur_id');
            $table->index('destinataire_id');
            $table->index('lu');
            $table->index('date_envoi');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};

