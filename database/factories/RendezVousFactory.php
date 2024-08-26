<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RendezVous>
 */
class RendezVousFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sujet' => $this->faker->sentence(),
            'date_rendezVous' => $this->faker->date(),
            'statut' => $this->faker->randomElement(['Reporté', 'Confirmé']),
            'lieu' => $this->faker->sentence(),
            'type' => $this->faker->randomElement(['En Ligne','Presentiel']),
            'durée' => $this->faker->numberBetween(1, 10),
            'lien' => $this->faker->url(),
            'mente_id' => $this->faker->numberBetween(1,5),
            'mentor_id' => $this->faker->numberBetween(1, 100),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),

        ];
    }
}
