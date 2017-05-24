@extends('layouts.base')

@section('content')
@include('alerts.errors')
{!! Form::model($postulante,['route'=>['datos.secundarios.update',$postulante],'method'=>'PUT','files'=>true]) !!}
<div class="col-md-4">
    <!-- BEGIN PORTLET-->
    <div class="portlet light tasks-widget widget-comments">
        <div class="portlet-title margin-bottom-20">
            <div class="caption caption-md font-red-sunglo">
                <span class="caption-subject theme-font bold uppercase">foto del postulante tamaño carné</span>
            </div>
        </div>
        <div class="portlet-body overflow-h">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 300px; height: 400px;">
                    <img src="{{ asset('/storage/'.$postulante->foto) }}" alt="" />
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                <div>
                    <span class="btn green btn-file">
                        <span class="fileinput-new"> Seleccionar Imagen </span>
                        <span class="fileinput-exists"> Cambiar </span>
                        {{ Form::file('file', []) }}
                    </span>
                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Quitar </a>
                </div>
            </div>
        </div>
    </div>
    <!-- END PORTLET-->
</div>
<div class="col-md-8">
    <!-- BEGIN PORTLET-->
    <div class="portlet light tasks-widget widget-comments">
        <div class="portlet-title margin-bottom-20">
            <div class="caption caption-md font-red-sunglo">
                <span class="caption-subject theme-font bold uppercase">datos del postulante (no del apoderado)</span>
            </div>
            <div class="actions">
                {!!Form::back(route('datos.index'))!!}
            </div>
        </div>
        <div class="form-body ">
            <div class="row">
                <div class="col-md-6">
                    {!!Field::text('email', null, ['label'=>'Email del postulante *','placeholder'=>'Email del postulante']);!!}
                </div><!--span-->
                <div class="col-md-3">
                    {!!Field::text('talla', null, ['label'=>'Talla del postulante *','placeholder'=>'Talla del postulante']);!!}
                </div><!--span-->
                <div class="col-md-3">
                    {!!Field::text('peso', null, ['label'=>'Peso del postulante *','placeholder'=>'Peso del postulante']);!!}
                </div><!--span-->
            </div><!--row-->
            <div class="row">
                <div class="col-md-6">
                    {!!Field::select('idsexo', $sexo, ['label'=>'Sexo del postulante *','empty'=>'Sexo del postulante']);!!}
                </div><!--span-->
                <div class="col-md-3">
                    {!!Field::text('telefono_celular', null, ['label'=>'Celular del postulante *','placeholder'=>'Telefono celular del postulante']);!!}
                </div><!--span-->
                <div class="col-md-3">
                    {!!Field::text('telefono_fijo', null, ['label'=>'Telefono fijo del postulante *','placeholder'=>'Telefono fijo del postulante']);!!}
                </div><!--span-->
            </div><!--row-->
            <div class="row">
                <div class="col-md-6">
                    {!!Field::select('idpais', $pais, ['label'=>'Pais donde vive el postulante *','empty'=>'Pais donde vive el postulante']);!!}
                </div><!--span-->
                <div class="col-md-6 Distrito">
                    <div class="form-group">
                        {!!Form::label('lblDistrito', 'Distrito donde vive el postulante');!!}
                        {!!Form::select('idubigeo',UbigeoPersonal($postulante->idubigeo) ,null , ['class'=>'form-control Ubigeo']);!!}
                    </div>
                </div><!--span-->

            </div><!--row-->
            <div class="row Distrito">
                <div class="col-md-12">
                    {!!Field::text('direccion', null, ['label'=>'Direccion donde vive el postulante','placeholder'=>'Direccion donde vive el postulante']);!!}
                </div><!--span-->
            </div><!--row-->
            <div class="row Distrito">
                <div class="col-md-6">
                    {!!Field::text('fecha_nacimiento', null, ['label'=>'Fecha de nacimiento de postulante (año-mes-día)','placeholder'=>'fecha de nacimiento del postulante']);!!}
                </div><!--span-->
                <div class="col-md-6">
                    {!!Field::text('telefono_varios', null, ['label'=>'Otros telefonos de contacto','placeholder'=>'Otros telefonos de contacto']);!!}
                </div><!--span-->
            </div><!--row-->
            <div class="row">
                <div class="col-md-6">
                    {!!Field::select('idpaisnacimiento', $pais, ['label'=>'Pais donde nacio el postulante *','empty'=>'Pais donde nacio el postulante']);!!}
                </div><!--span-->
                <div class="col-md-6 DistritoNacimiento">
                    <div class="form-group">
                        {!!Form::label('lblDistrito', 'Distrito donde nacio el postulante');!!}
                        {!!Form::select('idubigeonacimiento',UbigeoPersonal($postulante->idubigeonacimiento) ,null , ['class'=>'form-control Ubigeo']);!!}
                    </div>
                </div><!--span-->
            </div><!--row-->
            <h4>Completar solo si el postulante es de provincia</h4>
            <div class="row">
                <div class="col-md-6 DistritoProvincia">
                    <div class="form-group">
                        {!!Form::label('lblDistrito', 'Distrito de provincia del postulante');!!}
                        {!!Form::select('idubigeoprovincia',UbigeoPersonal($postulante->idubigeoprovincia) ,null , ['class'=>'form-control Ubigeo']);!!}
                    </div>
                </div><!--span-->
                <div class="col-md-6">
                    {!!Field::text('direccion_provincia', ['label'=>'Direccion de provincia del postulante ','placeholder'=>'Direccion de provincia del postulante']);!!}
                </div><!--span-->
                <div class="col-md-6">
                    {!!Field::text('telefono_provincia', ['label'=>'Telefono de provincia del postulante ','placeholder'=>'Telefono de provincia del postulante']);!!}
                </div><!--span-->
            </div><!--row-->


        {!!Form::enviar('Guardar')!!}
        </div>
    </div>
    <!-- END PORTLET-->
</div>
{!! Form::close() !!}
@stop

@section('js-scripts')
<script>
$(document).ready(function() {
    idpais = $("#idpais").val();
    idpaisNacimiento = $("#idpaisnacimiento").val();
    OcultaDistrito(idpais);
    OcultaDistritoNacimiento(idpaisNacimiento);

    $("#idpais").click(function() {
        var idpais = $(this).val();

        OcultaDistrito(idpais);

    });
    $("#idpaisnacimiento").click(function() {
        var idpais = $(this).val();

        OcultaDistritoNacimiento(idpais);

    });
    function OcultaDistrito(idpais) {
        $.ajax({
            url: '{{ url("pais") }}',
            dataType: 'json',
            data: {varsearch: idpais}
        })
        .done(function(pais) {
            if (pais.codigo == 'PE') {
                $('.Distrito').show();
            }else{
                $('.Distrito').hide();
            }
        })
        .fail(function() {
            console.log("error");
        });
    }
    function OcultaDistritoNacimiento(idpais) {
        $.ajax({
            url: '{{ url("pais") }}',
            dataType: 'json',
            data: {varsearch: idpais}
        })
        .done(function(pais) {
            if (pais.codigo == 'PE') {
                $('.DistritoNacimiento').show();
            }else{
                $('.DistritoNacimiento').hide();
            }
        })
        .fail(function() {
            console.log("error");
        });
    }
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


$("#fecha_nacimiento").inputmask("y-m-d", {
    "placeholder": "yyyy-mm-dd"
});
</script>
@stop


@section('plugins-js')
{!! Html::script(asset('assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')) !!}
@stop
