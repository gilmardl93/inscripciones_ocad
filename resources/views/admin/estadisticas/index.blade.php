@extends('layouts.admin')


@section('content')
{!! Alert::render() !!}
<div class="row">
	<div class="col-md-3">
		<table class="table table-bordered table-hover" data-toggle="table" data-pagination="true">
		    <thead>
		        <tr>
		            <th> Fecha registro </th>
		            <th> Cantidad </th>
		        </tr>
		    </thead>
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




