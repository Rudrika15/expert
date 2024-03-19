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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->string('studentName');
            $table->string('studentEmail');
            $table->string('studentPhoneNumber');
            $table->string('Subject');
            $table->string('totalAttempted');
            $table->string('totalRightAns');
            $table->string('totalWrongAns');
            $table->string('Score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
