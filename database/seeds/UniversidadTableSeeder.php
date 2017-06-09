<?php

use App\Models\Universidad;
use Illuminate\Database\Seeder;

class UniversidadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Universidad::create(['codigo' => 'UPSJB','nombre'=>'ASOCIACIÓN UNIVERSIDAD Privada SAN JUAN BAUTISTA','gestion'=>'Privada','idubigeo'=>1431,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UBB','nombre'=>'BIRKBECK UNIVERSITY OF LONDON','gestion'=>'Privada','idubigeo'=>null,'idpais'=>22,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'COLEGIO  JOSE CARLOS MARIATEGUI','gestion'=>'Pública','idubigeo'=>609,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'EO-PNP','nombre'=>'ESCUELA DE OFICIALES - POLICÍA NACIONAL DEL PERÚ','gestion'=>'Pública','idubigeo'=>1431,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'ENAMM','nombre'=>'ESCUELA NACIONAL MARINA MERCANTE ','gestion'=>'Pública','idubigeo'=>762,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'HEMILIO VALDIZAN','gestion'=>'Pública','idubigeo'=>1017,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'CUJAE','nombre'=>'INSTITUTO SUPERIOR POLITÉCNICO JOSÉ ANTONIO ECHEVA','gestion'=>'Privada','idubigeo'=>null,'idpais'=>35,'activo'=>true]);
		Universidad::create(['codigo' => 'ITCM','nombre'=>'INSTITUTO TECNOLOGICO DE CIUDAD MADERO','gestion'=>'Privada','idubigeo'=>null,'idpais'=>19,'activo'=>true]);
		Universidad::create(['codigo' => 'MACQU','nombre'=>'MACQUARIE UNIVERSITY','gestion'=>'Privada','idubigeo'=>null,'idpais'=>30,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'PEDRO RUIZ GALLO','gestion'=>'Pública','idubigeo'=>99,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'PUCP','nombre'=>'PONTIFICIA UNIVERSIDAD CATÓLICA DEL PERÚ','gestion'=>'Privada','idubigeo'=>534,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'QUOT','nombre'=>'QUEENSLAND UNIVERSITY OF TECHNOLOGY','gestion'=>'Privada','idubigeo'=>null,'idpais'=>30,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'SAN MARTIN DE PORRES DE CAJAMARQUIILLA','gestion'=>'Pública','idubigeo'=>1707,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'SANTA ISABEL','gestion'=>'Pública','idubigeo'=>1151,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'SANTA ISABEL - HUANCAYO','gestion'=>'Pública','idubigeo'=>1448,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNASAM','gestion'=>'Pública','idubigeo'=>99,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNE','nombre'=>'ENRIQUE GUZMAN Y VALLE','gestion'=>'Pública','idubigeo'=>1186,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNPRG','nombre'=>'UNIV NAC PEDRO RUIZ GALLO','gestion'=>'Pública','idubigeo'=>1380,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNJ','nombre'=>'UNIVERSDIDAD NACIONAL DE JAEN','gestion'=>'Pública','idubigeo'=>null,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UAP','nombre'=>'UNIVERSIDAD ALAS PERUANAS','gestion'=>'Privada','idubigeo'=>null,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNIVERSIDAD ALAS PERUANAS','gestion'=>'Privada','idubigeo'=>490,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNIVERSIDAD ALAS PERUANAS','gestion'=>'Privada','idubigeo'=>1443,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNIVERSIDAD ALAS PERUANAS','gestion'=>'Privada','idubigeo'=>1427,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNIVERSIDAD ALAS PERUANAS ','gestion'=>'Privada','idubigeo'=>630,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UAC','nombre'=>'UNIVERSIDAD ANDINA DEL CUSCO','gestion'=>'Privada','idubigeo'=>771,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UANCV','nombre'=>'UNIVERSIDAD ANDINA NÉSTOR CÁCERES VELÁSQUEZ','gestion'=>'Privada','idubigeo'=>1912,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UAUP','nombre'=>'UNIVERSIDAD AUTONOMA DEL PERU','gestion'=>'Privada','idubigeo'=>1465,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'USP','nombre'=>'UNIVERSIDAD CATÓLICA SAN PABLO','gestion'=>'Privada','idubigeo'=>372,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UCSM','nombre'=>'UNIVERSIDAD CATÓLICA SANTA MARÍA','gestion'=>'Privada','idubigeo'=>372,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UCSTM','nombre'=>'UNIVERSIDAD CATÓLICA SANTO TORIBIO DE MOGROVEJO','gestion'=>'Privada','idubigeo'=>1381,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UCSS','nombre'=>'UNIVERSIDAD CATÓLICA SEDES SAPIENTIAE','gestion'=>'Privada','idubigeo'=>1440,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UCVCP','nombre'=>'UNIVERSIDAD CÉSAR VALLEJO CHICLAYO','gestion'=>'Privada','idubigeo'=>1393,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UCVLM','nombre'=>'UNIVERSIDAD CÉSAR VALLEJO LIMA-NORTE','gestion'=>'Privada','idubigeo'=>1440,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UCAAL','nombre'=>'UNIVERSIDAD CIENCIAS Y ARTES DE AMERICA LATINA','gestion'=>'Privada','idubigeo'=>1437,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNIVERSIDAD CIENTÍFICA DEL SUR','gestion'=>'Privada','idubigeo'=>383,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UCSUR','nombre'=>'UNIVERSIDAD CIENTÍFICA DEL SUR','gestion'=>'Privada','idubigeo'=>1431,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UCCI','nombre'=>'UNIVERSIDAD CONTINENTAL DE CIENCIA E INGENIERÍA','gestion'=>'Privada','idubigeo'=>1151,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNIVERSIDAD DE CHICLAYO','gestion'=>'Privada','idubigeo'=>1381,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNIVERSIDAD DE CHILE ','gestion'=>'Pública','idubigeo'=>null,'idpais'=>5,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNIVERSIDAD DE CIENCIAS Y HUMANIDADES','gestion'=>'Privada','idubigeo'=>1440,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UFAEP','nombre'=>'UNIVERSIDAD DE LAS FUERZAS ARMADAS','gestion'=>'Privada','idubigeo'=>null,'idpais'=>7,'activo'=>true]);
		Universidad::create(['codigo' => 'ULIMA','nombre'=>'UNIVERSIDAD DE LIMA','gestion'=>'Privada','idubigeo'=>1463,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UPIURA','nombre'=>'UNIVERSIDAD DE PIURA','gestion'=>'Privada','idubigeo'=>1738,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNIVERSIDAD DE PIURA - CAMPUS LIMA','gestion'=>'Privada','idubigeo'=>383,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'USMP','nombre'=>'UNIVERSIDAD DE SAN MARTÍN DE PORRES','gestion'=>'Privada','idubigeo'=>1460,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UTACNA','nombre'=>'UNIVERSIDAD DE TACNA','gestion'=>'Privada','idubigeo'=>2024,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => ' ','nombre'=>'UNIVERSIDAD DE TARAPACA','gestion'=>'Pública','idubigeo'=>null,'idpais'=>5,'activo'=>true]);
		Universidad::create(['codigo' => 'UP','nombre'=>'UNIVERSIDAD DEL PACÍFICO','gestion'=>'Privada','idubigeo'=>null,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UE','nombre'=>'UNIVERSIDAD ESAN','gestion'=>'Privada','idubigeo'=>1463,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNIVERSIDAD FEDERICO VILLARREAL','gestion'=>'Pública','idubigeo'=>1443,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNIVERSIDAD FEDERICO VILLARREAL','gestion'=>'Pública','idubigeo'=>383,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNIFE','nombre'=>'UNIVERSIDAD FEMENINA DEL SAGRADO CORAZÓN','gestion'=>'Privada','idubigeo'=>1437,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UIGV','nombre'=>'UNIVERSIDAD INCA GARCILASO DE LA VEGA','gestion'=>'Privada','idubigeo'=>null,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UJCM','nombre'=>'UNIVERSIDAD JOSÉ CARLOS MARIÁTEGUI','gestion'=>'Privada','idubigeo'=>1681,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'ULADECH','nombre'=>'UNIVERSIDAD LOS ÁNGELES DE CHIMBOTE','gestion'=>'Privada','idubigeo'=>251,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNAS','nombre'=>'UNIVERSIDAD NACIONAL AGRARIA DE LA SELVA','gestion'=>'Pública','idubigeo'=>1057,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNALM','nombre'=>'UNIVERSIDAD NACIONAL AGRARIA LA MOLINA','gestion'=>'Pública','idubigeo'=>1437,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNIVERSIDAD NACIONAL DANIEL ALCIDES CARRIÓN','gestion'=>'Pública','idubigeo'=>1283,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNDAC','nombre'=>'UNIVERSIDAD NACIONAL DANIEL ALCIDES CARRIÓN','gestion'=>'Pública','idubigeo'=>1707,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNC','nombre'=>'UNIVERSIDAD NACIONAL DE CAJAMARCA','gestion'=>'Pública','idubigeo'=>621,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNE','nombre'=>'UNIVERSIDAD NACIONAL DE EDUCACIÓN E.G.V.','gestion'=>'Pública','idubigeo'=>1441,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNH','nombre'=>'UNIVERSIDAD NACIONAL DE HUANCAVELICA','gestion'=>'Pública','idubigeo'=>897,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNI','nombre'=>'UNIVERSIDAD NACIONAL DE INGENIERÍA','gestion'=>'Pública','idubigeo'=>null,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNAP','nombre'=>'UNIVERSIDAD NACIONAL DE LA AMAZONÍA PERUANA','gestion'=>'Pública','idubigeo'=>1606,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNP','nombre'=>'UNIVERSIDAD NACIONAL DE PIURA','gestion'=>'Pública','idubigeo'=>1738,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNR','nombre'=>'UNIVERSIDAD NACIONAL DE ROSARIO','gestion'=>'Privada','idubigeo'=>null,'idpais'=>2,'activo'=>true]);
		Universidad::create(['codigo' => 'UNSA','nombre'=>'UNIVERSIDAD NACIONAL DE SAN AGUSTÍN DE AREQUIPA','gestion'=>'Pública','idubigeo'=>372,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNSAAC','nombre'=>'UNIVERSIDAD NACIONAL DE SAN ANTONIO ABAD DEL CUSCO','gestion'=>'Pública','idubigeo'=>771,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNIVERSIDAD NACIONAL DE SAN MARTIN','gestion'=>'Pública','idubigeo'=>2013,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNSM','nombre'=>'UNIVERSIDAD NACIONAL DE SAN MARTÍN','gestion'=>'Pública','idubigeo'=>2004,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNT','nombre'=>'UNIVERSIDAD NACIONAL DE TRUJILLO','gestion'=>'Pública','idubigeo'=>1285,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNTUMBES','nombre'=>'UNIVERSIDAD NACIONAL DE TUMBES','gestion'=>'Pública','idubigeo'=>2057,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNU','nombre'=>'UNIVERSIDAD NACIONAL DE UCAYALI','gestion'=>'Pública','idubigeo'=>2076,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNA','nombre'=>'UNIVERSIDAD NACIONAL DEL ALTIPLANO','gestion'=>'Pública','idubigeo'=>1812,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNAC','nombre'=>'UNIVERSIDAD NACIONAL DEL CALLAO','gestion'=>'Pública','idubigeo'=>704,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNCP','nombre'=>'UNIVERSIDAD NACIONAL DEL CENTRO DEL PERÚ','gestion'=>'Pública','idubigeo'=>1151,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNIVERSIDAD NACIONAL DEL CENTRO DEL PERÚ ','gestion'=>'Pública','idubigeo'=>1161,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNS','nombre'=>'UNIVERSIDAD NACIONAL DEL SANTA','gestion'=>'Pública','idubigeo'=>259,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNIVERSIDAD NACIONAL FEDERICO VILLAREAL','gestion'=>'Pública','idubigeo'=>1422,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNFV','nombre'=>'UNIVERSIDAD NACIONAL FEDERICO VILLARREAL','gestion'=>'Pública','idubigeo'=>534,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNIVERSIDAD NACIONAL FEDERICO VILLARREAL','gestion'=>'Pública','idubigeo'=>1428,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNIVERSIDAD NACIONAL FEDERICO VILLARREAL','gestion'=>'Pública','idubigeo'=>198,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNHEVAL','nombre'=>'UNIVERSIDAD NACIONAL HERMILIO VALDIZÁN','gestion'=>'Pública','idubigeo'=>1007,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNJBG','nombre'=>'UNIVERSIDAD NACIONAL JORGE BASADRE GROHMANN','gestion'=>'Pública','idubigeo'=>2024,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNJFSC','nombre'=>'UNIVERSIDAD NACIONAL JOSÉ F. SÁNCHEZ CARRIÓN','gestion'=>'Pública','idubigeo'=>1551,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNIVERSIDAD NACIONAL JOSE FAUSTINO SANCHEZ CARRION','gestion'=>'Pública','idubigeo'=>1504,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNMSM','nombre'=>'UNIVERSIDAD NACIONAL MAYOR DE SAN MARCOS','gestion'=>'Pública','idubigeo'=>1422,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNIVERSIDAD NACIONAL MAYOR DE SAN MARCOS','gestion'=>'Pública','idubigeo'=>534,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNIVERSIDAD NACIONAL MAYOR DE SAN MARCOS','gestion'=>'Pública','idubigeo'=>762,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNAMBA','nombre'=>'UNIVERSIDAD NACIONAL MICAELA BASTIDAS DE APURIMAC ','gestion'=>'Pública','idubigeo'=>281,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNIVERSIDAD NACIONAL PEDRO RUIZ GALLO','gestion'=>'Pública','idubigeo'=>1381,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNSCH','nombre'=>'UNIVERSIDAD NACIONAL SAN CRISTÓBAL DE HUAMANGA','gestion'=>'Pública','idubigeo'=>490,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNICA','nombre'=>'UNIVERSIDAD NACIONAL SAN LUIS GONZAGA','gestion'=>'Pública','idubigeo'=>1101,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNIVERSIDAD NACIONAL SAN LUIS GONZAGA','gestion'=>'Pública','idubigeo'=>null,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNASAM','nombre'=>'UNIVERSIDAD NACIONAL SANTIAGO ANTÚNEZ DE MAYOLO','gestion'=>'Pública','idubigeo'=>94,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNIVERSIDAD NACIONAL SANTIAGO ANTÚNEZ DE MAYOLO','gestion'=>'Pública','idubigeo'=>1467,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UNTECS','nombre'=>'UNIVERSIDAD NACIONAL TEC. DEL CONO SUR DE LIMA ','gestion'=>'Pública','idubigeo'=>1465,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UPCH','nombre'=>'UNIVERSIDAD PERUANA CAYETANO HEREDIA','gestion'=>'Privada','idubigeo'=>null,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UPC','nombre'=>'UNIVERSIDAD PERUANA DE CIENCIAS APLICADAS','gestion'=>'Privada','idubigeo'=>1463,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UPLA','nombre'=>'UNIVERSIDAD PERUANA LOS ANDES','gestion'=>'Privada','idubigeo'=>1151,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UPEU','nombre'=>'UNIVERSIDAD PERUANA UNIÓN','gestion'=>'Privada','idubigeo'=>1441,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UPAO','nombre'=>'UNIVERSIDAD Privada ANTENOR ORREGO','gestion'=>'Privada','idubigeo'=>1285,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UPAGU','nombre'=>'UNIVERSIDAD Privada ANTONIO GUILLERMO URRELO','gestion'=>'Privada','idubigeo'=>621,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UCV','nombre'=>'UNIVERSIDAD Privada CÉSAR VALLEJO','gestion'=>'Privada','idubigeo'=>1285,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UCHICLAYO','nombre'=>'UNIVERSIDAD Privada DE CHICLAYO','gestion'=>'Privada','idubigeo'=>1381,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNIVERSIDAD Privada DE CIENCIAS APLICADAS','gestion'=>'Privada','idubigeo'=>1422,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UIQUITOS','nombre'=>'UNIVERSIDAD Privada DE IQUITOS','gestion'=>'Privada','idubigeo'=>1606,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UPNL','nombre'=>'UNIVERSIDAD Privada DEL  NORTE - LIMA','gestion'=>'Privada','idubigeo'=>1440,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UPN','nombre'=>'UNIVERSIDAD Privada DEL NORTE','gestion'=>'Privada','idubigeo'=>1285,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UPH','nombre'=>'UNIVERSIDAD Privada HUÁNUCO','gestion'=>'Privada','idubigeo'=>1007,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UMCH','nombre'=>'UNIVERSIDAD Privada MARCELINO CHAMPAGNAT','gestion'=>'Privada','idubigeo'=>1463,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UWIENER','nombre'=>'UNIVERSIDAD Privada NORBERT WIENER','gestion'=>'Privada','idubigeo'=>1422,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'USIL','nombre'=>'UNIVERSIDAD Privada SAN IGNACIO DE LOYOLA','gestion'=>'Privada','idubigeo'=>1437,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UPSP','nombre'=>'UNIVERSIDAD Privada SAN PEDRO','gestion'=>'Privada','idubigeo'=>251,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UPSS','nombre'=>'UNIVERSIDAD Privada SEÑOR DE SIPÁN','gestion'=>'Privada','idubigeo'=>1381,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UTELESUP','nombre'=>'UNIVERSIDAD Privada TELESUP','gestion'=>'Privada','idubigeo'=>1422,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'URP','nombre'=>'UNIVERSIDAD RICARDO PALMA','gestion'=>'Privada','idubigeo'=>1463,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNIVERSIDAD RICARDO PALMA','gestion'=>'Privada','idubigeo'=>1463,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>'UNIVERSIDAD RUSA DE LA AMISTAD DE LOS PUEBLOS','gestion'=>'Privada','idubigeo'=>490,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'USFX','nombre'=>'UNIVERSIDAD SAN FRANCISCO XAVIER DE CHUQUISACA','gestion'=>'Privada','idubigeo'=>null,'idpais'=>3,'activo'=>true]);
		Universidad::create(['codigo' => 'UTA','nombre'=>'UNIVERSIDAD TECNOLÓGICA DE LOS ANDES','gestion'=>'Privada','idubigeo'=>281,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UTP','nombre'=>'UNIVERSIDAD TECNOLÓGICA DEL PERÚ','gestion'=>'Privada','idubigeo'=>1422,'idpais'=>1,'activo'=>true]);
		Universidad::create(['codigo' => 'UTS','nombre'=>'UNIVERSITY OF TECHNOLOGY SYDNEY','gestion'=>'Privada','idubigeo'=>null,'idpais'=>30,'activo'=>true]);
		Universidad::create(['codigo' => null,'nombre'=>null,'gestion'=>'Pública','idubigeo'=>762,'idpais'=>1,'activo'=>true]);

    }
}
