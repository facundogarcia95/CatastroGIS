
    <div id="map" style=" width: 100%; height: 100%; cursor: pointer;" class="map">
        <button class="btn-primary btn btn-sm refrescar" style="position: absolute;z-index: 1;right: 20px;"><i class="fa fa-refresh" aria-hidden="true"></i></button>
        
    </div>

@push('scripts')

<script>
        

    /*================
    FUNCION QUE REMARCA EN EL MAPA LA PARCELA CLICKEADA
    ==================*/

    function dibujarPoligono(elem) {
	
        let hover; //LO USO POR SI EN ALGÚN MODULO DEBO CAMBIAR EL COLOR AL HACER UN CAMBIO DE COLOR EN EL HOVER
        let label; //LO USO PARA EL MODULO DE ASIGNAR EN BARRIOS

		highlightLayerSource.clear('');

	    coord= [];

		if(elem.features[0].geometry != null){

			for(i=0; i < elem.features[0].geometry.coordinates[0][0].length; i++){
	
				Coorx =  elem.features[0].geometry.coordinates[0][0][i][0];
				Coory = elem.features[0].geometry.coordinates[0][0][i][1];
				coord.push([Coorx, Coory]);
				
			}

			var thing = new ol.geom.Polygon([coord]);
			var featurething = new ol.Feature({geometry: thing});
	
				highlightLayerSource.addFeature(featurething);
		
		}
    }

    $(".refrescar").on("click",function (e) { 
       e.preventDefault();

        $(".ol-viewport").remove();

        setTimeout(() => {
        $.getScript("{{asset('js/cartografia_js/iniciar_mapa.js')}}", function() {});         
        }, 600);
        setTimeout(() => {
        $.getScript("{{asset('js/cartografia_js/single_click.js')}}", function() {});
        $.getScript("{{asset('js/cartografia_js/funciones_generales.js')}}", function() {});
        $.getScript("{{asset('js/cartografia_js/modulo_busqueda.js')}}", function() {});
        }, 800);

        setTimeout(() => {
        $(".ol-unselectable").css('max-width',$(".ol-viewport").width());  
        buscarPorNomenclatura($(".nomenclatura").val().split("-").join(""));   
        }, 1200);


        
    });

</script>

<script src="{{asset('js/cartografia_js/librerias/ol.js')}}"></script>
<script src="{{asset('js/cartografia_js/variables.js')}}"></script>
<script src="{{asset('js/cartografia_js/iniciar_mapa.js')}}"></script>
<script src="{{asset('js/cartografia_js/funciones_generales.js')}}"></script>
<script src="{{asset('js/cartografia_js/modulo_busqueda.js')}}"></script>
<script src="{{asset('js/cartografia_js/modulo_barrios.js')}}"></script>


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

