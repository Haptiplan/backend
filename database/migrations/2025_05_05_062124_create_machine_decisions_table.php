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
        Schema::create('machine_decisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('decision_id')->constrained('decisions');
            $table->foreignId('machine_type_id')->constrained('machine_types');
            $table->integer('buy')->default(0);
            $table->integer('sell')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machine_decisions');
    }
};
