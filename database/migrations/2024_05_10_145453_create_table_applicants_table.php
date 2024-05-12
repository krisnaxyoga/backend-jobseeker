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
        Schema::create('table_applicant', function (Blueprint $table) {
            $table->bigIncrements('applicant_id');
            $table->unsignedBigInteger('vacancy_id');
            $table->unsignedBigInteger('candidate_id');
            $table->datetime('apply_date');
            $table->integer('apply_status');
            $table->timestamps();


            $table->foreign('vacancy_id')->references('vacancy_id')->on('table_vacancy');
            $table->foreign('candidate_id')->references('candidate_id')->on('table_candidate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_applicants');
    }
};
