<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-item">
                    <a class="nav-link" href="{{url('home')}}" onclick="event.preventDefault(); document.getElementById('home-form').submit();"><i class="fa text-light fa-bar-chart"></i> Dashbord</a>
                            
                            <form id="home-form" action="{{url('home')}}" method="GET" style="display: none;">
                            @csrf
                            </form>
                    </li>
                    <li class="nav-title">
                        Menú
                    </li>

                   
                    <li class="nav-item">

                           <a class="nav-link" href="{{url('categoria')}}" onclick="event.preventDefault(); document.getElementById('categoria-form').submit();"><i class="fa text-light fa-list-ul"></i> Categorías</a>
                            
                            <form id="categoria-form" action="{{url('categoria')}}" method="GET" style="display: none;">
                            @csrf
                            </form>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('producto')}}" onclick="event.preventDefault(); document.getElementById('producto-form').submit();"><i class="fa text-light fa-product-hunt"></i> Productos</a>
                            
                            <form id="producto-form" action="{{url('producto')}}" method="GET" style="display: none;">
                            @csrf
                            </form>
                    </li>
                      
               

            
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('compra')}}" onclick="event.preventDefault(); document.getElementById('compra-form').submit();"><i class="fa text-light fa-shopping-cart"></i> Compras</a>
                        <form id="compra-form" action="{{url('compra')}}" method="GET" style="display: none;">
                            @csrf
                         </form>
                    </li>
                                         
                   
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('venta')}}" onclick="event.preventDefault(); document.getElementById('venta-form').submit();"><i class="fa text-light fa-suitcase"></i> Ventas</a>
                        <form id="venta-form" action="{{url('venta')}}" method="GET" style="display: none;">
                            @csrf
                         </form>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('faltante')}}" onclick="event.preventDefault(); document.getElementById('faltante-form').submit();"><i class="fa text-light fa-trash"></i> Ajuste de Inventario</a>
                        <form id="faltante-form" action="{{url('faltante')}}" method="GET" style="display: none;">
                            @csrf
                         </form>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('proveedor')}}" onclick="event.preventDefault(); document.getElementById('proveedor-form').submit();"><i class="fa text-light fa-users"></i> Proveedores</a>
                        <form id="proveedor-form" action="{{url('proveedor')}}" method="GET" style="display: none;">
                            @csrf
                         </form>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('cliente')}}" onclick="event.preventDefault(); document.getElementById('cliente-form').submit();"><i class="fa text-light fa-users"></i> Clientes</a>
                        <form id="cliente-form" action="{{url('cliente')}}" method="GET" style="display: none;">
                            @csrf
                         </form>
                    </li>
                        
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('user')}}" onclick="event.preventDefault(); document.getElementById('user-form').submit();"><i class="fa text-light fa-user"></i> Usuarios</a>
                        <form id="user-form" action="{{url('user')}}" method="GET" style="display: none;">
                            @csrf
                         </form> 
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('rol')}}" onclick="event.preventDefault(); document.getElementById('rol-form').submit();"><i class="fa text-light fa-list"></i> Roles</a>
                        <form id="rol-form" action="{{url('rol')}}" method="GET" style="display: none;">
                            @csrf
                         </form> 
                    </li>
                                  
                    
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>
