@extends('layouts.admin')


@section('content')
{!! Alert::render() !!}
<div class="alert alert-danger alert-dismissable hidden">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
    <strong>Error</strong> <span class="detalle"></span>
</div>
<div class="search-page search-content-4">
        <div class="search-bar bordered">
            <div class="row">
                <div class="col-lg-12">
                    {!!Form::token();!!}
                    <div class="row">
                        <div class="col-md-12">
                            {!! Field::text('dni',['label'=>'Ingresar el DNI del ingresante a registrar','placeholder'=>'Ingresar DNI']) !!}
                        </div><!--span-->
                    </div><!--row-->
                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::select('estado_constancia',['NO VINO'=>'NO VINO','ENTREGADO'=>'ENTREGADO','RETENIDO'=>'RETENIDO'],['label'=>'Escoger Estado','empty'=>'Escoger Estado','class'=>'input-lg']) !!}
                        </div><!--span-->
                        <div class="col-md-6">
                            {!! Field::text('dni',['label'=>'Ingresar el DNI del ingresante a registrar','placeholder'=>'Ingresar DNI','class'=>'']) !!}
                        </div><!--span-->
                    </div><!--row-->
                    <button class="btn green-soft uppercase bold" type="submit" id="Buscar">Buscar </button>
                </div>
            </div>
        </div>
        <div class="search-table table-responsive">
            <table class="table table-bordered table-striped table-condensed" id="Ingresante">
                <thead class="bg-blue">
                    <tr>
                        <th> <a href="javascript:;">Ingresantes</a> </th>
                        <th class="table-download"> <a href="javascript:;">Constancia</a> </th>
                        <th class="table-download"> <a href="javascript:;">Fecha</a> </th>
                        <th class="table-download"> <a href="javascript:;">Foto</a> </th>
                    </tr>
                </thead>
                <tbody class="Items">
                @foreach ($Lista as $item)
                    <tr>
                        <td class="table-title">
                            <h3>
                                <a href="{{ route('admin.ingresantes.show',$item->id) }}">{{ $item->numero_identificacion.'-'.$item->nombre_completo }}</a>
                            </h3>
                        </td>
                        <td class="table-download"> {{ $item->ingresantes->estado_constancia }} </td>
                        <td class="table-download"> {{ $item->ingresantes->fecha_constancia }} </td>
                        <td class="table-download"> <img src="{{ $item->ingresantes->foto }}" width='50px'> </td>
                    </tr>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js-scripts')
<script>
$(document).ready(function() {

    $("#dni").focus();
    $("#Buscar").click(function() {
        ListarConstancias();
    });
    $("#dni").change(function() {
        ListarConstancias();
    });
    function ListarConstancias() {
        $.ajax({
            url: '{{ url('admin/control/') }}',
            type: 'POST',
            data: {
                _token: $('input[name=_token]').val(),
                dni: $('input[name=dni]').val()
            },
        })
        .success(function(data) {
            if ((data.errors)) {
                    $('.alert').removeClass('hidden');
                    $('.detalle').text(data.errors.dni);
                } else {
                    $('.alert').remove();
                    $('.Items').empty();
                    data.forEach(function(item, index) {
                    $('#Ingresante').append('<tr> <td class="table-title"><h3>'+
                                    '<a href="{{ url("admin/ingresantes/") }}/'+item.id+'">'+
                                    item.numero_identificacion+' - '+
                                    item.paterno+' '+item.materno+' '+item.nombres+'</a></h3></td>'+
                                    '<td class="table-download">'+item.ingresantes.estado_constancia   +'</td>'+
                                    '<td class="table-download">'+item.ingresantes.fecha_constancia   +'</td>'+
                                    '<td class="table-download"><img src="{{ asset("storage/fotoIng/") }}/'+item.numero_identificacion+'.jpg" width="50px"></td>'+
                                    +'</tr>');
                    });
                }
                $("#dni").val ('');
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    }

});

</script>
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




