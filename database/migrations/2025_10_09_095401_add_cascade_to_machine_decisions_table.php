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
            $table->dropForeign(['decision_id']);
            $table->foreign('decision_id')
                ->references('id')->on('decisions')
                ->onDelete('cascade');
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
