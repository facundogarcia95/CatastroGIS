/* PARA MODIFICAR LAS CAPAS DEL APLICATIVO DESABILITAR EL GRUPO 'overlayGroup' DEL MAPA */
/* LUEGO MODIFICAR EL ZOOM INICIAL E IR AGREGANDO LAS DISTINTAS CAPAS DESDE 'Params' HASTA 'TileWMStotal'*/



/*================
ESTILOS y VECTORES DEL MAPA
=================*/

var TextStyle = {
    scale: 1.3,
    fill: new ol.style.Fill({
        color: '#FFFF99'
    }),
    stroke: new ol.style.Stroke({
        color: '#000',
        width: 3.5
    })
};

// VALOR DE LABEL
TextStyle.text = '';
var textEstilo = new ol.style.Text(TextStyle);

// Layer para Seleccion
var source = new ol.source.Vector({ wrapX: false });
var vector = new ol.layer.Vector({
    source: source,
    style: new ol.style.Style({
        fill: new ol.style.Fill({
            color: 'rgba(255, 77, 77, 0.7)'
        }),
        stroke: new ol.style.Stroke({
            color: '#ff4d4d', //rojo
            width: 5
        })
    }),
    opacity: 0.85
});



// Layers para resaltar consulta en azul
var highlightLayerSource = new ol.source.Vector();
var highlightLayer = new ol.layer.Vector({
    style: new ol.style.Style({
        fill: new ol.style.Fill({
            color: 'rgb(0, 50, 200)'
        }),
        stroke: new ol.style.Stroke({
            color: 'rgb(0, 50, 200)',
            width: 3
        }),
        text: textEstilo
    }),
    opacity: 0.35,
    source: highlightLayerSource,
    displayInLayerSwitcher: false,
    isBaseLayer: false
});


// Layers para resaltar consulta en rojo
var highlightLayerSourceHover = new ol.source.Vector();
var highlightLayerHover = new ol.layer.Vector({
    style: new ol.style.Style({
        fill: new ol.style.Fill({
            color: 'rgba(255,77,77,0.4)'
        }),
        stroke: new ol.style.Stroke({
            color: 'rgb(255, 102, 0)',
            width: 3
        }),
        text: textEstilo
    }),
    opacity: 0.45,
    source: highlightLayerSourceHover,
    displayInLayerSwitcher: false,
    isBaseLayer: false
});



//Layer de seleccion de parcela
var Seleccionsource = new ol.source.Vector();
var Seleccionvector = new ol.layer.Vector({
    source: Seleccionsource,
    style: new ol.style.Style({
        fill: new ol.style.Fill({
            color: "rgba(255, 255, 255, 0.2)"
        }),
        stroke: new ol.style.Stroke({
            color: "#ffcc33",
            width: 2
        }),
    })
});

// Layers para labels
var LabelLayerSource = new ol.source.Vector();
var LabelLayer = new ol.layer.Vector({
    style: new ol.style.Style({
        fill: new ol.style.Fill({
            color: 'rgb(0,255,0)',
        })
    }),
    opacity: 0.2,
    source: LabelLayerSource,
    displayInLayerSwitcher: false,
    isBaseLayer: false
});


var highlightStyle = new ol.style.Style({
    stroke: new ol.style.Stroke({
      color: '#f00',
      width: 1,
    }),
    fill: new ol.style.Fill({
      color: 'rgba(255,0,0,0.1)',
    }),
    text: new ol.style.Text({
      font: '12px Calibri,sans-serif',
      fill: new ol.style.Fill({
        color: '#000',
      }),
      stroke: new ol.style.Stroke({
        color: '#f00',
        width: 3,
      }),
    }),
  });



  /*================
    FIN DE ESTILOS Y VECTORES DEL MAPA
  ====================*/



/*================
GENERACION DEL MAPA
=================*/


// Creo el grupo de las capas vacio
var overlayGroup = new ol.layer.Group({
    title: 'Capas'
});

// Añado proyeccion y zoom inicial
var view = new ol.View({
    center: ol.proj.transform([CENTER_Y, CENTER_X], 'EPSG:4326', 'EPSG:3857'),
    zoom: 17,
    minZoom: 10, //limite superior
    maxZoom: 21 //limite inferior		
});

