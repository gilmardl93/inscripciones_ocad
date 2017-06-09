<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facultad', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo',1)->nullable();
            $table->string('nombre')->nullable();
            $table->string('sigla',5)->nullable();
            $table->string('decano',200)->nullable();
            $table->boolean('activo')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facultad');
    }
}
