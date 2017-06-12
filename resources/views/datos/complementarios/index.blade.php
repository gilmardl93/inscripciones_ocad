@extends('layouts.base')

@section('content')
@include('alerts.errors')
{!! Form::open(['route'=>'datos.complementarios.store','method'=>'POST','files'=>true]) !!}
<div class="col-md-12">
    <!-- BEGIN PORTLET-->
    <div class="portlet light tasks-widget widget-comments">
        <div class="portlet-title margin-bottom-20">
            <div class="caption caption-md font-red-sunglo">
                <span class="caption-subject theme-font bold uppercase">DATOS DE complementarios del PARTICIPANTE</span>
            </div>
            <div class="actions">
                {!!Form::back(route('datos.index'))!!}
            </div>
        </div>
        <div class="form-body ">
            <div class="row">
                {!!Form::hidden('idpostulante', IdPostulante() );!!}
                <div class="col-md-12">
                    {!!Field::select('idrazon',$razon, ['label'=>'¿Cual de las siguientes alternativas fue la razon principal en la eleccion de la especialidad de su primera prioridad de ingreso?','empty'=>'Selecionar']);!!}
                </div><!--span-->
                <div class="col-md-12">
                    <div class="form-group">
                        {!!Form::label('lblEnc2', 'Tipo de preparacion para postular a la universidad de Ingeniería');!!}
                        <div class="row">
                            <div class="col-md-2">
                            {!!Form::label('lblEnc2', 'Tipo de preparacion:',['class'=>'pull-right']);!!}
                            </div><!--span-->
                            <div class="col-md-2">
                            {!!Form::select('idtipopreparacion',$preparacion, null , ['class'=>'form-control col-md-','placeholder'=>'Tipo de preparacion']);!!}
                            </div><!--span-->
                        </div><!--row-->
                        <div class="row">
                            <div class="col-md-2">
                            {!!Form::label('lblEnc2', 'Tiempo Preparación (meses):',['class'=>'pull-right']);!!}
                            </div><!--span-->
                            <div class="col-md-2">
                            {!!Form::text('mes', 0 , ['class'=>'form-control','placeholder'=>'Meses']);!!}
                            </div><!--span-->
                        </div><!--row-->
                        <div class="row">
                            <div class="col-md-2">
                            {!!Form::label('lblEnc2', 'Academia:',['class'=>'pull-right']);!!}
                            </div><!--span-->
                            <div class="col-md-2">
                            {!!Form::select('idacademia',$academia, null , ['class'=>'form-control col-md-','placeholder'=>'Selecionar Academia']);!!}
                            </div><!--span-->
                        </div><!--row-->
                    </div>
                </div><!--span-->
                <div class="col-md-12">
                    <div class="form-group">
                        {!!Form::label('lblEnc2', 'Numero de Veces que postulo a la Universidad Nacional de Ingenieria y especialidad a la que ingreso y renuncio');!!}
                        <div class="row">
                            <div class="col-md-2">
                            {!!Form::label('lblEnc2', 'Número de veces:',['class'=>'pull-right']);!!}
                            </div><!--span-->
                            <div class="col-md-2">
                            {!!Form::select('numeroveces',$veces, null , ['class'=>'form-control col-md-','placeholder'=>'Numero de veces']);!!}
                            </div><!--span-->
                        </div><!--row-->
                        <div class="row">
                            <div class="col-md-2">
                            {!!Form::label('lblEnc2', 'Ingrese y renuncie:',['class'=>'pull-right']);!!}
                            </div><!--span-->
                            <div class="col-md-2">
                            {!!Form::select('idrenuncia',$especialidad, null , ['class'=>'form-control col-md-','placeholder'=>'Especialidad']);!!}
                            </div><!--span-->
                        </div>
                </div><!--span-->
                <div class="col-md-12">
                    <div class="form-group">
                        {!!Form::label('lblEnc2', 'Indique el ingreso económico familiar aproximadamente en nuevos soles');!!}
                        {!!Form::select('idingresoeconomico',$ingreso, null , ['class'=>'form-control col-md-','placeholder'=>'Ingreso economico']);!!}
                    </div>
                </div><!--span-->
                <div class="col-md-12">
                    <div class="form-group">
                        {!!Form::label('lblEnc2', '¿Porque medio se informó del Concurso de ADmision 2017-2?');!!}
                        {!!Form::select('idpublicidad',$publicidad, null , ['class'=>'form-control col-md-','placeholder'=>'Publicidad']);!!}
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
