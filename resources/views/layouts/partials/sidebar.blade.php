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

                    <p><i class="fa fa-caret-right text-yellow"></i> </p>
                </div>
            </div>
        @endif

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <!-- Optionally, you can add icons to the links -->


            <li class="treeview">
                <a href="#"><i class='fa fa-user-plus'></i> <span>Registro</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('form_nuevo_contacto') }}">Personas</a></li>
                    <li><a href="{{ url('listado_empresas') }}">Usuarios</a></li>
                    <li><a href="{{ url('listado_personas') }}">Transporte</a></li>
                    <li><a href="{{ url('listado_personas') }}">Casas de Campaña</a></li>
                    <li><a href="{{ url('listado_personas') }}">Candidatos</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class='fa fa-legal'></i> <span>Asignación</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('form_nuevo_contacto') }}">Persona - Mesa</a></li>
                    <li><a href="{{ url('listado_empresas') }}">Usuario - Mesa</a></li>
                    <li><a href="{{ url('listado_personas') }}">Usuario - Recinto</a></li>
                    <li><a href="{{ url('listado_personas') }}">Usuario - Distrito</a></li>
                    <li><a href="{{ url('listado_personas') }}">Usuario - Circunscripción</a></li>
                    <li><a href="{{ url('listado_personas') }}">Usuario - Casa</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="{{ url('form_nuevo_contacto') }}"><i class='fa fa-edit'></i> <span>Crear lista de asistencia</span> </a>
            </li>

            <li class="treeview">
                <a href="{{ url('form_nuevo_contacto') }}"><i class='fa fa-calendar-check-o'></i> <span>Registrar asistencia</span> </a>
            </li>

            <li class="treeview">
                <a href="{{ url('form_nuevo_contacto') }}"><i class='fa fa-list-ol'></i> <span>Registrar votos</span> </a>
            </li>

            <li class="treeview">
                <a href="#"><i class='fa fa-file-pdf-o'></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('form_nuevo_contacto') }}">Persona - Mesa</a></li>
                    <li><a href="{{ url('listado_empresas') }}">Usuario - Mesa</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="{{ url('form_nuevo_contacto') }}"><i class='fa fa-file-video-o'></i> <span>Tutorial</span> </a>
            </li>
























@role('admin')
<li class="treeview">
    <a href="#"><i class='fa fa-user'></i> <span>GESTION DE USUARIOS</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        @can('agregar_usuario')
        <li><a href="{{ url('listado_usuarios') }}">Listado Usuarios</a></li>
        <li><a href="{{ url('reporte_usuarios') }}">Reporte Usuarios</a></li>
        <li><a href="javascript:void(0);"  onclick="cargar_formulario(1);">Agregar Usuario</a></li>
        @endcan
        {{-- @can('crear_solicitud')
        <li><a href="{{url('form_sol_vacacion_usuario', ['id' => Auth::user()->id])}}">Dar de Baja</a></li>
        @endcan --}}

    </ul>
</li>
@endrole

@role('super_admin')
            <li class="treeview">
                <a href="#"><i class='fa fa-users'></i> <span>USUARIOS</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('listado_usuarios') }}">Listado Usuarios</a></li>
                    <li><a href="#"></a></li>
                </ul>
            </li>
