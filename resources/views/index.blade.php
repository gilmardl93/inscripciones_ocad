@extends('layouts.base')

@section('content')
{!! Alert::render() !!}
@include('alerts.errors')
<div class="row">
    <div class="col-md-12">
    <!-- BEGIN PORTLET-->
    <div class="portlet light ">
        <div class="portlet-title margin-bottom-10">
            <div class="caption caption-md font-red-sunglo">
                <span class="caption-subject theme-font bold uppercase">Bienvenido</span>
            </div>
        </div>
        <div class="portlet-body overflow-h">
            Para realizar tu inscripción deberás seguir los siguientes pasos:
            <ol>
                <li>Datos: Deberás registrar los datos del postulante (no del apoderado), donde ingresarás Apellido paterno, apellido materno, nombres, modalidad, especialidad e institución educativa donde estudió el postulante</li>
                <li>Pagos: Imprimirás los FORMATO DE PAGO que el sistema genera según la modalidad que ha escogido para realizar el pago en el banco Scotiabak, Financiero, BCP</li>
                <li>Ficha: Imprimirás tu ficha de inscripción después de realizar el pago y que la foto haya sido verificada por la Oficina Central de Admisión</li>
            </ol>
            Si tuviese alguna duda puedes hacer click al boton &nbsp<span class="label label-danger"> Ayuda </span>&nbsp que se encuentra a la derecha de la ventana y te aparecerán indicaciones para poder realizar la inscripción
        </div>
    </div>
    <!-- END PORTLET-->
</div>
</div><!--row-->
<div class="row">
    <div class="col-md-12">
        <div class="mt-element-step">
            <div class="row step-background">
                <a href="{{ route('datos.index') }}">
                <div class="col-md-4 bg-grey-steel mt-step-col">
                    <div class="mt-step-number">1</div>
                    <div class="mt-step-title uppercase font-grey-cascade">Datos</div>
                    <div class="mt-step-content font-grey-cascade">Datos Personales</div>
                </div>
                </a>
                <a href="{{ route('pagos.index') }}">
                <div class="col-md-4 bg-grey-steel mt-step-col active">
                    <div class="mt-step-number">2</div>
                    <div class="mt-step-title uppercase font-grey-cascade">Pago</div>
                    <div class="mt-step-content font-grey-cascade">Formatos de pagos</div>
                </div>
                </a>
                <a href="{{ route('ficha.index') }}">
                <div class="col-md-4 bg-grey-steel mt-step-col">
                    <div class="mt-step-number">3</div>
                    <div class="mt-step-title uppercase font-grey-cascade">Ficha</div>
                    <div class="mt-step-content font-grey-cascade">Ficha de inscripción</div>
                </div>
                </a>
            </div>
        </div>
    </div><!--span-->
</div><!--row-->
<p></p>
<div class="row widget-row">
    <div class="col-md-6">
        <a href="{{ route('reglamento.index') }}" class="list-group-item">
            <h4 class="list-group-item-heading">Descarga</h4>
            <p class="list-group-item-text"> Prospecto, reglamento, especialidades. </p>
        </a>
    </div>
    <div class="col-md-6">
        <a href="{{ route('contacto.index') }}" class="list-group-item">
            <h4 class="list-group-item-heading">Contáctanos</h4>
            <p class="list-group-item-text"> Si tienes dificultades con tu inscripción. </p>
        </a>
    </div>
</div>

@stop


