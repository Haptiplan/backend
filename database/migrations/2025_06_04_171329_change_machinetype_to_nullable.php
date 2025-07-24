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
            $table->dropForeign(['machine_type_id']);
        });

        Schema::table('machine_decisions', function (Blueprint $table) {
            $table->dropColumn('machine_type_id');
        });

        Schema::table('machine_decisions', function (Blueprint $table) {
            $table->unsignedBigInteger('machine_type_id')->nullable()->after('buy');
            $table->foreign('machine_type_id')->references('id')->on('machine_types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nullable', function (Blueprint $table) {
            //
        });
    }
};
