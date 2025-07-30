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
        Schema::table('machine_decisions', function (Blueprint $table) {
            $table->integer('buy')->nullable()->change();
            $table->unsignedBigInteger('sell')->nullable()->change();
            $table->foreign('sell')->nullable()->references('id')->on('machines');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('machine_decisions', function (Blueprint $table) {
            //
        });
    }
};
