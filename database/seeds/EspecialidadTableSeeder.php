<?php

use App\Models\Especialidad;
use Illuminate\Database\Seeder;

class EspecialidadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Especialidad::create(['idfacultad'=>1,'codigo'=>'A1','nombre'=>'ARQUITECTURA','canal'=>'V','activo'=>true]);
		Especialidad::create(['idfacultad'=>2,'codigo'=>'C1','nombre'=>'INGENIERÍA CIVIL','canal'=>'IV','activo'=>true]);
		Especialidad::create(['idfacultad'=>3,'codigo'=>'E3','nombre'=>'INGENIERÍA ESTADÍSTICA','canal'=>'III','activo'=>true]);
		Especialidad::create(['idfacultad'=>3,'codigo'=>'E1','nombre'=>'INGENIERÍA ECONÓMICA','canal'=>'III','activo'=>true]);
		Especialidad::create(['idfacultad'=>3,'codigo'=>'E2','nombre'=>'ESTADÍSTICA','canal'=>'III','activo'=>false]);
		Especialidad::create(['idfacultad'=>4,'codigo'=>'G1','nombre'=>'INGENIERÍA GEOLÓGICA','canal'=>'VI','activo'=>true]);
		Especialidad::create(['idfacultad'=>4,'codigo'=>'G3','nombre'=>'INGENIERÍA DE MINAS','canal'=>'VI','activo'=>true]);
		Especialidad::create(['idfacultad'=>4,'codigo'=>'G2','nombre'=>'INGENIERÍA METALÚRGICA','canal'=>'VI','activo'=>true]);
		Especialidad::create(['idfacultad'=>5,'codigo'=>'I2','nombre'=>'INGENIERÍA DE SISTEMAS','canal'=>'III','activo'=>true]);
		Especialidad::create(['idfacultad'=>5,'codigo'=>'I1','nombre'=>'INGENIERÍA INDUSTRIAL','canal'=>'III','activo'=>true]);
		Especialidad::create(['idfacultad'=>6,'codigo'=>'L1','nombre'=>'INGENIERÍA ELÉCTRICA','canal'=>'II','activo'=>true]);
		Especialidad::create(['idfacultad'=>6,'codigo'=>'L3','nombre'=>'INGENIERÍA DE TELECOMUNICACIONES','canal'=>'II','activo'=>true]);
		Especialidad::create(['idfacultad'=>6,'codigo'=>'L2','nombre'=>'INGENIERÍA ELECTRÓNICA','canal'=>'II','activo'=>true]);
		Especialidad::create(['idfacultad'=>7,'codigo'=>'M3','nombre'=>'INGENIERÍA MECÁNICA','canal'=>'VI','activo'=>true]);
		Especialidad::create(['idfacultad'=>7,'codigo'=>'M4','nombre'=>'INGENIERÍA MECÁNICA-ELÉCTRICA','canal'=>'VI','activo'=>true]);
		Especialidad::create(['idfacultad'=>7,'codigo'=>'M5','nombre'=>'INGENIERÍA NAVAL','canal'=>'VI','activo'=>true]);
		Especialidad::create(['idfacultad'=>7,'codigo'=>'M6','nombre'=>'INGENIERÍA MECATRÓNICA','canal'=>'VI','activo'=>true]);
		Especialidad::create(['idfacultad'=>8,'codigo'=>'N1','nombre'=>'FÍSICA','canal'=>'II','activo'=>true]);
		Especialidad::create(['idfacultad'=>8,'codigo'=>'N6','nombre'=>'CIENCIA DE LA COMPUTACIÓN','canal'=>'III','activo'=>true]);
		Especialidad::create(['idfacultad'=>8,'codigo'=>'N4','nombre'=>'ESTADÍSTICA','canal'=>'III','activo'=>false]);
		Especialidad::create(['idfacultad'=>8,'codigo'=>'N2','nombre'=>'MATEMÁTICA','canal'=>'III','activo'=>true]);
		Especialidad::create(['idfacultad'=>8,'codigo'=>'N3','nombre'=>'QUÍMICA','canal'=>'I','activo'=>true]);
		Especialidad::create(['idfacultad'=>8,'codigo'=>'N5','nombre'=>'INGENIERÍA FÍSICA','canal'=>'II','activo'=>true]);
		Especialidad::create(['idfacultad'=>9,'codigo'=>'P3','nombre'=>'INGENIERÍA DE PETRÓLEO Y GAS NATURAL','canal'=>'I','activo'=>true]);
		Especialidad::create(['idfacultad'=>9,'codigo'=>'P2','nombre'=>'INGENIERÍA PETROQUÍMICA','canal'=>'I','activo'=>true]);
		Especialidad::create(['idfacultad'=>9,'codigo'=>'P1','nombre'=>'INGENIERÍA DE PETRÓLEO','canal'=>'I','activo'=>false]);
		Especialidad::create(['idfacultad'=>10,'codigo'=>'Q1','nombre'=>'INGENIERÍA QUÍMICA','canal'=>'I','activo'=>true]);
		Especialidad::create(['idfacultad'=>10,'codigo'=>'Q2','nombre'=>'INGENIERÍA TEXTIL','canal'=>'I','activo'=>true]);
		Especialidad::create(['idfacultad'=>11,'codigo'=>'S3','nombre'=>'INGENIERÍA AMBIENTAL','canal'=>'IV','activo'=>true]);
		Especialidad::create(['idfacultad'=>11,'codigo'=>'S1','nombre'=>'INGENIERÍA SANITARIA','canal'=>'IV','activo'=>true]);
		Especialidad::create(['idfacultad'=>11,'codigo'=>'S2','nombre'=>'INGENIERÍA DE HIGIENE Y SEGURIDAD INDUSTRIAL','canal'=>'IV','activo'=>true]);

    }
}
