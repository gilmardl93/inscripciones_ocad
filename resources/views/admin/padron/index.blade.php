@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN Portlet PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Participante </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a class="reload actualizar"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
        <p></p>
            <div class="table-response">
            </br>
                <table class="table table-striped table-bordered table-hover Postulantes">
                    <thead>
                        <tr>
                            <th> Periodo </th>
                            <th> Concurso </th>
                            <th> Número Identificación </th>
                            <th> Codigo Verificación </th>
                            <th> Paterno </th>
                            <th> Materno </th>
                            <th> Nombres </th>
                            <th> Tipo Identificación </th>
                            <th> Numero identificación </th>
                            <th> Email </th>
                            <th> Talla </th>
                            <th> Peso </th>
                            <th> Sexo </th>
                            <th> Telefono Celular </th>
                            <th> Telefono Fijo </th>
                            <th> Telefono Varios </th>
                            <th> Modalidad </th>
                            <th> Codigo Especialidad </th>
                            <th> Especialidad </th>
                            <th> Segunda Modalidad </th>
                            <th> Codigo segunda Especialidad </th>
                            <th> segunda Especialidad </th>
                            <th> Ubigeo </th>
                            <th> Direccion </th>
                            <th> Nombre del Colegio </th>
                            <th> Gestion del Colegio </th>
                            <th> Ubigeo del Colegio </th>
                            <th> Nombre de Universidad </th>
                            <th> Inicio de Estudios </th>
                            <th> Fin de Estudios </th>
                            <th> Fecha Nacimiento </th>
                            <th> Ubigeo Nacimiento </th>
                            <th> Ubigeo Provincia </th>
                            <th> Direccion Provincia </th>
                            <th> Telefono Provincia </th>
                            <th> Sector 1 </th>
                            <th> Aula 1 </th>
                            <th> Sector 2 </th>
                            <th> Aula 2 </th>
                            <th> Sector 3 </th>
                            <th> Aula 3 </th>
                            <th> Sector voca </th>
                            <th> Aula voca </th>
                            <th> Razon de carrera</th>
                            <th> Tipo de preparacion</th>
                            <th> Tiempo de preparacion (meses)</th>
                            <th> Academia</th>
                            <th> Numero veces Postuló</th>
                            <th> Renuncio</th>
                            <th> Ingreso Economico</th>
                            <th> Publicidad</th>
                            <th> Fecha Registro </th>
                            <th> Pago </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Lista->chunk(10) as $item)
                            @foreach ($item as $padron)
                                <tr>
                                    <td> {{ $padron->datos_evaluacion->codigo }} </td>
                                    <td> {{ $padron->datos_evaluacion->nombre }} </td>
                                    <td> {{ $padron->codigo }} </td>
                                    <td> {{ $padron->codigo_verificacion }} </td>
                                    <td> {{ $padron->paterno }} </td>
                                    <td> {{ $padron->materno }} </td>
                                    <td> {{ $padron->nombres }} </td>
                                    <td> {{ $padron->tipo_identificacion }} </td>
                                    <td> {{ $padron->numero_identificacion }} </td>
                                    <td> {{ $padron->email }} </td>
                                    <td> {{ $padron->talla }} </td>
                                    <td> {{ $padron->peso }} </td>
                                    <td> {{ $padron->sexo }} </td>
                                    <td> {{ $padron->telefono_celular }} </td>
                                    <td> {{ $padron->telefono_fijo }} </td>
                                    <td> {{ $padron->telefono_varios }} </td>
                                    <td> {{ $padron->nombre_modalidad }} </td>
                                    <td> {{ $padron->codigo_especialidad }} </td>
                                    <td> {{ $padron->nombre_especialidad }} </td>
                                    <td> {{ $padron->nombre_modalidad2 }} </td>
                                    <td> {{ $padron->codigo_especialidad2 }} </td>
                                    <td> {{ $padron->nombre_especialidad2 }} </td>
                                    <td> {{ $padron->descripcion_ubigeo }} </td>
                                    <td> {{ $padron->direccion }} </td>
                                    <td> {{ $padron->datos_colegio->nombre }} </td>
                                    <td> {{ $padron->datos_colegio->gestion }} </td>
                                    <td> {{ $padron->datos_colegio->descripcion_ubigeo }} </td>
                                    <td> {{ $padron->datos_universidad->nombre }} </td>
                                    <td> {{ $padron->inicio_estudios }} </td>
                                    <td> {{ $padron->fin_estudios }} </td>
                                    <td> {{ $padron->fecha_nacimiento }} </td>
                                    <td> {{ $padron->descripcion_ubigeo_nacimiento }} </td>
                                    <td> {{ $padron->descripcion_ubigeo_provincia }} </td>
                                    <td> {{ $padron->direccion_provincia }} </td>
                                    <td> {{ $padron->telefono_provincia }} </td>
                                    <td> {{ $padron->datos_aula_uno->sector }} </td>
                                    <td> {{ $padron->datos_aula_uno->codigo }} </td>
                                    <td> {{ $padron->datos_aula_dos->sector }} </td>
                                    <td> {{ $padron->datos_aula_dos->codigo }} </td>
                                    <td> {{ $padron->datos_aula_tres->sector }} </td>
                                    <td> {{ $padron->datos_aula_tres->codigo }} </td>
                                    <td> {{ $padron->datos_aula_voca->sector }} </td>
                                    <td> {{ $padron->datos_aula_voca->codigo }} </td>
                                    <td>@if (isset($padron->complementarios)) {{ $padron->complementarios->razon }} @else --- @endif </td>
                                    <td>@if (isset($padron->complementarios)) {{ $padron->complementarios->tipo_preparacion }} @else --- @endif </td>
                                    <td>@if (isset($padron->complementarios)) {{ $padron->complementarios->mes }} @else --- @endif </td>
                                    <td>@if (isset($padron->complementarios)) {{ $padron->complementarios->academia }} @else --- @endif </td>
                                    <td>@if (isset($padron->complementarios)) {{ $padron->complementarios->numeroveces }} @else --- @endif </td>
                                    <td>@if (isset($padron->complementarios)) {{ $padron->complementarios->renuncio }} @else --- @endif </td>
                                    <td>@if (isset($padron->complementarios)) {{ $padron->complementarios->ingreso_economico }} @else --- @endif </td>
                                    <td>@if (isset($padron->complementarios)) {{ $padron->complementarios->publicidad }} @else --- @endif </td>
                                    <td> {{ $padron->fecha_registro }} </td>
                                    <td> {!! $padron->estado_pago !!} </td>

                                </tr>
                            @endforeach
                        @endforeach {{-- Fin del chunk --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Portlet PORTLET-->
	</div><!--span-->
</div><!--row-->
@stop

@section('js-scripts')
<script>
$(function(){
    $('.Postulantes').DataTable({
        "language": {
            "emptyTable": "No hay datos disponibles",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ filas",
            "search": "Buscar Postulante :",
            "lengthMenu": "_MENU_ registros"
        },
        stateSave: true,
        responsive: true,
        dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        buttons: [
                    { extend: 'excel', className: 'btn yellow btn-outline ' },
                    { extend: 'colvis', className: 'btn dark btn-outline', text: 'Columns'}
                ],
        "bProcessing": true,
               "pagingType": "bootstrap_full_number",

    });

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


@section('title')
Padron
@stop
@section('page-title')

@stop

@section('page-subtitle')
@stop



