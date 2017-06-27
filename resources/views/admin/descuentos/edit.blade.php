@extends('layouts.admin')

@section('content')
{!! Alert::render() !!}
@include('alerts.errors')
<div class="row">
	<div class="col-md-12">
	<!-- BEGIN Portlet PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-money"></i>Editar Descuentos </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a class="reload actualizar"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
        <p></p>
			{!! Form::model($descuento,['route'=>['admin.descuentos.update',$descuento],'method'=>'PUT']) !!}
                    {!! Field::text('periodo',['label'=>'Periodo','placeholder'=>'Periodo']) !!}
                    {!! Field::text('concurso',['label'=>'Concurso','placeholder'=>'Concurso']) !!}
                    {!! Field::text('dni',['label'=>'Número de DNI','placeholder'=>'Número de DNI']) !!}
                    {!! Field::select('tipo',['Total'=>'Total','Parcial'=>'Parcial'],['label'=>'Escoger tipo de descuento','empty'=>'Tipo descuento']) !!}
                    {!! Field::select('idservicio',$servicios,['label'=>'Servicio','empty'=>'Servicio']) !!}
                    {!! Field::text('motivo',['label'=>'Motivo','placeholder'=>'Motivo']) !!}
                {!!Form::enviar('Actualizar')!!}
            {!! Form::close() !!}

        </div>
    </div>
    <!-- END Portlet PORTLET-->
	</div><!--span-->
</div><!--row-->

@stop

@section('js-scripts')
<script>
$('.Servicios').dataTable({
    "language": {
        "emptyTable": "No hay datos disponibles",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ filas",
        "search": "Buscar :",
        "lengthMenu": "_MENU_ registros"
    },


});
</script>
@stop

@section('plugins-styles')
{!! Html::style('assets/global/plugins/datatables/datatables.min.css') !!}
{!! Html::style('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}
{!! Html::style('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') !!}

@stop

@section('plugins-js')
{!! Html::script('assets/global/plugins/jquery-ui/jquery-ui.min.js') !!}
{!! Html::script('assets/global/scripts/datatable.js') !!}
{!! Html::script('assets/global/plugins/datatables/datatables.min.js') !!}
{!! Html::script('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
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



