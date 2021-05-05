varglobal = window.location.host;

// Frame 'buscando..'
$body = $("body");
$(document).on({
	ajaxStart: function () { 
	
		$body.css("cursor", "wait"); 	
	},ajaxStop: function () {

		 $body.css("cursor", "default"); 
		}
});

//REUTILIZAR PUNTO
var reutilizarPunto = false;
var Nom;
var datosPoligon;

// Variables
var src = "EPSG:3857"; /*EPSG:900913*/
var dest = "EPSG:4326";
var parcelas_intersectadas = new Array(); //listado de parcelas intersectadas
var poligono_puntos = new Array(); //puntos del poligono dibujado
var X, Y, latitud, longitud, draw, snap, polygon, geojson_parcelas, vectorLayer_seach, poligono_puntos;
var moduloActivado = "NINGUNO";
var polygons = [];
var modulo;
var draw;

// Cambio de switch
var datos_del_barrio;
var geojson_mejoras;

// Coordenadas latitud y longitud
Cooryy = '';
Coorxx = '';

// Array de coordenadas x, y
var Coor = new Array();
var Box = new Array();


// Creo array con las capas y le coloco los valores correspondientes
var Capas = new Array();

// El array con la capa final que luego se agrega al grupo overlayGroup
var TileWMStotal = new Array();

// Array con las columnas que define los campos a llamar en el feature del geoserver
var Columnas = new Array();

// Funciones para mostrar el contenido final de la ventana emergente
var Funciones = new Array();

// Inicio la capa de highlight vacia
var featurething = '';

var distrito_seleccionado;

// Nombre de columnas con los datos a traer
var Columnas2 = new Array();
Columnas2[0] = 'nom_dist';
Columnas2[1] = 'barrio';
Columnas2[2] = 'nombre';
Columnas2[3] = 'nombre';
Columnas2[4] = 'nomenc21';
Columnas2[5] = 'nombre';
Columnas2[6] = 'nombre';
Columnas2[7] = 'nombre';
Columnas2[8] = 'depto';


// distrito seleccionado en modulo barrio / mejoras
var distrito_nombre;
var distrito;

//id del barrio en el que no deba hacerle alguna consultar al usuario
var barrioNoPreguntar;

var estilo_remarcar = new ol.style.Style({//estilo del tramo buscado
	fill: new ol.style.Fill({
	  color: 'rgba(0,61,93,0.01)'
	}),
	stroke: new ol.style.Stroke({
	  color: 'rgba(249,133,87,0.21)',
	  width: 2
	})
 });




