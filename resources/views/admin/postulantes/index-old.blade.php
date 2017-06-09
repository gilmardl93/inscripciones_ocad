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
		{!!Form::boton('Sin Foto','#','green-meadow','fa fa-file-image-o')!!}
        <p></p>
            <div class="table-response">

                <table class="table table-striped table-bordered table-hover Postulantes">
                    <thead>
                        <tr>
                            <th> Codigo </th>
                            <th> Paterno </th>
                            <th> Materno </th>
                            <th> Nombres </th>
                            <th class="none"> Sexo </th>
                            <th class="none"> Fecha Nacimiento </th>
                            <th class="none"> Sede </th>
                            <th class="none"> Especialidad </th>
                            <th class="none"> Ubigeo </th>
                            <th class="none"> Direccion </th>
                            <th class="none"> Colegio </th>
                            <th class="none"> Ubigeo Colegio </th>
                            <th> DNI </th>
                            <th> Telefono </th>
                            <th> Email </th>
                            <th> Foto Cargada</th>
                            <th> Foto Editada</th>
                            <th> Foto Rechazado </th>
                            <th> Fecha Foto </th>
                            <th> Fecha Registro </th>
                            <th> Grado </th>
                            <th> Aula </th>
                            <th> Pago </th>
                            <th> Anulado </th>
                            <th> Opciones </th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Portlet PORTLET-->
	</div><!--span-->
</div><!--row-->
<div class="modal fade" id="verfoto" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Foto</h4>
            </div>
            <div class="modal-body">
                <img id="fotito" style="height: 400px" alt="" >
            </div>
            <div class="modal-footer">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
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
    responsive: true,
    dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
    buttons: [
                { extend: 'excel', className: 'btn yellow btn-outline ' },
                { extend: 'colvis', className: 'btn dark btn-outline', text: 'Columns'}
            ],
    "bProcessing": true,
    "sAjaxSource": '{{ url('admin/postulantes-lista') }}',
    "pagingType": "bootstrap_full_number",
    "columnDefs": [
                {  // set default column settings
                    'orderable': true,
                    'targets': '_all'
                },
                {
                    'targets':15,
                    'render': function ( data ) {
                      return '<a href="#verfoto" data-foto="{{ asset('/storage/') }}/'+data+'" data-toggle="modal"><img src="{{ asset('/storage/') }}/'+data+'"  width="25px" ></a>';
                    }
                },
                {
                    'targets':16,
                    'render': function ( data, type, row ) {
                        var ext = data.foto;
                        var n = ext.slice((ext.lastIndexOf(".") - 1 >>> 0) + 2);
                        var foto = data.dni+'.'+n;
                        if( data.foto_estado == 'ACEPTADO'){
                            return '<a href="#verfoto" data-foto="{{ asset('/storage/fotosok') }}/'+foto+'" data-toggle="modal"><img src="{{ asset('/storage/fotosok') }}/'+foto+'"  width="25px" ></a>';
                        }
                    }
                },
                {
                    'targets':17,
                    'render': function ( data ) {
                        if (data!=null) {
                            return '<a href="#verfoto" data-foto="{{ asset('/storage/') }}/'+data+'" data-toggle="modal"><img src="{{ asset('/storage/') }}/'+data+'"  width="25px" ></a>';
                        }
                    }
                },
                {
                    'targets':22,
                    'render': function ( data ) {
                    	if (data) {
                    		return '<span class="label label-sm label-info"> SI </span>';
                    	}else{
                    		return '<span class="label label-sm label-danger"> NO </span>';
                    	}
                    }
                },{
                    'targets':23,
                    'render': function ( data ) {
                    	if (data) {
                    		return '<span class="label label-sm label-info"> SI </span>';
                    	}else{
                    		return '<span class="label label-sm label-danger"> NO </span>';
                    	}
                    }
                },
                {
                    'targets':24,
                    'render': function ( data ) {
                      return '<a href="postulante/'+data+'/edit" title="Editar"class="btn btn-icon-only green-haze" ><i class="fa fa-edit"></i></a>'+
                      '<a href="postulantes-ficha/'+data+'" title="Ficha"class="btn btn-icon-only blue" ><i class="fa fa-file-image-o"></i></a>'+
                      '<a href="postulantes-pago/'+data+'" title="Formato Pago"class="btn btn-icon-only grey-gallery" ><i class="fa fa-money"></i></a>';
                    }
                }
            ],
    "columns": [
            { "data": "codigo","defaultContent": "" },
            { "data": "paterno","defaultContent": "" },
            { "data": "materno","defaultContent": "" },
            { "data": "nombres","defaultContent": "" },
            { "data": "sexo.nombre","defaultContent": "" },
            { "data": "fecha_nacimiento","defaultContent": "" },
            { "data": "sedes.nombre","defaultContent": "" },
            { "data": "especialidades.nombre","defaultContent": "" },
            { "data": "ubigeos.descripcion","defaultContent": "" },
            { "data": "direccion","defaultContent": "" },
            { "data": "colegios.nombre","defaultContent": "" },
            { "data": "colegios.nombre","defaultContent": "" },
            { "data": "dni","defaultContent": "" },
            { "data": "telefono","defaultContent": "" },
            { "data": "email","defaultContent": "" },
            { "data": "foto","defaultContent": "" },
            { "data":  null,"defaultContent": "" },
            { "data": "foto_rechazo","defaultContent": "" },
            { "data": "fecha_foto","defaultContent": "" },
            { "data": "fecha_registro","defaultContent": "" },
            { "data": "grado.nombre","defaultContent": "" },
            { "data": "aulas.codigo","defaultContent": "" },
            { "data": "pago","defaultContent": "" },
            { "data": "anulado","defaultContent": "" },
            { "data": "id","defaultContent": "" },
        ],
});

$(".actualizar").click(function(){
	$(".Postulantes").DataTable().ajax.reload();
});
});

$('#verfoto').on('show.bs.modal', function (e) {
        var foto = $(e.relatedTarget).data('foto');
        $(e.currentTarget).find('#fotito').attr("src",foto);
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
Postulantes
@stop
@section('page-title')

@stop

@section('page-subtitle')
@stop



