@extends('layouts.base')

@section('content')
{!! Alert::render() !!}
@include('alerts.errors')
<div class="row widget-row">
    <div class="col-md-12">
        <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white margin-bottom-20 ">
            <h4 class="widget-thumb-heading">Contactanos</h4>
            <div class="widget-thumb-wrap">
                <div class="widget-thumb-body">
                    Oficina Central de Admisión
                    </br>Túpac Amaru 210 Rímac
                    </br><strong>Telefonos:</strong> 481-10-70 anexo 253 | 482-3804
                    </br><strong>Email:</strong> informes@admisionuni.edu.pe
                </div>
            </div>
        </div>
        <!-- END WIDGET THUMB -->
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="portlet-body overflow-h">
            <div class="fb-page " data-href="https://www.facebook.com/admision.uni/" data-tabs="messages" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false"><blockquote cite="https://www.facebook.com/admision.uni/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/admision.uni/">Admisión UNI</a></blockquote>
            </div>
        </div>
    </div><!--span-->
</div><!--row-->
@stop
@section('js-scripts')
    <div id="fb-root"></div>
<script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.9";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

@stop