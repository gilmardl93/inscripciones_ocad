<?php

use App\Models\Evaluacion;
use Illuminate\Database\Seeder;

class EvaluacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Evaluacion::create(['codigo' => '2017-2','nombre' => 'CONCURSO DE ADMISION 2017-2', 'descripcion' => 'CONCURSO DE ADMISION 2017-2','fecha_inicio'=>'2017-04-17','fecha_fin'=>'2017-05-31','activo'=>true]);

    }
}
