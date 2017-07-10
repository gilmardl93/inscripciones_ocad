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
                <h3 class="uppercase">System</h3>
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
            <li class="nav-item  ">
                {!!Form::menulink('Aulas',route('admin.aulas.index'),'fa fa-cubes')!!}
                <ul class="sub-menu">
                    {!!Form::menu('Activas',route('admin.activas.aulas'))!!}
                    {!!Form::menu('Habilitadas',route('admin.activas.habilitadas'))!!}
                </ul>
            </li>
            {!!Form::menu('Servicios',route('admin.servicios.index'),'fa fa-dollar')!!}
            <li class="heading">
                <h3 class="uppercase">IDENTIFICACION</h3>
            </li>
            {!!Form::menu('Constancias',route('admin.ingresantes.constancias'),'fa fa-file-pdf-o')!!}
            {!!Form::menu('Etiquetas','#','fa fa-sticky-note-o')!!}
            {!!Form::menu('Ingresante',route('admin.ingresantes.index'),'fa fa-graduation-cap')!!}
            {!!Form::menu('Control entrega',route('admin.ingresantes.control'),'fa fa-check-square-o')!!}
            <li class="heading">
                <h3 class="uppercase">Modulos</h3>
            </li>
            {!!Form::menu('Descuento',route('admin.descuentos.index'),'fa fa-cut')!!}
            {!!Form::menu('Comunicacion',route('admin.comunicacion.index'),'fa fa-share-alt')!!}
@endif
@if (str_contains(Auth::user()->codigo_rol,['admin','jefe','root']))
{!!Form::menu('Padron',route('admin.padron.index'),'fa fa-database')!!}
@endif
@if (str_contains(Auth::user()->codigo_rol,['foto','admin','jefe','root']))
{!!Form::menu('Editar Fotos',route('admin.fotos.index'),'fa fa-file-image-o')!!}
@endif
@if (str_contains(Auth::user()->codigo_rol,['pago','admin','jefe','root']))
{!!Form::menu('Pagos',route('admin.pagos.index'),'fa fa-money')!!}
@endif
@if (str_contains(Auth::user()->codigo_rol,['informes','admin','jefe','root']))
{!!Form::menu('Usuarios',route('admin.usuarios.index'),'icon-users')!!}
{!!Form::menu('Estadistica',route('admin.estadisticas.index'),'fa fa-bar-chart')!!}
{!!Form::menu('Colegio',route('admin.colegios.index'),'fa fa-bank')!!}
{!!Form::menu('Universidad',route('admin.universidades.index'),'fa fa-bank')!!}
{!!Form::menu('Importa Pago',route('admin.ventanilla.index'),'fa fa-dollar')!!}
{!!Form::menu('Listados',route('admin.listados.index'),'fa fa-users')!!}
@endif
    </ul>
    <!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->
</div>
