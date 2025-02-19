<?php

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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained()->onDelete('cascade'); // Relación con games
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con users
            $table->integer('rating')->unsigned(); // Puntuación de 1 a 5
            $table->text('comment')->nullable(); // Comentario opcional
            $table->enum('status', ['pending', 'published', 'rejected'])->default('pending'); // Estado de la reseña
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
