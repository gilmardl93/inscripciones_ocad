@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
    {!! Alert::render() !!}
    @include('alerts.errors')
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cubes"></i>
                    Gestion de Aulas activas
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="" class="fullscreen"> </a>
                    <a href="javascript:;" class="remove"> </a>
                </div>
            </div>
            <div class="portlet-body">
            {!! Form::model($aula,['route'=>['admin.aulas.activas.actualizar',$aula],'method'=>'PUT']) !!}
                <div class="row">
                    <div class="col-md-1">
                    {!! Field::text('orden',null,['label'=>'Orden','placeholder'=>'Orden']) !!}
                    </div><!--span-->
                </div><!--row-->
                <div class="row">
                    <div class="col-md-1">
                    {!! Field::text('sector',null,['label'=>'Sector','placeholder'=>'Sector']) !!}
                    </div><!--span-->
                </div><!--row-->
                <div class="row">
                    <div class="col-md-1">
                    {!! Field::text('capacidad',null,['label'=>'Capacidad','placeholder'=>'Capacidad']) !!}
                    </div><!--span-->
                </div><!--row-->
                <div class="row">
                    <div class="col-md-2">
                    {!! Field::text('disponible_01',null,['label'=>'Disponible día 1','placeholder'=>'Disponible día 1']) !!}
                    </div><!--span-->
                    <div class="col-md-2">
                    {!! Field::text('disponible_02',null,['label'=>'Disponible día 2','placeholder'=>'Disponible día 2']) !!}
                    </div><!--span-->
                    <div class="col-md-2">
                    {!! Field::text('disponible_03',null,['label'=>'Disponible día 3','placeholder'=>'Disponible día 3']) !!}
                    </div><!--span-->
                    <div class="col-md-2">
                    {!! Field::text('disponible_voca',null,['label'=>'Disponible Vocacional','placeholder'=>'Disponible Vocacional']) !!}
                    </div><!--span-->
                </div><!--row-->
                {!!Form::enviar('Guardar')!!}
                {!!Form::back(route('admin.aulas.index'))!!}
            {!! Form::close() !!}
            <p></p>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
    </div>
</div>
@stop

@section('menu-user')
@include('menu.profile-admin')
@stop

@section('sidebar')
@include(Auth::user()->menu)
@stop

@section('user-img')
{{ asset('storage/fotos/'.Auth::user()->foto) }}
@stop

@section('user-name')
{!!Auth::user()->dni!!}
@stop



@section('page-title')

@stop

@section('page-subtitle')

@stop


