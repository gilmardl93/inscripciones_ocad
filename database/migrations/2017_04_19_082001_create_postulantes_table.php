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
            $table->integer('idespecialidad')->nullable();
            $table->string('codigo',6)->nullable();
            $table->string('paterno',50)->nullable();
            $table->string('materno',50)->nullable();
            $table->string('nombres',50)->nullable();
            $table->string('dni',20)->nullable();
            $table->integer('idubigeo')->nullable();
            $table->string('direccion')->nullable();
            $table->integer('idubigeonacimiento')->nullable();
            $table->string('direccion_nacimiento')->nullable();
            $table->integer('idcolegio')->nullable();
            $table->string('telefono_celular',30)->nullable();
            $table->string('telefono_fijo',30)->nullable();
            $table->string('telefono_varios',30)->nullable();
            $table->string('telefono_provincia',30)->nullable();
            $table->string('email',100)->nullable();
            $table->string('foto_cargada',200)->default('avatar/nofoto.jpg');
            $table->string('foto_editada',200)->nullable();
            $table->string('foto_rechazo',200)->nullable();
            $table->string('foto_estado',200)->default('SIN FOTO');
            $table->date('fecha_foto')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->integer('idsexo')->nullable();
            $table->integer('idusuario')->nullable();
            $table->integer('idgrado')->nullable();
            $table->integer('idaula')->nullable();
            $table->date('fecha_registro')->nullable();
            $table->string('mensaje',50)->nullable();
            $table->boolean('pago')->default(false);
            $table->boolean('pago_prospecto')->default(false);
            $table->boolean('anulado')->default(false);
            $table->boolean('datos_ok')->default(false);
            $table->timestamps();
            $table->foreign('idevaluacion')->references('id')->on('evaluacion');
            $table->foreign('idubigeo')->references('id')->on('ubigeo');
            $table->foreign('idubigeonacimiento')->references('id')->on('ubigeo');
            $table->foreign('idusuario')->references('id')->on('users');
            $table->foreign('idsexo')->references('id')->on('catalogo');
            $table->foreign('idgrado')->references('id')->on('catalogo');
            $table->foreign('idaula')->references('id')->on('aula');
            $table->foreign('idsede')->references('id')->on('catalogo');
            $table->unique(['idevaluacion','codigo','dni']);
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
