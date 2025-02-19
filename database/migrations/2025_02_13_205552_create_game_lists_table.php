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
        Schema::create('game_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Usuario dueño de la lista
            $table->string('name'); // Nombre de la lista (Ej: "Favoritos", "Por jugar", etc.)
            $table->timestamps();
        });

        // Tabla intermedia para relacionar juegos con listas
        Schema::create('game_list_game', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_list_id')->constrained()->onDelete('cascade');
            $table->foreignId('game_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_list_game');
        Schema::dropIfExists('game_lists');
    }
};
