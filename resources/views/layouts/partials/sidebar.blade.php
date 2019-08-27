<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('/img/avatar.png')}}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    {{-- @foreach ($personas as $persona)
                        @if ( $persona->ci == Auth::user()->ci)
                            <!-- Status -->
                    <p><i class="fa fa-caret-right text-yellow"></i> {{ $persona->sigla }}</p>
                        @endif
                    @endforeach --}}
                    @role('super_admin')
                    <p><i class="fa fa-caret-right text-yellow"></i> Administrador</p>
                    @endrole
                    {{-- @role('admin')
                    <p><i class="fa fa-caret-right text-yellow"></i> Administrador</p>
                    @endrole --}}


                    @role('delegado_mas')
                    <p><i class="fa fa-caret-right text-yellow"></i> Delegado del MAS</p>
                    @endrole
                    @role('conductor')
                    <p><i class="fa fa-caret-right text-yellow"></i> Conductor</p>
                    @endrole
                    @role('registrador')
                    <p><i class="fa fa-caret-right text-yellow"></i> Registrador</p>
                    @endrole

                    @role('call_center')
                    <p><i class="fa fa-caret-right text-yellow"></i> Supervisor Call Center</p>
                    @endrole

                    @role('informatico')
                    <p><i class="fa fa-caret-right text-yellow"></i> Delegado Informático</p>
                    @endrole

                    @role('responsable_recinto')
                    <p><i class="fa fa-caret-right text-yellow"></i> Responsable de Recinto</p>
                    @endrole

                    @role('responsable_distrito')
                    <p><i class="fa fa-caret-right text-yellow"></i> Responsable de Distrito</p>
                    @endrole

                    @role('responsable_circunscripcion')
                    <p><i class="fa fa-caret-right text-yellow"></i> Responsable de Circunscripción</p>
                    @endrole

                    {{-- <p><i class="fa fa-caret-right text-yellow"></i> </p> --}}
                </div>
            </div>
        @endif

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <!-- Optionally, you can add icons to the links -->

            @role('super_admin')
            <li class="treeview">
                <a href="#"><i class='fa fa-gear'></i> <span>Configuración</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                        <li><a href="{{ url('listado_usuarios') }}">Roles</a></li>
                    {{-- <li><a href="{{ url('listado_empresas') }}">Usuarios</a></li> --}}
                </ul>
            </li>
            <li class="header"> #</li>
            @endrole

            @can('registrar')
            <li class="treeview">
                <a href="#"><i class='fa fa-user-plus'></i> <span>Registro</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @can('registrar_persona')
                    <li><a href="{{ url('form_agregar_persona') }}">Personas</a></li>
                    {{-- <li><a href="{{ url('listado_empresas') }}">Usuarios</a></li> --}}
                    @endcan

                    @can('registrar_transporte')
                    <li><a href="{{ url('form_agregar_transporte') }}">Transporte</a></li>
                    <!--li><a href="{{ url('listado_personas') }}">Casas de Campaña</a></li>
                    <li><a href="{{ url('listado_personas') }}">Candidatos</a></li-->
                    @endcan
                </ul>
            </li>
            @endcan

            @can('listar')
            <li class="treeview">
                <a href="#"><i class='fa fa-list'></i> <span>Listado</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @can('listar_personas')
                    <li><a href="{{ url('listado_personas') }}">Personas</a></li>
                    @endcan
                    @can('listar_transportes')
                    <li><a href="{{ url('listado_transportes') }}">Transporte</a></li>
                    @endcan
                    <!--<li><a href="{{ url('listado_personas') }}">Casas de Campaña</a></li>
                    <li><a href="{{ url('listado_personas') }}">Candidatos</a></li>-->
                </ul>
            </li>
            @endcan

            @role('admin')
            <li class="treeview">
                <a href="#"><i class='fa fa-legal'></i> <span>Asignación</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('listado_personas_asignacion') }}">Rol - Usuario</a></li>
                </ul>
            </li>
            @endrole

            @can('ver_lista_asistencia')
            <li class="treeview">
                <a href="#"><i class='fa fa-edit'></i> <span>Asistencia</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @can('crear_lista_asistencia')
                    <li><a href="{{ url('form_agregar_lista_de_asistencia') }}">Crear lista de asistencia</a></li>
                    @endcan
                    @can('ver_lista_asistencia')
                    <li><a href="{{ url('form_listas_de_asistencia') }}">Ver listas de asistencia</a></li>
                    @endcan
                    @can('crear_lista_asistencia')
                    <li><a href="{{ url('revisar_transportes_asistencia') }}">Asistencia Conductores (Hoy)</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('registrar_asistencia')
            <li class="treeview">
                <a href="{{ url('form_registrar_asistencia') }}"><i class='fa fa-calendar-check-o'></i> <span>Registrar asistencia</span> </a>
            </li>
            @endcan

            @can('registrar_votos')
            <li class="treeview">
                <a href="{{ url('form_votar_seleccionar_mesa') }}"><i class='fa fa-list-ol'></i> <span>Registrar votos</span> </a>
            </li>
            @endcan

            @can('como_llegar_a_mi_recinto')
            <li class="treeview">
                <a href="{{ url('form_ver_recinto') }}"><i class='fa fa-map-o'></i> <span>Como llegar a mi Recinto</span> </a>
            </li>
            @endcan

            @role('ejecutivo')
            <li class="treeview">
                <a href="#"><i class='fa fa-file-pdf-o'></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/home') }}">Persona - Mesa</a></li>
                    <li><a href="{{ url('home') }}">Usuario - Mesa</a></li>
                </ul>
            </li>
            @endrole

            <li class="treeview">
                <a href="{{ url('home') }}"><i class='fa fa-file-video-o'></i> <span>Tutorial</span> </a>
            </li>

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
