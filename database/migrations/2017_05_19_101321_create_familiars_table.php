<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamiliarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('familiar', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idpostulante')->nullable();
            $table->string('paterno',25)->nullable();
            $table->string('materno',25)->nullable();
            $table->string('nombres',50)->nullable();
            $table->string('dni',10)->nullable();
            $table->mediumtext('direccion')->nullable();
            $table->string('email',100)->nullable();
            $table->string('telefonos',100)->nullable();
            $table->enum('parentesco',['Papá','Mamá','Apoderado'])->nullable();
            $table->integer('orden')->nullable();
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
        Schema::dropIfExists('familiar');
    }
}
