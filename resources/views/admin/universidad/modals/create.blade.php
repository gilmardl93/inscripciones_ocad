{!!Form::open(['route'=> 'admin.colegios.store','method'=> 'POST','files'=>true,'class'=>''])!!}
<div class="modal fade" id="CreateColegio" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Nuevo Usuario</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!Form::label('lblCodigo', 'Codigo Modular');!!}
                            {!!Form::text('codigo_modular', null , ['class'=>'form-control','placeholder'=>'Codigo','maxlength'=>'7']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-group">
                                {!!Form::label('lblAnexo', 'Anexo');!!}
                                {!!Form::text('anexo', null , ['class'=>'form-control','placeholder'=>'Anexo','maxlength'=>'2']);!!}
                            </div>
                        </div>
                    </div><!--span-->
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-group">
                                {!!Form::label('lblNombre', 'Nombre');!!}
                                {!!Form::text('nombre', null , ['class'=>'form-control','placeholder'=>'Nombre']);!!}
                            </div>
                        </div>
                    </div><!--span-->
                </div><!--row-->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!Form::label('lblNivel', 'Nivel');!!}
                            {!!Form::text('nivel', null , ['class'=>'form-control','placeholder'=>'Nivel']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-group">
                                {!!Form::label('lblForma', 'Forma');!!}
                                {!!Form::text('forma', null , ['class'=>'form-control','placeholder'=>'Forma']);!!}
                            </div>
                        </div>
                    </div><!--span-->
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-group">
                                {!!Form::label('lblArea', 'Area');!!}
                                {!!Form::text('area', null , ['class'=>'form-control','placeholder'=>'Area']);!!}
                            </div>
                        </div>
                    </div><!--span-->
                </div><!--row-->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!Form::label('lblGestion', 'Gestion');!!}
                            {!!Form::select('gestion',['Privada'=>'Privada','Pública'=>'Pública'], null , ['class'=>'form-control','placeholder'=>'Gestion']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-group">
                                {!!Form::label('lblDireccion', 'Direccion');!!}
                                {!!Form::text('direccion', null , ['class'=>'form-control','placeholder'=>'Direccion']);!!}
                            </div>
                        </div>
                    </div><!--span-->
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-group">
                                {!!Form::label('lblDirector', 'Director');!!}
                                {!!Form::text('director', null , ['class'=>'form-control','placeholder'=>'Director']);!!}
                            </div>
                        </div>
                    </div><!--span-->
                </div><!--row-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!!Form::label('lblEmail', 'Email');!!}
                            {!!Form::text('email', null , ['class'=>'form-control','placeholder'=>'Email']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-group">
                                {!!Form::label('lblTelefonos', 'Telefonos');!!}
                                {!!Form::text('telefonos', null , ['class'=>'form-control','placeholder'=>'Telefonos']);!!}
                            </div>
                        </div>
                    </div><!--span-->
                </div><!--row-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!!Form::label('lblPais', 'Pais');!!}
                            {!!Form::select('idpais', $pais, null , ['class'=>'form-control','placeholder'=>'Pais']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-6">
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
