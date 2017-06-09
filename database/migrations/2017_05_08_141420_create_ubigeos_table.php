<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUbigeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubigeo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo',6)->nullable();
            $table->string('nombre',50)->nullable();
            $table->string('descripcion',150)->nullable();
            $table->boolean('activo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ubigeo');
    }
}
