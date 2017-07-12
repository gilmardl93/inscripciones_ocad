@extends('layouts.admin')

@section('content')
{!! Alert::render() !!}
@include('alerts.errors')

<div class="row">
	<div class="col-md-12">
		<!-- BEGIN Portlet PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-file-image-o"></i>Editor de Fotos </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a class="reload actualizar"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
        {!! Form::open(['route'=>'admin.fotos.buscar','method'=>'POST']) !!}
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::label('lblDatos', 'Foto que desea visualizar', ['class'=>'form-group']) !!}
                    </div>
                    <div class="col-md-2">
                         {!!Form::text('dni', null , ['class'=>'form-control','placeholder'=>'DNI del Alumno']);!!}
                    </div>
                    <div class="col-md-4 text-left">
                        {!!Form::enviar('Buscar')!!}
                    </div>
                </div>{{-- row --}}
            </div>
            <p></p>
        {!! Form::close() !!}
            <div class="row">
                <div class="col-md-12">
                {!!Form::boton('Cargar',route('admin.fotos.index'),'green-meadow','fa fa-cloud-download')!!}
            @if (isset($postulante))
                {!!Form::boton('Aceptar',route('admin.fotos.update',[$postulante->id,1]),'blue','fa fa-check')!!}
                {!!Form::boton('Rechazar',route('admin.fotos.update',[$postulante->id,0]),'red','fa fa-times')!!}
                {!!Form::boton('Editar','#','dark','fa fa-edit','',['onclick'=>"return launchEditor('editableimage1','$postulante->mostrar_foto_cargada')"])!!}
                {!!Form::boton('Fotos Rechazadas',route('admin.fotos.rechazadas'),'purple','fa fa-pdf-o','')!!}
            @endif
                </div>
            </div><!--row-->
            <p></p>
            @if (isset($postulante))
            <div class="row">
                <div class="col-md-3">
                    <a href="javascript:;" class="thumbnail">
                        <img id="editableimage1" src="{{ $postulante->mostrar_foto_cargada }}" style="height: 400px; width: 300px; display: block;">
                    </a>
                </div><!--span-->
                <div class="col-md-9">
                    <table class="table table-bordered table-hover" data-toggle="table" data-pagination="true">
                        <thead>
                            <tr>
                                <th> Estado </th>
                                <th> Cantidad </th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th> Total </th>
                                <th> {{ $resumen->sum('cantidad') }} </th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($resumen as $item)
                            <tr >
                                <td> {{ $item->foto_estado }} </td>
                                <td> {{ $item->cantidad }} </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!--span-->

            </div><!--row-->
            @endif

        </div>
    </div>
    <!-- END Portlet PORTLET-->
	</div><!--span-->
</div><!--row-->

@stop

@section('js-scripts')
<script>

var featherEditor = new Aviary.Feather({
        apiKey: '1234567',
        language : 'es',
        tools : ['orientation','crop','lighting','color','sharpness'],
        onSave: function(imageID, newURL) {
            var img = document.getElementById(imageID);
            img.src = newURL;
            var nueva_imagen = newURL;
            $.ajax({
                type : "GET",
                url : "cargar-editado",
                data : { nueva_imagen : nueva_imagen,idpostulante: {{ $postulante->id }} },
                cache : false,
                success : function()
                {
                    location.reload();
                    console.log("imagen cargada");
                }
            });
        }
    });

    function launchEditor(id, src) {
        featherEditor.launch({
            image: id,
            url: src
        });
        return false;
    }

</script>
@stop

@section('plugins-js')
{!! Html::script('http://feather.aviary.com/imaging/v3/editor.js') !!}
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



