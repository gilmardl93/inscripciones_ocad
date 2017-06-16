<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostulantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postulante', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idevaluacion')->nullable();
            $table->string('codigo',6)->nullable();
            $table->string('codigo_verificacion',10)->nullable();
            $table->string('paterno',50)->nullable();
            $table->string('materno',50)->nullable();
            $table->string('nombres',50)->nullable();
            $table->integer('idtipoidentificacion')->nullable();
            $table->string('numero_identificacion',20)->nullable();
            $table->string('email',100)->nullable();
            $table->decimal('talla','8','2')->nullable();
            $table->decimal('peso','8','2')->nullable();
            $table->integer('idsexo')->nullable();
            $table->string('telefono_celular',30)->nullable();
            $table->string('telefono_fijo',30)->nullable();
            $table->string('telefono_varios',30)->nullable();
            $table->integer('idmodalidad')->nullable();
            $table->integer('idespecialidad')->nullable();
            $table->integer('idmodalidad2')->nullable();
            $table->integer('idespecialidad2')->nullable();
            $table->integer('idpais')->nullable();
            $table->integer('idubigeo')->nullable();
            $table->string('direccion')->nullable();
            $table->integer('idcolegio')->nullable();
            $table->integer('iduniversidad')->nullable();
            $table->bigInteger('inicio_estudios')->nullable();
            $table->bigInteger('fin_estudios')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->integer('idpaisnacimiento')->nullable();
            $table->integer('idubigeonacimiento')->nullable();
            $table->integer('idubigeoprovincia')->nullable();
            $table->string('direccion_provincia')->nullable();
            $table->string('telefono_provincia',30)->nullable();
            $table->string('foto_cargada',200)->default('avatar/nofoto.jpg');
            $table->string('foto_editada',200)->nullable();
            $table->string('foto_rechazada',200)->nullable();
            $table->string('foto_estado',200)->default('SIN FOTO');
            $table->date('foto_fecha_carga')->nullable();
            $table->date('foto_fecha_rechazo')->nullable();
            $table->date('foto_fecha_edicion')->nullable();
            $table->integer('idaula1')->nullable();
            $table->integer('idaula2')->nullable();
            $table->integer('idaula3')->nullable();
            $table->integer('idaulavoca')->nullable();
            $table->boolean('anulado')->default(false);
            $table->boolean('datos_ok')->default(false);
            $table->boolean('pago')->default(false);
            $table->date('fecha_registro')->nullable();
            $table->date('fecha_conformidad')->nullable();
            $table->integer('idusuario')->nullable();
            $table->timestamps();
            $table->foreign('idevaluacion')->references('id')->on('evaluacion');
            $table->foreign('idusuario')->references('id')->on('users');
            $table->foreign('idsexo')->references('id')->on('catalogo');
            $table->foreign('idaula1')->references('id')->on('aula');
            $table->foreign('idaula2')->references('id')->on('aula');
            $table->foreign('idaula3')->references('id')->on('aula');
            $table->foreign('idaulavoca')->references('id')->on('aula');
            $table->unique(['numero_identificacion']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postulante');
    }
}
