<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSinVacantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sin_vacante', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idmodalidad')->nullable();
            $table->integer('idespecialidad')->nullable();

            $table->foreign('idmodalidad')->references('id')->on('modalidad');
            $table->foreign('idespecialidad')->references('id')->on('especialidad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sin_vacante');
    }
}
