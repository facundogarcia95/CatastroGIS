@inject('versionController', 'App\Http\Controllers\VersionController')
@inject('requesPendientes', 'App\Http\Controllers\RequerimientoController')
@inject('bloqueo', 'App\Http\Controllers\BloqueoController')
@php
  $cantidadRequerimientos =  $requesPendientes->cantidadRequesPendiente()->count();
  $URLBASE = str_replace(Request::path(),null,URL::current());

@endphp
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema ">
    <meta name="keyword" content="Sistema">
    <meta name="csrf-token" content="{{csrf_token()}}">
    @stack('header')

    <title>CATASTRO GUAYMALLÉN</title>

    @stack('css')
    <!-- Icons -->
    <link href="{{asset('css/librerias/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/librerias/simple-line-icons.min.css')}}" rel="stylesheet">
    <!-- Main styles for this application -->
    <link href="{{asset('css/librerias/jquery-ui.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/librerias/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/librerias/estilos.css')}}" rel="stylesheet">
    <link href="{{asset('css/librerias/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/librerias/responsive.bootstrap.min.css')}}" rel="stylesheet">

</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!--PONER LOGO-->
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="nav navbar-nav d-md-down-none">
            <li class="nav-item px-3">
                <a class="nav-link" href="#">Menu </a>
            </li>
           
        </ul>
        <label class="text-lasheras ml-auto h4 font-weight-bold" >
            @if(env('APP_MANTENIMIENTO'))
                <label class="f-20 text-danger animacion mantenimiento pointer d-sm-none">SISTEMA EN MANTENIMIENTO</label>
            @else
                <a href="https://www.guaymallen.gob.ar//" target="_blank"><img src="{{asset('img')."/".env('ICONO_LOGO')}}" width="100"></a>
            @endif
        </label>

        <ul class="nav navbar-nav ml-auto">

            <li class="nav-item">
                <a href="#modalBusquedaParcela" data-toggle="modal">
                    <i class="fa fa-search fa-2x text-primary" aria-hidden="true"></i>
                </a>
            </li>

            @if($bloqueo->mi_bloqueo())
            <li class="nav-item">
                <a href="#modalBloqueo" data-toggle="modal" data-id_usuario="{{Auth::user()->usuario_id}}">
                        <i class="fa fa-exclamation-triangle fa-2x text-danger animacion" aria-hidden="true"></i>
                </a>
            </li>
            @endif

            @if($cantidadRequerimientos > 0)
                <li class="nav-item " >
                    <a href="#modalRequerimientosPendientes"  data-toggle="modal" data-id_usuario="{{Auth::user()->usuario_id}}" class="mr-2">
                        <i class="fa fa-bell-o fa-2x  @php if($cantidadRequerimientos < 5 ){ echo 'text-info '; }else if($cantidadRequerimientos <10 && $cantidadRequerimientos >=5){ echo 'text-warning'; }else{ echo 'text-danger'; }@endphp" aria-hidden="true"></i>
                        <span class="notificaciones  @php if($cantidadRequerimientos < 5 ){ echo 'bg-info '; }else if($cantidadRequerimientos <10 && $cantidadRequerimientos >=5){ echo 'bg-warning'; }else{ echo 'bg-danger'; } @endphp text-light font-weight-bold">{{$cantidadRequerimientos}}</span>
                    </a>
                </li>  
            @endif          

            <li class="nav-item dropdown">
                <a class="nav-link nav-link mr-4" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="{{asset('storage/archivos/usuario/'.Auth::user()->imagen)}}" class="img-avatar" class="img-avatar" alt="{{Auth::user()->email}}">
                    <span class="d-md-down-none">{{Auth::user()->usuario_login}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Cuenta</strong>
                    </div>  

                    <a class="dropdown-item" href="{{route('logout')}}" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-lock"></i> Cerrar sesión</a>

                    <form  id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                    {{ csrf_field() }} 
                    </form>
                </div>
            </li>
        </ul>
       
            
       
    </header>
  
    <div class="app-body">
   
        
        @if(Auth::check())
           
            @if (Auth::user()->idrol == 1 || Auth::user()->idrol == 4 )
                @include('navbar.sidebaradministrador')
            @elseif (Auth::user()->idrol == 2)
                @include('navbar.sidebaroperador')
            @elseif (Auth::user()->idrol == 3)
                @include('navbar.sidebarconsulta')
            @endif
       
      
            @if ($errors->any())
                    <script>
                            var text = "";
                        @foreach ($errors->all() as $error)
                            text = text + "<li>"+ {{ $error }} + "</li> <br/>"
                        @endforeach

                            Swal.fire({
                            type: 'error',
                            //title: 'Oops...',
                            html: text,
                        
                            })

                    </script>
                <div class="alert alert-danger">
                    <ul>
                        
                    </ul>
                </div>
            @endif
            <!-- Contenido Principal -->
            
            <main class="main"> 
                
                @yield('breadcrumb')
                
                @yield('contenido')
                
                <!---------------------------------------------------
                    Procesando
                ------------------------------------------------------->
                <div class="modal fade " id="procesando" style="z-index: 9999 !important;" tabindex="-1" role="dialog" aria-labelledby="procesando" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content  rounded">
                            <div class="modal-body">
                                <div class="col-12 text-center">
                                    <img src="{{asset('css/librerias/images/loader.gif')}}" style="max-width: 300px;">
                                    <h4 >Cargando: <span id="porcentaje-procesado"></span></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!---------------------------------------------------
                    REQUERIMIENTOS PENDIENTES
                ------------------------------------------------------->
                <div class="modal fade" id="modalRequerimientosPendientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dark modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-catastro">
                                <h4 class="modal-title">Requerimientos Pendientes</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="text-light">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table id="tablaRequerimientos" class="table table-bordered table-striped table-sm table-responsive w-100">
                                    <thead>
                                        <tr class="bg-dark text-light">   
                                            <th>#</th>
                                            <th>Titulo</th>
                                            <th>Estado</th>
                                            <th>Ult. Actividad</th>
                                        </tr>
                                    </thead>
                                
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary rounded" data-dismiss="modal">Cerrar</button>
                            </div>
                    </div>
                    </div>
                </div>

                <!---------------------------------------------------
                    BLOQUEO DE PADRON
                ------------------------------------------------------->
                @if($bloqueo->mi_bloqueo() != null)
                <div class="modal fade" id="modalBloqueo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dark  modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Padrón Bloqueado</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="text-light">×</span>
                                </button>
                            </div>
                            <form method="POST" action="{{url('liberarBloqueo')}}">
                                @csrf
                                <div class="modal-body m-3">
                                    <input type="hidden" name="parcela_id" value="{{$bloqueo->mi_bloqueo()->parcela_id}}">
                                    @if($bloqueo->mi_bloqueo()->parcela)
                                        <h5>Usted tiene bloqueado el padrón N° <a href="{{url('gestion/padron',$bloqueo->mi_bloqueo()->parcela_id)}}" class="text-catastro">{{$bloqueo->mi_bloqueo()->parcela->parcela_padron}}</a></h5>
                                    @else
                                    <h5>El padrón que usted tiene bloqueado no existe en la Base de Datos</h5>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary rounded" >Liberar Padrón</button>
                                    <button type="button" class="btn btn-danger rounded" data-dismiss="modal">Cerrar</button>
                                </div>
                            </form>
                    </div>
                    </div>
                </div>
                @endif


                <div class="modal fade" id="modalBusquedaParcela" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dark  modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Búsqueda de Parcela</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="text-light">×</span>
                                </button>
                            </div>
                            <form method="GET" action="{{action('ParcelaController@index') }}">
                                <input type="hidden" name="search" value="true"> 
                                <div class="modal-body m-3">
                                    <div class="form-row mb-3">
                                        <div class="col-md-12 col-lg-6"> <input type="number" id="buscarPadronPrincipal" name="parcela_padron" class="form-control rounded" placeholder="Padrón" value="{{app('request')->input('parcela_padron')}}"></div>
                                        <div class="col-md-12 col-lg-6"> <input type="text" id="buscarNomenclaturaPrincipal" name="parcela_nomenclatura" class="form-control rounded" placeholder="Nomenclatura" value="{{app('request')->input('parcela_nomenclatura')}}"></div>
                                </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary rounded" >Buscar</button>
                                    <button type="button" class="btn btn-success rounded buscarCarto" ><i class="fa fa-map" aria-hidden="true"></i> Cartografía</button>
                                    <button type="button" class="btn btn-danger rounded" data-dismiss="modal">Cerrar</button>
                                </div>
                            </form>
                            <form method="GET" action="{{action('CartografiaController@index') }}" id="busquedaCarto">
                                <input type="hidden" id="buscarCarto" name="buscarCarto" value="false"> 
                                <input type="hidden" id="buscarCartoPadron" name="parcela_padron" value=""> 
                                <input type="hidden" id="buscarCartoNomenclatura" name="parcela_nomenclatura" value=""> 
                            </form>
                    </div>
                    </div>
                </div>

            </main>
     
        @endif
        <!-- /Fin del contenido principal -->

    </div>   


    <footer class="app-footer">
        <span class="">Versión: <a href="{{url('version')}}"> {{ $versionController->version()}} </a> - <a href="{{asset('storage/manuales/manual.pdf')}}" target="_blank"> Manual de uso </a></span>
        <span class="ml-auto"><a href="https://divisiongis.com" target="_blank">DivisionGIS</a> &copy; 2021</span>
    </footer>

    <!-- Bootstrap and necessary plugins -->
    <script>const RUTA = "{{Request::route()->getName()}}";</script>
    <script  src="{{asset('js/librerias/jquery.min.js')}}"></script>
    <script  src="{{asset('js/librerias/jquery-ui.js')}}"></script>
    <script  src="{{asset('js/librerias/jquery-migrate-3.0.0.min.js')}}"></script>
    <script src="{{asset('js/librerias/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/librerias/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/librerias/moment.min.js')}}"></script>
    <script src="{{asset('js/librerias/popper.min.js')}}"></script>
    <script src="{{asset('js/librerias/bootstrap.min.js')}}"></script>

    <script src="{{asset('js/librerias/pace.min.js')}}"></script>
    <!-- Plugins and scripts required by all views -->
    <script src="{{asset('js/librerias/Chart.min.js')}}"></script>
    <script src="{{asset('js/librerias/util.js')}}"></script>
    <!-- GenesisUI main scripts -->
    <script src="{{asset('js/librerias/template.js')}}"></script>
    <script src="{{asset('js/librerias/sweetalert2.all.min.js')}}"></script>
     
    <script src="{{asset('js/librerias/inputmask.js')}}"></script>
    <script src="{{asset('js/librerias/inputmask.extensions.js')}}"></script>   
    <script src="{{asset('js/librerias/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('js/principal.js')}}"></script>
    <script>
    /*========================================
        VARIABLES FIJAS PARA NOMENCLATURA Y CARTOGRAFIA DE .ENV
    =========================================*/
    var FIJO_COORDENADA_X="{{env('FIJO_COORDENADA_X')}}";
    var FIJO_COORDENADA_Y="{{env('FIJO_COORDENADA_Y')}}";
    var FIJO_DEPARTAMENTO="{{env('FIJO_DEPARTAMENTO')}}";
    var FIJO_DEPARTAMENTO_PROVISORIO="{{env('FIJO_DEPARTAMENTO_PROVISORIO')}}";
    var URLBASE = "{{str_replace(Request::path(),null,URL::current())}}";
    var PATH = "{{Request::path()}}";
    var CENTER_X = {{env('CENTER_X')}};
    var CENTER_Y = {{env('CENTER_Y')}};;
    
    $(document).ready(function () {
            
                
            $(".buscarCarto").on("click",function(){
                $("#buscarCarto").val("true");
                $("#buscarCartoPadron").val($("#buscarPadronPrincipal").val())
                $("#buscarCartoNomenclatura").val($("#buscarNomenclaturaPrincipal").val())
                $("#busquedaCarto").submit();
            });


            olTable = $('#tablaRequerimientos').DataTable({
                    "ajax":"{{url('tabla_requerimientos')}}",
                    "deferRender": true,
                    "retrieve": true,
                    "processing": true,
                    "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }

                },
                columns: [
                    
                        {data: 'noticia_id'},
                        {data: 'asunto'},
                        {data: 'estado',"searchable": false},
                        {data: 'ultima_actividad'}
                    ]
                }).order( [ 3, 'asc' ]);

                var count = 0;
                $(".nav-collapse").on('show.bs.collapse', function () {
                    
                    $padre = $(this).prev().data('parent');
                    $actual = $(this).attr('id');

                    $('.nav-collapse.show').each(function(){ 
                        if($(this).attr('id') != $padre && $(this).attr('id') != $actual)
                            $(this).collapse('hide');         
                    });
               

                });



    
                $.ajax({
                    type: "GET",
                    url: "{{url('verificarSession')}}",
                    success: function (response) {
                        if(!response.session){
                            window.location.reload();
                        }
                    },error: function(response){
                        window.location.reload();
                    }
                });

                // Reload
                setTimeout(() => {
                    window.location.reload();                    
                }, 3610000); // 7800000


                $(".mantenimiento").on("click",function(){
                    Swal.fire({
                        position: 'center',
                        type: 'warning',
                        title: 'Sistema en mantenimiento',
                        html:'Algunas funciones del sistema pueden ser afectadas temporalmente.',
                        showConfirmButton: true
                    })
                })


            });

            $("form").on("submit",function(){
                formulario = $(this);
                formulario.find(':submit').attr("disabled",true);
            })
    </script>
  
 @stack('scripts')


</body>

</html>