<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescuentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descuento', function (Blueprint $table) {
            $table->increments('id');
            $table->string('periodo',6)->nullable();
            $table->string('concurso',100)->nullable();
            $table->string('dni',8)->nullable();
            $table->enum('tipo',['Total','Parcial'])->nullable();
            $table->integer('idservicio')->nullable();
            $table->string('motivo',200)->nullable();
            $table->boolean('activo')->default(false);
            $table->foreign('idservicio')->references('id')->on('servicio');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('descuento');
    }
}
