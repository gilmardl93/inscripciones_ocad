<?php

use App\Models\Catalogo;
use App\Models\Colegio;
use App\Models\Evaluacion;
use App\Models\Mensaje;
use App\Models\Ubigeo;
use App\Models\Universidad;
if (! function_exists('IdEvaluacion')) {
	/**
	 * Funcion que retorna el prefijo para nombres de archivos
	 * @return [type] [description]
	 */
    function IdEvaluacion()
    {
    	$evaluacion = Evaluacion::select('id')->where('activo',1)->first();
        return $evaluacion->id;
    }
}

if (! function_exists('IdRole')) {
    /**
     * Funcion que retorna el prefijo para nombres de archivos
     * @return [type] [description]
     */
    function IdRole($name)
    {
        $role = Catalogo::select('id')->table('ROLES')->where('codigo',$name)->first();
        return $role->id;
    }
}

if (! function_exists('NameCatalogo')) {
    /**
     * Funcion que retorna el prefijo para nombres de archivos
     * @return [type] [description]
     */
    function NameCatalogo($id)
    {
        $role = Catalogo::select('nombres')->where('id',$id)->first();
        return $role->nombres;
    }
}
if (! function_exists('IdTCCodigo')) {
    /**
     * Funcion que retorna el prefijo para nombres de archivos
     * @return [type] [description]
     */
    function IdTCCodigo($table,$codigo)
    {
        return Catalogo::IdCatalogoCodigo($table,$codigo);
    }
}

if (! function_exists('SiNo')) {
    /**
     * Funcion que retorna el prefijo para nombres de archivos
     * @return [type] [description]
     */
    function SiNo($valor)
    {
        if ($valor) {
           return '<span class="label label-sm label-info"> SI </span>';
        }else{
           return '<span class="label label-sm label-danger"> NO </span>';
        }
    }
}

/**
 * Devuelve un pad del elemento que ingrese
 */
if (! function_exists('pad')) {
    /**
     * Funcion que retorna el prefijo para nombres de archivos
     * @return [type] [description]
     */
    function pad($input,$cant,$aguja,$lado = null)
    {
        switch ($lado) {
            case 'L':
                $pad = str_pad($input, $cant, $aguja,STR_PAD_LEFT);
                break;
            case 'B':
                $pad = str_pad($input, $cant, $aguja,STR_PAD_BOTH);
                break;

            default:
                $pad = str_pad($input, $cant, $aguja);
                break;
        }

        return $pad;
    }
}

/**
 * Devuelve un pad del elemento que ingrese
 */
if (! function_exists('str_clean')) {
    /**
     * Funcion que retorna el prefijo para nombres de archivos
     * @return [type] [description]
     */
    function str_clean($string)
    {
         $string = trim($string);
         $string = str_replace(
                array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
                array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
                $string
            );

            $string = str_replace(
                array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
                array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
                $string
            );

            $string = str_replace(
                array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
                array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
                $string
            );

            $string = str_replace(
                array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
                array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
                $string
            );

            $string = str_replace(
                array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
                array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
                $string
            );

            $string = str_replace(
                array('ñ', 'Ñ', 'ç', 'Ç'),
                array('n', 'N', 'c', 'C',),
                $string
            );
         //Esta parte se encarga de eliminar cualquier caracter extraño
            $string = str_replace(
                array("¨", "º", "-", "~",
                     '#', "@", "|", "!", '"',
                     "·", "$", "%", "&", "/",
                     "(", ")", "?", "'", "¡",
                     "¿", "[", "^", "<code>", "]",
                     "+", "}", "{", "¨", "´",
                     ">", "< ", ";", ",", ":",
                     "."),
                '',
                $string
            );

    return $string;
    }
}

/**
 * Devuelve un pad del elemento que ingrese
 */
if (! function_exists('search_in_array')) {
    /**
     * Funcion que retorna el prefijo para nombres de archivos
     * @return [type] [description]
     */
    function search_in_array($array,$field,$search,$retval)
    {
        $cnt = count($array);
        $value = 0;
        for ($i=0; $i < $cnt; $i++) {
            if ($array[$i][$field]==$search) {
                $value = $array[$i][$retval];
            }
        }

        return $value;
    }
}
/**
 * Devuelve un pad del elemento que ingrese
 */
if (! function_exists('NumeroInscripcion')) {
    /**
     * Funcion que retorna el prefijo para nombres de archivos
     * @return [type] [description]
     */
    function NumeroInscripcion($primerdigito,$id)
    {
        $numero = $primerdigito.str_pad($id, 4, '0', STR_PAD_LEFT);
        $letra = '';
        $suma = 0;
        for ($i = 0; $i < 5; $i++) {
            $suma += substr($numero, $i, 1) * ($i + 1);
        }
        $letra = chr($suma % 11 + 65);
        $codigo = $numero.$letra;

        return $codigo;
    }
}

/**
 * Devuelve un pad del elemento que ingrese
 */
if (! function_exists('extension')) {
    /**
     * Funcion que retorna el prefijo para nombres de archivos
     * @return [type] [description]
     */
    function extension($str)
    {
        $ext = explode(".", $str);
        $ext = '.'.end($ext);
        return $ext;
    }
}
/**
 * Devuelve un pad del elemento que ingrese
 */
if (! function_exists('FinalizoConcurso')) {
    /**
     * Funcion que retorna el prefijo para nombres de archivos
     * @return [type] [description]
     */
    function FinalizoConcurso($str)
    {
        $ext = explode(".", $str);
        $ext = '.'.end($ext);
        return $ext;
    }
}
/**
 * Devuelve un pad del elemento que ingrese
 */
if (! function_exists('PorAtender')) {
    /**
     * Funcion que retorna el prefijo para nombres de archivos
     * @return [type] [description]
     */
    function PorAtender()
    {
        $mensajes = Mensaje::whereNull('respuesta')->orderBy('created_at')->get();
        return $mensajes;
    }
}

/**
 * devuelve el id estado de catalogo
 */
if (! function_exists('ubigeopersonal')) {
    /**
     * funcion que retorna el prefijo para nombres de archivos
     * @return [type] [description]
     */
    function ubigeopersonal($id)
    {
        if (isset($id)) {
            $ubigeo = ubigeo::where('id',$id)->pluck('nombre','id')->toarray();
        } else {
            $ubigeo=[];
        }
        return $ubigeo;
    }
}
/**
 * devuelve el id estado de catalogo
 */
if (! function_exists('ColegioPersonal')) {
    /**
     * funcion que retorna el prefijo para nombres de archivos
     * @return [type] [description]
     */
    function ColegioPersonal($id)
    {
        if (isset($id)) {
            $colegio = Colegio::where('id',$id)->pluck('nombre','id')->toarray();
        } else {
            $colegio=[];
        }
        return $colegio;
    }
}
/**
 * devuelve el id estado de catalogo
 */
if (! function_exists('UniversidadPersonal')) {
    /**
     * funcion que retorna el prefijo para nombres de archivos
     * @return [type] [description]
     */
    function UniversidadPersonal($id)
    {
        if (isset($id)) {
            $universidad = Universidad::where('id',$id)->pluck('nombre','id')->toarray();
        } else {
            $universidad=[];
        }
        return $universidad;
    }
}