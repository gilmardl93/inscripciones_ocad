@extends('layouts.base')

@section('content')
<div class="col-md-12">
    <!-- BEGIN PORTLET-->
    <div class="portlet light tasks-widget widget-comments">
        <div class="portlet-title margin-bottom-20">
            <div class="caption caption-md font-red-sunglo">
                <span class="caption-subject theme-font bold uppercase">FORMATOs DE PAGO AL NOMBRE DEL PARTICIPANTE</span>
            </div>
            <div class="actions">
                {!!Form::back(route('home.index'))!!}
            </div>
        </div>
        <div class="form-body ">
        <h4><b>Estos son los pagos de que debe realizar</b></h4>
            <div class="list-group">
                <a href="{{ route('pagos.formato',$pagos['prospecto']) }}" class="list-group-item active">
                    <h4 class="list-group-item-heading">Prospecto de Admisión virtual</h4>
                    <p class="list-group-item-text"> El prospecto de admisión virtual comprende los siguientes documentos (Reglamento, Solucionario del examen de admisión 2017-1,Catalogo de carreras). </p>
                </a>
                @if (isset($pagos['examen']))
                <a href="{{ route('pagos.formato',$pagos['examen']) }}" class="list-group-item">
                    <h4 class="list-group-item-heading">Derecho de Examen</h4>
                    <p class="list-group-item-text"> Es el pago por derecho de rendir examen. </p>
                </a>
                @endif
                @if (isset($pagos['vocacepre']))
                    <a href="{{ route('pagos.formato',$pagos['vocacepre']) }}" class="list-group-item">
                        <h4 class="list-group-item-heading">Prueba de Aptitud Vocacional para arquitectura (CEPRE-UNI)</h4>
                        <p class="list-group-item-text"> Dirigido a los postulantes de CEPRE-UNI que desean ingresar a la especialidad de Arquitectura. </p>
                    </a>
                @endif
                @if (isset($pagos['voca']))
                <a href="{{ route('pagos.formato',$pagos['voca']) }}" class="list-group-item">
                    <h4 class="list-group-item-heading">Prueba de Aptitud Vocacional para arquitectura</h4>
                    <p class="list-group-item-text"> Dirigido a los postulantes que desean ingresar a la especialidad de Arquitectura. </p>
                </a>
                @endif
                @if (isset($pagos['extemporaneo']))
                <a href="{{ route('pagos.formato',$pagos['extemporaneo']) }}" class="list-group-item">
                    <h4 class="list-group-item-heading">Inscripción Extemporanea</h4>
                    <p class="list-group-item-text"> Este pago se realizá cuando realiza la inscripción fuera de la fecha del cronograma. </p>
                </a>
                @endif
            </div>

        </div>
    </div>
    <!-- END PORTLET-->
</div>

@stop

