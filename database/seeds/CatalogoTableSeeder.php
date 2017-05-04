<?php

use Illuminate\Database\Seeder;
use App\Models\Catalogo;

class CatalogoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Catalogo::create(['idtable' => 0,'iditem' => 0, 'codigo' => 'MAE','nombre'=>'MAESTRO','descripcion'=>'MAESTRO DE TABLAS','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 0,'iditem' => 1, 'codigo' => 'ROLES','nombre' => 'ROLES','descripcion'=>'Rol de lo su suarios al sistema','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 0,'iditem' => 2, 'codigo' => 'SEXO','nombre' => 'SEXO','descripcion'=>'SEXO','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 0,'iditem' => 3, 'codigo' => 'GRADO','nombre' => 'GRADO','descripcion'=>'GRADOS','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 0,'iditem' => 4, 'codigo' => 'SERVICIO','nombre' => 'SERVICIO','descripcion'=>'SERVICIO DE BANCO','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 0,'iditem' => 5, 'codigo' => 'TIPO IDENTIFICACION','nombre' => 'TIPO DE IDENTIFICACION','descripcion'=>'SEDES','valor'=> null,'activo'=>true]);
        /**
         * sub tablas
         */
        Catalogo::create(['idtable' => 1,'iditem' => 1, 'codigo' => 'root','nombre' => 'root','descripcion'=>'Administrador del sistema','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 1,'iditem' => 2, 'codigo' => 'alum','nombre' => 'Alumno','descripcion'=>'Alumno','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 1,'iditem' => 3, 'codigo' => 'admin','nombre' => 'Administrador','descripcion'=>'Administrador','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 1,'iditem' => 4, 'codigo' => 'foto','nombre' => 'Editor Foto','descripcion'=>'Editor Foto','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 1,'iditem' => 5, 'codigo' => 'pago','nombre' => 'Carga Pago','descripcion'=>'Carga Pago','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 1,'iditem' => 6, 'codigo' => 'jefe','nombre' => 'Jefatura','descripcion'=>'Jefatura','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 1,'iditem' => 7, 'codigo' => 'informes','nombre' => 'Informes','descripcion'=>'Informes','valor'=> null,'activo'=>true]);
        /**
         * Sexo
         */
        Catalogo::create(['idtable' => 2,'iditem' => 1, 'codigo' => 'M','nombre' => 'Masculino','descripcion'=>'Masculino','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 2,'iditem' => 2, 'codigo' => 'F','nombre' => 'Femenino','descripcion'=>'Femenino','valor'=> null,'activo'=>true]);
        /**
         * GRADOS
         */
        Catalogo::create(['idtable' => 3,'iditem' => 1, 'codigo' => '1A','nombre' => 'Primer Año','descripcion'=>'Primer Año','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 3,'iditem' => 2, 'codigo' => '2A','nombre' => 'Segundo Año','descripcion'=>'Segundo Año','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 3,'iditem' => 3, 'codigo' => '3A','nombre' => 'Tercer Año','descripcion'=>'Tercer Año','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 3,'iditem' => 4, 'codigo' => '4A','nombre' => 'Cuarto Año','descripcion'=>'Cuarto Año','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 3,'iditem' => 5, 'codigo' => '5A','nombre' => 'Quinto Año','descripcion'=>'Quinto Año','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 3,'iditem' => 6, 'codigo' => '6O','nombre' => 'Otro','descripcion'=>'Otro','valor'=> null,'activo'=>true]);
        /**
         * SERVICIO
         */
        Catalogo::create(['idtable' => 4,'iditem' => 1, 'codigo' => '520','nombre' => '520','descripcion'=>'INSCRIP. SIMULACRO','valor'=> 50,'activo'=>true]);
        /**
         * Tipo de Identificacion
         */


    }
}
