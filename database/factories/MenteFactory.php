<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mente>
 */
class MenteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'nom'=>$this->faker->lastName,
            // 'prenom'=>$this->faker->firstName,
            // 'email'=>$this->faker->email,
            // 'password'=>Hash::make('password'),
            // 'numeroTelephone'=>$this->faker->phoneNumber,
            'user_id' => User::factory(), // Associe un utilisateur aléatoire
            'created_at' => $this->faker->dateTime(),

        ];
    }
}
