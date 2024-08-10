<?php

namespace Database\Seeders;

use App\Models\DemandeMentorat;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DemandeMentoratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DemandeMentorat::factory(10)->create();  // Crée 10 instances de demande de mentorat
    }
}
