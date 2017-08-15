@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <iframe src="{{route('admin.ingresantes.listadonotas.pdf')}}" width="100%" height="700px" scrolling="auto"></iframe>
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



