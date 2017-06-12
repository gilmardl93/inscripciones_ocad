@extends('layouts.base')

@section('content')
{!! Alert::render() !!}
<div class="col-md-12">
    <!-- BEGIN PORTLET-->
    <div class="portlet light tasks-widget widget-comments">
        <div class="portlet-title margin-bottom-20">
            <div class="caption caption-md font-red-sunglo">
                <span class="caption-subject theme-font bold uppercase">RESTRICCION</span>
            </div>
            <div class="actions">
                {!!Form::back(route('home.index'))!!}
            </div>
        </div>
        <div class="form-body ">
        Se han detectado los siguientes inconvenientes
            <p></p>
            @if (isset($msj))
                @foreach ($msj as $item)
                    <div class="note note-danger">
                        <h4 class="block">{{ $item['titulo'] }}</h4>
                        <p> {{ $item['mensaje'] }}. </p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <!-- END PORTLET-->
</div>

@stop

@section('title')
Restriccion de ficha
@stop
