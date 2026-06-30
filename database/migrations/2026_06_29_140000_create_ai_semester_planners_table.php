<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_semester_planners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('major', 100);
            $table->decimal('ukt_fee', 15, 2);
            $table->decimal('monthly_rent', 15, 2)->nullable();
            $table->decimal('monthly_consumption', 15, 2);
            $table->decimal('monthly_transport', 15, 2)->nullable();
            $table->decimal('self_fund', 15, 2);
            $table->decimal('total_expense', 15, 2);
            $table->decimal('surplus_deficit', 15, 2);
            $table->text('ai_response_text')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_semester_planners');
    }
};
