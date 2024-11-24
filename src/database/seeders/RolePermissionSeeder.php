<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Liste des permissions
        $permissions = [
            'create mission',
            'view mission',
            'edit mission',
            'delete mission',
        ];

        // Création des permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Création des rôles et attribution des permissions
        $roles = [
            'admin' => $permissions, // Admin a toutes les permissions
            'user' => ['view mission'], // User standard ne peut que voir les missions
        ];

//        foreach ($roles as $roleName => $rolePermissions) {
//            $role = Role::firstOrCreate(['name' => $roleName]);
//            $role->syncPermissions($rolePermissions);
//        }



        // Créer le rôle Admin et lui attribuer toutes les permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions(Permission::all());

        // Créer le rôle User avec des permissions spécifiques
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->syncPermissions(['view mission']);
    }

    }

