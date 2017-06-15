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
			<table class="table table-bordered table-hover Recaudacion">
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
            {!! $postulantes->links() !!}
        </div>
    </div>
    <!-- END Portlet PORTLET-->
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

@stop

@section('page-subtitle')
@stop




