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
        Catalogo::create(['idtable' => 0,'iditem' => 5, 'codigo' => 'IDENTIFICACION','nombre' => 'IDENTIFICACION','descripcion'=>'SEDES','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 0,'iditem' => 6, 'codigo' => 'RAZON','nombre' => 'RAZON','descripcion'=>'Elección de la primera prioridad','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 0,'iditem' => 7, 'codigo' => 'TPRE','nombre' => 'TIPO PREPARACION','descripcion'=>'Tipo de Preparación para el Concurso','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 0,'iditem' => 8, 'codigo' => 'ACAD','nombre' => 'ACADEMIA','descripcion'=>'Academia Pre-Universitaria','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 0,'iditem' => 9, 'codigo' => 'ING','nombre' => 'INGRESO','descripcion'=>'Ingreso Familiar promedio','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 0,'iditem' => 10, 'codigo' => 'INF','nombre' => 'INFORMES','descripcion'=>'Medio mediante el cual se informo el postulante acerca del Examen de Admisión','valor'=> null,'activo'=>true]);
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
        Catalogo::create(['idtable' => 1,'iditem' => 8, 'codigo' => 'semibeca','nombre' => 'Semibeca','descripcion'=>'Semibecas','valor'=> null,'activo'=>true]);
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
        Catalogo::create(['idtable' => 5,'iditem' => 1, 'codigo' => 'DNI','nombre' => 'DNI','descripcion'=>'Documento Nacional de identidad','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 5,'iditem' => 2, 'codigo' => 'PART','nombre' => 'PARTIDA DE NACIMIENTO','descripcion'=>'PARTIDA DE NACIMIENTO','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 5,'iditem' => 3, 'codigo' => 'LM','nombre' => 'LIBRETA MILITAR','descripcion'=>'LIBRETA MILITAR','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 5,'iditem' => 4, 'codigo' => 'BM','nombre' => 'BOLETA MILITAR','descripcion'=>'BOLETA MILITAR','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 5,'iditem' => 5, 'codigo' => 'EXT','nombre' => 'CARNE DE EXTRANJERIA','descripcion'=>'CARNE DE EXTRANJERIA','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 5,'iditem' => 6, 'codigo' => 'OTROS','nombre' => 'OTROS','descripcion'=>'OTROS','valor'=> null,'activo'=>true]);
        /**
         * Razón de postulacion
         */
        Catalogo::create(['idtable' => 6,'iditem' => 1, 'codigo' => 'DE','nombre' => 'GRAN DEMANDA','descripcion'=>'Es una profesión de gran demanda y bien remunerada','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 6,'iditem' => 2, 'codigo' => 'MP','nombre' => 'MISMA PROFESIÓN','descripcion'=>'Sus padres y parientes tienen la misma profesión','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 6,'iditem' => 3, 'codigo' => 'IP','nombre' => 'INCLINACIÓN','descripcion'=>'Posee inclinación por esa especialidad','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 6,'iditem' => 4, 'codigo' => 'OV','nombre' => 'O. VOCACIONAL','descripcion'=>'Por orientación vocacional','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 6,'iditem' => 5, 'codigo' => 'OT','nombre' => 'OTROS','descripcion'=>'Otros','valor'=> null,'activo'=>true]);
        /**
         * Tipo de preparacion
         */
        Catalogo::create(['idtable' => 7,'iditem' => 1, 'codigo' => 'A','nombre' => 'ACADEMIA','descripcion'=>'Preparación en Academia','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 7,'iditem' => 2, 'codigo' => 'U','nombre' => 'AUTOPREPARACIÓN','descripcion'=>'Autopreparación','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 7,'iditem' => 3, 'codigo' => 'P','nombre' => 'PARTICULAR','descripcion'=>'Profesor Particular','valor'=> null,'activo'=>true]);
        Catalogo::create(['idtable' => 7,'iditem' => 4, 'codigo' => 'O','nombre' => 'OTRO','descripcion'=>'Otro tipo de preparación','valor'=> null,'activo'=>true]);
        /**
         * Academia
         */
         Catalogo::create(['idtable' => 8,'iditem' => 1, 'codigo' => 'CEPRE','nombre' => 'CEPRE-UNI','descripcion'=>'Centro Pre-Universitario de la Universidad Nacional de Ingeniería','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 8,'iditem' => 2, 'codigo' => 'ADUNI','nombre' => 'ADUNI','descripcion'=>'Academia Pre-Universitaria de la Asociación de Docentes de la UNI','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 8,'iditem' => 3, 'codigo' => 'VALLEJO','nombre' => 'CÉSAR VALLEJO','descripcion'=>'Academia Pre-Universitaria César Vallejo','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 8,'iditem' => 4, 'codigo' => 'PITAGORAS','nombre' => 'PITÁGORAS','descripcion'=>'Asociación Educativa Pitágoras','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 8,'iditem' => 5, 'codigo' => 'PAMER','nombre' => 'PAMER','descripcion'=>'Academia Pre-Universitaria PAMER','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 8,'iditem' => 6, 'codigo' => 'TRILCE','nombre' => 'TRILCE','descripcion'=>'Academia TRILCE','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 8,'iditem' => 7, 'codigo' => 'ALFA','nombre' => 'ALFA','descripcion'=>'Academia Pre-Universitaria ALFA','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 8,'iditem' => 8, 'codigo' => 'SACO','nombre' => 'SACO OLIVEROS','descripcion'=>'Academia Pre-Universitaria Saco Oliveros','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 8,'iditem' => 9, 'codigo' => 'APPU','nombre' => 'APPU','descripcion'=>'Academia APPU','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 8,'iditem' => 10, 'codigo' => 'SUI','nombre' => 'SUI GÉNERIS','descripcion'=>'Sui Géneris Grupo de Estudio','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 8,'iditem' => 11, 'codigo' => 'SANFER','nombre' => 'SAN FERNANDO','descripcion'=>'Academia Peruana San Fernando','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 8,'iditem' => 12, 'codigo' => 'CIRCULO','nombre' => 'CÍRCULO UNI-UNMSM','descripcion'=>'Asociación Educativa Círculo UNI - San Marcos','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 8,'iditem' => 13, 'codigo' => 'OTRA','nombre' => 'OTRA','descripcion'=>'Otra academia','valor'=> null,'activo'=>true]);
         /**
          * Ingreso economico
          */
         Catalogo::create(['idtable' => 9,'iditem' => 1, 'codigo' => '0','nombre' => 'MENOR A 800','descripcion'=>'Menor a S/.800,00','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 9,'iditem' => 2, 'codigo' => '800','nombre' => '800 - 1500','descripcion'=>'Entre S/.800,00 y S/.1 500,00','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 9,'iditem' => 3, 'codigo' => '1500','nombre' => '1500 - 2000','descripcion'=>'Entre S/.1 500,00 y S/.2 000,00','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 9,'iditem' => 4, 'codigo' => '2000','nombre' => '2000 - 3000','descripcion'=>'Entre S/.2 000,00 y S/.3 000,00','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 9,'iditem' => 5, 'codigo' => '3000','nombre' => '3000 - 4000','descripcion'=>'Entre S/.3 000,00 y S/.4 000,00','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 9,'iditem' => 6, 'codigo' => '4000','nombre' => '4000 - 5000','descripcion'=>'Entre S/.4 000,00 y S/.5 000,00','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 9,'iditem' => 7, 'codigo' => '5000','nombre' => 'MAYOR a 5000','descripcion'=>'Mayor a S/.5 000,00','valor'=> null,'activo'=>true]);
        /**
         * Medio de informacion
         */
         Catalogo::create(['idtable' => 10,'iditem' => 1, 'codigo' => 'TV','nombre' => 'TELEVISION','descripcion'=>'TELEVISION','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 10,'iditem' => 3, 'codigo' => 'OTRARAD','nombre' => 'OTRAS RADIOS','descripcion'=>'OTRAS RADIOS','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 10,'iditem' => 4, 'codigo' => 'ELCOME','nombre' => 'EL COMERCIO','descripcion'=>'EL COMERCIO','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 10,'iditem' => 5, 'codigo' => 'ELCORR','nombre' => 'EL CORREO','descripcion'=>'EL CORREO','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 10,'iditem' => 7, 'codigo' => 'OTRODIA','nombre' => 'OTRO DIARIO','descripcion'=>'OTRO DIARIO','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 10,'iditem' => 8, 'codigo' => 'AMIGOS','nombre' => 'POR AMIGOS','descripcion'=>'POR AMIGOS','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 10,'iditem' => 9, 'codigo' => 'WEB','nombre' => 'INTERNET','descripcion'=>'INTENET','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 10,'iditem' => 2, 'codigo' => 'RPP','nombre' => 'RADIO PROGRAMAS DEL PERÚ','descripcion'=>'RADIO PROGRAMAS DEL PERÚ','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 10,'iditem' => 6, 'codigo' => 'PERU21','nombre' => 'PERÚ 21','descripcion'=>'PERÚ 21','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 10,'iditem' => 10, 'codigo' => 'radio1','nombre' => 'MODA','descripcion'=>'MODA','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 10,'iditem' => 11, 'codigo' => 'radio2','nombre' => 'PLANETA','descripcion'=>'PLANETA','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 10,'iditem' => 12, 'codigo' => 'radio3','nombre' => 'STUDIO 92','descripcion'=>'STUDIO 92','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 10,'iditem' => 13, 'codigo' => 'radiO4','nombre' => 'LA ZONA','descripcion'=>'LA ZONA','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 10,'iditem' => 14, 'codigo' => 'RADIO5','nombre' => 'EXITOSA','descripcion'=>'EXITOSA DEPORTES','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 10,'iditem' => 15, 'codigo' => 'RADIO6','nombre' => 'CAPITAL','descripcion'=>'RADIO CAPITAL LA HORA 15','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 10,'iditem' => 16, 'codigo' => 'ZONA','nombre' => 'LA ZONA','descripcion'=>'RADIZONA D ETIBURONES','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 10,'iditem' => 17, 'codigo' => 'TROME','nombre' => 'EL TROME','descripcion'=>'EL TROME','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 10,'iditem' => 18, 'codigo' => 'OJO','nombre' => 'EL OJO','descripcion'=>'EL OJO','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 10,'iditem' => 19, 'codigo' => 'PUBLIMETRO','nombre' => 'PUBLIMETRO','descripcion'=>'PUBLIMETRO','valor'=> null,'activo'=>true]);
         Catalogo::create(['idtable' => 10,'iditem' => 20, 'codigo' => 'MSJ','nombre' => 'MENSAJE DE TEXTO','descripcion'=>'MENSAJE DE TEXTO','valor'=> null,'activo'=>true]);


    }
}
