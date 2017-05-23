<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplementariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complementario', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idpostulante')->nullable();
            $table->integer('idrazon')->nullable();
            $table->integer('idtipopreparacion')->nullable();
            $table->integer('mes')->nullable();
            $table->integer('idacademia')->nullable();
            $table->integer('numeroveces')->nullable();
            $table->integer('idrenuncia')->nullable();
            $table->integer('idingresoeconomico')->nullable();
            $table->integer('idpublicidad')->nullable();

            $table->foreign('idpostulante')->references('id')->on('postulante');
            $table->foreign('idrazon')->references('id')->on('catalogo');
            $table->foreign('idtipopreparacion')->references('id')->on('catalogo');
            $table->foreign('idacademia')->references('id')->on('catalogo');
            $table->foreign('idrenuncia')->references('id')->on('catalogo');
            $table->foreign('idingresoeconomico')->references('id')->on('catalogo');
            $table->foreign('idpublicidad')->references('id')->on('catalogo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complementario');
    }
}
