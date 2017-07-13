<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aula', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('orden')->default(0);
            $table->string('sector',10)->nullable();
            $table->string('codigo',10)->nullable();
            $table->integer('capacidad')->default(0);
            $table->integer('disponible_01')->default(0);
            $table->integer('asignado_01')->default(0);
            $table->integer('disponible_02')->default(0);
            $table->integer('asignado_02')->default(0);
            $table->integer('disponible_03')->default(0);
            $table->integer('asignado_03')->default(0);
            $table->integer('disponible_voca')->default(0);
            $table->integer('asignado_voca')->default(0);
            $table->boolean('activo')->default(false);
            $table->boolean('habilitado')->default(false);
            $table->boolean('especial')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aula');
    }
}
