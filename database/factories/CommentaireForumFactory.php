<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\PostForum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommentaireForum>
 */
class CommentaireForumFactory extends Factory
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
            'user_id' => User::factory(),
            'post_forum_id' => PostForum::factory(),
        ];
    }
}
