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
        Schema::create('cita_medica', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_hora_atencion');
            $table->unsignedBigInteger('id_area_medica');
            $table->unsignedBigInteger('id_paciente');
            $table->unsignedBigInteger('id_doctor');
            $table->foreign('id_area_medica')->references('id')->on('area_medicas');
            $table->foreign('id_paciente')->references('id')->on('personas');
            $table->foreign('id_doctor')->references('id')->on('users');

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
        Schema::dropIfExists('cita_medica');
    }
};
