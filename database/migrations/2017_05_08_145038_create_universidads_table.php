<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUniversidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('universidad', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo')->nullable();
            $table->string('nombre')->nullable();
            $table->integer('idubigeo')->nullable();
            $table->enum('gestion',['Pública','Privada'])->nullable();
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
        Schema::dropIfExists('universidad');
    }
}
