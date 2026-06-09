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
        Schema::table('scholarship_finance_plans', function (Blueprint $table) {
            $table->decimal('rent_cost', 15, 2)->nullable()->after('uses_rent');
            $table->decimal('transport_cost', 15, 2)->nullable()->after('rent_cost');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scholarship_finance_plans', function (Blueprint $table) {
            $table->dropColumn(['rent_cost', 'transport_cost']);
        });
    }
};
