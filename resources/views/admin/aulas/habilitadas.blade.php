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
                    Gestion de Aulas habilitadas
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="" class="fullscreen"> </a>
                    <a href="javascript:;" class="remove"> </a>
                </div>
            </div>
            <div class="portlet-body">
                {!!Form::back(route('admin.activas.aulas'))!!}
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
                                    <th colspan="2"> Voca </th>
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
                                    <th> Disponible </th>
                                    <th> Asignado </th>
                                    <th> Activo </th>
                                    <th> Habilitado </th>
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
                                    <th> Disponible </th>
                                    <th> Asignado </th>
                                    <th> Activo </th>
                                    <th> Habilitado </th>
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
    "sAjaxSource": '{{ url('admin/lista-aulas-habilitadas') }}',
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
                    'targets':13,
                    'render': function ( data, type, row ) {
                        if (data) {
                            return '<a href="activar-aula/'+row.id+'" class="label label-sm label-info"> Activo </a>';
                        }else{
                            return '<a href="activar-aula/'+row.id+'" class="label label-sm label-danger"> Inactivo </a>';
                        }
                    }
                },
                {
                    'targets':14,
                    'render': function ( data, type, row ) {
                        if (data) {
                            return '<a href="habilitar-aula/'+row.id+'" class="label label-sm label-info"> SI </a>';
                        }else{
                            return '<a href="habilitar-aula/'+row.id+'" class="label label-sm label-danger"> NO </a>';
                        }
                    }
                },
                {
                    'targets':15,
                    'render': function ( data, type, row ) {
                      return ' \
                      <a href="editar-aulas-activas/'+data+'/edit" title="Editar"class="btn btn-icon-only green-haze" ><i class="fa fa-edit"></i></a> \
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
            { "data": "disponible_voca","defaultContent": "" },
            { "data": "asignado_voca","defaultContent": "" },
            { "data": "activo","defaultContent": "" },
            { "data": "habilitado","defaultContent": "" },
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
            },
        "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
                // Total over this page
                Capacidad = api
                    .column( 4, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                // Total de aulas Disponibles para el dia 1
                Disponible1 = api
                    .column( 5, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                // Total de aulas asignadas para el dia 1
                Asignado1 = api
                    .column( 6, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                // Total de aulas Disponibles para el dia 2
                Disponible2 = api
                    .column( 7, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                // Total de aulas asignadas para el dia 2
                Asignado2 = api
                    .column( 8, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                // Total de aulas Disponibles para el dia 3
                Disponible3 = api
                    .column( 9, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                // Total de aulas asignadas para el dia 3
                Asignado3 = api
                    .column( 10, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                // Total de aulas Disponibles para el voca
                DisponibleVoca = api
                    .column( 11, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                // Total de aulas asignadas para el dia Voca
                AsignadoVoca = api
                    .column( 12, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api.column( 4 ).footer() ).html(Capacidad);
                $( api.column( 5 ).footer() ).html(Disponible1);
                $( api.column( 6 ).footer() ).html(Asignado1);
                $( api.column( 7 ).footer() ).html(Disponible2);
                $( api.column( 8 ).footer() ).html(Asignado2);
                $( api.column( 9 ).footer() ).html(Disponible3);
                $( api.column( 10).footer() ).html(Asignado3);
                $( api.column( 11).footer() ).html(DisponibleVoca);
                $( api.column( 12).footer() ).html(AsignadoVoca);
            },


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


