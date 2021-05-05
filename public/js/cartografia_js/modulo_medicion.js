$(".medicion").on("click",function(){

   html = `<div class="row m-3 bordered" style="max-width: 300px;">
            <div class="box box-default box-solid " style="min-width: 200px;">
                <div class="box-header with-border">
                      <h3 class="box-title">Medición</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target=".box-body" aria-expanded="true"><i class="fa fa-minus"></i>
                      </button>
                    </div>
                </div>
                <div class="box-body collapse show">
                  <div class="row">
                      <div class="col-sm-12 col-md-3 bg-secondary text-dark">
                          <label><h5 class="mt-3 font-weight-bold">TIPO</h5></label>
                      </div>
                      <div class="col-sm-12 col-md-9  bg-secondary text-dark">
                      <select class=" m-2 w-50" id="tipoMedicion" onchange="medirDistancias()">
                          <option value="" selected disabled>Seleccionar</option>
                          <option value="length">Distancia</option>
                          <option value="area">Superficie</option>
                      </select>
                      <a class="btn btn-success btn-md rounded m-2 text-light" onclick="limpiarMedicion()">
                          <i class="fa fa-refresh fa-2x"></i> 
                          <b class="f-14">Limpiar</b>
                      </a>
                      <input type="hidden" id="geodesic">
                      </div>
                      <div class="col-sm-12 col-md-3 bg-dark text-light">
                        <label><h5 class="mt-2">PASO 1</h5></label>
                      </div>
                      <div class="col-sm-12 col-md-9 bg-dark text-light">
                        <label><h6 class="mt-2">Primer click marca punto inicial</h6></label>
                      </div>
                      <div class="col-sm-12 col-md-3 bg-dark text-light">
                        <label><h5 class="mt-2">PASO 2</h5></label>
                      </div>
                      <div class="col-sm-12 col-md-9 bg-dark text-light">
                        <label><h6 class="mt-2">Doble click marca el punto final</h6></label>
                      </div>
                  </div>
                 </div>
            </div>
          </div>`

   SwalAlertHtml("",html,'top-end');

   moduloActivado = "MEDICION";

});

function limpiarMedicion() {

  highlightLayerSource.clear('');
  source.clear();
  $(".tooltip-static").remove();


}

