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
        Schema::create('table_candidate', function (Blueprint $table) {
            $table->bigIncrements('candidate_id');
            $table->string('email')->unique();
            $table->string('phone_number')->unique()->nullable();
            $table->string('full_name');
            $table->string('dob');
            $table->string('pob');
            $table->string('gender');
            $table->string('year_exp');
            $table->string('last_salary');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_candidates');
    }
};
