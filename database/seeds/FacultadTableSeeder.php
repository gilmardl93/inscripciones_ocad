<?php

use App\Models\Facultad;
use Illuminate\Database\Seeder;

class FacultadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Facultad::create(['codigo'=>'A','nombre'=>'ARQUITECTURA, URBANISMO Y ARTES','sigla'=>'FAUA']);
		Facultad::create(['codigo'=>'C','nombre'=>'INGENIERÍA CIVIL','sigla'=>'FIC']);
		Facultad::create(['codigo'=>'E','nombre'=>'INGENIERÍA ECONÓMICA Y CIENCIAS SOCIALES','sigla'=>'FIECS']);
		Facultad::create(['codigo'=>'G','nombre'=>'INGENIERÍA GEOLÓGICA, MINERA Y METALÚRGICA','sigla'=>'FIGMN']);
		Facultad::create(['codigo'=>'I','nombre'=>'INGENIERÍA INDUSTRIAL Y DE SISTEMAS','sigla'=>'FIIS']);
		Facultad::create(['codigo'=>'L','nombre'=>'INGENIERÍA ELÉCTRICA Y ELECTRÓNICA','sigla'=>'FIEE']);
		Facultad::create(['codigo'=>'M','nombre'=>'INGENIERÍA MECÁNICA','sigla'=>'FIM']);
		Facultad::create(['codigo'=>'N','nombre'=>'CIENCIAS','sigla'=>'FC']);
		Facultad::create(['codigo'=>'P','nombre'=>'INGENIERÍA DE PETRÓLEO, GAS NATURAL Y PETROQUÍMICA','sigla'=>'FIP']);
		Facultad::create(['codigo'=>'Q','nombre'=>'INGENIERÍA QUÍMICA Y TEXTIL','sigla'=>'FIQT']);
		Facultad::create(['codigo'=>'S','nombre'=>'INGENIERÍA AMBIENTAL','sigla'=>'FIA']);

    }
}
