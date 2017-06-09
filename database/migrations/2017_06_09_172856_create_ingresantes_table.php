<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngresantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingresante', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idpostulante')->nullable();
            $table->integer('idfacultad')->nullable();
            $table->integer('idespecialidad')->nullable();
            $table->integer('idmodalidad')->nullable();
            $table->integer('idcanal')->nullable();
            $table->string('foto')->nullable();
            $table->string('numero_constancia')->nullable();
            $table->string('facultad_procedencia')->nullable();
            $table->string('grado')->nullable();
            $table->string('titulo')->nullable();
            $table->integer('numero_creditos')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingresante');
    }
}
