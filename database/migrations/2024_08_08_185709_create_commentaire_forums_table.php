<?php

use App\Models\User;
use App\Models\PostForum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commentaire_forums', function (Blueprint $table) {
            $table->id();
            $table->string('contenu');
            $table->foreignIdFor(User::class)->onDelete('cascade');
            $table->foreignIdFor(PostForum::class)->onDelete('cascade');
            $table->foreignIdFor(User::class)->onDelete('cascade');
            $table->timestamps();
        });
    }




    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaire_forums');
    }
};
