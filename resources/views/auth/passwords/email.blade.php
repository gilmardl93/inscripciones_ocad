@extends('layouts.login')

@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
    <div id="form-opcion">
    {!! Form::open(['url'=>'/password/email','method'=>'POST','id'=>'form-login']) !!}
        <h3 class="form-title font-green">Cambiar Contraseña</h3>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <b class="text:"> Esta recuperación solo funciona si ha registrado su email si no lo ha ingresado escriba a informes@admisionuni.edu.pe</b>
            <p></p>
            <label for="email" class="col-md-12 control-label">Ingresa tu Correo</label>

            <div class="col-md-12">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-actions">
        </div>
        <div class="create-account">
            {!!Form::submit('Enviar',['class'=>'btn green uppercase btn-block'])!!}
        </div>
    {!! Form::close() !!}
    </div>




@stop



@section('copyright')
Oficina Central de Admision. Universidad Nacional de Ingeniería
@stop