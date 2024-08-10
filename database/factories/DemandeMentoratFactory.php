<?php

namespace Database\Factories;

use App\Models\Mente;
use App\Models\Mentor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DemandeMentorat>
 */
class DemandeMentoratFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'statut' => $this->faker->randomElement(['En attente', 'Acceptée', 'Refusée']),
            'mente_id' => Mente::factory(),  // Associe un mente aléatoire
            'mentor_id' => Mentor::factory(), // Associe un mentor aléatoire
        ];
    }
}
