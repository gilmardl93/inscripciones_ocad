@extends('layouts.base')

@section('content')
@include('alerts.errors')
{!! Alert::render() !!}
<div class="col-md-12">
    <!-- BEGIN PORTLET-->
    <div class="portlet light tasks-widget widget-comments">
        <div class="portlet-title margin-bottom-20">
            <div class="caption caption-md font-red-sunglo">
                <span class="caption-subject theme-font bold uppercase">DATOS PERSONALES DEL PARTICIPANTE </span>
            </div>
            <div class="actions">
                {!!Form::back(route('home.index'))!!}
            </div>
        </div>
        <div class="form-body ">
        Debe ingresar la siguiente información
        <p></p>
        <div class="col-md-3">
            <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ route('datos.postulante.index') }}">
                <div class="visual">
                    <i class="fa fa-book"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span>Preinscripción</span>
                    </div>
                    <div class="desc"> Datos, modalidad del postulante </div>
                </div>
            </a>
        </div>
        @if ($swp)

        <div class="col-md-3">
            <a class="dashboard-stat dashboard-stat-v2 purple" href="{{ route('datos.secundarios.index') }}">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span>Datos personales</span>
                    </div>
                    <div class="desc"> Datos personales del postulante </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a class="dashboard-stat dashboard-stat-v2 red" href="{{ route('datos.familiares.index') }}">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span>Familiares</span>
                    </div>
                    <div class="desc"> Datos de los familiares del postulante </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a class="dashboard-stat dashboard-stat-v2 green" href="{{ route('datos.complementarios.index') }}">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span>Complementario</span>
                    </div>
                    <div class="desc"> Datos complementarios del postulante </div>
                </div>
            </a>
        </div>
        @endif

        </div>
    </div>
    <!-- END PORTLET-->
</div>

@stop