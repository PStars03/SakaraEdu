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
        Schema::table('bootcamp_registrations', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->after('status');
            $table->json('payment_info')->nullable()->after('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bootcamp_registrations', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'payment_info']);
        });
    }
};
