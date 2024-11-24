<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Création de l'utilisateur Admin
        $admin = User::firstOrCreate([
            'email' => 'rached.bkhalifa@gmail.com',
        ], [
            'name' => 'Rached BENKHALIFA',
            'password' => bcrypt('160481'), // Mot de passe crypté
        ]);

        $admin->assignRole('admin'); // Cette ligne insère dans model_has_roles



        // Création de l'utilisateur Standard
        $user = User::firstOrCreate([
            'email' => 'user@example.com',
        ], [
            'name' => 'Standard User',
            'password' => bcrypt('160481'), // Mot de passe crypté
        ]);

        // Assignez le rôle user à cet utilisateur
        $user->assignRole('user');
    }
}
