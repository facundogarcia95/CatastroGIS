
@extends('principal')
@section('breadcrumb')
    {{ Breadcrumbs::render('cartografia') }}
@endsection
@section('contenido')
         <div class="container-fluid mt-6" >
            <div class="card">
                @if( session('error') )
                    <div class="alert alert-danger" role="alert">{{session('error')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true" class="text-dark">&times;</span>
                        </button>
                    </div>
                @endif
                <div id="map" style=" cursor: pointer; height:83vh;" class="map pr-2">
                </div>
            </div>
         </div>

         <div class="menu-float">

            <nav class="floating-menu">
               <ul class="main-menu">
                   <li>
                    <span class="titulo text-uppercase">Consulta</span>
                       <a class="ripple text-light"  data-toggle="modal" data-target="#abrirmodalConsulta">
                        <i class="fa fa-search fa-lg"></i>
                       </a>
                     
                   </li>
                   <li>
                    <span class="titulo text-uppercase">Medición</span>
                       <a class="ripple text-light medicion">
                        <i class="fa fa-arrows-h fa-lg" aria-hidden="true"></i>
                       </a>
                   </li>
                   <li>
                    <span class="titulo text-uppercase">Capas</span>
                       <a class="ripple text-light leyendas" >
                        <i class="fa fa-list fa-lg" aria-hidden="true"></i>
                       </a>
                   </li>
                   @if(Auth::user()->idrol == 1 || Auth::user()->idrol == 2 || Auth::user()->idrol == 4  )
                    <li>
                        <span class="titulo text-uppercase">Barrios</span>
                        <a class="ripple moduloBarrios text-light">
                            <i class="fa fa-th fa-lg" aria-hidden="true"></i>
                        </a>
                    </li>
                   @endif
                   <!-- HAY QUE HACER LA FUNCIONALIDAD
                    <li>
                        <span class="titulo text-uppercase">Mejoras</span>
                        <a href="#" class="ripple">
                            <i class="fa fa-building-o fa-lg" aria-hidden="true"></i>
                        </a>
                   </li>-->
               </ul>
               <div class="menu-bg"></div>
           </nav>
         </div>


         @include('cartografia.modales')
  


@push('scripts')


<script src="{{asset('js/cartografia_js/librerias/ol.js')}}"></script>
<script src="{{asset('js/cartografia_js/librerias/jquery.redirect.js')}}"></script>
<script src="{{asset('js/cartografia_js/variables.js')}}"></script>
<script src="{{asset('js/cartografia_js/funciones_generales.js')}}"></script>
<script src="{{asset('js/cartografia_js/modulo_busqueda.js')}}"></script>
<script src="{{asset('js/cartografia_js/modulo_medicion.js')}}"></script>
<script src="{{asset('js/cartografia_js/modulo_barrios.js')}}"></script>
<script src="{{asset('js/cartografia_js/iniciar_mapa.js')}}"></script>
<script src="{{asset('js/cartografia_js/single_click.js')}}"></script>


<script>
    /*===========================================
        FUNCIONES DE VENTANAS MODALES Y VALIDACIONES
    ==============================================*/


        $(document).ready(function () {
            autoCompletarTitulares();
            autoCompletarCalles();

            
            if({{$barrio_id}} != 0){
                mostrarBarrioClick({{$barrio_id}},true)

                TileWMStotal[5].setVisible(true);
                let params = {
                    LAYERS: EspacioTrabajo[2]+':'+Params[2],
                    STYLES: 'barrios'
                };
                TileWMStotal[2].getSource().updateParams(params);

            }

                $(".ol-unselectable").css('max-width',$(".ol-viewport").width());   
                $(".ol-unselectable").css('min-width',$(".ol-viewport").width()); 
                
                $(".ol-zoom").removeAttr('style'); 
                $(".ol-scale-line").removeAttr('style'); 
                 

            @isset($buscar)
                $("#padronNomencla_busqueda").val("{{$buscar}}");
                $(".buscarPadronNomencla").trigger("click");
            @endisset

        });


</script>


@endpush

@push('css')
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9"crossorigin="anonymous">
   <link rel="stylesheet" href="{{asset('css/cartografia_css/librerias/ol.css')}}" />
   <link rel="stylesheet" href="{{asset('css/cartografia_css/librerias/jquery-ui.css')}}" />
   <link rel="stylesheet" href="{{asset('css/cartografia_css/carto_lasheras.css')}}" />
   <link rel="stylesheet" href="{{asset('/css/librerias/adminlte.min.css')}}">
@endpush

@endsection