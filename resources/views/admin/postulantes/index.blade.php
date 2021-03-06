@extends('layouts.admin')


@section('content')
{!! Alert::render() !!}
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN Portlet PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-users"></i>Postulantes </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a class="reload actualizar"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
        <p></p>
        <p></p>
			<table class="table table-bordered table-hover Postulantes">
			    <thead>
			        <tr>
			            <th> Codigo </th>
			            <th> Paterno </th>
			            <th> Materno </th>
			            <th> Nombres </th>
			            <th> Número de identificación </th>
			            <th> Opciones </th>
			        </tr>
			    </thead>
			    <tbody>
				@foreach ($postulantes as $item)
			    	<tr>
			            <td> {{ $item->codigo }} </td>
			            <td> {{ $item->paterno }} </td>
			            <td> {{ $item->materno }} </td>
			            <td> {{ $item->nombres }} </td>
			            <td> {{ $item->identificacion }} </td>
			            <td>{!!Form::boton('Ver',route('admin.pos.show',$item->id),'green-dark','fa fa-eye','btn-xs')!!}</td>
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
$(function(){
    $('.Postulantes').DataTable({
        "language": {
            "emptyTable": "No hay datos disponibles",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ filas",
            "search": "Buscar Postulante :",
            "lengthMenu": "_MENU_ registros"
        },
        stateSave: true,
        "bProcessing": true,
        "pagingType": "bootstrap_full_number",

    });

});

</script>
@stop


@section('plugins-styles')
{!! Html::style('assets/global/plugins/datatables/datatables.min.css') !!}
{!! Html::style('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}
@stop

@section('plugins-js')
{!! Html::script('assets/global/plugins/jquery-ui/jquery-ui.min.js') !!}
{!! Html::script('assets/global/scripts/datatable.js') !!}
{!! Html::script('assets/global/plugins/datatables/datatables.min.js') !!}
{!! Html::script('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
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




