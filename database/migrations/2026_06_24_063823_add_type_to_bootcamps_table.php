<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bootcamps', function (Blueprint $table) {
            // type: bootcamp, workshop, webinar
            $table->string('type')->default('bootcamp')->after('status');
            $table->integer('max_participants')->nullable()->after('type');
            $table->string('level')->nullable()->after('max_participants'); // Beginner, Intermediate, Advanced
        });
    }

    public function down(): void
    {
        Schema::table('bootcamps', function (Blueprint $table) {
            $table->dropColumn(['type', 'max_participants', 'level']);
        });
    }
};

