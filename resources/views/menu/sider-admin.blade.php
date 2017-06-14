<div class="page-sidebar-wrapper">
<div class="page-sidebar navbar-collapse collapse">
    <ul class="page-sidebar-menu page-sidebar-menu-hover-submenu page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <li class="sidebar-toggler-wrapper hide">
            <div class="sidebar-toggler">
                <span></span>
            </div>
        </li>
        <!-- END SIDEBAR TOGGLER BUTTON -->
        {!!Form::menu('Escritorio',route('home.index'),'icon-home','start')!!}
@if (str_contains(Auth::user()->codigo_rol,['root']))
            <li class="heading">
                <h3 class="uppercase">Sistema</h3>
            </li>
            <li class="nav-item  ">
                {!!Form::menulink('Configuracion','#','fa fa-cogs')!!}
                <ul class="sub-menu">
                    {!!Form::menu('Maestro',route('catalogo.gestion','maestro'))!!}
                    {!!Form::menu('Secuencia',route('admin.secuencia.index'))!!}
                    {!!Form::menu('Evaluacion',route('admin.evaluacion.index'))!!}
                </ul>
            </li>
            {!!Form::menu('Aulas',route('admin.aulas.index'),'fa fa-cubes')!!}
            <li class="heading">
                <h3 class="uppercase">Modulos</h3>
            </li>
            {!!Form::menu('Usuarios',route('admin.users.index'),'icon-users')!!}
            {!!Form::menu('Colegio',route('admin.colegios.index'),'fa fa-bank')!!}
            {!!Form::menu('Editar Fotos',route('admin.fotos.index'),'fa fa-file-image-o')!!}
            {!!Form::menu('Padron',route('admin.padron.index'),'fa fa-database')!!}
            {!!Form::menu('Pagos',route('admin.pagos.index'),'fa fa-money')!!}
            {!!Form::menu('Estadistica',route('admin.users.index'),'icon-users')!!}
@endif
@if (str_contains(Auth::user()->codigo_rol,['foto','admin']))
{!!Form::menu('Editar Fotos',route('admin.fotos.index'),'fa fa-file-image-o')!!}
@endif
@if (str_contains(Auth::user()->codigo_rol,['pago','admin']))
{!!Form::menu('Editar Fotos',route('admin.fotos.index'),'fa fa-file-image-o')!!}
{!!Form::menu('Pagos',route('admin.pagos.index'),'fa fa-money')!!}
@endif
    </ul>
    <!-- END SIDEBAR MENU -->
    <!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->
</div>