function medirDistancias(){

  map.removeInteraction(draw);
  
  $(".tooltip").removeClass("d-none")

	 var wgs84Sphere = new ol.Sphere(6378137);

      /**
       * Currently drawn feature.
       * @type {ol.Feature}
       */
      var sketch;


      /**
       * The help tooltip element.
       * @type {Element}
       */
      var helpTooltipElement;


      /**
       * Overlay to show the help messages.
       * @type {ol.Overlay}
       */
      var helpTooltip;


      /**
       * The measure tooltip element.
       * @type {Element}
       */
      var measureTooltipElement;


      /**
       * Overlay to show the measurement.
       * @type {ol.Overlay}
       */
      var measureTooltip;


      /**
       * Message to show when the user is drawing a polygon.
       * @type {string}
       */
      var continuePolygonMsg = 'Click para continiar Medición';


      /**
       * Message to show when the user is drawing a line.
       * @type {string}
       */
      var continueLineMsg = 'Finalizar con Doble Click';


      /**
       * Handle pointer move.
       * @param {ol.MapBrowserEvent} evt The event.
       */
      var pointerMoveHandler = function(evt) {
         
         if(moduloActivado == "MEDICION"){
            
               if (evt.dragging) {
                  return;
               }
               /** @type {string} */
               var helpMsg = 'Click para comenzar';

               if (sketch) {

                  var geom = (sketch.getGeometry());
                  if (geom instanceof ol.geom.Polygon) {
                     helpMsg = continuePolygonMsg;
                  } else if (geom instanceof ol.geom.LineString) {
                     helpMsg = continueLineMsg;
                  }
               }

               helpTooltipElement.innerHTML = helpMsg;
               helpTooltip.setPosition(evt.coordinate);

               
               helpTooltipElement.classList.remove('d-none');
         }
      };

      map.on('pointermove', pointerMoveHandler);

      map.getViewport().addEventListener('mouseout', function() {
        helpTooltipElement.classList.add('d-none');
      });

      var typeSelect = $('#tipoMedicion');
      var geodesicCheckbox = $('#geodesic');


      /**
       * Format length output.
       * @param {ol.geom.LineString} line The line.
       * @return {string} The formatted length.
       */
      var formatLength = function(line) {
        var length;
        if (geodesicCheckbox.prop('checked')) {
          var coordinates = line.getCoordinates();
          length = 0;
          var sourceProj = map.getView().getProjection();
          for (var i = 0, ii = coordinates.length - 1; i < ii; ++i) {
            var c1 = ol.proj.transform(coordinates[i], sourceProj, 'EPSG:4326');
            var c2 = ol.proj.transform(coordinates[i + 1], sourceProj, 'EPSG:4326');
            length += wgs84Sphere.haversineDistance(c1, c2);
          }
        } else {
          length = Math.round(line.getLength() * 100) / 100;
        }
        var output;
        if (length > 100) {
          output = (Math.round(length / 1000 * 100) / 100) +
              ' ' + 'km';
        } else {
          output = (Math.round(length * 100) / 100) +
              ' ' + 'm';
        }
        return output;
      };


      /**
       * Format area output.
       * @param {ol.geom.Polygon} polygon The polygon.
       * @return {string} Formatted area.
       */
      var formatArea = function(polygon) {
        var area;
        if (geodesicCheckbox.prop('checked')) {
          var sourceProj = map.getView().getProjection();
          var geom = /** @type {ol.geom.Polygon} */(polygon.clone().transform(
              sourceProj, 'EPSG:4326'));
          var coordinates = geom.getLinearRing(0).getCoordinates();
          area = Math.abs(wgs84Sphere.geodesicArea(coordinates));
        } else {
          area = polygon.getArea();
        }
        var output;
        if (area > 10000) {
          output = (Math.round(area / 1000000 * 100) / 100) +
              ' ' + 'km<sup>2</sup>';
        } else {
          output = (Math.round(area * 100) / 100) +
              ' ' + 'm<sup>2</sup>';
        }
        return output;
      };


      function addInteraction() {
        var type = (typeSelect.val() == 'area' ? 'Polygon' : 'LineString');
        console.log(type);

        draw = new ol.interaction.Draw({
          source: source,
          type: /** @type {ol.geom.GeometryType} */ (type),
          style: new ol.style.Style({
            fill: new ol.style.Fill({
              color: 'rgba(255, 255, 255, 0.2)'
            }),
            stroke: new ol.style.Stroke({
              color: 'rgba(0, 0, 0, 0.5)',
              lineDash: [10, 10],
              width: 2
            }),
            image: new ol.style.Circle({
              radius: 5,
              stroke: new ol.style.Stroke({
                color: 'rgba(0, 0, 0, 0.7)'
              }),
              fill: new ol.style.Fill({
                color: 'rgba(255, 255, 255, 0.2)'
              })
            })
          })
        });
        map.addInteraction(draw);

        createMeasureTooltip();
        createHelpTooltip();

        var listener;
        draw.on('drawstart',
            function(evt) {
              // set sketch
              sketch = evt.feature;

              /** @type {ol.Coordinate|undefined} */
              var tooltipCoord = evt.coordinate;

              listener = sketch.getGeometry().on('change', function(evt) {
                var geom = evt.target;
                var output;

                if (geom instanceof ol.geom.Polygon) {
                  output = formatArea(geom);
                  tooltipCoord = geom.getInteriorPoint().getCoordinates();
                } else if (geom instanceof ol.geom.LineString) {
                  output = formatLength(geom);
                  tooltipCoord = geom.getLastCoordinate();

                }
                measureTooltipElement.innerHTML = output;
                measureTooltip.setPosition(tooltipCoord);
              });
            }, this);

        draw.on('drawend',
            function() {
              measureTooltipElement.className = 'tooltip tooltip-static';
              measureTooltip.setOffset([0, -7]);
              // unset sketch
              sketch = null;
              // unset tooltip so that a new one can be created
              measureTooltipElement = null;
              createMeasureTooltip();
              ol.Observable.unByKey(listener);
            }, this);
      }


      /**
       * Creates a new help tooltip
       */
      function createHelpTooltip() {
        if (helpTooltipElement) {
          helpTooltipElement.parentNode.removeChild(helpTooltipElement);
        }
        helpTooltipElement = document.createElement('div');
        helpTooltipElement.className = 'tooltip d-none';
        helpTooltip = new ol.Overlay({
          element: helpTooltipElement,
          offset: [15, 0],
          positioning: 'center-left'
        });
        map.addOverlay(helpTooltip);
      }


      /**
       * Creates a new measure tooltip
       */
      function createMeasureTooltip() {
        if (measureTooltipElement) {
          measureTooltipElement.parentNode.removeChild(measureTooltipElement);
        }
        measureTooltipElement = document.createElement('div');
        measureTooltipElement.className = 'tooltip tooltip-measure';
        measureTooltip = new ol.Overlay({
          element: measureTooltipElement,
          offset: [0, -15],
          positioning: 'bottom-center'
        });
        map.addOverlay(measureTooltip);
      }


      /**
       * Let user change the geometry type.
       */
      typeSelect.on("change",function(){
         map.removeInteraction(draw);
         highlightLayerSource.clear('');
         source.clear();
         $(".tooltip").addClass("d-none")
          $(".tooltip-static").remove();
         addInteraction();

      })

     addInteraction();
   
}

