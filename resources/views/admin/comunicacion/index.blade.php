@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-md-12">
	<!-- BEGIN Portlet PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-money"></i>Comunicación </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a class="reload actualizar"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
        {!! Form::open(['route'=>'admin.pagos.store','method'=>'POST','files'=>'true']) !!}
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::label('lblDatos', 'Datos', ['class'=>'form-group']) !!}
                    </div>
                    <div class="col-md-4">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="input-group input-large">
                                <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                    <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                    <span class="fileinput-filename"> </span>
                                </div>
                                <span class="input-group-addon btn default btn-file">
                                    <span class="fileinput-new"> Seleccionar </span>
                                    <span class="fileinput-exists"> Cambiar </span>
                                    {{ Form::file('file', []) }}
                                </span>
                                <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-left">
                        {!!Form::enviar('Cargar')!!}
                    </div>
                </div>{{-- row --}}
            </div>
            <p></p>
        {!! Form::close() !!}
        <p></p>{{-- asset('/storage/carteras/UNIADMIS.txt') --}}
        {!!Form::boton('Crear Cartera',route('admin.cartera.create'),'green-meadow','fa fa-file-image-o')!!}
        {!!Form::boton('Descargar Cartera',route('admin.cartera.download'),'green-seagreen','fa fa-cloud-download')!!}
        {!!Form::botonmodal('Crear Pago','#PagoCreate','blue','fa fa-plus')!!}
        {!!Form::boton('Importar pagos de OCAD',route('admin.ventanilla.obtener'),'yellow','fa fa-cloud-upload')!!}
        {!!Form::boton('Recaducacion',route('admin.recaudacion'),'red','fa fa-eye')!!}
        <p></p>
        {!! Alert::render() !!}
        </div>
    </div>
    <!-- END Portlet PORTLET-->
	</div><!--span-->
</div><!--row-->


@stop

@section('plugins-styles')
{!! Html::style('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') !!}
@stop

@section('plugins-js')
{!! Html::script('assets/global/plugins/jquery-ui/jquery-ui.min.js') !!}
{!! Html::script('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}

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