// Creo el mapa con los dos grupos (capas y base)

var map = new ol.Map({
        target: 'map',
        controls: ol.control.defaults().extend([
            new ol.control.ScaleLine()
        ]),
        layers: [
            overlayGroup,
            highlightLayer,
            highlightLayerHover,
            LabelLayer,
            vector,
            Seleccionvector
        ],
        view: view
    });


/*====================

GENERACIÓN Y CARGA DE CAPAS

=====================*/


/* 
======================
CARGA DE CAPAS SEGÚN LOS PARÁMETROS
=====================
*/
var Params = [];
var EspacioTrabajo = [];

$.ajax({
    type: "GET",
    url: URLBASE+'capas_cartografia',
    async: false,
    data: {
        _token: $("meta[name='csrf-token']").attr("content"), 
    },
    complete: function(resp){
  
    },
    success: function (response) {
        capas_tabla = response.capas;

        for (let i = 0; i < capas_tabla.length; i++) {

            Params[capas_tabla[i].orden] = capas_tabla[i].nombre;
            EspacioTrabajo[capas_tabla[i].orden] = capas_tabla[i].espacio_trabajo;

            if(capas_tabla[i].tipo == "TileWMS"){

                if(capas_tabla[i].nombre != "imagen_satelital"){

                    Capas[capas_tabla[i].orden] = new ol.source.TileWMS({
                        url: 'http://' + varglobal + '/geoserver/'+capas_tabla[i].espacio_trabajo+'/wms',
                        params: {
                            'FORMAT': capas_tabla[i].formato,
                            'VERSION': capas_tabla[i].version,
                            'tiled': capas_tabla[i].tiled, 
                            'LAYERS': capas_tabla[i].espacio_trabajo+':' +capas_tabla[i].nombre,
                            'STYLE':capas_tabla[i].style,
                            'CQL_FILTER':capas_tabla[i].cql_filter
                        },
                        serverType: 'geoserver'
                    });
                    
                    TileWMStotal[capas_tabla[i].orden] = new ol.layer.Tile({
                        source: Capas[capas_tabla[i].orden]
                    });

                }else{

                    Capas[capas_tabla[i].orden] = new ol.source.BingMaps({
                            key:'AnCE_1wIgB2Tyxenf4tFA5yWOizSDn5VARZC4Do6RVFWeJtntq2AIpcawNkt2ffk',
                            imagerySet: 'Aerial',
                            maxZoom:19
                    });

                    // Servicio de Google
                    TileWMStotal[capas_tabla[i].orden] = new ol.layer.Tile({
                        preload: Infinity,
                        source: Capas[capas_tabla[i].orden]
                    });



                }

                
            }else{
                

                Capas[capas_tabla[i].orden] = new ol.source.ImageWMS({
                    url: 'http://' + varglobal + '/geoserver/'+capas_tabla[i].espacio_trabajo+'/wms',
                    params: {
                        'FORMAT': capas_tabla[i].formato,
                        'VERSION': capas_tabla[i].version,
                        'tiled': capas_tabla[i].tiled, 
                        'LAYERS': capas_tabla[i].espacio_trabajo+':' +capas_tabla[i].nombre,
                        'STYLES':capas_tabla[i].style,
                        'CQL_FILTER': capas_tabla[i].cql_filter
                    },
                    serverType: 'geoserver'
                });
                
                TileWMStotal[capas_tabla[i].orden] = new ol.layer.Image({
                    source: Capas[capas_tabla[i].orden]
                });

               
            }


            
            if(capas_tabla[i].visible != 1){
                TileWMStotal[capas_tabla[i].orden].setVisible(false);
            }

            if(capas_tabla[i].opacidad != null){
                TileWMStotal[capas_tabla[i].orden].setOpacity(capas_tabla[i].opacidad);
            }

            
        }

        


    }
});


for(i = 0; i < TileWMStotal.length; i++){

    overlayGroup.getLayers().push(TileWMStotal[i]);

}

