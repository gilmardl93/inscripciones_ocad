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
            $table->string('numero_constancia')->nullable();
            $table->decimal('nota_ingreso','10','3')->nullable();
            $table->biginteger('merito')->nullable();
            $table->enum('estado_constancia',['NO VINO','ENTREGADO','RETENIDO'])->default('NO VINO');
            $table->date('fecha_constancia')->nullable();
            $table->mediumtext('observacion')->nullable();
            $table->string('facultad_procedencia')->nullable();
            $table->string('grado')->nullable();
            $table->string('titulo')->nullable();
            $table->integer('numero_creditos')->nullable();
            $table->string('secuencia_identificacion')->nullable();
            $table->foreign('idpostulante')->references('id')->on('postulante');
            $table->foreign('idfacultad')->references('id')->on('facultad');
            $table->foreign('idespecialidad')->references('id')->on('especialidad');
            $table->foreign('idmodalidad')->references('id')->on('modalidad');
            $table->decimal('e1','10','3')->nullable();
            $table->decimal('e2','10','3')->nullable();
            $table->decimal('e3','10','3')->nullable();
            $table->decimal('n','10','3')->nullable();
            $table->decimal('nv','10','3')->nullable();
            $table->decimal('na','10','3')->nullable();
            $table->boolean('etiqueta')->default(true);
            $table->boolean('constancia')->default(true);

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
