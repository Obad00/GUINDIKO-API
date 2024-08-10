<?php

namespace Database\Seeders;

use App\Models\PostForum;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       PostForum::factory(10)->create();
    }
}
