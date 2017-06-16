@extends('layouts.base')

@section('content')
<div class="col-md-12">
    <!-- BEGIN PORTLET-->
    <div class="portlet light tasks-widget widget-comments">
        <div class="portlet-title margin-bottom-20">
            <div class="caption caption-md font-red-sunglo">
                <span class="caption-subject theme-font bold uppercase">FORMATO DE PAGO A NOMBRE DEL postulante</span>
            </div>
            <div class="actions">
                {!!Form::back(route('pagos.index'))!!}
            </div>
        </div>
        <div class="form-body ">
            <div class="Pulsear">
               <h1>Una vez realizado el pago en el banco y/o en la OCAD, esperar a que este sea validado por nuestro sistema. Este proceso puede durar 120 minutos </br>
               </h1>
            </div>
            <p></p>
            <iframe src="{{route('pagos.pdf',$servicio)}}" width="100%" height="600px" scrolling="auto"></iframe>
        </div>
    </div>
    <!-- END PORTLET-->
</div>

@stop

