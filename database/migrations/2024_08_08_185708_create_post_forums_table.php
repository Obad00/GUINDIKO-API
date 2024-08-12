<?php

use App\Models\User;
use App\Models\Forum;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_forums', function (Blueprint $table) {
            $table->id();
            $table->string('contenu');
            $table->string('image');
            $table->foreignIdFor(User::class)->onDelete('cascade');
            $table->foreignIdFor(Forum::class)->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_forums');
    }
};
