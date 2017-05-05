@extends('layouts.base')

@section('content')
@include('alerts.errors')
{!! Form::open(['route'=>'datos.store','method'=>'POST','files'=>true]) !!}
<div class="col-md-12">
    <!-- BEGIN PORTLET-->
    <div class="portlet light tasks-widget widget-comments">
        <div class="portlet-title margin-bottom-20">
            <div class="caption caption-md font-red-sunglo">
                <span class="caption-subject theme-font bold uppercase">DATOS DE la modalidad del PARTICIPANTE</span>
            </div>
            <div class="actions">
                {!!Form::back(route('datos.index'))!!}
            </div>
        </div>
        <div class="form-body ">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {!!Form::hidden('dni', $dni );!!}
                        {!!Form::label('lblModalidad', 'Modalidad de postulacion');!!}
                        {!!Form::select('idmodalidad',[], null , ['class'=>'form-control','placeholder'=>'Modalidad']);!!}
                    </div>
                </div><!--span-->
                <div class="col-md-4">
                    <div class="form-group">
                        {!!Form::label('lblEspecialidad', 'Especialidad');!!}
                        {!!Form::select('idespecialidad',[], null , ['class'=>'form-control','placeholder'=>'Especialidad']);!!}
                    </div>
                </div><!--span-->
                <div class="col-md-4">
                    <div class="form-group">
                        {!!Form::label('lblColegio', 'Institucion Educativa del postulante (Colegio / Universidad)');!!}
                        {!!Form::text('idcolegio', null , ['class'=>'form-control','placeholder'=>'Colegio del postulante']);!!}
                    </div>
                </div><!--span-->
            </div><!--row-->

        {!!Form::enviar('Guardar')!!}
        </div>
    </div>
    <!-- END PORTLET-->
</div>
{!! Form::close() !!}
@stop

