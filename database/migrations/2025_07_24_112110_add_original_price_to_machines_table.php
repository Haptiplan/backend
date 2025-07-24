<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * We use the original price the company paid for the machiene (after parameters)
     * to easily calculate the remaining value after depreciation. If we used the current
     * value, it would be more complex to calulate it due to the parameters.
     */
    public function up(): void
    {
        Schema::table('machines', function (Blueprint $table) {
            $table->integer('original_price')->nullable()->after('period');
        });
        Schema::table('machines', function (Blueprint $table) {
            $table->integer('original_price')->nullable()->after('period');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('machines', function (Blueprint $table) {
            $table->dropColumn('original_price');
        });
    }
};
