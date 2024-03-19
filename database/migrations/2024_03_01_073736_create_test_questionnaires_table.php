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
        Schema::create('test_questionnaires', function (Blueprint $table) {
            $table->id();
            $table->integer('testId');
            $table->string('Questions');
            $table->string('Opt1');
            $table->string('Opt2');
            $table->string('Opt3');
            $table->string('Opt4');
            $table->string('Right_Ans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_questionnaires');
    }
};
