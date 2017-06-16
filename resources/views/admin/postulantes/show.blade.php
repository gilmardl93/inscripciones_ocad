@extends('layouts.admin')


@section('content')
{!! Alert::render() !!}
@include('alerts.errors')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8 profile-info">
                <h1 class="font-green sbold uppercase">{{ $postulante->nombre_completo }}</h1>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="thumbnail">
                            <img src="{{ $postulante->mostrar_foto_cargada }}" alt="" style="width: 100%; height: 200px;">
                            <div class="caption">
                                <h3>Foto Cargada</h3>
                                <p>{{ $postulante->foto_fecha_carga }}</p>
                            </div>
                        </div>
                    </div><!--span-->
                    <div class="col-sm-3">
                        <div class="thumbnail">
                            <img src="{{ $postulante->mostrar_foto_editada }}" alt="" style="width: 100%; height: 200px;">
                            <div class="caption">
                                <h3>Foto Editada</h3>
                                <p>{{ $postulante->foto_fecha_edicion }}</p>
                            </div>
                        </div>
                    </div><!--span-->
                    <div class="col-sm-3">
                        <div class="thumbnail">
                            <img src="{{ $postulante->mostrar_foto_rechazada }}" alt="" style="width: 100%; height: 200px;">
                            <div class="caption">
                                <h3>Foto Rechazada</h3>
                                <p>{{ $postulante->foto_fecha_rechazo }}</p>
                            </div>
                        </div>
                    </div><!--span-->
                </div><!--row-->
            </div>
            <!--end col-md-8-->
            <div class="col-md-4">
                <div class="portlet sale-summary">
                    <div class="portlet-title">
                        <div class="caption font-red sbold"> Pagos Realizados </div>
                        <div class="tools">
                            <a class="reload" href="javascript:;" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <ul class="list-unstyled">
                            @foreach ($postulante->recaudaciones as $item)
                                <li>
                                    <span class="sale-info"> {{ $item->fecha.' - '.$item->descripcion }}
                                        <i class="fa fa-img-up"></i>
                                    </span>
                                    <span class="sale-num"> {{ $item->monto }} </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!--end col-md-4-->
        </div>
        <!--end row-->
        <div class="tabbable-line tabbable-custom-profile">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab_1_11" data-toggle="tab" aria-expanded="true"> Datos del Postulante </a>
                </li>
                <li>
                    <a href="#tab_1_22" data-toggle="tab" aria-expanded="true"> Ficha </a>
                </li>
                <li>
                    <a href="#tab_1_23" data-toggle="tab" aria-expanded="true"> Usuario </a>
                </li>
                <li>
                    <a href="#tab_1_24" data-toggle="tab" aria-expanded="true"> Cargar Foto </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1_11">
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-advance table-hover">
                            <thead>
                                <tr>
                                    <th><i class="fa fa-briefcase"></i> Campo </th>
                                    <th class="hidden-xs"><i class="fa fa-edit"></i> Nombre </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Número de Inscripción
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->codigo }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Numero de Identificación
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->identificacion }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Paterno
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->paterno }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Materno
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->materno }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Nombres
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->nombres }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Modalidad
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->nombre_modalidad }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Especialidad
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->nombre_especialidad }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Aula Dia 1
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->datos_aula_uno->codigo }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Aula Dia 2
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->datos_aula_dos->codigo }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Aula Dia 3
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->datos_aula_tres->codigo }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Email
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->email }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Telefonos
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->telefono_celular.' / '.$postulante->telefono_fijo.' / '.$postulante->telefono_varios }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--tab-pane-->
                <div class="tab-pane" id="tab_1_22">
                <iframe src="{{route('ficha.pdf',$postulante->id)}}" width="100%" height="900px" scrolling="auto"></iframe>
                </div>
                <!--tab-pane-->
                <div class="tab-pane" id="tab_1_23">
                    <div class="tab-pane active" id="tab_1_1_1">
                    {!! Form::open(['route'=>'admin.pos.store','method'=>'POST']) !!}
                        <div class="col-md-4">
                        {!!Form::hidden('idpostulante', $postulante->id );!!}
                        {!! Field::text('password',null,['label'=>'Calmbiar la contraseña del usuario']) !!}
                        {!!Form::enviar('Actualizar')!!}
                        </div>
                    {!! Form::close() !!}
                    </div>
                </div>
                <!--tab-pane-->
                <div class="tab-pane" id="tab_1_24">
                    <div class="tab-pane active" id="tab_1_1_1">
                    {!! Form::open(['route'=>'admin.pos.store','method'=>'POST']) !!}
                        <div class="col-md-4">
                        {!!Form::hidden('idpostulante', $postulante->id );!!}

                        </div>
                    {!! Form::close() !!}
                    </div>
                </div>
                <!--tab-pane-->
            </div>
        </div>
    </div>
</div>

@stop


@section('plugins-styles')
{!! Html::style(asset('assets/pages/css/profile-2.min.css')) !!}
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




