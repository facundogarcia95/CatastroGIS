<div class="sidebar bg-catastro accordion" id="accordion">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-title bg-catastro">
                        Menú 
                    </li>
                    <li class="nav-item bg-catastro"><a class="nav-link " href="{{route('home')}}" onclick="event.preventDefault(); document.getElementById('home-form').submit();"><i class="fa text-light fa-bell-o"></i> <span class="d-sm-none d-sm-inline">Requerimientos</span></a></li>
                    <li class="nav-item bg-catastro"><a class="nav-link " href="{{route('cartografia')}}" onclick="event.preventDefault(); document.getElementById('cartografia-form').submit();"><i class="fa text-light fa-map-o"></i> <span class="d-sm-none d-sm-inline">Cartografía</span></a></li>
                    <li class="nav-item bg-catastro">
                        <a class="nav-link collapsed"   href="#submenu1" data-toggle="collapse" data-target="#submenu1"><i class="fa text-light fa-id-card-o"></i> <span class="d-sm-none d-sm-inline" >Perfiles</span></a>
                        <div class="collapse nav-collapse"  navbar="true" id="submenu1" aria-expanded="false">
                            <ul class="inline-grid pl-4">
                                <li class="nav-item bg-catastro"><a class="nav-link" href="{{route('user')}}" onclick="event.preventDefault(); document.getElementById('user-form').submit();"><i class="fa text-light fa-users"></i><span>Usuarios</span></a></li>
                                <li class="nav-item bg-catastro"><a class="nav-link" href="{{route('seccion')}}" onclick="event.preventDefault(); document.getElementById('seccion-form').submit();"><i class="fa text-light fa-list-ul"></i><span>Secciones</span></a></li>
                                <li class="nav-item bg-catastro"><a class="nav-link" href="{{route('bloqueo')}}" onclick="event.preventDefault(); document.getElementById('bloqueo-form').submit();"><i class="fa text-light fa-lock"></i><span>Bloqueos</span></a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item bg-catastro">
                        <a class="nav-link collapsed" href="#submenu2" data-toggle="collapse" data-target="#submenu2"><i class="fa text-light fa-tasks"></i> <span class="d-sm-none d-sm-inline">Gestión</span></a>
                        <div class="collapse nav-collapse" navbar="true" id="submenu2" aria-expanded="false">
                            <ul class="inline-grid pl-4">
                                <li class="nav-item bg-catastro"><a class="nav-link" href="{{route('parcelas')}}" onclick="event.preventDefault(); document.getElementById('parcelas-form').submit();"><i class="fa text-light fa-table"></i><span>Padrones</span></a></li>
                                <li class="nav-item bg-catastro"><a class="nav-link" href="{{route('modulo_personas')}}" onclick="event.preventDefault(); document.getElementById('modulo_personas-form').submit();"><i class="fa text-light fa-male"></i><span>Personas</span></a></li>
                                <li class="nav-item bg-catastro"><a class="nav-link" href="{{url('gestion/union')}}" onclick="event.preventDefault(); document.getElementById('union-form').submit();"><i class="fa text-light fa-compress"></i><span>Uniones</span></a></li>
                                <li class="nav-item bg-catastro"><a class="nav-link" href="{{url('gestion/desglose')}}" onclick="event.preventDefault(); document.getElementById('desglose-form').submit();"><i class="fa text-light fa-expand"></i><span>Desgloses</span></a></li>
                             
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item bg-catastro">
                        <a class="nav-link collapsed"  href="#submenu3" data-toggle="collapse" data-target="#submenu3"><i class="fa text-light fa-gears"></i> <span class="d-sm-none d-sm-inline">Administración</span></a>
                        <div class="collapse nav-collapse"  navbar="true" id="submenu3" aria-expanded="false">
                            <ul class="inline-grid pl-4">
                                <li class="nav-item bg-catastro">
                                    <a class="nav-link collapsed" data-parent="submenu3" href="#submenu4" data-toggle="collapse" data-target="#submenu4"><i class="fa text-light fa-gear"></i> <span class="">Adm. de Parcela</span></a>
                                    <div class="collapse nav-collapse"  navbar="true" id="submenu4" aria-expanded="false">
                                        <ul class="inline-grid pl-4">
                                            <li class="nav-item bg-catastro"><a class="nav-link" href="{{route('tipo_de_condicion')}}" onclick="event.preventDefault(); document.getElementById('tipo_de_condicion-form').submit();"><i class="fa text-light fa-circle-o"></i><span>Tipo de Condición</span></a></li>
                                            <li class="nav-item bg-catastro"><a class="nav-link" href="{{route('tipo_de_instrumento')}}" onclick="event.preventDefault(); document.getElementById('tipo_de_instrumento-form').submit();"><i class="fa text-light fa-circle-o"></i><span>Tipo de Instrumento</span></a></li>
                                            <!--<li class="nav-item bg-catastro"><a class="nav-link" href="{{route('tipo_de_parcela')}}" onclick="event.preventDefault(); document.getElementById('tipo_de_parcela-form').submit();"><i class="fa text-light fa-circle-o"></i><span>Tipo de Parcela</span></a></li>-->
                                            <!--<li class="nav-item bg-catastro"><a class="nav-link" href="{{route('tipo_de_profesional')}}" onclick="event.preventDefault(); document.getElementById('tipo_de_profesional-form').submit();"><i class="fa text-light fa-circle-o"></i><span>Tipo de Profesional</span></a></li>-->
                                            <li class="nav-item bg-catastro"><a class="nav-link" href="{{route('tipo_de_servicio')}}" onclick="event.preventDefault(); document.getElementById('tipo_de_servicio-form').submit();"><i class="fa text-light fa-circle-o"></i><span>Tipo de Servicio</span></a></li>
                                            <li class="nav-item bg-catastro"><a class="nav-link" href="{{route('poligonos_sin_padrones')}}" onclick="event.preventDefault(); document.getElementById('poligonos_sin_padron-form').submit();"><i class="fa text-light fa-circle-o"></i><span>Polígonos sin padrón</span></a></li>

                                        </ul>
                                    </div>
                                </li>

                                <li class="nav-item bg-catastro">
                                    <a class="nav-link collapsed"  data-parent="submenu3" href="#submenu5" data-toggle="collapse" data-target="#submenu5"><i class="fa text-light fa-gear"></i> <span class="">Adm. de Personas</span></a>
                                    <div class="collapse nav-collapse"  navbar="true" id="submenu5" aria-expanded="false">
                                        <ul class="inline-grid pl-4">
                                            <li class="nav-item bg-catastro"><a class="nav-link" href="{{route('tipo_de_documento')}}" onclick="event.preventDefault(); document.getElementById('tipo_de_documento-form').submit();"><i class="fa text-light fa-circle-o"></i><span>Tipo de Documento</span></a></li>
                                            <li class="nav-item bg-catastro"><a class="nav-link" href="{{route('tipo_de_persona_parcela')}}" onclick="event.preventDefault(); document.getElementById('tipo_de_persona_parcela-form').submit();"><i class="fa text-light fa-circle-o"></i><span>Tipo de Persona/Parcela</span></a></li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="nav-item bg-catastro">
                                    <a class="nav-link collapsed" data-parent="submenu3" href="#submenu6" data-toggle="collapse" data-target="#submenu6"><i class="fa text-light fa-gear"></i> <span class="">Adm. de Mejoras</span></a>
                                    <div class="collapse nav-collapse"  navbar="true" id="submenu6" aria-expanded="false">
                                        <ul class="inline-grid pl-4">
                                            <li class="nav-item bg-catastro"><a class="nav-link" href="{{route('tipo_de_mejora')}}" onclick="event.preventDefault(); document.getElementById('tipo_de_mejora-form').submit();"><i class="fa text-light fa-circle-o"></i><span>Tipo de Mejora</span></a></li>
                                            <li class="nav-item bg-catastro"><a class="nav-link" href="{{route('tipo_de_mejora_destino')}}" onclick="event.preventDefault(); document.getElementById('tipo_de_mejora_destino-form').submit();"><i class="fa text-light fa-circle-o"></i><span>Tipo de Mejora Destino</span></a></li>
                                            <li class="nav-item bg-catastro"><a class="nav-link" href="{{route('tipo_de_tramite')}}" onclick="event.preventDefault(); document.getElementById('tipo_de_tramite-form').submit();"><i class="fa text-light fa-circle-o"></i><span>Tipo de Trámite</span></a></li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="nav-item bg-catastro">
                                    <a class="nav-link collapsed" data-parent="submenu3" href="#submenu7" data-toggle="collapse" data-target="#submenu7"><i class="fa text-light fa-gear"></i> <span class="">Adm. de Avaluo</span></a>
                                    <div class="collapse nav-collapse"  navbar="true" id="submenu7" aria-expanded="false">
                                        <ul class="inline-grid pl-4">
                                            <li class="nav-item bg-catastro"><a class="nav-link" href="{{route('config_calc_avaluo')}}" onclick="event.preventDefault(); document.getElementById('config_calc_avaluo-form').submit();"><i class="fa text-light fa-circle-o"></i><span>Configuracion de calculo de Avaluo</span></a></li>
                                            <li class="nav-item bg-catastro"><a class="nav-link" href="{{route('config_utm')}}" onclick="event.preventDefault(); document.getElementById('config_utm-form').submit();"><i class="fa text-light fa-circle-o"></i><span>Configuracion de UTM</span></a></li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="nav-item bg-catastro"><a class="nav-link " href="{{route('tipo_de_afectacion')}}" onclick="event.preventDefault(); document.getElementById('tipo_de_afectacion-form').submit();"><i class="fa text-light fa-gear"></i> <span class="d-sm-none d-sm-inline">Adm. de Afectaciones</span></a></li>

                            </ul>
                        </div>
                    </li>

                    <li class="nav-item bg-catastro">
                        <a class="nav-link collapsed" href="#submenu8" data-toggle="collapse" data-target="#submenu8"><i class="fa text-light fa-code"></i> <span class="d-sm-none d-sm-inline">Códigos</span></a>
                        <div class="collapse nav-collapse"  navbar="true" id="submenu8" aria-expanded="false">
                            <ul class="inline-grid pl-4">
                                <li class="nav-item bg-catastro"><a class="nav-link" href="{{route('tipo_de_bonificacion')}}" onclick="event.preventDefault(); document.getElementById('tipo_de_bonificacion-form').submit();"><i class="fa text-light fa-circle-o"></i><span>Códigos de Bonificaciones</span></a></li>
                                <li class="nav-item bg-catastro"><a class="nav-link" href="{{route('tipo_de_estado')}}" onclick="event.preventDefault(); document.getElementById('tipo_de_estado-form').submit();"><i class="fa text-light fa-circle-o"></i><span>Estados Parcelas</span></a></li>
                                <li class="nav-item bg-catastro"><a class="nav-link" href="{{route('tipo_de_ryb')}}" onclick="event.preventDefault(); document.getElementById('tipo_de_ryb-form').submit();"><i class="fa text-light fa-circle-o"></i><span>R y B Parcelas</span></a></li>
                                <li class="nav-item bg-catastro"><a class="nav-link" href="{{route('tipo_de_uso')}}" onclick="event.preventDefault(); document.getElementById('tipo_de_uso-form').submit();"><i class="fa text-light fa-circle-o"></i><span>Uso de Mejoras</span></a></li>
                                <li class="nav-item bg-catastro"><a class="nav-link" href="{{route('tipo_de_construccion')}}" onclick="event.preventDefault(); document.getElementById('tipo_de_construccion-form').submit();"><i class="fa text-light fa-circle-o"></i><span>Construcción de Mejoras</span></a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item bg-catastro"><a class="nav-link"  href="{{url('reporteGeneral')}}" onclick="event.preventDefault(); document.getElementById('reporte-form').submit();"><i class="fa text-light fa-file"></i> <span class="d-sm-none d-sm-inline">Reporte Dinámico</span></a></li>
                    
                    <li class="nav-item bg-catastro"><a class="nav-link"  href="{{route('auditorias')}}" onclick="event.preventDefault(); document.getElementById('auditorias-form').submit();"><i class="fa text-light fa-calendar-o"></i> <span class="d-sm-none d-sm-inline">Auditorías</span></a></li>

                    <li class="nav-item bg-catastro"><a class="nav-link"  href="{{url('totales')}}" onclick="event.preventDefault(); document.getElementById('totales-form').submit();"><i class="fa text-light fa-bar-chart"></i> <span class="d-sm-none d-sm-inline">Estadísticas</span></a></li>
                </ul>
            </nav>

            <form id="home-form" action="{{route('home')}}" method="GET" style="display: none;">
                @csrf
            </form>

            <form id="cartografia-form" action="{{route('cartografia')}}" method="GET" style="display: none;">
                @csrf
            </form>
            
            <form id="user-form" action="{{route('user')}}" method="GET" style="display: none;">
                @csrf
            </form> 

            <form id="seccion-form" action="{{route('seccion')}}" method="GET" style="display: none;">
                @csrf
            </form> 

            <form id="bloqueo-form" action="{{route('bloqueo')}}" method="GET" style="display: none;">
                @csrf
            </form> 

            <form id="parcelas-form" action="{{route('parcelas')}}" method="GET" style="display: none;">
                @csrf
            </form> 

            <form id="modulo_personas-form" action="{{route('modulo_personas')}}" method="GET" style="display: none;">
                @csrf
            </form> 

            <form id="union-form" action="{{url('gestion/union')}}" method="GET" style="display: none;">
                @csrf
            </form> 

            <form id="desglose-form" action="{{url('gestion/desglose')}}" method="GET" style="display: none;">
                @csrf
            </form> 


            <form id="tipo_de_condicion-form" action="{{route('tipo_de_condicion')}}" method="GET" style="display: none;">
                @csrf
            </form> 

            <form id="tipo_de_instrumento-form" action="{{route('tipo_de_instrumento')}}" method="GET" style="display: none;">
                @csrf
            </form> 

            <form id="tipo_de_parcela-form" action="{{route('tipo_de_parcela')}}" method="GET" style="display: none;">
                @csrf
            </form> 

            <form id="tipo_de_profesional-form" action="{{route('tipo_de_profesional')}}" method="GET" style="display: none;">
                @csrf
            </form> 

            <form id="tipo_de_servicio-form" action="{{route('tipo_de_servicio')}}" method="GET" style="display: none;">
                @csrf
            </form> 

            <form id="tipo_de_documento-form" action="{{route('tipo_de_documento')}}" method="GET" style="display: none;">
                @csrf
            </form> 

            <form id="tipo_de_persona_parcela-form" action="{{route('tipo_de_persona_parcela')}}" method="GET" style="display: none;">
                @csrf
            </form> 

            <form id="tipo_de_mejora-form" action="{{route('tipo_de_mejora')}}" method="GET" style="display: none;">
                @csrf
            </form> 

            <form id="tipo_de_mejora_destino-form" action="{{route('tipo_de_mejora_destino')}}" method="GET" style="display: none;">
                @csrf
            </form> 
           
            <form id="tipo_de_tramite-form" action="{{route('tipo_de_tramite')}}" method="GET" style="display: none;">
                @csrf
            </form> 

            <form id="tipo_de_afectacion-form" action="{{route('tipo_de_afectacion')}}" method="GET" style="display: none;">
                @csrf
            </form> 

            <form id="tipo_de_estado-form" action="{{route('tipo_de_estado')}}" method="GET" style="display: none;">
                @csrf
            </form> 

            <form id="config_calc_avaluo-form" action="{{route('config_calc_avaluo')}}" method="GET" style="display: none;">
                @csrf
            </form> 

            <form id="config_utm-form" action="{{route('config_utm')}}" method="GET" style="display: none;">
                @csrf
            </form> 

            <form id="tipo_de_ryb-form" action="{{route('tipo_de_ryb')}}" method="GET" style="display: none;">
                @csrf
            </form> 

            <form id="tipo_de_uso-form" action="{{route('tipo_de_uso')}}" method="GET" style="display: none;">
                @csrf
            </form> 

            <form id="tipo_de_construccion-form" action="{{route('tipo_de_construccion')}}" method="GET" style="display: none;">
                @csrf
            </form> 

            <form id="reporte-form" action="{{url('reporteGeneral')}}" method="GET" style="display: none;">
                @csrf
            </form> 

            <form id="auditorias-form" action="{{url('auditorias')}}" method="GET" style="display: none;">
                @csrf
            </form> 

            <form id="totales-form" action="{{url('totales')}}" method="GET" style="display: none;">
                @csrf
            </form> 

            <form id="poligonos_sin_padron-form" action="{{url('Administracion/Parcelas/poligonos_sin_padrones')}}" method="GET" style="display: none;">
                @csrf
            </form> 

</div>

        