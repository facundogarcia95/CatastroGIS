
 @extends('principal')
 @section('breadcrumb')
     {{ Breadcrumbs::render('cartografia_reporte') }}
 @endsection
 @section('contenido')

   <div id="map" style=" width: 100%; height: 80vh; cursor: pointer;" class="map">
   </div>

@push('scripts')

   <script src="{{asset('js/cartografia_js/librerias/ol.js')}}"></script>
   <script src="{{asset('js/cartografia_js/variables.js')}}"></script>
   <script src="{{asset('js/cartografia_js/iniciar_mapa_reporte.js')}}"></script>
   <script src="{{asset('js/cartografia_js/funciones_generales.js')}}"></script>
   <script src="{{asset('js/cartografia_js/modulo_busqueda.js')}}"></script>
   <script>

      map.setView(new ol.View({
         center: ol.proj.transform([{{$extent["xcent"]}}, {{$extent["ycent"]}}], 'EPSG:4326', 'EPSG:3857'),
         zoom: map.getView().getZoom()
      }));
      
   </script>

@endpush

@push('css')

<link rel="stylesheet" href="{{asset('css/cartografia_css/librerias/ol.css')}}" />
<link rel="stylesheet" href="{{asset('css/cartografia_css/librerias/jquery-ui.css')}}" />
<link rel="stylesheet" href="{{asset('css/cartografia_css/carto_lasheras.css')}}" />

<style>
   .app-body{
      overflow-y: auto !important;
   }
</style>

@endpush


@endsection

