@extends('layouts.admin')


@section('content')
{!! Alert::render() !!}
<div class="row">
	<div class="col-md-3">
		<h3>Preinscritos Lima + Provincias</h3>
		<table class="table table-bordered table-hover" data-toggle="table" data-pagination="true">
		    <thead>
		        <tr>
		            <th> Region </th>
		            <th> Cantidad </th>
		        </tr>
		    </thead>
		    <tfoot>
		        <tr>
		            <th> Total </th>
		            <th> {{ $Preinscritos_provincia->sum('cantidad') }} </th>
		        </tr>
		    </tfoot>
		    <tbody>
			@foreach ($Preinscritos_provincia as $item)
		        <tr >
		            <td> {{ $item->region }} </td>
		            <td> {{ $item->cantidad }} </td>
		        </tr>
			@endforeach
		    </tbody>
		</table>
		{!! $Preinscritos_provincia->links() !!}
	</div><!--span-->
	<div class="col-md-3">
		<h3>Inscritos Lima + Provincia</h3>
		<table class="table table-bordered table-hover" data-toggle="table" data-pagination="true">
		    <thead>
		        <tr>
		            <th> Region </th>
		            <th> Cantidad </th>
		        </tr>
		    </thead>
		    <tfoot>
		        <tr>
		            <th> Total </th>
		            <th> {{ $Inscritos_provincia->sum('cantidad') }} </th>
		        </tr>
		    </tfoot>
		    <tbody>
			@foreach ($Inscritos_provincia as $item)
		        <tr >
		            <td> {{ $item->region }} </td>
		            <td> {{ $item->cantidad }} </td>
		        </tr>
			@endforeach
		    </tbody>
		</table>
		{!! $Inscritos_provincia->links() !!}
	</div><!--span-->
	<div class="col-md-3">
		<h3>Semibecas</h3>
		<table class="table table-bordered table-hover" data-toggle="table" data-pagination="true">
		    <thead>
		        <tr>
		            <th> Evaluacion </th>
		            <th> Cantidad </th>
		        </tr>
		    </thead>
		    <tfoot>
		        <tr>
		            <th> Total </th>
		            <th> {{ $Semibecas->sum('cantidad') }} </th>
		        </tr>
		    </tfoot>
		    <tbody>
			@foreach ($Semibecas as $item)
		        <tr >
		            <td>
						@if (isset($item->otorga))
							{{ $item->otorga }}
						@else
							SOLICITANTES
						@endif
		            </td>
		            <td> {{ $item->cantidad }} </td>
		        </tr>
			@endforeach
		    </tbody>
		</table>
	</div><!--span-->
	<div class="col-md-3">
		<h3>Fotos</h3>
		<table class="table table-bordered table-hover" data-toggle="table" data-pagination="true">
		    <thead>
		        <tr>
		            <th> descripcion </th>
		            <th> Cantidad </th>
		        </tr>
		    </thead>
		    <tbody>
			@foreach ($Fotos as $item)
		        <tr >
		            <td> {{ $item->foto_estado }} </td>
		            <td> {{ $item->cantidad }} </td>
		        </tr>
			@endforeach
		    </tbody>
		</table>
	</div><!--span-->
</div><!--row-->
<div class="row">
	<div class="col-md-3">
		<h3>Cepre UNI</h3>
		<table class="table table-bordered table-hover" data-toggle="table" data-pagination="true">
		    <thead>
		        <tr>
		            <th> Estado </th>
		            <th> Cantidad </th>
		        </tr>
		    </thead>

		    <tbody>
		        <tr>
		            <td> Preinscritos </td>
		            <td> {{ $CepreUniPre }} </td>
		        </tr>
		        <tr>
		            <td> Pagantes </td>
		            <td> {{ $CepreUniPag }} </td>
		        </tr>
		        <tr>
		            <td> Inscritos </td>
		            <td> {{ $CepreUniIns }} </td>
		        </tr>
		    </tbody>
		</table>
	</div><!--span-->
	<div class="col-md-3">
		<h3>Cepre UNI Vocacional</h3>
		<table class="table table-bordered table-hover" data-toggle="table" data-pagination="true">
		    <thead>
		        <tr>
		            <th> Estado </th>
		            <th> Cantidad </th>
		        </tr>
		    </thead>
		    <tbody>
		        <tr>
		            <td> Preinscritos </td>
		            <td> {{ $CepreUniPreVoca }} </td>
		        </tr>
		        <tr>
		            <td> Pagantes </td>
		            <td> {{ $CepreUniPagVoca }} </td>
		        </tr>
		        <tr>
		            <td> Inscritos </td>
		            <td> {{ $CepreUniInsVoca }} </td>
		        </tr>
		    </tbody>
		</table>
		<h3> Vocacional</h3>
		<table class="table table-bordered table-hover" data-toggle="table" data-pagination="true">
		    <thead>
		        <tr>
		            <th> Estado </th>
		            <th> Cantidad </th>
		        </tr>
		    </thead>
		    <tbody>
		        <tr>
		            <td> Preinscritos </td>
		            <td> {{ $PreVoca }} </td>
		        </tr>
		        <tr>
		            <td> Pagantes </td>
		            <td> {{ $PagVoca }} </td>
		        </tr>
		        <tr>
		            <td> Inscritos </td>
		            <td> {{ $InsVoca }} </td>
		        </tr>
		    </tbody>
		</table>
	</div><!--span-->
	<div class="col-md-6">
		<h3>Cepre UNI Modalidad</h3>
		<table class="table table-bordered table-hover" data-toggle="table" data-pagination="true">
		    <thead>
		        <tr>
		            <th> Modalidad 1 </th>
		            <th> Modalidad 2 </th>
		            <th> Pago </th>
		            <th> Cantidad </th>
		        </tr>
		    </thead>
		    <tbody>
		        @foreach ($CepreUniModalidad as $item)
			        <tr >
			            <td> {{ $item->modalidad1 }} </td>
			            <td> {{ $item->modalidad2 }} </td>
			            <td> {{ $item->pago }} </td>
			            <td> {{ $item->cantidad }} </td>
			        </tr>
				@endforeach
		    </tbody>
		</table>
	</div><!--span-->
