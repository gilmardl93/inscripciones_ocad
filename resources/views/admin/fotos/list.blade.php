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
                <i class="fa fa-money"></i>Fotos Rechazadas </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a class="reload actualizar"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
        {!!Form::back(route('admin.fotos.index'))!!}
        <p></p>
			<table class="table table-bordered table-hover FotosRechazadas">
			    <thead>
			        <tr>
                        <th> Postulante </th>
                        <th> Telefono Celular </th>
			            <th> Telefono Fijo </th>
			        </tr>
			    </thead>
			    <tbody>
                    @foreach ($Lista as $item)
                        <tr>
                            <td>{{ $item->nombre_completo }} </td>
                            <td>{{ $item->telefono_celular }} </td>
                            <td>{{ $item->telefono_fijo }} </td>
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
$('.FotosRechazadas').dataTable({
    "language": {
        "emptyTable": "No hay datos disponibles",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ filas",
        "search": "Buscar Postulante :",
        "lengthMenu": "_MENU_ registros"
    },
    dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
    buttons: [
                { extend: 'excel', className: 'btn yellow btn-outline ' },
            ],
    "order": [0,"asc"],
    "bProcessing": true,

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



