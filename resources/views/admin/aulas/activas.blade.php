@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
    {!! Alert::render() !!}
    @include('alerts.errors')
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cubes"></i>
                    Gestion de Aulas
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="" class="fullscreen"> </a>
                    <a href="javascript:;" class="remove"> </a>
                </div>
            </div>
            <div class="portlet-body">
            {!! Form::open(['route'=>'admin.disponible.aulas','method'=>'POST']) !!}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!Form::label('lblSector', 'Sector');!!}
                            {!!Form::select('sector', $sectores ,null , ['class'=>'form-control','placeholder'=>'Nombre del sector']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!Form::label('lblDisponibilidad', 'Disponible');!!}
                            {!!Form::text('disponible', null , ['class'=>'form-control','placeholder'=>'Disponibilidad del aula']);!!}
                        </div>
                    </div><!--span-->
                </div><!--row-->
                {!!Form::enviar('Guardar')!!}
                {!!Form::back(route('admin.aulas.index'))!!}
                {!!Form::boton('Ordenar aulas',route('admin.ordenar.aulas'),'blue-madison','fa fa-arrows-v')!!}
            {!! Form::close() !!}
            <div class="row">
                <div class="col-md-4">
                     <h4 class="block">Resumen</h4>
                        <ul class="list-group">
                            @foreach ($resumen as $item)
                                <li class="list-group-item"> {{ $item->sector }}
                                    <span class="badge badge-info"> {{ $item->cnt }} </span>
                                </li>
                            @endforeach
                                <li class="list-group-item"> Total
                                    <span class="badge ">  {{ $resumen->sum('cnt')}} </span>
                                </li>
                        </ul>
                </div><!--span-->
            </div><!--row-->
            <p></p>
                <div class="row">
                    <div class="col-md-12">
                    {!! Form::open(['route'=>'admin.desactivar.aulas','method'=>'POST']) !!}
                        <table class="table table-bordered table-hover" id="Aulas">
                            <thead>
                                <tr>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                    <th colspan="2"> Día 01 </th>
                                    <th colspan="2"> Día 02 </th>
                                    <th colspan="2"> Día 03 </th>
                                    <th>  </th>
                                    <th>  </th>
                                </tr>
                                <tr>
                                    <th>
                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" class="group-checkable" data-set="#Aulas .checkboxes" />
                                            <span></span>
                                        </label>
                                    </th>
                                    <th> Orden </th>
                                    <th> Sector </th>
                                    <th> Codigo </th>
                                    <th> Capacidad </th>
                                    <th> Disponible </th>
                                    <th> Asignado </th>
                                    <th> Disponible </th>
                                    <th> Asignado </th>
                                    <th> Disponible </th>
                                    <th> Asignado </th>
                                    <th> Activo </th>
                                    <th> Opciones </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>
                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" class="group-checkable" data-set="#Aulas .checkboxes" />
                                            <span></span>
                                        </label>
                                    </th>
                                    <th> Orden </th>
                                    <th> Sector </th>
                                    <th> Codigo </th>
                                    <th> Capacidad </th>
                                    <th> Disponible </th>
                                    <th> Asignado </th>
                                    <th> Disponible </th>
                                    <th> Asignado </th>
                                    <th> Disponible </th>
                                    <th> Asignado </th>
                                    <th> Activo </th>
                                    <th> Opciones </th>
                                </tr>
                            </tfoot>
                            <tbody>
                            </tbody>
                        </table>
                        {!!Form::enviar('Desactivar')!!}
                    {!! Form::close() !!}
                    </div><!--span-->
                </div><!--row-->
            </div>
        </div>
        <!-- END Portlet PORTLET-->
    </div>
</div>
@stop

@section('js-scripts')
<script>
var table = $('#Aulas');
table.dataTable({
    "language": {
        "emptyTable": "No hay datos disponibles",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ filas",
        "search": "Buscar Aulas :",
        "lengthMenu": "_MENU_ registros"
    },
    "bProcessing": true,
    "sAjaxSource": '{{ url('admin/lista-aulas-activas') }}',
    "pagingType": "bootstrap_full_number",
    "columnDefs": [
                {  // set default column settings
                    'orderable': false,
                    'targets': '_all'
                },
                {
                    'targets':0,
                    'render': function ( data, type, row ) {
                        return '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> \
                                    <input name="idaulas[]" type="checkbox" class="checkboxes" value="'+data+'" /> \
                                    <span></span> \
                                </label>';
                    }
                },
                {
                    'targets':11,
                    'render': function ( data, type, row ) {
                        if (data) {
                            return '<a href="activar-aula/'+row.id+'" class="label label-sm label-info"> Activo </a>';
                        }else{
                            return '<a href="activar-aula/'+row.id+'" class="label label-sm label-danger"> Inactivo </a>';
                        }
                    }
                },
                {
                    'targets':12,
                    'render': function ( data, type, row ) {
                      return ' \
                      <a href="aulas/'+data+'/edit" title="Editar"class="btn btn-icon-only green-haze" ><i class="fa fa-edit"></i></a> \
                      <a href="delete-aulas/'+data+' " title="Eliminar"class="btn btn-icon-only red" ><i class="fa fa-trash"></i></a> \
                      ';
                    }
                }
            ],
    "columns": [
            { "data": "id","defaultContent": "" },
            { "data": "orden","defaultContent": "" },
            { "data": "sector","defaultContent": "" },
            { "data": "codigo","defaultContent": "" },
            { "data": "capacidad","defaultContent": "" },
            { "data": "disponible_01","defaultContent": "" },
            { "data": "asignado_01","defaultContent": "" },
            { "data": "disponible_02","defaultContent": "" },
            { "data": "asignado_02","defaultContent": "" },
            { "data": "disponible_03","defaultContent": "" },
            { "data": "asignado_03","defaultContent": "" },
            { "data": "activo","defaultContent": "" },
            { "data": "id","defaultContent": "" },

        ],
        "order": [[2,"asc"],[1,"asc"],[3,"asc"]],
        stateSave: true,
        "initComplete": function() {
                // Sector
                this.api().column(2).every(function(){
                    var column = this;
                    var select = $('<select class="form-control input-sm"><option value="">Sector</option></select>')
                        .appendTo( $(column.footer()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                });
            }


});
table.find('.group-checkable').change(function () {
        var set = jQuery(this).attr("data-set");
        var checked = jQuery(this).is(":checked");
        jQuery(set).each(function () {
            if (checked) {
                $(this).prop("checked", true);
                $(this).parents('tr').addClass("active");
            } else {
                $(this).prop("checked", false);
                $(this).parents('tr').removeClass("active");
            }
        });
    });

table.on('change', 'tbody tr .checkboxes', function () {
        $(this).parents('tr').toggleClass("active");
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

@section('user-img')
{{ asset('storage/fotos/'.Auth::user()->foto) }}
@stop

@section('user-name')
{!!Auth::user()->dni!!}
@stop



@section('page-title')

@stop

@section('page-subtitle')

@stop


