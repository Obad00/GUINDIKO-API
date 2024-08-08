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
        Schema::create('demande_mentorats', function (Blueprint $table) {
            $table->id();
            $table->enum('statut', ['En attente', 'Acceptée', 'Refusée'])->default('En attente');
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
        Schema::dropIfExists('demande_mentorats');
    }
};
