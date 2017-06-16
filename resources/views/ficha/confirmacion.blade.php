@extends('layouts.base')

@section('content')
{!! Alert::render() !!}
<div class="col-md-12">
    <!-- BEGIN PORTLET-->
    <div class="portlet light tasks-widget widget-comments">
        <div class="portlet-title margin-bottom-20">
            <div class="caption caption-md font-red-sunglo">
                <span class="caption-subject theme-font bold uppercase">INSCRIPCIÓN FINALIZADA</span>
            </div>
            <div class="actions">
                {!!Form::back(route('home.index'))!!}
            </div>
        </div>
        <div class="form-body ">
        Estimado postulante: ¿está seguro que la información y fotografía ingresada es correcta?, </br> para poder mostrar su ficha necesitamos que ingrese su dni y su clave, de esta manera aparecera su ficha y no habrá oportunidad de modificar sus datos por el sistema. <br>
        Tendrá que acercarse a la Oficina Central de Aamisión si deseas modificar algún dato.
        <p></p>
        {!! Form::open(['route'=>'ficha.confirmar','method'=>'POST']) !!}
            {!!Form::hidden('id', $id );!!}
            <div class="row">
                <div class="col-md-3">
                {!! Field::text('dni',null,['label'=>'Ingrese su DNI','maxlength'=>'8']) !!}
                </div><!--span-->
                <div class="col-md-3">
                {!! Field::password('password',['label'=>'Ingrese su Clave']) !!}
                </div><!--span-->
            </div><!--row-->
                {!!Form::enviar('Guardar')!!}
        {!! Form::close() !!}
        </div>
    </div>
    <!-- END PORTLET-->
</div>

@stop

@section('title')
Restriccion de ficha
@stop
