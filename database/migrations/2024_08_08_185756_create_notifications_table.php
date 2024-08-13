<?php

use App\Models\DemandeMentorat;
use App\Models\RendezVous;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('objet');
            $table->text('contenu'); // Utilisez 'text' pour permettre des chaînes plus longues
            $table->foreignId('demande_mentorat_id')->nullable()->constrained('demande_mentorats')->onDelete('cascade');
            $table->foreignId('rendez_vous_id')->nullable()->constrained('rendez_vouses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
