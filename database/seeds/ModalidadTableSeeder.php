<?php

use App\Models\Modalidad;
use Illuminate\Database\Seeder;

class ModalidadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Modalidad::create(['codigo' => 'O','nombre'=>'ORDINARIO','modalidad2'=>'ID-CEPRE','colegio'=>true]);
        Modalidad::create(['codigo' => 'E1DPA','nombre'=>'EXTRAORDINARIO1 - DOS PRIMEROS ALUMNOS','modalidad2'=>'ID-CEPRE','colegio'=>true]);
        Modalidad::create(['codigo' => 'E1DCAN','nombre'=>'EXTRAORDINARIO1 - DEPORTISTAS CALIFICADOS DE ALTO NIVEL','modalidad2'=>'ID-CEPRE','colegio'=>true]);
        Modalidad::create(['codigo' => 'E1DB','nombre'=>'EXTRAORDINARIO1 - DIPLOMADOS CON BACHILLERATO','modalidad2'=>'ID-CEPRE','colegio'=>true]);
        Modalidad::create(['codigo' => 'E1TG','nombre'=>'EXTRAORDINARIO1 - TITULADOS O GRADUADOS','modalidad2'=>'ID-CEPRE','colegio'=>false]);
        Modalidad::create(['codigo' => 'E1TGU','nombre'=>'EXTRAORDINARIO1 - TITULADO O GRADUADO UNI','modalidad2'=>'ID-CEPRE','colegio'=>false]);
        Modalidad::create(['codigo' => 'E1TE','nombre'=>'EXTRAORDINARIO1 - TRASLADO EXTERNO','modalidad2'=>'ID-CEPRE','colegio'=>false]);
        Modalidad::create(['codigo' => 'E1CD','nombre'=>'EXTRAORDINARIO1 - CONVENIO DIPLOMATICO','modalidad2'=>'ID-CEPRE','colegio'=>true]);
        Modalidad::create(['codigo' => 'E1CABI','nombre'=>'EXTRAORDINARIO1 - CONVENIO ANDRES BELLO (iniciar estudios)','modalidad2'=>'ID-CEPRE','colegio'=>true]);
        Modalidad::create(['codigo' => 'E1CABC','nombre'=>'EXTRAORDINARIO1 - CONVENIO ANDRES BELLO (continuar estudios)','modalidad2'=>'ID-CEPRE','colegio'=>false]);
        Modalidad::create(['codigo' => 'E1VTI','nombre'=>'EXTRAORDINARIO1 - VICTIMAS DEL TERRORISMO (iniciar estudios)','modalidad2'=>'ID-CEPRE','colegio'=>true]);
        Modalidad::create(['codigo' => 'E1VTC','nombre'=>'EXTRAORDINARIO1 - VICTIMAS DEL TERRORISMO (continuar estudios)','modalidad2'=>'ID-CEPRE','colegio'=>false]);
        Modalidad::create(['codigo' => 'E1PDI','nombre'=>'EXTRAORDINARIO1 - PERSONAS CON DISCAPACIDAD (iniciar estudios)','modalidad2'=>'ID-CEPRE','colegio'=>true]);
        Modalidad::create(['codigo' => 'E1PDC','nombre'=>'EXTRAORDINARIO1 - PERSONAS CON DISCAPACIDAD (continuar estudios)','modalidad2'=>'ID-CEPRE','colegio'=>false]);
        Modalidad::create(['codigo' => 'E1TI','nombre'=>'EXTRAORDINARIO1 - TRASLADO INTERNO','modalidad2'=>'ID-CEPRE','colegio'=>false]);
        Modalidad::create(['codigo' => 'ID-CEPRE','nombre'=>'EXTRAORDINARIO2 – INGRESO DIRECTO CEPRE','colegio'=>true]);
        Modalidad::create(['codigo' => 'IEN-UNI','nombre'=>'EXTRAORDINARIO2 – INGRESO ESCOLAR NACIONAL','colegio'=>false]);


    }
}
