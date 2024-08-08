<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Créer des permissions
         Permission::create(['name' => 'edit users']);
         Permission::create(['name' => 'create users']);
         Permission::create(['name' => 'delete users']);
         Permission::create(['name' => 'publish users']);
         Permission::create(['name' => 'enabled users']);
         Permission::create(['name' => 'disabled users']);
 
         // Créer des rôles
         $roleAdmin = Role::create(['name' => 'admin']);
         $roleMente = Role::create(['name' => 'menti']);
         $roleMentor = Role::create(['name' => 'mentor']);
 
         // Assigner des permissions aux rôles
         $roleAdmin->givePermissionTo(Permission::all());
         $roleMente->givePermissionTo(['edit users', 'create users']);
         $roleMentor->givePermissionTo(['edit users', 'create users']);
    }
}
