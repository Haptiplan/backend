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
        Schema::create('gamemasters', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->foreignId('game_id')->constrained('games')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['id', 'game_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gamemasters');
    }
};
