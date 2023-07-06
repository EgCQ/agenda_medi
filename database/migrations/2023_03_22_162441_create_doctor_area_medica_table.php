<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_area_medica', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_doctor');
            $table->unsignedBigInteger('id_area_medica');
            $table->foreign('id_doctor')->references('id')->on('users');
            $table->foreign('id_area_medica')->references('id')->on('area_medicas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_area_medica');
    }
};
