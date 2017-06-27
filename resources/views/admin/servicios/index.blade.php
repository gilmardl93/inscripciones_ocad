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
                <i class="fa fa-money"></i>Servicios </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a class="reload actualizar"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
        <p></p>
			<table class="table table-bordered table-hover Servicios">
			    <thead>
			        <tr>
			            <th> Código </th>
			            <th> Descripcion </th>
			            <th> Partida </th>
			            <th> Banco </th>
			            <th> Monto </th>
			            <th> Activo </th>
			            <th> Opciones </th>
			        </tr>
			    </thead>
			    <tbody>
                @foreach ($Lista as $item)
                    <tr>
                        <td> {{ $item->codigo }} </td>
                        <td> {{ $item->descripcion }} </td>
                        <td> {{ $item->partida }} </td>
                        <td> {{ $item->banco }} </td>
                        <td> {{ $item->monto }} </td>
                        <td>
                        @if ($item->activo)
                            <a href="{{ route('admin.servicios.activate',$item->id) }}" class="label label-sm label-info"> SI </a>
                        @else
                            <a href="{{ route('admin.servicios.activate',$item->id) }}" class="label label-sm label-danger"> NO </a>
                        @endif
                        </td>
                        <td>{!!Form::boton('Edit',route('admin.servicios.edit',$item->id),'yellow','fa fa-edit','btn-xs')!!}

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
                    {!!Form::text('banco', 'Scotiabank' , ['class'=>'form-control','placeholder'=>'Numero de DNI']);!!}
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



