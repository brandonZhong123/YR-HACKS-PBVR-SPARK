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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');    
            $table->foreignId('period_1_course_id')->nullable()->constrained('individual_courses')->onDelete('cascade');
            $table->foreignId('period_2_course_id')->nullable()->constrained('individual_courses')->onDelete('cascade');
            $table->foreignId('period_3_course_id')->nullable()->constrained('individual_courses')->onDelete('cascade');
            $table->foreignId('period_4_course_id')->nullable()->constrained('individual_courses')->onDelete('cascade');
            $table->foreignId('period_5_course_id')->nullable()->constrained('individual_courses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
