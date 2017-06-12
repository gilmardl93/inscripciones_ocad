@extends('layouts.login')

@section('content')
@include('alerts.errors')
{!! Alert::render() !!}
    <div id="form-opcion">
    Bienvenido al Examen de admisión de la UNI, para ingresar debe crear una cuenta, si ya la creo haga click al boton ya tengo cuenta
    <p></p>
    {!!Form::boton('Crear cuenta','javascript:;','green','fa fa-plus','',['id'=>'registrar'])!!}
    {!!Form::boton('Ya tengo cuenta','javascript:;','green','fa fa-send','',['id'=>'logear'])!!}
    </div>

{!! Form::open(['url'=>'login','method'=>'POST','id'=>'form-login']) !!}
    <h3 class="form-title font-green">Iniciar Sesion</h3>
    <div class="form-group">
            <div class="input-icon right ">
            <i class="fa fa-envelope"></i>
            {!!Form::text('dni',old('dni'), ['class'=>'form-control','placeholder'=>'DNI','maxlength'=>'8'])!!}
            </div>
    </div>
    <div class="form-group">
        <div class="input-icon right ">
            <i class="fa fa-lock"></i>
            {!!Form::password('password', ['class'=>'form-control','placeholder'=>'Clave'])!!}
        </div>
    </div>
    <div class="form-actions">
        {!!Form::submit('Entrar',['class'=>'btn green uppercase btn-block'])!!}
    </div>
    <div class="create-account">
    <p></p>
    {!!Form::boton('Regresar','javascript:;','default','fa fa-mail-reply','',['id'=>'back'])!!}
    {!!Form::boton('Olvide mi Clave',url('/password/reset'),'green','fa fa-cog')!!}
    </div>
{!! Form::close() !!}

{!! Form::open(['url'=>'register','method'=>'POST','id'=>'form-register']) !!}
    <h3 class="form-title font-green">Crear Cuenta</h3>
    <div class="form-group">
            {!! Form::label('lblDNI', 'Ingrese el numero de DNI del postulante no del apoderado', []) !!}
            <div class="input-icon right ">
            <i class="fa fa-envelope"></i>
            {!!Form::text('dni',old('dni'), ['class'=>'form-control','placeholder'=>'dni','maxlength'=>'8'])!!}
            </div>
    </div>
    <div class="form-group">
            {!! Form::label('lblPassword', 'Ingrese su Clave (minimo de 6 digitos)', []) !!}
        <div class="input-icon right ">
            <i class="fa fa-lock"></i>
            {!!Form::password('password', ['class'=>'form-control','placeholder'=>'Clave'])!!}
        </div>
            {!! Form::label('lblPassword2', 'Ingrese nuevamente su Clave', []) !!}
        <div class="input-icon right ">
            <i class="fa fa-lock"></i>
            {!!Form::password('password_confirmation', ['class'=>'form-control','placeholder'=>'Clave'])!!}
        </div>
    </div>
    <div class="form-actions">
        {!!Form::submit('Crear',['class'=>'btn green uppercase btn-block'])!!}
    </div>
    <div class="create-account">
    {!!Form::back(url('/'))!!}
    </div>
{!! Form::close() !!}
@stop

@section('js-scripts')
<script>
$('#form-register').hide();
$('#form-login').hide();
$('#registrar').click(function() {
    $('#form-opcion').hide();
    $('#form-register').show();

});
$('#back').click(function() {
    $('#form-opcion').show();
    $('#form-register').hide();
    $('#form-login').hide();

});
$('#logear').click(function() {
    $('#form-opcion').hide();
    $('#form-register').hide();
    $('#form-login').show();

});
</script>
@stop

@section('copyright')
Oficina Central de Admision. Universidad Nacional de Ingeniería
@stop