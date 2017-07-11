<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModalidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modalidad', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo',10)->nullable();
            $table->string('nombre',100)->nullable();
            $table->string('modalidad2',100)->nullable();
            $table->boolean('colegio')->default(true);
            $table->boolean('activo')->default(true);
            $table->string('reglamento',200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modalidad');
    }
}
