@extends('layouts.admin')

@section('content')
        {!! Alert::render() !!}
<div class="row">
    <div class="col-md-12">
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-envelope-o"></i>Comunicación </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a class="reload actualizar"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
        <ul class="nav nav-pills">
            <li class="active">
                <a href="#tab_1" data-toggle="tab"> Email </a>
            </li>
            <li>
                <a href="#tab_2" data-toggle="tab"> Mensaje de texto </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="tab_1">
            {!! Form::open(['route'=>'admin.comunicacion.emails','method'=>'POST']) !!}
                {!! Field::text('asunto',['label'=>'Asunto del Mensaje','placeholder'=>'Asunto del Mensaje']) !!}
                {!! Field::text('dni',['label'=>'Dni del remitente','placeholder'=>'Dni del remitente']) !!}
                {!! Field::textarea('mensaje',['label'=>'Mensaje','placeholder'=>'Mensaje que desea enviar']) !!}

                {!!Form::enviar('Enviar')!!}
            {!! Form::close() !!}

            </div>
            <div class="tab-pane fade" id="tab_2">
                {!! Form::open(['route'=>'admin.comunicacion.sms','method'=>'POST']) !!}
                    {!! Field::text('celular',['label'=>'Ingrese celular','placeholder'=>'Ingrese celular']) !!}
                    {!! Field::textarea('mensaje',['label'=>'Mensaje','placeholder'=>'Mensaje que desea enviar','maxlength'=>'160']) !!}

                    {!!Form::enviar('Enviar')!!}
                {!! Form::close() !!}
            </div>
        </div>
        </div>
    </div>
    <!-- END Portlet PORTLET-->
    </div><!--span-->
</div><!--row-->
@stop

@section('plugins-js')
{!! Html::script(asset('assets/global/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js')) !!}
@stop


@section('menu-user')
@include('menu.profile-admin')
@stop

@section('sidebar')
@include(Auth::user()->menu)
@stop


@section('user-name')
{!!Auth::user()->dni!!}
@stop

@section('breadcrumb')

@stop


@section('page-title')

@stop

@section('page-subtitle')
@stop



