{!!Form::open(['route'=> 'admin.universidades.store','method'=> 'POST','files'=>true,'class'=>''])!!}
<div class="modal fade" id="CreateUniversidad" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Nuevo Usuario</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        {!! Field::text('codigo',['label'=>'Ingresar Codigo de la Universidad','placeholder'=>'Código de la universidad','maxlength'=>'7']) !!}
                    </div><!--span-->
                    <div class="col-md-12">
                        <div class="form-group">
                        {!!Field::text('nombre', null , ['label'=>'Nombre de la Universidad','placeholder'=>'Nombre de la Universidad']);!!}
                        </div>
                    </div><!--span-->
                </div><!--row-->
                <div class="row">
                    <div class="col-md-6">
                        {!! Field::select('gestion',['Privada'=>'Privada','Pública'=>'Pública'],['label'=>'Gestion','empty'=>'Seleccionar Gestion']) !!}
                    </div><!--span-->
                    <div class="col-md-6">
                        {!! Field::select('idpais',$pais,['label'=>'Pais','empty'=>'Seleccionar Pais']) !!}
                    </div><!--span-->
                </div><!--row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-group">
                                {!!Form::label('lblUbigeo', 'Ubigeo');!!}
                                {!!Form::select('idubigeo',[], null , ['id'=>'Ubigeo','class'=>'form-control']);!!}
                            </div>
                            <div class="form-group">
                                {!!Form::hidden('activo', true );!!}
                            </div>

                        </div>
                    </div><!--span-->
                </div><!--row-->


            </div>
            <div class="modal-footer">

                {!!Form::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>'modal'])!!}
                {!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{!!Form::close()!!}
