<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'), // Changez ce mot de passe après installation
            'role' => 'admin', // Ajouter un champ 'role' pour différencier les utilisateurs
            'is_approved' => true, // L'admin est approuvé par défaut
        ]);
    }
}
