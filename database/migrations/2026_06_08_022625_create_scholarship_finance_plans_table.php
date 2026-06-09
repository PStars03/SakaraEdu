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
        Schema::create('scholarship_finance_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->decimal('scholarship_amount', 15, 2);
            $table->boolean('uses_transport')->default(false);
            $table->boolean('uses_rent')->default(false);
            $table->integer('rent_percentage')->default(0);
            $table->integer('food_percentage')->default(0);
            $table->integer('transport_percentage')->default(0);
            $table->integer('saving_percentage')->default(0);
            $table->integer('other_percentage')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarship_finance_plans');
    }
};
