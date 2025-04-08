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
        Schema::create('pending_tutor_sessions', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->foreignId('tutor_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade'); 
            $table->text('location');
            $table->text('subject');
            $table->text('status')->default('Pending');
            $table->text('reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_tutor_sessions');
    }
};