@endrole
@role('encuestador')
            <li class="treeview">
                <a href="#"><i class='fa fa-users'></i> <span>VISITANTE</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">


                    <li><a href="{{url('/form_encuesta_visitante')}}">Encuesta</a></li>
                    <li><a href="{{url('/form_conteo')}}">Conteo Varones</a></li>
                    <li><a href="{{url('/form_conteo_mujeres')}}">Conteo Mujeres</a></li>

                    @can('aprobar_solicitud')
                    <li><a href="{{url('/listado_solicitudes_unidad')}}">Solicitudes por Aprobar</a></li>
                    @endcan
                    @can('autorizar_solicitud')
                    <li><a href="{{url('listado_solicitudes_rr_hh')}}">Solicitudes por Autorizar</a></li>
                    @endcan
                    <li><a href="#"></a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-tags'></i> <span>EXPOSITORES</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">

                    <li><a href="{{url('/form_encuesta_gastronomia')}}">Gastronomía</a></li>
                    <li><a href="{{url('/form_encuesta_literatura')}}">Literatura</a></li>
                    <li><a href="{{url('/form_encuesta_turismo')}}">ServicioS Turístico</a></li>
                    <li><a href="{{url('/form_encuesta_productores')}}">Productores</a></li>
                    <li><a href="{{url('/form_encuesta_artesania')}}">Artesanía</a></li>

                    @can('aprobar_solicitud')
                    <li><a href="{{url('/listado_suspension_unidad')}}">Suspension por Aprobar</a></li>
                    @endcan
                    @can('autorizar_solicitud')
                    <li><a href="{{url('listado_suspension_rr_hh')}}">Suspension por Autorizar</a></li>
                    @endcan
                    <li><a href="#"></a></li>
                </ul>
            </li>
            @endrole
            @role('revisors')
            <li class="treeview">
                <a href="#"><i class='fa fa-power-off'></i> <span>On / Off</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('/listado_personas')}}">Elecciones</a></li>
                    <li><a href="#"></a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-database'></i> <span>BASE</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">

                    <li><a href="{{url('/reporte_encuesta')}}">Visitantes</a></li>
                    <li><a href="{{url('/reporte_encuesta_gastronomia')}}">Gastronomía</a></li>
                    <li><a href="{{url('/reporte_encuesta_literatura')}}">Literatura</a></li>
                    <li><a href="{{url('/reporte_encuesta_turismo')}}">Servicios Turísticos</a></li>
                    <li><a href="{{url('/reporte_encuesta_productores')}}">Productores</a></li>
                    <li><a href="{{url('/reporte_encuesta_artesania')}}">Artesania</a></li>
                    <li><a href="{{url('/reporte_gastronomia')}}">Conteo F - M</a></li>
                    {{-- <li><a href="{{url('/reporte_final')}}">Reporte final</a></li> --}}
                    {{-- <li><a href="{{url('/reporte_plato_genero')}}">Plato preferido por sexo</a></li> --}}
                    {{-- <li><a href="{{url('/reporte_plato_genero')}}">Plato preferido por sexo</a></li> --}}

                    @can('aprobar_solicitud')
                    {{-- <li><a href="{{url('/listado_suspension_unidad')}}">Suspension por Aprobar</a></li> --}}
                    <li><a href="{{url('/reporte_encuesta')}}">Visitantes</a></li>
                    <li><a href="{{url('/reporte_encuesta_gastronomia')}}">Gastronomía</a></li>
                    <li><a href="{{url('/reporte_encuesta_literatura')}}">Literatura</a></li>
                    <li><a href="{{url('/reporte_encuesta_turismo')}}">Servicios Turísticos</a></li>
                    <li><a href="{{url('/reporte_encuesta_productores')}}">Productores</a></li>
                    <li><a href="{{url('/reporte_encuesta_artesania')}}">Artesania</a></li>
                    @endcan
                    @can('autorizar_solicitud')
                    {{-- <li><a href="{{url('listado_suspension_rr_hh')}}">Suspension por Autorizar</a></li> --}}
                    <li><a href="{{url('/reporte_encuesta')}}">Visitantes</a></li>
                    <li><a href="{{url('/reporte_encuesta_gastronomia')}}">Gastronomía</a></li>
                    <li><a href="{{url('/reporte_encuesta_literatura')}}">Literatura</a></li>
                    <li><a href="{{url('/reporte_encuesta_turismo')}}">Servicios Turísticos</a></li>
                    <li><a href="{{url('/reporte_encuesta_productores')}}">Productores</a></li>
                    <li><a href="{{url('/reporte_encuesta_artesania')}}">Artesania</a></li>
                    @endcan
                    <li><a href="#"></a></li>
                </ul>
            </li>
            @endrole
@role('reporte')
<li class="treeview">
    <a href="#"><i class='fa fa-pie-chart'></i> <span>REPORTES</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        @can('crear_solicitud')
        <li><a href="{{url('/reporte_gastronomia')}}">Visitantes</a></li>
        {{-- <li><a href="{{url('/reporte_final')}}">Reporte final</a></li> --}}
        {{-- <li><a href="{{url('/reporte_plato_genero')}}">Plato preferido por sexo</a></li> --}}
        @endcan
        @can('aprobar_solicitud')
        {{-- <li><a href="{{url('/listado_suspension_unidad')}}">Suspension por Aprobar</a></li> --}}
        <li><a href="{{url('/reporte_gastronomia')}}">Visitantes</a></li>
        {{-- <li><a href="{{url('/reporte_final')}}">Reporte final</a></li> --}}
        @endcan
        @can('autorizar_solicitud')
        {{-- <li><a href="{{url('listado_suspension_rr_hh')}}">Suspension por Autorizar</a></li> --}}
        <li><a href="{{url('/reporte_gastronomia')}}">Visitantes</a></li>
        {{-- <li><a href="{{url('/reporte_final')}}">Reporte final</a></li> --}}
        @endcan
        <li><a href="#"></a></li>
    </ul>
</li>
@endrole
@role('admin')
            <li class="treeview">
                <a href="#"><i class='fa fa-calculator'></i> <span>PAGO DE VACACIONES</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @can('crear_solicitud')
                    <li><a href="{{ url('listado_usuarios_duo') }}">Ver Usuarios</a></li>
                    @endcan
                </ul>
            </li>
@endrole
@can('autorizar_solicitud')
<li class="treeview">
    <a href="#"><i class='fa fa-bar-chart'></i> <span>REPORTES</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        @can('autorizar_solicitud')
        <li><a href="{{url('/reporte_ranking_vacaciones')}}">Ranking con mayor Vacación</a></li>
        <li><a href="{{url('/reporte_rechazados')}}">Reporte de Rechazados</a></li>
        @endcan
        <li><a href="#"></a></li>
    </ul>
</li>
@endcan
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
