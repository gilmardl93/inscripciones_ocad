@extends('layouts.admin')

@section('content')
@include('alerts.errors')
<div class="row">
	<div class="col-md-12">
	<!-- BEGIN Portlet PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-money"></i>Ventanilla </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a class="reload actualizar"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
        {!! Form::open(['route'=>'admin.ventanilla.store','method'=>'POST','files'=>'true']) !!}
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::label('lblFecha', 'Escoger Fecha', ['class'=>'form-group']) !!}
                    </div>
                    <div class="col-md-4">
                        <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" >
                            <input type="text" class="form-control" name="fecha">
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>{{-- row --}}
            </div>
            {!!Form::enviar('Importar','yellow')!!}
            <p></p>
        {!! Form::close() !!}
        <p></p>{{-- asset('/storage/carteras/UNIADMIS.txt') --}}
        {!! Alert::render() !!}
        </div>
    </div>
    <!-- END Portlet PORTLET-->
	</div><!--span-->
</div><!--row-->

@stop

@section('js-scripts')
<script>
$('.date-picker').datepicker({
    rtl: App.isRTL(),
    language: 'es',
    todayBtn: true,
    todayHighlight: true,
    orientation: "left",
    autoclose: true
});
</script>
@stop

@section('plugins-styles')
{!! Html::style('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}
@stop

@section('plugins-js')
{!! Html::script('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') !!}
{!! Html::script('assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js') !!}
@stop




@section('menu-user')
@include('menu.profile-admin')
@stop

@section('sidebar')
@include(Auth::user()->menu)
@stop


@section('user-name')
{!!Auth::user()->dni!!}
@stop

@section('breadcrumb')

@stop


@section('page-title')

@stop

@section('page-subtitle')
@stop



