@extends('layouts.base')

@section('content')
@include('alerts.errors')
<div class="col-md-12">
    <!-- BEGIN PORTLET-->
    <div class="portlet light tasks-widget widget-comments">
        <div class="portlet-title margin-bottom-20">
            <div class="caption caption-md font-red-sunglo">
                <span class="caption-subject theme-font bold uppercase">DATOS PESONALES DEL PARTICIPANTE (NO DEL APODERADO)</span>
            </div>
            <div class="actions">
                {!!Form::back(route('home.index'))!!}
            </div>
        </div>
        <div class="form-body ">
        Tus nombres y apellidos deben coincidir con el de tu DNI, los campos con asterisco son obligatorios
        <p></p>
        <div class="col-md-3">
            <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ route('datos.potulante.index') }}">
                <div class="visual">
                    <i class="fa fa-book"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span>Datos</span>
                    </div>
                    <div class="desc"> Datos del postulante </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a class="dashboard-stat dashboard-stat-v2 red" href="#">
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
            <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span>Modalidad</span>
                    </div>
                    <div class="desc"> Modalidad y colegio del postulante </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span>Varios</span>
                    </div>
                    <div class="desc"> Datos complementarios del postulante </div>
                </div>
            </a>
        </div>

        </div>
    </div>
    <!-- END PORTLET-->
</div>

@stop