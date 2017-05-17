<?php

use App\Models\Cronograma;
use Illuminate\Database\Seeder;

class CronogramaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cronograma::create(['codigo'=>'INSC','nombre' => 'INSCRIPCION','fecha_inicio'=>'2017-04-17','fecha_fin'=>'2017-08-01','activo'=>true]);
        Cronograma::create(['codigo'=>'INEX','nombre' => 'INSCRIPCION EXTEMPORANEA','fecha_inicio'=>'2017-08-02','fecha_fin'=>'2017-08-03','activo'=>true]);
        Cronograma::create(['codigo'=>'INCE','nombre' => 'INSCRIPCION CEPRE-UNI','fecha_inicio'=>'2017-04-17','fecha_fin'=>'2017-07-14','activo'=>true]);
        Cronograma::create(['codigo'=>'INBE','nombre' => 'PRESENTA DOCUMENTO SEMIBECA','fecha_inicio'=>'2017-04-17','fecha_fin'=>'2017-07-12','activo'=>true]);
        Cronograma::create(['codigo'=>'IDIN','nombre' => 'IDENTIFICACION INGRESANTE','fecha_inicio'=>'2017-08-14','fecha_fin'=>'2017-08-17','activo'=>true]);

    }
}
