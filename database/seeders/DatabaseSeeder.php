<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'), // Changez ce mot de passe après installation
            'role' => 'admin', // Ajouter un champ 'role' pour différencier les utilisateurs
            'is_approved' => true, // L'admin est approuvé par défaut
        ]);
    }
}
