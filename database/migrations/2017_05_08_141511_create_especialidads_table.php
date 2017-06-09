<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspecialidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especialidad', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idfacultad')->nullable();
            $table->string('codigo',2)->nullable();
            $table->string('nombre',50)->nullable();
            $table->enum('canal',['I','II','III','IV','V','VI','VII'])->nullable();
            $table->boolean('activo')->nullable();
            $table->foreign('idfacultad')->references('id')->on('facultad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('especialidad');
    }
}
