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
            $table->boolean('preinscripcion')->default(false);
            $table->boolean('datos_personales')->default(false);
            $table->boolean('datos_familiares')->default(false);
            $table->boolean('encuesta')->default(false);
            $table->boolean('pago_prospecto')->default(false);
            $table->boolean('pago_examen')->default(false);
            $table->boolean('pago_vocacional')->default(false);
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
