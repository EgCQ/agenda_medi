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
        Schema::create('all_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_form1');
            $table->unsignedBigInteger('id_form2');
            $table->unsignedBigInteger('id_form3');
            $table->foreign('id_form1')->references('id')->on('form1');
            $table->foreign('id_form2')->references('id')->on('form2');
            $table->foreign('id_form3')->references('id')->on('form3');
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
        Schema::dropIfExists('all_forms');
    }
};
