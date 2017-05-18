<?php

namespace App\Listeners;

use App\Events\AfterUpdatingDataPersonal;
use App\Models\Proceso;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RecordSecondaryData
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AfterUpdatingData  $event
     * @return void
     */
    public function handle(AfterUpdatingDataPersonal $event)
    {
        $postulante = $event->Postulante;
        $proceso = Proceso::where('idpostulante',$postulante->id)->update(['datos_personales'=>true]);
    }
}
