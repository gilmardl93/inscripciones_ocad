<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValidacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validacion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idevaluacion')->nullable();
            $table->integer('idmodalidad')->nullable();
            $table->string('codigo',10)->nullable();
            $table->string('paterno',50)->nullable();
            $table->string('materno',50)->nullable();
            $table->string('nombres',50)->nullable();
            $table->foreign('idevaluacion')->references('id')->on('evaluacion');
            $table->foreign('idmodalidad')->references('id')->on('modalidad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('validacion');
    }
}
