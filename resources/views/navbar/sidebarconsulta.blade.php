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
                    </ul>
                </div>
            </li>
            <li class="nav-item bg-catastro">
                <a class="nav-link collapsed" href="#submenu2" data-toggle="collapse" data-target="#submenu2"><i class="fa text-light fa-tasks"></i> <span class="d-sm-none d-sm-inline">Gestión</span></a>
                <div class="collapse nav-collapse" navbar="true" id="submenu2" aria-expanded="false">
                    <ul class="inline-grid pl-4">
                        <li class="nav-item bg-catastro"><a class="nav-link" href="{{route('parcelas')}}" onclick="event.preventDefault(); document.getElementById('parcelas-form').submit();"><i class="fa text-light fa-table"></i><span>Padrones</span></a></li>
                    </ul>
                </div>
            </li>
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
    
    <form id="parcelas-form" action="{{route('parcelas')}}" method="GET" style="display: none;">
        @csrf
    </form> 

    <form id="reporte-form" action="{{url('reporteGeneral')}}" method="GET" style="display: none;">
        @csrf
    </form> 

    <form id="totales-form" action="{{url('totales')}}" method="GET" style="display: none;">
        @csrf
    </form> 

</div>


