<?php

use App\Models\Mente;
use App\Models\Mentor;
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
        Schema::create('rendez_vouses', function (Blueprint $table) {
            $table->id();
            $table->string('sujet');
            $table->date('date_rendezVous');
            $table->string('lieu')->nullable();
            $table->enum('type', ['En Ligne','Presentiel']);
            $table->integer('durée');
            $table->text('lien')->nullable();
            $table->enum('statut', ['Reporté', 'Confirmé'])->default('Confirmé');
            $table->string('lieu')->nullable();
            $table->enum('type', ['En Ligne','Presentiel']);
            $table->integer('durée');
            $table->text('lien');
            $table->foreignIdFor(Mente::class)->onDelete('cascade');
            $table->foreignIdFor(Mentor::class)->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendez_vouses');
    }
};
