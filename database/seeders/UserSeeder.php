<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Créer un utilisateur admin
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
        ]);

        // Assigner le rôle d'admin
        $adminRole = Role::findByName('admin');
        $admin->assignRole($adminRole);

        // Créer deux mentors
        $mentors = User::factory(2)->create();
        foreach ($mentors as $mentor) {
            $mentorRole = Role::findByName('mentor');
            $mentor->assignRole($mentorRole);
        }

        // Créer quatre mentees
        $mentees = User::factory(4)->create();
        foreach ($mentees as $mentee) {
            $menteeRole = Role::findByName('menti');
            $mentee->assignRole($menteeRole);
        }
    }
}
