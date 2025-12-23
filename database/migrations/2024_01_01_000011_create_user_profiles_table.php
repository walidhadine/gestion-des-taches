<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->string('avatar', 255)->default('default-avatar.png');
            $table->string('telephone', 20)->nullable();
            $table->string('poste', 100)->nullable();
            $table->string('departement', 100)->nullable();
            $table->string('bureau', 50)->nullable();
            $table->boolean('notifications_email')->default(true);
            $table->boolean('notifications_app')->default(true);
            $table->enum('theme', ['clair', 'sombre', 'auto'])->default('clair');
            $table->string('langue', 5)->default('fr');
            $table->text('signature')->nullable();
            $table->text('bio')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};

