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
        Schema::create('bootcamps', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('organizer');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('location');
            $table->longText('description');
            $table->longText('requirements')->nullable();
            $table->longText('curriculum')->nullable();
            $table->string('poster')->nullable();
            $table->string('registration_link');
            $table->string('status')->default('draft');
            $table->boolean('is_paid')->default(false);
            $table->decimal('price', 15, 2)->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bootcamps');
    }
};
