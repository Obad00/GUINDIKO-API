<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Forum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostForum>
 */
class PostForumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'contenu' => $this->faker->text(200),
            'image' => $this->faker->imageUrl(),
            'forum_id' => Forum::factory(),
            'user_id' => User::factory(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
