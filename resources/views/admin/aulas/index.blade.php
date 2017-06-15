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
            {!! Form::open(['route'=>'admin.aulas.store','method'=>'POST']) !!}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!Form::label('lblSector', 'Sector');!!}
                            {!!Form::text('sector', null , ['class'=>'form-control','placeholder'=>'Nombre del sector']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!Form::label('lblCodigo', 'Codigo');!!}
                            {!!Form::text('codigo', null , ['class'=>'form-control','placeholder'=>'Codigo del aula']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!Form::label('lblCapacidad', 'Capacidad');!!}
                            {!!Form::text('capacidad', null , ['class'=>'form-control','placeholder'=>'Capacidad del aula']);!!}
                        </div>
                    </div><!--span-->
                </div><!--row-->
                {!!Form::enviar('Guardar')!!}
                {!!Form::boton('Activos',route('admin.activas.aulas'),'blue','fa fa-check')!!}
                {!!Form::boton('Ordenar aulas',route('admin.ordenar.aulas'),'blue-madison','fa fa-arrows-v')!!}
            {!! Form::close() !!}
            <p></p>
                <div class="row">
                    <div class="col-md-12">
                    {!! Form::open(['route'=>'admin.activar.aulas','method'=>'POST']) !!}
                        <table class="table table-bordered table-hover" id="Aulas">
                            <thead>
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
                                    <th> Activo </th>
                                    <th> Opciones </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    {!!Form::enviar('Activar')!!}
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
    "sAjaxSource": '{{ url('admin/lista-aulas') }}',
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
                    'targets':7,
                    'render': function ( data, type, row ) {
                        if (data) {
                            return '<a href="activar-aula/'+row.id+'" class="label label-sm label-info"> Activo </a>';
                        }else{
                            return '<a href="activar-aula/'+row.id+'" class="label label-sm label-danger"> Inactivo </a>';
                        }
                    }
                },
                {
                    'targets':8,
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
            { "data": "disponible","defaultContent": "" },
            { "data": "asignado","defaultContent": "" },
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


@section('user-name')
{!!Auth::user()->dni!!}
@stop

@section('breadcrumb')

@stop


@section('page-title')

@stop

@section('page-subtitle')
@stop



