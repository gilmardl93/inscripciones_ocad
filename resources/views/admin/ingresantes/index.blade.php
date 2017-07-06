@extends('layouts.admin')


@section('content')
{!! Alert::render() !!}
<div class="search-page search-content-4">
        <div class="search-bar bordered">
            {!! Form::open(['route'=>'admin.ingresantes.search','method'=>'POST']) !!}
            <div class="row">
                <div class="col-lg-12">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar Ingresantes" name="dni">
                        <span class="input-group-btn">
                            <button class="btn green-soft uppercase bold" type="submit">Buscar </button>
                        </span>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="search-table table-responsive">
            <table class="table table-bordered table-striped table-condensed">
                <thead class="bg-blue">
                    <tr>
                        <th> <a href="javascript:;">DNI</a> </th>
                        <th class="table-download"> <a href="javascript:;">Nombres</a> </th>
                        <th class="table-download"> <a href="javascript:;">Ver</a> </th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($Lista as $item)
                    <tr>
                        <td class="table-title">
                            <h3>
                                <a href="{{ route('admin.ingresantes.show',$item->id) }}">{{ $item->identificacion }}</a>
                            </h3>
                            <p>Nombres:
                                <a href="{{ route('admin.ingresantes.show',$item->id) }}">{{ $item->nombre_completo }}</a>

                            </p>
                        </td>
                        <td class="table-download"> <img src="{{ $item->mostrar_foto_editada }}" width='50px'> </td>
                        <td class="table-download">
                            <a href="{{ route('admin.ingresantes.show',$item->id) }}">
                                <i class="fa fa-eye font-green-soft"></i>
                            </a>
                        </td>
                    </tr>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop


@section('plugins-styles')
{!! Html::style(asset('assets/pages/css/search.min.css')) !!}
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
Panel de Administracion
@stop

@section('page-subtitle')
@stop




