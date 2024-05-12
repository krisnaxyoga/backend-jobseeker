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
        Schema::create('table_vacancy', function (Blueprint $table) {
            $table->bigIncrements('vacancy_id');
            $table->string('vacancy_name');
            $table->integer('min_exp');
            $table->integer('max_age')->nullable();
            $table->string('salary');
            $table->string('description');
            $table->datetime('publish_date');
            $table->datetime('expired_date');
            $table->integer('flag_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_vacancies');
    }
};
