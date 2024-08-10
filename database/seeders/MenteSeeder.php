<?php

namespace Database\Seeders;

use App\Models\Mente;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mente::factory()->count(10)->create();
    }
}
