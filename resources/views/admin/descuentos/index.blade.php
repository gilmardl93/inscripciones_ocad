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
                <i class="fa fa-money"></i>Descuentos </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a class="reload actualizar"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
{!!Form::botonmodal('Nuevo descuento','#DescuentoCreate','green-meadow','fa fa-plus')!!}
        <p></p>
			<table class="table table-bordered table-hover Servicios">
			    <thead>
			        <tr>
			            <th> Periodo </th>
			            <th> Concurso </th>
			            <th> DNI </th>
			            <th> Tipo </th>
                        <th> Servicio </th>
			            <th> Monto </th>
                        <th> Motivo </th>
			            <th> Activo </th>
			            <th> Opciones </th>
			        </tr>
			    </thead>
			    <tbody>
                @foreach ($Lista as $item)
                    <tr>
                        <td> {{ $item->periodo }} </td>
                        <td> {{ $item->concurso }} </td>
                        <td> {{ $item->dni }} </td>
                        <td> {{ $item->tipo }} </td>
                        <td> {{ $item->Datos_servicio->descripcion }} </td>
                        <td> {{ $item->Datos_servicio->monto }} </td>
                        <td> {{ $item->motivo }} </td>
                        <td>
                        @if ($item->activo)
                            <a href="{{ route('admin.descuentos.activate',$item->id) }}" class="label label-sm label-info"> SI </a>
                        @else
                            <a href="{{ route('admin.descuentos.activate',$item->id) }}" class="label label-sm label-danger"> NO </a>
                        @endif
                        </td>
                        <td>{!!Form::boton('Edit',route('admin.descuentos.edit',$item->id),'yellow','fa fa-edit','btn-xs')!!}

                        </td>
                    </tr>
                @endforeach
			    </tbody>
			</table>

        </div>
    </div>
    <!-- END Portlet PORTLET-->
	</div><!--span-->
</div><!--row-->

<div class="modal fade" id="DescuentoCreate" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Crea Descuento</h4>
            </div>
            {!! Form::open(['route'=>'admin.descuentos.store','method'=>'POST']) !!}
            <div class="modal-body">
                    {!! Field::text('periodo',['label'=>'Periodo','placeholder'=>'Periodo']) !!}
                    {!! Field::text('concurso',['label'=>'Concurso','placeholder'=>'Concurso']) !!}
                    {!! Field::text('dni',['label'=>'Número de DNI','placeholder'=>'Número de DNI']) !!}
                    {!! Field::select('tipo',['Total'=>'Total','Parcial'=>'Parcial'],['label'=>'Escoger tipo de descuento','empty'=>'Tipo descuento']) !!}
                    {!! Field::select('idservicio',$servicio_descuento,['label'=>'Servicio','empty'=>'Servicio']) !!}
                    {!! Field::text('motivo',['label'=>'Motivo','placeholder'=>'Motivo']) !!}
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



