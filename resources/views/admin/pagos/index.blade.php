@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-md-12">
	<!-- BEGIN Portlet PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-money"></i>Pagos </div>
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
        {!!Form::botonmodal('Intercambiar Pago','#PagoChange','blue-madison','fa fa-arrows-v')!!}
        <p></p>
        {!! Alert::render() !!}
        @include('alerts.errors')
        </div>
    </div>
    <!-- END Portlet PORTLET-->
	</div><!--span-->
</div><!--row-->

<div class="modal fade" id="PagoCreate" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Crea Pago</h4>
            </div>
            {!! Form::open(['route'=>'admin.pagos.create','method'=>'POST']) !!}
            <div class="modal-body">
                <div class="form-group">
                    {!!Form::label('lblDNI', 'Numero de DNI');!!}
                    {!!Form::text('codigo', null , ['class'=>'form-control','placeholder'=>'Numero de DNI','maxlength'=>'8']);!!}
                </div>
                <div class="form-group">
                    {!!Form::label('lblBanco', 'Banco');!!}
                    {!!Form::text('banco', 'Scotiabank' , ['class'=>'form-control','placeholder'=>'Banco']);!!}
                </div>
                <div class="form-group">
                    {!!Form::label('lblServicio', 'Servicio');!!}
                    {!!Form::select('servicio', $servicios,null , ['class'=>'form-control','placeholder'=>'Servicio']);!!}
                </div>
                <div class="form-group">
                    {!!Form::label('lblReferencia', 'Referencia');!!}
                    {!!Form::text('referencia', null , ['class'=>'form-control','placeholder'=>'Referencia del pago']);!!}
                </div>
            </div>
            <div class="modal-footer">
                {!!Form::enviar('Guardar')!!}
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="PagoChange" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Crea Pago</h4>
            </div>
            {!! Form::open(['route'=>'admin.pagos.change','method'=>'POST']) !!}
            <div class="modal-body">
                <div class="form-group">
                    {!!Form::label('lblDNI', 'Numero de DNI');!!}
                    {!!Form::text('codigo', null , ['class'=>'form-control','placeholder'=>'Numero de DNI','maxlength'=>'8']);!!}
                </div>
                <div class="form-group">
                    {!!Form::label('lblServicio', 'Pago inicial');!!}
                    {!!Form::select('servicio_ini', $servicios,null , ['class'=>'form-control','placeholder'=>'Servicio Inicial']);!!}
                </div>
                <div class="form-group">
                    {!!Form::label('lblServicio', 'Pago final');!!}
                    {!!Form::select('servicio_fin', $servicios,null , ['class'=>'form-control','placeholder'=>'Servicio Final']);!!}
                </div>
            </div>
            <div class="modal-footer">
                {!!Form::enviar('Guardar')!!}
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

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



