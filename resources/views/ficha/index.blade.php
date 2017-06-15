@extends('layouts.base')

@section('content')
{!! Alert::render() !!}
<div class="col-md-12">
    <!-- BEGIN PORTLET-->
    <div class="portlet light tasks-widget widget-comments">
        <div class="portlet-title margin-bottom-20">
            <div class="caption caption-md font-red-sunglo">
                <span class="caption-subject theme-font bold uppercase">FICHA DE INSCRIPCION</span>
            </div>
            <div class="actions">
                {!!Form::back(route('home.index'))!!}
            </div>
        </div>
        <div class="form-body ">
            <p></p>
            <iframe src="{{route('ficha.pdf',$id)}}" width="100%" height="700px" scrolling="auto"></iframe>
        </div>
    </div>
    <!-- END PORTLET-->
</div>

@stop


