@extends('layouts.admin')


@section('content')
{!! Alert::render() !!}
<div class="row">
	<div class="col-md-3">
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
		            <th> Fecha registro </th>
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
	<div class="col-md-3">
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
		            <th> Fecha registro </th>
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
	<div class="col-md-3">
		<h3>Pagantes</h3>
		<table class="table table-bordered table-hover" data-toggle="table" data-pagination="true">
		    <thead>
		        <tr>
		            <th> Fecha de Pago </th>
		            <th> Cantidad </th>
		        </tr>
		    </thead>
		    <tfoot>
		        <tr>
		            <th> Fecha de Pago </th>
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
		{!! $Lista->links() !!}
	</div><!--span-->
	<div class="col-md-3">
		<h3>Por Modalidad</h3>
		<table class="table table-bordered table-hover" data-toggle="table" data-pagination="true">
		    <thead>
		        <tr>
		            <th> Modalidad </th>
		            <th> Cantidad </th>
		        </tr>
		    </thead>
		    <tbody>
			@foreach ($Modalidades as $item)
		        <tr >
		            <td> {{ $item->modalidad }} </td>
		            <td> {{ $item->cantidad }} </td>
		        </tr>
			@endforeach
		    </tbody>
		</table>
		{!! $Lista->links() !!}
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




