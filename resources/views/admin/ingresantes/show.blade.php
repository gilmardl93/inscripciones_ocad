@extends('layouts.admin')


@section('content')
{!! Alert::render() !!}
@include('alerts.errors')
@include('alerts.errors')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8 profile-info">
                <h1 class="font-green sbold uppercase">{{ $postulante->nombre_completo }}</h1>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="thumbnail">
                            <a href="#verimagen" data-toggle="modal" data-imagen="{{ $postulante->mostrar_foto_editada }}" >
                                <img src="{{ $postulante->mostrar_foto_editada }}" alt="" style="width: 100%; height: 300px;">
                            </a>
                            <div class="caption">
                                <h3>Foto Postulante</h3>
                            </div>
                        </div>
                    </div><!--span-->
                    <div class="col-sm-3">
                        <div class="thumbnail">
                            <a href="#verimagen" data-toggle="modal" data-imagen="{{ $postulante->ingresantes->foto }}" >
                                <img src="{{ $postulante->ingresantes->foto }}" alt="" style="width: 100%; height: 300px;">
                            </a>
                            <div class="caption">
                                <h3>Foto Ingresante</h3>
                            </div>
                        </div>
                    </div><!--span-->
                    <div class="col-sm-3">
                        <div class="thumbnail">
                            <a href="#verimagen" data-toggle="modal" data-imagen="{{ $postulante->ingresantes->huella }}" >
                                <img src="{{ $postulante->ingresantes->huella }}" alt="" style="width: 100%; height: 300px;">
                            </a>
                            <div class="caption">
                                <h3>Huella Ingresante</h3>
                            </div>
                        </div>
                    </div><!--span-->
                    <div class="col-sm-3">
                        <div class="thumbnail">
                            <a href="#verimagen" data-toggle="modal" data-imagen="{{ $postulante->ingresantes->firma }}" >
                                <img src="{{ $postulante->ingresantes->firma }}" alt="" style="width: 100%; height: 300px;">
                            </a>
                            <div class="caption">
                                <h3>Firma Ingresante</h3>
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
                    <a href="#tab_1" data-toggle="tab" aria-expanded="true"> Datos del Postulante </a>
                </li>
                <li>
                    <a href="#tab_5" data-toggle="tab" aria-expanded="true"> Editar Datos Postulante </a>
                </li>
                <li>
                    <a href="#tab_2" data-toggle="tab" aria-expanded="true"> Ficha </a>
                </li>
                <li>
                    <a href="#tab_3" data-toggle="tab" aria-expanded="true"> Constancia </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <iframe src="{{route('admin.ingresantes.pdfdatos',$postulante->id)}}" width="100%" height="900px" scrolling="auto"></iframe>
                </div>
                <!--tab-pane-->
                <div class="tab-pane" id="tab_2">
                    <iframe src="{{route('ficha.pdf',$postulante->id)}}" width="100%" height="900px" scrolling="auto"></iframe>
                </div>
                <!--tab-pane-->
                <div class="tab-pane" id="tab_3">
                    @if (str_contains($ingresante->codigo_modalidad,['E1TE','E1TG','E1TGU']))
                        {!! Form::model($ingresante,['route'=>['admin.ingresantes.update',$ingresante],'method'=>'PUT']) !!}
                            <div class="row">
                                <div class="col-md-3">
                                    {!! Field::text('facultad_procedencia',['label'=>'Facultad de Procedencia','placeholder'=>'Facultad de Procedencia']) !!}
                                </div><!--span-->
                                @if (str_contains($ingresante->codigo_modalidad,['E1TE']))
                                    <div class="col-md-3">
                                        {!! Field::text('numero_creditos',['label'=>'Numero de Creditos','placeholder'=>'Numero de creditos']) !!}
                                    </div><!--span-->
                                @else
                                    <div class="col-md-3">
                                        {!! Field::text('titulo',['label'=>'Titulo Obtenido','placeholder'=>'Titulo Obtenido']) !!}
                                    </div><!--span-->
                                    <div class="col-md-3">
                                        {!! Field::text('grado',['label'=>'Grado Obtenido','placeholder'=>'Grado Obtenido']) !!}
                                    </div><!--span-->
                                @endif
                            </div><!--row-->
                            {!!Form::enviar('Actualzar')!!}
                        {!! Form::close() !!}
                        <p></p>
                    @endif
                    <iframe src="{{route('admin.ingresantes.pdfconstancia',$postulante->id)}}" width="100%" height="900px" scrolling="auto"></iframe>
                </div>
                <!--tab-pane-->
                <div class="tab-pane" id="tab_4">
                    <div class="tab-pane active" id="tab_1_1_1">

                    </div>
                </div>
                <!--tab-pane-->
                <div class="tab-pane" id="tab_5">
                    {!! Form::model($postulante,['route'=>['admin.pos.update',$postulante],'method'=>'PUT']) !!}
                    <div class="row">
                        <div class="col-md-2">
                        {!! Field::text('fecha_nacimiento',['label'=>'Fecha de Nacimiento','placeholder'=>'Fecha de Nacimiento']) !!}
                        </div><!--span-->
                    </div><!--row-->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!!Form::label('lblDistrito', 'Distrito donde nacio el postulante');!!}
                                {!!Form::select('idubigeonacimiento',UbigeoPersonal($postulante->idubigeonacimiento) ,null , ['class'=>'form-control Ubigeo']);!!}
                            </div>
                        </div><!--span-->
                    </div><!--row-->
                    {!!Form::enviar('Actualizar')!!}
                    {!! Form::close() !!}
                </div>
                <!--tab-pane-->
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="verimagen" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">IMAGEN</h4>
            </div>
            <div class="modal-body">
                <img id="imagen" style="height: 400px" alt="" >
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
$(document).ready(function() {
    $('#verimagen').on('show.bs.modal', function (e) {
        var foto = $(e.relatedTarget).data('imagen');
        $(e.currentTarget).find('#imagen').attr("src",foto);
    });

    $(".Ubigeo").select2({
        width:'auto',
        allowClear: true,
        ajax: {
            url: '{{ url("ubigeo") }}',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    varsearch: params.term // search term
                };
            },
            processResults: function(data) {
                // parse the results into the format expected by Select2.
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data
                return {
                    results: data
                };
            },
            cache: true
        },
        placeholder : 'Seleccione el distrito del participante: ejemplo LIMA',
        minimumInputLength: 3,
        templateResult: format,
        templateSelection: format,
        escapeMarkup: function(markup) {
            return markup;
        } // let our custom formatter work
    });
    function format(res){
        var markup=res.text;
        return markup;

    }


});


$(".Fecha").inputmask("y-m-d", {
    "placeholder": "yyyy-mm-dd"
});
</script>
@stop

@section('plugins-styles')
{!! Html::style(asset('assets/pages/css/profile-2.min.css')) !!}
@stop
@section('plugins-js')
{!! Html::script(asset('assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')) !!}
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




