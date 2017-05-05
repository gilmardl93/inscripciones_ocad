@extends('layouts.base')

@section('content')
@include('alerts.errors')
{!! Form::open(['route'=>'datos.store','method'=>'POST','files'=>true]) !!}
<div class="col-md-12">
    <!-- BEGIN PORTLET-->
    <div class="portlet light tasks-widget widget-comments">
        <div class="portlet-title margin-bottom-20">
            <div class="caption caption-md font-red-sunglo">
                <span class="caption-subject theme-font bold uppercase">DATOS DE FAMILIARES DEL PARTICIPANTE</span>
            </div>
            <div class="actions">
                {!!Form::back(route('datos.index'))!!}
            </div>
        </div>
        <div class="form-body ">
        Tus nombres y apellidos deben coincidir con el de tu DNI, los campos con asterisco son obligatorios
        <h3 class="text-error">Datos del Padre del Postulante</h3>
        {!!Form::hidden('tipo', 'Padre' );!!}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!Form::hidden('dni', $dni );!!}
                            {!!Form::label('lblPaterno', 'Apellido Paterno del padre');!!}
                            {!!Form::text('paterno', null , ['class'=>'form-control','placeholder'=>'Apellido Paterno']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!Form::label('lblMaterno', 'Apellido Materno del padre');!!}
                            {!!Form::text('materno', null , ['class'=>'form-control','placeholder'=>'Apellido Materno']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!Form::label('lblNombres', 'Nombres del padre');!!}
                            {!!Form::text('nombres', null , ['class'=>'form-control','placeholder'=>'Pais del participante']);!!}
                        </div>
                    </div><!--span-->
                </div><!--row-->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!Form::label('lblDNIP', 'DNI del padre');!!}
                            {!!Form::text('dni', null , ['class'=>'form-control','placeholder'=>'dni del padre']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!Form::label('lblDireccion', 'Direccion del Padre');!!}
                            {!!Form::text('direccion', null , ['class'=>'form-control','placeholder'=>'Direccion del padre']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!Form::label('lblTelefono', 'Telefonos (celular/fijo/trabajo-anexo)');!!}
                            {!!Form::text('telefonos', null , ['class'=>'form-control','placeholder'=>'Telefonos']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!Form::label('lblEmail', 'Email del padre');!!}
                            {!!Form::email('email', null , ['class'=>'form-control','placeholder'=>'Email del padre']);!!}
                        </div>
                    </div><!--span-->
                </div><!--row-->
         <h3 class="text-error">Datos de la Madre del Postulante</h3>
         {!!Form::hidden('tipo', 'Madre' );!!}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">

                            {!!Form::hidden('dni', $dni );!!}
                            {!!Form::label('lblPaterno', 'Apellido Paterno de la madre');!!}
                            {!!Form::text('paterno', null , ['class'=>'form-control','placeholder'=>'Apellido Paterno']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!Form::label('lblMaterno', 'Apellido Materno de la madre');!!}
                            {!!Form::text('materno', null , ['class'=>'form-control','placeholder'=>'Apellido Materno']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!Form::label('lblNombres', 'Nombres de la madre');!!}
                            {!!Form::text('nombres', null , ['class'=>'form-control','placeholder'=>'Pais de la participante']);!!}
                        </div>
                    </div><!--span-->
                </div><!--row-->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!Form::label('lblDNIP', 'DNI de la madre');!!}
                            {!!Form::text('dni', null , ['class'=>'form-control','placeholder'=>'dni de la madre']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!Form::label('lblDireccion', 'Direccion de la madre');!!}
                            {!!Form::text('direccion', null , ['class'=>'form-control','placeholder'=>'Direccion de la madre']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!Form::label('lblTelefono', 'Telefonos (celular/fijo/trabajo-anexo)');!!}
                            {!!Form::text('telefonos', null , ['class'=>'form-control','placeholder'=>'Telefonos']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!Form::label('lblEmail', 'Email de la madre');!!}
                            {!!Form::email('email', null , ['class'=>'form-control','placeholder'=>'Email de la madre']);!!}
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

