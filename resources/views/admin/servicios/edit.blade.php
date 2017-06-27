@extends('layouts.admin')

@section('content')
{!! Alert::render() !!}
@include('alerts.errors')
<div class="row">
	<div class="col-md-12">
	<!-- BEGIN Portlet PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-money"></i>Editar Servicio </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a class="reload actualizar"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
        {!! Form::model($servicio,['route'=>['admin.servicios.update',$servicio],'method'=>'PUT']) !!}
            <div class="row">
                <div class="col-md-2">
                    {!! Field::text('codigo',['label'=>'Ingresar Código','placeholder'=>'Ingresar Código']) !!}
                </div><!--span-->
                <div class="col-md-5">
                    {!! Field::text('descripcion',['label'=>'Ingresar Descripcion','placeholder'=>'Ingresar Descripcion']) !!}
                </div><!--span-->
                <div class="col-md-5">
                    {!! Field::text('partida',['label'=>'Ingresar Partida','placeholder'=>'Ingresar Partida']) !!}
                </div><!--span-->
            </div><!--row-->
            <div class="row">
                <div class="col-md-5">
                    {!! Field::text('banco',['label'=>'Ingresar Banco','placeholder'=>'Ingresar Banco']) !!}
                </div><!--span-->
                <div class="col-md-2">
                    {!! Field::text('monto',['label'=>'Ingresar Monto','placeholder'=>'Ingresar Monto']) !!}
                </div><!--span-->
            </div><!--row-->
            {!!Form::enviar('Guardar')!!}
        {!! Form::close() !!}
        </div>
    </div>
    <!-- END Portlet PORTLET-->
	</div><!--span-->
</div><!--row-->
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