</div><!--row-->
<div class="row">
	<div class="col-md-4">
		<h3>Preinscritos</h3>
		<table class="table table-bordered table-hover" data-toggle="table" data-pagination="true">
		    <thead>
		        <tr>
		            <th> Fecha registro </th>
		            <th> Cantidad </th>
		        </tr>
		    </thead>
		    <tfoot>
		        <tr>
		            <th> Total </th>
		            <th> {{ Totales('Preinscritos') }} </th>
		        </tr>
		    </tfoot>
		    <tbody>
			@foreach ($Lista as $item)
		        <tr >
		            <td> {{ $item->fecha_registro }} </td>
		            <td> {{ $item->cantidad }} </td>
		        </tr>
			@endforeach
		    </tbody>
		</table>
		{!! $Lista->links() !!}
	</div><!--span-->
	<div class="col-md-4">
		<h3>Inscritos</h3>
		<table class="table table-bordered table-hover" data-toggle="table" data-pagination="true">
		    <thead>
		        <tr>
		            <th> Fecha registro </th>
		            <th> Cantidad </th>
		        </tr>
		    </thead>
		    <tfoot>
		        <tr>
		            <th> Total </th>
		            <th> {{ Totales('Inscritos') }} </th>
		        </tr>
		    </tfoot>
		    <tbody>
			@foreach ($Inscritos as $item)
		        <tr >
		            <td> {{ $item->fecha_conformidad }} </td>
		            <td> {{ $item->cantidad }} </td>
		        </tr>
			@endforeach
		    </tbody>
		</table>
		{!! $Lista->links() !!}
	</div><!--span-->
	<div class="col-md-4">
		<h3>Pagantes</h3>
		<table class="table table-bordered table-hover" data-toggle="table" data-pagination="true">
		    <thead>
		        <tr>
		            <th> Fecha Pago </th>
		            <th> Cantidad </th>
		        </tr>
		    </thead>
		    <tfoot>
		        <tr>
		            <th> Total </th>
		            <th> {{ Totales('Pagantes') }} </th>
		        </tr>
		    </tfoot>
		    <tbody>
			@foreach ($Pagantes as $item)
		        <tr >
		            <td> {{ $item->fecha_pago }} </td>
		            <td> {{ $item->cantidad }} </td>
		        </tr>
			@endforeach
		    </tbody>
		</table>
		{!! $Pagantes->links() !!}
	</div><!--span-->
</div><!--row-->
<div class="row">
	<div class="col-md-6">
		<h3>Pagos</h3>
		<table class="table table-bordered table-hover" data-toggle="table" data-pagination="true">
		    <thead>
		        <tr>
		            <th> descripcion </th>
		            <th> Cantidad </th>
		        </tr>
		    </thead>
		    <tfoot>
		        <tr>
		            <th> Total </th>
		            <th> {{ $Pagos->sum('cantidad') }} </th>
		        </tr>
		    </tfoot>
		    <tbody>
			@foreach ($Pagos as $item)
		        <tr >
		            <td> {{ $item->descripcion }} </td>
		            <td> {{ $item->cantidad }} </td>
		        </tr>
			@endforeach
		    </tbody>
		</table>
	</div><!--span-->
	<div class="col-md-6">
		<h3>Pre Inscritos Por Modalidad</h3>
		<table class="table table-bordered table-hover" data-toggle="table" data-pagination="true">
		    <thead>
		        <tr>
		            <th> Modalidad </th>
		            <th> Cantidad </th>
		        </tr>
		    </thead>
		    <tfoot>
		        <tr>
		            <th> Total </th>
		            <th> {{ $Modalidades->sum('cantidad') }} </th>
		        </tr>
		    </tfoot>
		    <tbody>
			@foreach ($Modalidades as $item)
		        <tr >
		            <td> {{ $item->modalidad }} </td>
		            <td> {{ $item->cantidad }} </td>
		        </tr>
			@endforeach
		    </tbody>
		</table>
		{!! $Modalidades->links() !!}
	</div><!--span-->
	<div class="col-md-6">
		<h3>Inscritos Por Modalidad</h3>
		<table class="table table-bordered table-hover" data-toggle="table" data-pagination="true">
		    <thead>
		        <tr>
		            <th> Modalidad </th>
		            <th> Cantidad </th>
		        </tr>
		    </thead>
		    <tfoot>
		        <tr>
		            <th> Total </th>
		            <th> {{ $ModalidadesIns->sum('cantidad') }} </th>
		        </tr>
		    </tfoot>
		    <tbody>
			@foreach ($ModalidadesIns as $item)
		        <tr >
		            <td> {{ $item->modalidad }} </td>
		            <td> {{ $item->cantidad }} </td>
		        </tr>
			@endforeach
		    </tbody>
		</table>
		{!! $ModalidadesIns->links() !!}
	</div><!--span-->
</div><!--row-->
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
Estadisticas
@stop

@section('page-subtitle')
@stop




