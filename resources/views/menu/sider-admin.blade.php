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
            {!!Form::menu('Usuarios',route('admin.users.index'),'icon-users')!!}
            {!!Form::menu('Aulas',route('admin.aulas.index'),'fa fa-cubes')!!}
            {!!Form::menu('Servicios',route('admin.servicios.index'),'fa fa-dollar')!!}
            <li class="heading">
                <h3 class="uppercase">Modulos</h3>
            </li>


            {!!Form::menu('Editar Fotos',route('admin.fotos.index'),'fa fa-file-image-o')!!}
            {!!Form::menu('Pagos',route('admin.pagos.index'),'fa fa-money')!!}
            {!!Form::menu('Descuento',route('admin.descuentos.index'),'fa fa-cut')!!}
@endif
@if (str_contains(Auth::user()->codigo_rol,['admin']))
{!!Form::menu('Padron',route('admin.padron.index'),'fa fa-database')!!}
@endif
@if (str_contains(Auth::user()->codigo_rol,['foto','admin']))
{!!Form::menu('Editar Fotos',route('admin.fotos.index'),'fa fa-file-image-o')!!}
@endif
@if (str_contains(Auth::user()->codigo_rol,['pago','admin']))
{!!Form::menu('Pagos',route('admin.pagos.index'),'fa fa-money')!!}
@endif
@if (str_contains(Auth::user()->codigo_rol,['informes','admin']))
{!!Form::menu('Usuarios',route('admin.usuarios.index'),'icon-users')!!}
{!!Form::menu('Estadistica',route('admin.estadisticas.index'),'fa fa-bar-chart')!!}
{!!Form::menu('Colegio',route('admin.colegios.index'),'fa fa-bank')!!}
{!!Form::menu('Universidad',route('admin.universidades.index'),'fa fa-bank')!!}
@endif
    </ul>
    <!-- END SIDEBAR MENU -->
    <!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->
</div>
