<?php

namespace App\Providers;

use App\Models\Catalogo;
use App\Models\Colegio;
use App\Models\Cronograma;
use App\Models\Modalidad;
use App\Models\Postulante;
use App\Models\SinVacante;
use App\Models\Validacion;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
class RulesServiceProvider extends ServiceProvider
{
    public $Mensaje;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->RequiredSchool();
        $this->UniqueSchool();
        $this->RequiredCodCepre();
        $this->RequiredModCepre();
        $this->RequiredEspCepre();
        $this->ValidaCodeCepre();
        $this->ValidaFechaInscripcion();
        $this->ValidaNumeroIdentificacion();
        $this->ValidaNumIdenUsuario();
        $this->ValidaVacantes();
        #Validacion de datos de familiares
        $this->DniSize();
        $this->DniNumeric();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function ValidaVacantes()
    {
        Validator::extend('required_vacante', function ($attribute, $value, $parameters, $validator) {
            $sin_vacante = SinVacante::where('idespecialidad',$value)->where('idmodalidad',$parameters[0])->get();
            return $sin_vacante->IsEmpty();
        },"No existe Vacante de esta especialidad en la modalidad que escogio");
    }
    public function UniqueSchool()
    {
        Validator::extend('unique_school', function ($attribute, $value, $parameters, $validator) {

            $colegio = Colegio::where('anexo',$value)->where('codigo_modular',$parameters[0])->get();

            return $colegio->IsEmpty();;

        },"El colegio que desea ingresar ya existe");
    }
    public function CodigoExist()
    {
        Validator::extend('codigo_exist', function ($attribute, $value, $parameters, $validator) {
            $correcto = true;
            if (is_array($value)) {
                foreach ($value as $key => $item) {
                    if(strlen($item)<8){
                        $correcto = false;
                        break;
                    }
                }
            } else if(strlen($value)<8)$correcto = false;

            return $correcto;

        },"Uno de los DNI Ingresado no tiene 8 digitos");
    }
    public function DniSize()
    {
        Validator::extend('dni_size', function ($attribute, $value, $parameters, $validator) {
            $correcto = true;
            if (is_array($value)) {
                foreach ($value as $key => $item) {
                    if(strlen($item)<8){
                        $correcto = false;
                        break;
                    }
                }
            } else if(strlen($value)<8)$correcto = false;

            return $correcto;

        },"Uno de los DNI Ingresado no tiene 8 digitos o no has llenado los datos completo de
        (Papá, Mamá o apoderado) los tres registros son obligatorios");
    }
    public function DniNumeric()
    {
        Validator::extend('dni_numeric', function ($attribute, $value, $parameters, $validator) {
            $correcto = true;
            foreach ($value as $key => $item) {
                if(!is_numeric($item)){
                    $correcto = false;
                    break;
                }
            }
            return $correcto;


        },"Uno de los DNI Ingresado contiene un caracter que no es numerico o no has llenado los datos completo de
        (Papá, Mamá o apoderado) los tres registros son obligatorios");
    }
    /**
     * Valido la institucion educativa que requiere la modalidad
     */
    public function ValidaNumIdenUsuario()
    {
        Validator::extend('num_ide_usu', function ($attribute, $value, $parameters, $validator) {

            if (Auth::user()->dni !=$value) return false;
            return true;

        },"El DNI Ingresado es diferente al DNI que usted creo al inicio");
    }
    /**
     * Valido la institucion educativa que requiere la modalidad
     */
    public function ValidaNumeroIdentificacion()
    {
        Validator::extend('num_ide_max', function ($attribute, $value, $parameters, $validator) {
            if (isset($parameters[0])) {
                $tipo = Catalogo::find($parameters[0]);
                if ($tipo->nombre == 'DNI' && strlen($value)!=8) return false;
                return true;
            } else return false;


        },"El DNI ingresado debe contener 8 digitos");
    }
    /**
     * Valido la institucion educativa que requiere la modalidad
     */
    public function ValidaFechaInscripcion()
    {
        Validator::extend('fecha_ins', function ($attribute, $value, $parameters, $validator) {
            $date = Carbon::now()->toDateString();
            $fecha_inicio = Cronograma::FechaInicio('INSC');
            $fecha_fin = Cronograma::FechaFin('INEX');

            if($date>=$fecha_inicio && $date<=$fecha_fin) return true;
            return false;
        },"No esta habilitada la inscripción");
    }
    /**
     * Valido la institucion educativa que requiere la modalidad
     */
    public function RequiredSchool()
    {
        Validator::extend('required_ie', function ($attribute, $value, $parameters, $validator) {

            $modalidad = Modalidad::find($value);
            $retval = false;
            if ($modalidad->colegio && is_numeric($parameters[0])) {
                $retval = true;
            }elseif (!$modalidad->colegio && is_numeric($parameters[1])) {
                $retval = true;
            }

            return $retval;
        },"No escogio institución educativa ");
    }
    /**
     * Valido la institucion educativa que requiere la modalidad
     */
    public function ValidaCodeCepre()
    {

        Validator::extend('valida_cod_cepre', function ($attribute, $value, $parameters, $validator)  {
            if(isset($parameters[0])){
                $modalidad = Modalidad::find($parameters[0]);
                if ($modalidad->codigo =='ID-CEPRE') {
                    $cepre = Validacion::where('codigo',$value)->Activos()->first();
                    return !is_null($cepre);
                } else {
                    return true;
                }
            }else{
                return false;
            }


        },"No existe este codigo de cepreuni");
    }
    /**
     * Valido si se ha escogido la segunda modalidad
     */
    public function RequiredModCepre()
    {

        Validator::extend('required_mod_cepre', function ($attribute, $value, $parameters, $validator)  {

            $modalidad1 = Modalidad::find($value);
            $modalidad2 = Modalidad::find($parameters[0]);

            $retVal = true;
            if ($modalidad1->codigo =='ID-CEPRE') {
                return !is_null($modalidad2);
            } else {
                $retVal = true;
            }

            return $retVal;

        },"No escogio su segunda modalidad");
    }
    /**
     * Valido si ha ingresado el codigo
     */
    public function RequiredCodCepre()
    {

        Validator::extend('required_cod_cepre', function ($attribute, $value, $parameters, $validator)  {

            $modalidad1 = Modalidad::find($value);

            $retVal = true;
            if ($modalidad1->codigo =='ID-CEPRE') {
                return !is_null($parameters[0]);
            } else {
                $retVal = true;
            }

            return $retVal;

        },"El codigo de cepre UNI es obligatorio");
    }
    /**
     * Valido si ha ingresado la segunda especialidad
     */
    public function RequiredEspCepre()
    {

        Validator::extend('required_esp_cepre', function ($attribute, $value, $parameters, $validator)  {

            $modalidad1 = Modalidad::find($value);

            $retVal = true;
            if ($modalidad1->codigo =='ID-CEPRE') {
                return !is_null($parameters[0]);
            } else {
                $retVal = true;
            }

            return $retVal;

        },"No escogio su segunda especialidad");
    }



}
