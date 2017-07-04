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
                <i class="fa fa-money"></i>Listados </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a class="reload actualizar"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
        Relacion de postulantes que no ha finalizado su inscripcion
        <p></p>
			<table class="table table-bordered table-hover Servicios">
			    <thead>
			        <tr>
                        <th> Paterno </th>
                        <th> Materno </th>
                        <th> Nombres </th>
                        <th> DNI </th>
                        <th> Email </th>
                        <th> Celular </th>
                        <th> Telefono Fijo </th>
                        <th> Otro Telefono </th>
                        <th> Datos Personales </th>
                        <th> Datos Familiares </th>
                        <th> Datos Encuesta </th>
                        <th> Foto Cargada </th>
			            <th> Foto Rechazada </th>
			        </tr>
			    </thead>
			    <tbody>
                @foreach ($Lista as $item)
                    <tr>
                        <td> {{ $item->paterno }} </td>
                        <td> {{ $item->materno }} </td>
                        <td> {{ $item->nombres }} </td>
                        <td> {{ $item->identificacion }} </td>
                        <td> {{ $item->email }} </td>
                        <td> {{ $item->telefono_celular }} </td>
                        <td> {{ $item->telefono_fijo }} </td>
                        <td> {{ $item->telefono_varios }} </td>
                        <td> {!! $item->procesos->personal !!} </td>
                        <td> {!! $item->procesos->familiar !!} </td>
                        <td> {!! $item->procesos->datos_encuesta !!} </td>
                        <td> <img src="{{ $item->mostrar_foto_cargada }}" width="25px"> </td>
                        <td> <img src="{{ $item->mostrar_foto_rechazada }}" width="25px"> </td>
                    </tr>
                @endforeach
			    </tbody>
			</table>

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
    stateSave: true,
    dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
    buttons: [
                { extend: 'excel', className: 'btn yellow btn-outline ' },
                { extend: 'colvis', className: 'btn dark btn-outline', text: 'Columns'}
            ],

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

@section('title')
Listado
@stop

@section('breadcrumb')
@stop

@section('page-title')

@stop

@section('page-subtitle')
@stop



