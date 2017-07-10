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
                    <div class="input-group">
                        {!!Form::token();!!}
                        <input type="text" class="form-control" placeholder="Buscar Ingresantes" name="dni">
                        <span class="input-group-btn">
                            <button class="btn green-soft uppercase bold" type="submit" id="Buscar">Buscar </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="search-table table-responsive">
            <table class="table table-bordered table-striped table-condensed" id="Ingresante">
                <thead class="bg-blue">
                    <tr>
                        <th> <a href="javascript:;">Ingresantes</a> </th>
                        <th class="table-download"> <a href="javascript:;">Foto</a> </th>
                    </tr>
                </thead>
                <tbody class="Items">
                @foreach ($Lista as $item)
                    <tr>
                        <td class="table-title">
                            <h3>
                                <a href="{{ route('admin.ingresantes.show',$item->id) }}">{{ $item->identificacion }}</a>
                            </h3>
                            - Nombres:
                                <a href="{{ route('admin.ingresantes.show',$item->id) }}">{{ $item->nombre_completo }}</a>
                        </td>
                        <td class="table-download"> <img src="{{ $item->mostrar_foto_editada }}" width='50px'> </td>
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
$("#Buscar").click(function(event) {
    $.ajax({
        url: '{{ url('admin/ingresantes-search/') }}',
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
                $('#Ingresante').append('<tr> <td class="table-descarga font-blue"><h3>'+
                                '<a href="{{ url("admin/ingresantes/") }}/'+item.id+'">'+
                                item.numero_identificacion+' - '+
                                item.paterno+' '+item.materno+' '+item.nombres+'</a></h3></td>'+
                                '<td class="table-download">'+
                                '<img src="{{ asset("storage/")}}/'+item.foto_editada+'" width="50px">'
                                +'</td>'
                                +'</tr>');
                });
            }
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });

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




