<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CommentaireForum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentaireForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       CommentaireForum::factory(10)->create();
    }
}
