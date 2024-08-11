<?php

namespace Database\Seeders;

use App\Models\Forum;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Forum::create([
            'nomForum' => 'Tech Enthusiasts',
            'sujet' => 'Discussion about the latest in technology.',
        ]);

        Forum::create([
            'nomForum' => 'Career Advice',
            'sujet' => 'Sharing career tips and guidance.',
        ]);

        Forum::create([
            'nomForum' => 'Coding Challenges',
            'sujet' => 'Weekly coding challenges for developers.',
        ]);
    }

}
