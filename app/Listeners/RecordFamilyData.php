<?php

namespace App\Listeners;

use App\Events\AfterUpdatingDataFamily;
use App\Models\Proceso;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RecordFamilyData
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
    public function handle(AfterUpdatingDataFamily $event)
    {
        $postulante = $event->Postulante;
        $proceso = Proceso::where('idpostulante',$postulante->id)->update(['datos_familiares'=>true]);
    }
}
