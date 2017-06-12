<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColegiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colegio', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo_modular')->unique();
            $table->string('anexo',2)->nullable();
            $table->string('nombre')->nullable();
            $table->string('nivel',50)->nullable();
            $table->string('forma',50)->nullable();
            $table->string('area',10)->nullable();
            $table->string('gestion_minedu',50)->nullable();
            $table->string('gestion',50)->nullable();
            $table->string('direccion')->nullable();
            $table->string('director')->nullable();
            $table->string('email')->nullable();
            $table->string('telefonos')->nullable();
            $table->integer('idubigeo')->nullable();
            $table->integer('idpais')->nullable();
            $table->boolean('activo')->nullable();
            $table->foreign('idubigeo')->references('id')->on('ubigeo');
            $table->foreign('idpais')->references('id')->on('pais');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colegio');
    }
}
