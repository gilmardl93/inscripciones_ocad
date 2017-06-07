<?php

namespace App\Providers;

use App\Http\ViewComposers\AulasActivasSelectData;
use App\Http\ViewComposers\ComplementarioSelectData;
use App\Http\ViewComposers\ControlSelectData;
use App\Http\ViewComposers\EspecialidadSelectData;
use App\Http\ViewComposers\ModalidadSelectData;
use App\Http\ViewComposers\PaisSelectData;
use App\Http\ViewComposers\RoleSelectData;
use App\Http\ViewComposers\SexoSelectData;
use App\Http\ViewComposers\TipoIdentificacionSelectData;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->make('view')->composer(
            ['datos.personal.index','datos.personal.edit'],
            ModalidadSelectData::class
            );
        $this->app->make('view')->composer(
            ['datos.personal.index','datos.personal.edit','datos.complementarios.index','datos.complementarios.edit'],
            EspecialidadSelectData::class
            );
        $this->app->make('view')->composer(
            ['datos.secundarios.index'],
            SexoSelectData::class
            );
        $this->app->make('view')->composer(
            ['datos.complementarios.index','datos.complementarios.edit'],
            ComplementarioSelectData::class
            );
        $this->app->make('view')->composer(
            ['admin.users.index','admin.users.edit','admin.users.delete'],
            RoleSelectData::class
            );
        $this->app->make('view')->composer(
            ['admin.aulas.activas'],
            AulasActivasSelectData::class
            );
        $this->app->make('view')->composer(
            ['admin.colegio.index','datos.personal.index','datos.personal.edit','datos.secundarios.index'],
            PaisSelectData::class
            );
        $this->app->make('view')->composer(
            ['datos.personal.index','datos.personal.edit','datos.secundarios.index'],
            TipoIdentificacionSelectData::class
            );
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
}
