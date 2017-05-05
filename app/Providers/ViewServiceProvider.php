<?php

namespace App\Providers;

use App\Http\ViewComposers\AulasActivasSelectData;
use App\Http\ViewComposers\ControlSelectData;
use App\Http\ViewComposers\EspecialidadSelectData;
use App\Http\ViewComposers\PaisSelectData;
use App\Http\ViewComposers\RoleSelectData;
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
            ControlSelectData::class
            );
        $this->app->make('view')->composer(
            ['datos.personal.index','datos.personal.edit'],
            EspecialidadSelectData::class
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
            ['admin.colegio.index','datos.personal.index','datos.personal.edit'],
            PaisSelectData::class
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
