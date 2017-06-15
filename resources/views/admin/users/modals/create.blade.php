{!!Form::open(['route'=> 'admin.users.store','method'=> 'POST','files'=>true,'class'=>''])!!}
<div class="modal fade" id="myModalNewUser" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Nuevo Usuario</h4>
            </div>
            <div class="modal-body">
              <div class="form-horizontal">
                <div class="form-group">
                    {!!Form::label('lblNombres','Username',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-10 ">
                      {!!Form::text('dni',null,['class'=>'form-control','placeholder'=>'Username','maxlength'=>8])!!}
                    </div>
                </div>
                <div class="form-group">
                    {!!Form::label('lblEmail','Email',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-10 ">
                      {!!Form::text('email',null,['class'=>'form-control','placeholder'=>'Email'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!!Form::label('lblPassword','Password',['class'=>'col-sm-2 control-label'])!!}
                  <div class="col-sm-10 ">
                    {!!Form::password('password',['class'=>'form-control'])!!}
                  </div>
                </div>
                <div class="form-group">
                  {!!Form::label('lblRol','Rol',['class'=>'col-sm-2 control-label'])!!}
                  <div class="col-sm-10 ">
                    {!!Form::select('idrole', $roles,null,['class'=>'form-control','id'=>'idrole']);!!}
                  </div>
                </div>
                <div class="form-group">
                    {!!Form::label('lblFoto','Foto',['class'=>'col-sm-2 control-label'])!!}
                  <div class="col-sm-10">
                  {!!Form::file('file',['class'=>'form-control'])!!}
                  </div>
                </div>
              </div>
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