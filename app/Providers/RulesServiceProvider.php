<?php

namespace App\Providers;

use App\Models\Modalidad;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class RulesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->RequiredSchool();
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
    /**
     * Valido la institucion educativa que requiere la modalidad
     */
    public function RequiredSchool()
    {
        $retmsj = '';
        Validator::extend('required_ie', function ($attribute, $value, $parameters, $validator) use ($retmsj) {

            $modalidad = Modalidad::find($value);
            $retval = false;
            if ($modalidad->colegio && $parameters[0]>0) {
                $retval = true;
                $retmsj = 'Colegio';
            }elseif (!$modalidad->colegio && $parameters[1]>0) {
                $retval = true;
                $retmsj = 'Universidad';
            }

            return $retval;
        },"No escogio institución educativa $retmsj");
    }
}
