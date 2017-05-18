@extends('layouts.base')

@section('content')
@include('alerts.errors')
{!! Form::model($postulante,['route'=>['datos.secundarios.update',$postulante],'method'=>'PUT','files'=>true]) !!}
<div class="col-md-4">
    <!-- BEGIN PORTLET-->
    <div class="portlet light tasks-widget widget-comments">
        <div class="portlet-title margin-bottom-20">
            <div class="caption caption-md font-red-sunglo">
                <span class="caption-subject theme-font bold uppercase">foto del postulante tamaño carné</span>
            </div>
        </div>
        <div class="portlet-body overflow-h">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 300px; height: 400px;">
                    <img src="{{ asset('/storage/'.$postulante->foto) }}" alt="" />
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                <div>
                    <span class="btn green btn-file">
                        <span class="fileinput-new"> Seleccionar Imagen </span>
                        <span class="fileinput-exists"> Cambiar </span>
                        {{ Form::file('file', []) }}
                    </span>
                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Quitar </a>
                </div>
            </div>
        </div>
    </div>
    <!-- END PORTLET-->
</div>
<div class="col-md-8">
    <!-- BEGIN PORTLET-->
    <div class="portlet light tasks-widget widget-comments">
        <div class="portlet-title margin-bottom-20">
            <div class="caption caption-md font-red-sunglo">
                <span class="caption-subject theme-font bold uppercase">datos del postulante (no del apoderado)</span>
            </div>
            <div class="actions">
                {!!Form::back(route('datos.index'))!!}
            </div>
        </div>
        <div class="form-body ">
            <div class="row">
                <div class="col-md-6">
                    {!!Field::text('email', null, ['label'=>'Email del postulante *','placeholder'=>'Email del postulante']);!!}
                </div><!--span-->
                <div class="col-md-3">
                    {!!Field::text('talla', null, ['label'=>'Talla del postulante *','placeholder'=>'Talla del postulante']);!!}
                </div><!--span-->
                <div class="col-md-3">
                    {!!Field::text('peso', null, ['label'=>'Peso del postulante *','placeholder'=>'Peso del postulante']);!!}
                </div><!--span-->
            </div><!--row-->
            <div class="row">
                <div class="col-md-6">
                    {!!Field::select('idsexo', $sexo, ['label'=>'Sexo del postulante *','empty'=>'Sexo del postulante']);!!}
                </div><!--span-->
                <div class="col-md-3">
                    {!!Field::text('telefono_celular', null, ['label'=>'Telefono celular del postulante *','placeholder'=>'Telefono celular del postulante']);!!}
                </div><!--span-->
                <div class="col-md-3">
                    {!!Field::text('telefono_fijo', null, ['label'=>'Telefono fijo del postulante *','placeholder'=>'Telefono fijo del postulante']);!!}
                </div><!--span-->
            </div><!--row-->
            <div class="row">
                <div class="col-md-6">
                    {!!Field::select('idpais', $pais, ['label'=>'Pais donde vive el participante *','empty'=>'Pais donde vive el participante']);!!}
                </div><!--span-->

            </div><!--row-->

        {!!Form::enviar('Guardar')!!}
        </div>
    </div>
    <!-- END PORTLET-->
</div>
{!! Form::close() !!}
@stop

