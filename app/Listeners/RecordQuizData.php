<?php

namespace App\Listeners;

use App\Events\AfterUpdatingDataQuiz;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RecordQuizData
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
    public function handle(AfterUpdatingDataQuiz $event)
    {
        $postulante = $event->Postulante;
        $proceso = Proceso::where('idpostulante',$postulante->id)->update(['encuesta'=>true]);
    }
}
