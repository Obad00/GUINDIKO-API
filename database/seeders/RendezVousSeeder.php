<?php

namespace Database\Seeders;

use App\Models\RendezVous;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RendezVousSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RendezVous::factory(70)->create();
    }
}
