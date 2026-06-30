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
        Schema::table('users', function (Blueprint $table) {
            $table->string('bank_name')->nullable()->after('role');
            $table->string('bank_account_number')->nullable()->after('bank_name');
        });

        Schema::table('bootcamp_registrations', function (Blueprint $table) {
            $table->string('payout_status')->nullable()->after('payment_info')->comment('Status transfer Iris (pending, success, failed)');
            $table->json('payout_info')->nullable()->after('payout_status')->comment('Respons dari Iris API');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['bank_name', 'bank_account_number']);
        });

        Schema::table('bootcamp_registrations', function (Blueprint $table) {
            $table->dropColumn(['payout_status', 'payout_info']);
        });
    }
};
