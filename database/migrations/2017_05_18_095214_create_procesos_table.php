<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proceso', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idpostulante')->nullable();
            $table->boolean('preinscripcion')->nullable();
            $table->boolean('datos_personales')->nullable();
            $table->boolean('datos_familiares')->nullable();
            $table->boolean('encuesta')->nullable();
            $table->foreign('idpostulante')->references('id')->on('postulante');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proceso');
    }
}
