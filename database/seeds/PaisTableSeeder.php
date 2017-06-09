<?php

use App\Models\Pais;
use Illuminate\Database\Seeder;

class PaisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pais::create(['codigo'=>'PE','nombre'=>'PERÚ','activo'=>true]);
		Pais::create(['codigo'=>'AR','nombre'=>'ARGENTINA','activo'=>true]);
		Pais::create(['codigo'=>'BO','nombre'=>'BOLIVIA','activo'=>true]);
		Pais::create(['codigo'=>'BR','nombre'=>'BRAZIL','activo'=>true]);
		Pais::create(['codigo'=>'CL','nombre'=>'CHILE','activo'=>true]);
		Pais::create(['codigo'=>'CO','nombre'=>'COLOMBIA','activo'=>true]);
		Pais::create(['codigo'=>'EC','nombre'=>'ECUADOR','activo'=>true]);
		Pais::create(['codigo'=>'PY','nombre'=>'PARAGUAY','activo'=>true]);
		Pais::create(['codigo'=>'UY','nombre'=>'URUGUAY','activo'=>true]);
		Pais::create(['codigo'=>'VE','nombre'=>'VENEZUELA','activo'=>true]);
		Pais::create(['codigo'=>'BZ','nombre'=>'BELIZE','activo'=>true]);
		Pais::create(['codigo'=>'CR','nombre'=>'COSTA RICA','activo'=>true]);
		Pais::create(['codigo'=>'SV','nombre'=>'EL SALVADOR','activo'=>true]);
		Pais::create(['codigo'=>'GT','nombre'=>'GUATEMALA','activo'=>true]);
		Pais::create(['codigo'=>'HN','nombre'=>'HONDURAS','activo'=>true]);
		Pais::create(['codigo'=>'NI','nombre'=>'NICARAGUA','activo'=>true]);
		Pais::create(['codigo'=>'PA','nombre'=>'PANAMÁ','activo'=>true]);
		Pais::create(['codigo'=>'US','nombre'=>'EE.UU.','activo'=>true]);
		Pais::create(['codigo'=>'MX','nombre'=>'MÉXICO','activo'=>true]);
		Pais::create(['codigo'=>'CA','nombre'=>'CANADA','activo'=>true]);
		Pais::create(['codigo'=>'AN','nombre'=>'ANGOLA','activo'=>true]);
		Pais::create(['codigo'=>'IN','nombre'=>'INGLATERRA','activo'=>true]);
		Pais::create(['codigo'=>'RU','nombre'=>'RUSIA','activo'=>true]);
		Pais::create(['codigo'=>'JP','nombre'=>'JAPÓN','activo'=>true]);
		Pais::create(['codigo'=>'CN','nombre'=>'CHINA','activo'=>true]);
		Pais::create(['codigo'=>'UK','nombre'=>'UCRANIA','activo'=>true]);
		Pais::create(['codigo'=>'ES','nombre'=>'ESPAÑA','activo'=>true]);
		Pais::create(['codigo'=>'IT','nombre'=>'ITALIA','activo'=>true]);
		Pais::create(['codigo'=>'DE','nombre'=>'ALEMANIA','activo'=>true]);
		Pais::create(['codigo'=>'AU','nombre'=>'AUSTRALIA','activo'=>true]);
		Pais::create(['codigo'=>'SY','nombre'=>'SIRIA','activo'=>true]);
		Pais::create(['codigo'=>'LY','nombre'=>'LIBIA','activo'=>true]);
		Pais::create(['codigo'=>'IQ','nombre'=>'IRAK','activo'=>true]);
		Pais::create(['codigo'=>'SZ','nombre'=>'SUIZA','activo'=>true]);
		Pais::create(['codigo'=>'CU','nombre'=>'CUBA','activo'=>true]);
		Pais::create(['codigo'=>'NE','nombre'=>'NO ESPECIFICA','activo'=>true]);

    }
}
