
var IP = window.location.host;
var espacio_trabajo = 'catastro_gllen';
// Capas en mapa

// Highlights
highlightLayerSource = new ol.source.Vector({});
highlightLayer = new ol.layer.Vector({});

// OSM
var OSM = new ol.layer.Tile({
      source: new ol.source.OSM()
    });

// Parcelas
sourceParcelas = new ol.source.TileWMS({
		url: 'http://' + IP + '/geoserver/'+espacio_trabajo+'/wms',
		params: {
			LAYERS: espacio_trabajo+':gllen_parcelas_pos'
		},
		serverType: 'geoserver'
	});
	
console.log(sourceParcelas);
parcelas = new ol.layer.Tile({
	source: sourceParcelas
});

// Ejes
var ejes = new ol.layer.Tile({
	source: new ol.source.TileWMS({
		url: 'http://' + IP + '/geoserver/'+espacio_trabajo+'/wms',
		params: {
			LAYERS: espacio_trabajo+':ejes_gllen'
		},
		serverType: 'geoserver'
	})
});

// Barrios
var barrios = new ol.layer.Tile({
	source: new ol.source.TileWMS({
		url: 'http://' + IP + '/geoserver/'+espacio_trabajo+'/wms',
		params: {
			LAYERS: espacio_trabajo+':barrios_dissolve'
		},
		serverType: 'geoserver'
	})
});

view = new ol.View({
    center: ol.proj.transform([-68.7880795988543, -32.899881837824374], 'EPSG:4326', 'EPSG:3857'),
    zoom: 17,
	maxZoom: 22,
	minZoom: 13
});

map = new ol.Map({
  target: 'map',
  layers: [ parcelas, ejes/*, barrios*/ ],
  view: view//,
  //controls: [],
  //interactions: []
});


