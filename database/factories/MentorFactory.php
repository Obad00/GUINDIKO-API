<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mentor>
 */
class MentorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'domaineExpertise' => $this->faker->domainWord,
            'experience' => $this->faker->sentence,
            'disponibilite' => $this->faker->boolean,
            'user_id' => User::factory(), // Associe un utilisateur aléatoire
            'created_at' => $this->faker->dateTime(),
        ];
    }
}
