@extends('layouts.base')

@section('content')
{!! Alert::render() !!}
<div class="col-md-12">
    <!-- BEGIN PORTLET-->
    <div class="portlet light tasks-widget widget-comments">
        <div class="portlet-title margin-bottom-20">
            <div class="caption caption-md font-red-sunglo">
                <span class="caption-subject theme-font bold uppercase">Documentos para la Inscripción</span>

            </div>
            <div class="actions">
                {!!Form::back(route('home.index'))!!}
            </div>
        </div>
        <div class="form-body ">
            <div class="row">
                <div class="col-md-4">
                    @if (PagoProspecto())
                    <div class="list-group">
                        <a href="{{ route('document.download','reglamento') }}" class="list-group-item"> Reglamento de Admisión </a>
                        <a href="{{ route('document.download','solucionario') }}" class="list-group-item"> Solucionario </a>
                        <a href="{{ route('document.download','guia') }}" class="list-group-item"> Guía de Inscripción </a>
                        <a href="{{ route('document.download','catalogo') }}" class="list-group-item"> Catalogo de Carreras </a>
                    </div>
                    @else
                        <div class="note note-danger">
                            <h4 class="block">No Pago el Prospecto</h4>
                            <p> Para poder descargar los documentos deberá cancelar el Prospecto de admisión en el banco scotiabank puedes imprimir tu formato haciendo click <a href="{{route('pagos.pdf',475)}}" target="blank">Aqui</a>  </p>
                        </div>
                    @endif
                </div><!--span-->
            </div><!--row-->
            {!!Form::back(route('home.index'))!!}
        </div>
    </div>
    <!-- END PORTLET-->
</div>

@stop

