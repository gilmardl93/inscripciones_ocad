@extends('layouts.base')

@section('content')
@include('alerts.errors')
{{ Alert::render() }}
{!! Form::open(['route'=>'datos.familiares.store','method'=>'POST','files'=>true]) !!}
<div class="col-md-12">
    <!-- BEGIN PORTLET-->
    <div class="portlet light tasks-widget widget-comments">
        <div class="portlet-title margin-bottom-20">
            <div class="caption caption-md font-red-sunglo">
                <span class="caption-subject theme-font bold uppercase">DATOS DE FAMILIARES DEL Postulante</span>
            </div>
            <div class="actions">
                {!!Form::back(route('datos.index'))!!}
            </div>
        </div>
        <div class="form-body ">
        Tus nombres y apellidos deben coincidir con el de tu DNI, los campos con asterisco son obligatorios
        <h3 class="text-error">Datos del Padre del Postulante</h3>
        {!!Form::hidden('idpostulante', $postulante->id );!!}
        {!!Form::hidden('parentesco[0]', 'Papá' );!!}
        {!!Form::hidden('orden[0]', 0 );!!}
                <div class="row">
                    <div class="col-md-4">
                            {!!Field::text('paterno[0]', null , ['label'=>'Apellido Paterno del padre (*)','placeholder'=>'Apellido Paterno'])!!}
                    </div><!--span-->
                    <div class="col-md-4">
                        {!!Field::text('materno[0]', null , ['label'=>'Apellido Materno del padre (*)','placeholder'=>'Apellido Materno'])!!}
                    </div><!--span-->
                    <div class="col-md-4">
                        {!!Field::text('nombres[0]', null , ['label'=>'Nombres del padre (*)','placeholder'=>'Nombres del Padre'])!!}
                    </div><!--span-->
                </div><!--row-->
                <div class="row">
                    <div class="col-md-4">
                        {!!Field::text('dni[0]', null , ['label'=>'DNI del padre','placeholder'=>'DNI del Padre'])!!}
                    </div><!--span-->
                    <div class="col-md-4">
                        {!!Field::text('direccion[0]', null , ['label'=>'Direccion del padre(*)','placeholder'=>'Direccion del Padre'])!!}
                    </div><!--span-->
                    <div class="col-md-4">
                        {!!Field::text('telefonos[0]', null , ['label'=>'Telefonos del padre (celular/fijo/trabajo-anexo)(*)','placeholder'=>'Telefonos del Padre'])!!}
                    </div><!--span-->
                    <div class="col-md-4">
                        {!!Field::text('email[0]', null , ['label'=>'Email del padre (*)','placeholder'=>'Email del Padre'])!!}
                    </div><!--span-->
                </div><!--row-->
         <h3 class="text-error">Datos de la Madre del Postulante</h3>
         {!!Form::hidden('parentesco[1]', 'Mamá' );!!}
         {!!Form::hidden('orden[1]', 1 );!!}
                <div class="row">
                    <div class="col-md-4">
                            {!!Field::text('paterno[1]', null , ['label'=>'Apellido Paterno de la Madre (*)','placeholder'=>'Apellido Paterno'])!!}
                    </div><!--span-->
                    <div class="col-md-4">
                        {!!Field::text('materno[1]', null , ['label'=>'Apellido Materno de la Madre (*)','placeholder'=>'Apellido Materno'])!!}
                    </div><!--span-->
                    <div class="col-md-4">
                        {!!Field::text('nombres[1]', null , ['label'=>'Nombres de la Madre (*)','placeholder'=>'Nombres de la Madre'])!!}
                    </div><!--span-->
                </div><!--row-->
                <div class="row">
                    <div class="col-md-4">
                        {!!Field::text('dni[1]', null , ['label'=>'DNI de la Madre (*)','placeholder'=>'DNI de la Madre'])!!}
                    </div><!--span-->
                    <div class="col-md-4">
                        {!!Field::text('direccion[1]', null , ['label'=>'Direccion de la Madre (*)','placeholder'=>'Direccion de la Madre'])!!}
                    </div><!--span-->
                    <div class="col-md-4">
                        {!!Field::text('telefonos[1]', null , ['label'=>'Telefonos de la Madre (celular/fijo/trabajo-anexo) (*)','placeholder'=>'Telefonos de la Madre'])!!}
                    </div><!--span-->
                    <div class="col-md-4">
                        {!!Field::text('email[1]', null , ['label'=>'Email de la Madre (*) ','placeholder'=>'Email del Padre'])!!}
                    </div><!--span-->
                </div><!--row-->
         <h3 class="text-error">Datos del apoderado</h3>
         {!!Form::hidden('parentesco[2]', 'Apoderado' );!!}
         {!!Form::hidden('orden[2]', 2 );!!}
                <div class="row">
                    <div class="col-md-4">
                            {!!Field::text('paterno[2]', null , ['label'=>'Apellido Paterno del apoderado (*)','placeholder'=>'Apellido Paterno del apoderado'])!!}
                    </div><!--span-->
                    <div class="col-md-4">
                        {!!Field::text('materno[2]', null , ['label'=>'Apellido Materno del apoderado (*)','placeholder'=>'Apellido Materno del apoderado'])!!}
                    </div><!--span-->
                    <div class="col-md-4">
                        {!!Field::text('nombres[2]', null , ['label'=>'Nombres del apoderado (*)','placeholder'=>'Nombres del apoderado'])!!}
                    </div><!--span-->
                </div><!--row-->
                <div class="row">
                    <div class="col-md-4">
                        {!!Field::text('dni[2]', null , ['label'=>'DNI del apoderado (*)','placeholder'=>'DNI del apoderado'])!!}
                    </div><!--span-->
                    <div class="col-md-4">
                        {!!Field::text('direccion[2]', null , ['label'=>'Direccion del apoderado (*)','placeholder'=>'Direccion del apoderado'])!!}
                    </div><!--span-->
                    <div class="col-md-4">
                        {!!Field::text('telefonos[2]', null , ['label'=>'Telefonos del apoderado (celular/fijo/trabajo-anexo) (*)','placeholder'=>'Telefonos del apoderado'])!!}
                    </div><!--span-->
                    <div class="col-md-4">
                        {!!Field::text('email[2]', null , ['label'=>'Email del apoderado (*)','placeholder'=>'Email del apoderado'])!!}
                    </div><!--span-->
                </div><!--row-->
            {!!Form::enviar('Guardar')!!}
        </div>
    </div>
    <!-- END PORTLET-->
</div>
{!! Form::close() !!}
@stop

