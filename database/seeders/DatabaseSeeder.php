<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Category;
use App\Models\Setting;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Créer l'admin par défaut s'il n'existe pas
        $admin = User::firstOrCreate(
            ['email' => 'admin@taskapp.com'],
            [
                'role' => 'admin',
                'password' => Hash::make('Admin123!'),
                'nom' => 'Admin',
                'prenom' => 'Système',
                'is_active' => true,
            ]
        );

        if (!$admin->profile) {
            UserProfile::create(['user_id' => $admin->id]);
        }

        // Créer quelques utilisateurs de test (seulement s'ils n'existent pas)
        if (User::where('role', 'user')->count() < 5) {
            $users = User::factory(5)->create([
                'role' => 'user',
                'is_active' => true,
            ]);

            foreach ($users as $user) {
                if (!$user->profile) {
                    UserProfile::create(['user_id' => $user->id]);
                }
            }
        }

        // Créer les catégories par défaut
        $categories = [
            ['nom' => 'Travail', 'description' => 'Tâches professionnelles', 'color' => '#3498db', 'is_default' => true],
            ['nom' => 'Personnel', 'description' => 'Tâches personnelles', 'color' => '#2ecc71', 'is_default' => true],
            ['nom' => 'Urgent', 'description' => 'Tâches prioritaires urgentes', 'color' => '#e74c3c', 'is_default' => true],
            ['nom' => 'Réunion', 'description' => 'Tâches liées aux réunions', 'color' => '#9b59b6', 'is_default' => true],
            ['nom' => 'Projet', 'description' => 'Tâches de projets spécifiques', 'color' => '#f39c12', 'is_default' => true],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['nom' => $category['nom']],
                array_merge($category, ['created_by' => $admin->id])
            );
        }

        // Créer les paramètres système
        $settings = [
            ['cle' => 'app_name', 'valeur' => 'Task Management Pro', 'type' => 'string'],
            ['cle' => 'app_version', 'valeur' => '1.0.0', 'type' => 'string'],
            ['cle' => 'maintenance_mode', 'valeur' => '0', 'type' => 'boolean'],
            ['cle' => 'email_notifications', 'valeur' => '1', 'type' => 'boolean'],
            ['cle' => 'session_timeout', 'valeur' => '30', 'type' => 'integer'],
            ['cle' => 'max_file_size', 'valeur' => '10', 'type' => 'integer'],
            ['cle' => 'allowed_file_types', 'valeur' => '["pdf","doc","docx","xls","xlsx","jpg","png","txt"]', 'type' => 'json'],
            ['cle' => 'default_timezone', 'valeur' => 'Europe/Paris', 'type' => 'string'],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(
                ['cle' => $setting['cle']],
                $setting
            );
        }
    }
}
