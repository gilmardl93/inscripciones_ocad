<?php

namespace App\Providers;

use App\Models\Postulante;
use App\Models\Proceso;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\AfterUpdatingDataPersonal' => [
            'App\Listeners\RecordSecondaryData'
        ],
        'App\Events\AfterUpdatingDataFamily' => [
            'App\Listeners\RecordFamilyData'
        ],
        'App\Events\AfterUpdatingDataQuiz' => [
            'App\Listeners\RecordQuizData'
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        /**
         * Indica al sistema que se lleno los datos de preinscripcion
         */
        Postulante::created(function($postulante){
            $proceso = new Proceso;
            $proceso->idpostulante = $postulante->id;
            $proceso->preinscripcion = true;
            $proceso->save();
        });

    }
}
