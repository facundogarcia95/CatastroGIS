/*=====================================
ABRIR MODAL CON LAS OPCIONES DEL MODULO DE BARRIOS
======================================*/
$(".moduloBarrios").on("click",function(){


   if (TileWMStotal[5].getVisible()) {

      visibleCapa = ' <div class="col-12 mb-2">\
                           <a onclick="leyendaBarrio(this)" class="btn font-weight-bold bg-dark wrn-btn text-light rounded w-100 f-15"><i class="fa fa-times"></i> OCULTAR BARRIOS</a>\
                        </div>';                       
   }else{

      visibleCapa = '<div class="col-12 mb-2">\
                     <a onclick="leyendaBarrio(this)" class="btn font-weight-bold bg-dark wrn-btn text-light rounded w-100 f-15"><i class="fa fa-check"></i> VISUALIZAR BARRIOS</a>\
                  </div>';
   }

   HTML = '<div class="row">\
                  '+visibleCapa+'\
                  <div class="col-12 mb-2">\
                     <a onclick="gestionBarrios()" class="btn font-weight-bold bg-catastro wrn-btn text-light rounded w-100 f-15"><i class="fa fa-edit"></i> GESTION BARRIOS</a>\
                  </div>\
                  <div class="col-12 mb-2">\
                     <a onclick="actualizarBarriosDissolve()" class="btn font-weight-bold bg-dark wrn-btn text-light rounded w-100 f-15"><i class="fa fa-refresh"></i> REFRESCAR BARRIOS</a>\
                  </div>\
                  <div class="col-12 mb-2">\
                     <a href="'+URLBASE+'/listadoBarrios" target="blank_" class="btn font-weight-bold bg-dark wrn-btn text-light rounded w-100 f-15"><i class="fa fa-file"></i> LISTADO PDF BARRIOS</a>\
                  </div>\
            </div>';
  
         //imageUrl: './img/logo_las_heras.png',
         Swal.fire({
            position: 'top-end',
            backdrop: false,
            allowOutsideClick: false,
            title: 'MÓDULO DE BARRIOS',
            width:'auto',
            html: HTML,
            showCloseButton: true,
            showCancelButton: true,
            cancelButtonText: "Cerrar",
            showConfirmButton: false,
            onClose: () => {
               highlightLayerSource.clear('');
               source.clear();
               map.removeInteraction(draw);
               moduloActivado = "NINGUNO";
               }
            })

})


/*=====================================
ACTIVAR CAPA BARRIOS DISSOLVE Y EL ESTILO DE BARRIOS
======================================*/

function leyendaBarrio(boton){

   if (TileWMStotal[5].getVisible()) {

      $(boton).html('<i class="fa fa-check"></i> VISUALIZAR BARRIOS</a>')

      TileWMStotal[5].setVisible(false);

      let params = {
         LAYERS: EspacioTrabajo[2]+':' + Params[2],
         STYLES: 'las_heras_parcelas_pos'
     };
 

     TileWMStotal[2].getSource().updateParams(params);

   }else{

      $(boton).html('<i class="fa fa-times"></i> OCULTAR BARRIOS</a>')


      TileWMStotal[5].setVisible(true);

      let params = {
         LAYERS: EspacioTrabajo[2]+':' + Params[2],
         STYLES: 'barrios'
     };
 

     TileWMStotal[2].getSource().updateParams(params);
     TileWMStotal[2].setOpacity(0.65);


   }

}

/*=====================================
ABRIR MODAL PARA LA GESTION DE BARRIOS
======================================*/

function gestionBarrios(){

   
      HTML =   '<div class="row" style="overflow-x: auto !important; max-width: 500px;">\
                  <div class="col-12 mb-2">\
                     <a class="btn font-weight-bold bg-catastro wrn-btn text-light rounded w-100 f-15" data-toggle="modal" data-backdrop="false" data-target="#modalBuscarBarrio"><i class="fa fa-search"></i> BUSCAR BARRIOS</a>\
                  </div>\
                  <div class="col-12 mb-2">\
                     <a  class="btn font-weight-bold bg-catastro wrn-btn text-light rounded w-100 f-15" data-toggle="modal" data-backdrop="true" data-target="#modalAltaBarrio"><i class="fa fa-plus"></i> ALTA BARRIO</a>\
                  </div>\
                  <div class="col-12 mb-2">\
                     <a  class="btn font-weight-bold bg-catastro wrn-btn text-light rounded w-100 f-15" data-toggle="modal" data-backdrop="true" data-target="#modalBajaBarrio"><i class="fa fa-minus"></i> BAJA BARRIO</a>\
                  </div>\
                  <div class="col-12 mb-2">\
                     <a  class="btn font-weight-bold bg-catastro wrn-btn text-light rounded w-100 f-15" data-toggle="modal" data-backdrop="true" data-target="#modalModificacionBarrio"><i class="fa fa-edit"></i> MODIFICAR BARRIO</a>\
                  </div>\
                  <div class="col-12 mb-2">\
                     <a onclick="aviso_seleccion_parcela(), seleccion_parcelas()" class="btn font-weight-bold bg-catastro wrn-btn text-light rounded w-100 f-15" ><i class="fa fa-retweet"></i> ASIGNAR/QUITAR BARRIO</a>\
                  </div>\
                  <div class="col-12">\
                     <a href="jsonBarrios" class="btn font-weight-bold bg-catastro wrn-btn text-light rounded w-100 f-15"><i class="fa fa-file-code-o"></i> EXPORTAR JSON BARRIOS</a>\
                  </div>\
               </div>';
      //imageUrl: './img/logo_las_heras.png',
      Swal.fire({
      position: 'top-end',
      backdrop: true,
      title: 'MÓDULO DE BARRIOS',
      height: 'auto',
      width:'auto',
      html: HTML,
      showCloseButton: true,
      showCancelButton: true,
      cancelButtonText: "Cerrar",
      showConfirmButton: false,
      onClose: () => {
         highlightLayerSource.clear('');
         source.clear();
         map.removeInteraction(draw);
         $(".moduloBarrios").trigger("click");
         moduloActivado = "NINGUNO"
         }
      })

      autocompletarBarrios();

      moduloActivado = "BARRIOS";
      
      Seleccionsource.clear();//vacia el vector de datos
      if(Seleccionvector.length > 0){
         map.removeLayer(Seleccionvector);//quita el dibujo del mapa
      }
      map.removeInteraction(draw);
      map.removeInteraction(snap);
      highlightLayerSource.clear('');

}

/*=====================================
AL ABRIRSE/CERRARSE EL MODAL DE BUSQUEDA DE BARRIO
======================================*/

$('#modalBuscarBarrio').on('show.bs.modal', function (event) {
   swal.close();
   $("#formularioBusquedaBarrio")[0].reset();

});

$('#modalBuscarBarrio').on('hidden.bs.modal', function (event) {

   highlightLayerSource.clear('');
   source.clear();
   
   if(moduloActivado == "BARRIOS" || moduloActivado == "BUSCAR-BARRIO"){  
      gestionBarrios();
   }else{
      moduloActivado = "NINGUNO";

      if(reutilizarPunto){

          /*=========================
           BUSCO LA PARCELA CLICKEADA
            =========================== */
           searchMapNomencla(Nom); 

         /*=========================
            REMARCO LA PARCELA CLICKEADA
         =========================== */                           
         dibujarPoligono(datosPoligono);

         reutilizarPunto = false;
      }
     
   }


   $(".nombreBarrio").html("");
   $(".nombre_barrio").val("");
  
});


/*=====================================
AL ABRIRSE/CERRARSE EL MODAL DE ALTA DE BARRIO
======================================*/

$('#modalAltaBarrio').on('show.bs.modal', function (event) {
   swal.close();
   $("#formularioAltaBarrio")[0].reset();
});

$('#modalAltaBarrio').on('hidden.bs.modal', function (event) {

   if(moduloActivado == "BARRIOS")  
   gestionBarrios();

});

/*=====================================
AL ABRIRSE/CERRARSE EL MODAL DE BAJA DE BARRIO
======================================*/
$('#modalBajaBarrio').on('show.bs.modal', function (event) {
   swal.close();
   $("#formularioBajaBarrio")[0].reset();
   $(".bajaBarrio").addClass("d-none");

});

$('#modalBajaBarrio').on('hidden.bs.modal', function (event) {

   if(moduloActivado == "BARRIOS")  
   gestionBarrios();
   
   $(".nombreBarrio").html("");
   $(".nombre_barrio").val("");
   $(".barrio_id").val("");
   $("#formularioBajaBarrio")[0].reset();
   $(".bajaBarrio").addClass("d-none");

  
});



/*=====================================
AL ABRIRSE/CERRARSE EL MODAL DE MODIFICAR DE BARRIO
======================================*/
$('#modalModificacionBarrio').on('show.bs.modal', function (event) {
   swal.close();
   $("#formularioModificacionBarrio")[0].reset();
   $(".modificarBarrio").addClass("d-none");

});

$('#modalModificacionBarrio').on('hidden.bs.modal', function (event) {

   if(moduloActivado == "BARRIOS")  
   gestionBarrios();
   
   $(".nombre_barrio").val("");
   $(".barrio_id").val("");
   $("#formularioModificacionBarrio")[0].reset();
   $(".modificarBarrio").addClass("d-none");

});


/*=======================================
 AUTOCOMPLETADO DE BARRIOS
========================================= */

function  autocompletarBarrios(distrito_select = null){

   $.ajax({
      url: 'barriosAutocompletar',
      type: 'get',
      data: {"distrito":distrito_select},
      success: function(response) {

      console.log(response,distrito);

         $(".nombre_barrio").autocomplete({ 
            autoFocus: false,
            minLength: 2,
            source: response.barrios,
            open: function() {
                  setTimeout(function() {
                     $('.ui-autocomplete').css('z-index', 9999);
                  }, 0);
                  $(".ui-helper-hidden-accessible").css("display", "none");
            },
            select: function(event, ui) {
               
              distrito_seleccionado = ui.item.distrito_id;
           
               $(".barrio_id").val(ui.item.barrio_id);
                  if(moduloActivado != "BARRIOS-VER-PARCELA"){
                     barrioSeleccionado(ui.item.barrio_id)
                  }else{
                     verificarParcelasDelBarrio(ui.item.barrio_id, ui.item);
                  }


              
            }
         });

      },
      error: function(resp) {
         console.log(resp);
      }

   });

}


/*========================================
ENVIAR FORMULARIO BUSQUEDA DE BARRIO
======================================*/

$('#formularioBusquedaBarrio').on('submit', function(e){
   e.preventDefault();
   
   var btnBuscar = $(".btn_buscar");

	$.ajax({
      data: $(this).serialize(),
		type: $(this).attr("method"),
		url: $(this).attr("action"),
		beforeSend: function () {
			btnBuscar.html(' <i class="fa fa-search fa-2x"></i>  <b class="f-14">Buscando...</b>');
			btnBuscar.attr("disabled", "disabled");
		},
		complete: function (data) {
			btnBuscar.html(' <i class="fa fa-search fa-2x"></i> <b class="f-14">Buscar</b>');
			btnBuscar.removeAttr("disabled");
		},
		success: function (data) {
         html = "";
         $.each(data.barrios, function(idx, barrio) {

            nombre_del_barrio = nombreDelBarrio(barrio)
          
            html = html + '<div class="col-12"><button class="btn btn-danger btn-md rounded font-weight-bold w-100 m-1" onclick="barrioSeleccionado('+barrio.barrio_id+')">'+nombre_del_barrio+'</button></div>';
           $(".barriosEncontrados").html(html);
           $("#respuestaBusquedaBarrios").modal("show");

          });
			
		},
		error: function (data) {

			Swal.fire({
				position: 'center',
				type: 'error',
            title: 'Ups!',
            html: data.responseJSON.mensaje,
				showConfirmButton: false,
				timer: 3500
			 })

		}
   });
   
 });


 /*=========================================
   ZOOM BARRIO SELECCIONADO
 =========================================== */
 function zoomBarrio(barrio_id){
  
      $.ajax({
         type: "get",
         url: 'zoomBarrio',
         data: {
            _method:"get", 
            _token: $("meta[name='csrf-token']").attr("content"), 
            barrio_id: barrio_id, 
         },
         success: function (data) {

            Coorxx = data.center.xcent;
            Cooryy = data.center.ycent;
                        
            map.setView(new ol.View({
                  center: ol.proj.transform([Coorxx, Cooryy], 'EPSG:4326', 'EPSG:3857'),
                  zoom: data.zoom
            }));

          
            for (var i = 0; i < data.parcelas.features.length; i++) { //cargar listado en tabla
               
               if(data.parcelas.features[i] != null){
                  dibujarPoligono(data.parcelas.features[i]);
               }
            }

         },error: function(response){

            console.log(response);
            
            Swal.fire({
               position: 'center',
               type: 'error',
               title: 'Ups!',
               html: response.responseJSON.message,
               showConfirmButton: false,
               timer: 3500
             })

         }
      });

 }

/*========================================
LIMPIAR LOS BARRIOS ENCONTRADOS EN LA BUSQUEDA
======================================*/

$('#respuestaBusquedaBarrios').on('hidden.bs.modal', function (event) {
   $(".barriosEncontrados").html("");
});



/*========================================
TRAER DATOS DEL BARRIO SELECCIONADO
======================================*/

function barrioSeleccionado(id){

   $.ajax({
      type: "GET",
      url: 'buscarBarrio',
      data: {barrio_id: id},
      success: function (data) {
         $("#respuestaBusquedaBarrios").modal("hide")

         nombre_del_barrio = nombreDelBarrio(data.barrios[0]);

         $(".nombreBarrio").html('<h4 class="font-font-weight-bold mt-2 text-catastro">'+nombre_del_barrio+'</h4>');
         $(".bajaBarrio").removeClass("d-none");
         $(".modificarBarrio").removeClass("d-none");

         $.each(data.barrios[0], function(idx, dato) {
           $('.'+idx).val(dato);
         });

         /*=====================================================
            HACER ZOOM SOBRE BARRIOS SELECCIONADO
         =======================================================*/
         zoomBarrio(id)
      },
      error: function (data) {

			Swal.fire({
				position: 'center',
				type: 'error',
            title: 'Ha ocurrido un error',
            html: data.responseJSON.mensaje,
				showConfirmButton: false,
				timer: 3500
			 })

		}
   });



}


/*========================================
LIMPIAR FORMULARIOS DE BARRIOS
======================================*/
$(".limpiar_busqueda_barrio").on("click",function () {

   $("#formularioBusquedaBarrio")[0].reset();
   $("#formularioAltaBarrio")[0].reset();
   $("#formularioBajaBarrio")[0].reset();
   $("#formularioModificacionBarrio")[0].reset();

   $(".nombre_barrio").val("")
   $(".nombreBarrio").html("")   
});


/*========================================
DEVUELVE EL NOMBRE EN MAYOR JERARQUIA DEL BARRIO
======================================*/

function nombreDelBarrio(barrio){

   nombre_del_barrio = "";

   if( barrio.barrio_nombre != null){ 
      nombre_del_barrio = barrio.barrio_nombre + " - BARRIO" 
   }
   else if(barrio.barrio_loteo != null){ 
      nombre_del_barrio = barrio.barrio_loteo + " - LOTEO"
   }
   else{
       nombre_del_barrio = barrio.barrio_empresa + " - EMPRESA" 
   }

   return nombre_del_barrio;
}


/*=====================================================
MOSTRAR BARRIO SELECCIONADO AL HACER CLICK SOBRE EL MAPA
=======================================================*/

function mostrarBarrioClick(id,punto = false){
  
   moduloActivado = "BUSCAR-BARRIO";
   reutilizarPunto = punto;
   barrioSeleccionado(id);


   if (!$('#modalBuscarBarrio').is(':visible')) {
      $('#modalBuscarBarrio').modal({
         backdrop:false,
         show: true
      });
   }


}

/*=====================================================
AL SELLECCIONAR UNA EMPRESA EN ALTA/MODIFICACION
=======================================================*/

$(".id_empresa").on("change",function () {
   var denominacion = $('option:selected', this).attr('denominacion');
   $(".barrio_empresa").val(denominacion);
  })


/*=====================================================
ENVIAR FORMULARIO DE ALTA DE BARRIO
=======================================================*/

$('#formularioAltaBarrio').on('submit', function(e){
   e.preventDefault();
   
   var btnAlta = $(".btn_alta_barrio");

	$.ajax({
      data: $(this).serialize(),
		type: $(this).attr("method"),
		url: $(this).attr("action"),
		beforeSend: function () {
			btnAlta.html(' <i class="fa fa-plus"></i><b class="f-14">Generando...</b>');
			btnAlta.attr("disabled", "disabled");
		},
		complete: function (data) {
			btnAlta.html(' <i class="fa fa-plus"></i> <b class="f-14">Añadir</b>');
         btnAlta.removeAttr("disabled");
		},
		success: function (data) {

         $(".limpiar_busqueda_barrio").trigger("click")
         autocompletarBarrios();

         Swal.fire({
            title: data.mensaje,
            text: "¿Desea asignarle parcelas?",
            type: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Asignar',
            cancelButtonText: 'Cerrar',
          }).then((result) => {
  
            if (result.value) {

               /*=====================================================
                  ACTIVAR ASIGNAR PARCELAS AL BARRIO
               =======================================================*/
               $("#modalAltaBarrio").modal("hide");
               moduloActivado = "BARRIOS";
               aviso_seleccion_parcela();
               seleccion_parcelas();
               
            }
          })

			
		},
		error: function (data) {

			Swal.fire({
				position: 'center',
				type: 'error',
            title: data.responseJSON.mensaje,
				showConfirmButton: true,
				timer: 4200
			 })

      }
      
   });
   
 });



   /*=====================================================
   ENVIAR FORMULARIO DE BAJA DE BARRIO
   =======================================================*/

   $('#formularioBajaBarrio').on('submit', function(e){
   e.preventDefault();
   
   var btnBaja = $(".btn_baja_barrio");

	$.ajax({
      data: $(this).serialize(),
		type: $(this).attr("method"),
		url: $(this).attr("action"),
		beforeSend: function () {
			btnBaja.html(' <i class="fa fa-trash fa-2x"></i><b class="f-14">Eliminando...</b>');
			btnBaja.attr("disabled", "disabled");
		},
		complete: function (data) {
			btnBaja.html(' <i class="fa fa-trash fa-2x"></i> <b class="f-14">Eliminar</b>');
         btnBaja.removeAttr("disabled");
		},
		success: function (data) {

         /*========================
         REFRESCO EL PARCELARIO
         ========================== */
         refrescarCapa(TileWMStotal[2]);

         /*========================
         ACTUALIZO LA CAPA BARRIOS DISSOLVE
         ========================== */
         actualizarBarriosDissolve();

         autocompletarBarrios();
         $(".limpiar_busqueda_barrio").trigger("click")
         $(".bajaBarrio").addClass("d-none");
         
         Swal.fire({
				position: 'center',
				type: 'success',
            title: data.mensaje,
				showConfirmButton: true,
				timer: 3200
          })
          
		},
		error: function (data) {

         console.log(data.responseText);
         
			Swal.fire({
				position: 'center',
				type: 'error',
            title: data.responseJSON.mensaje,
				showConfirmButton: true,
				timer: 4200
			 })

      }
      
   });
   
 });


   /*=====================================================
   ENVIAR FORMULARIO DE MODIFICACION DE BARRIO
   =======================================================*/

   $('#formularioModificacionBarrio').on('submit', function(e){
      e.preventDefault();
      
      var btnModif = $(".btn_modificar_barrio");

      $.ajax({
         data: $(this).serialize(),
         type: $(this).attr("method"),
         url: $(this).attr("action"),
         beforeSend: function () {
            btnModif.html(' <i class="fa fa-edit fa-2x"></i><b class="f-14">Modificando...</b>');
            btnModif.attr("disabled", "disabled");
         },
         complete: function (data) {
            btnModif.html(' <i class="fa fa-edit fa-2x"></i> <b class="f-14">Modificar</b>');
            btnModif.removeAttr("disabled");
         },
         success: function (data) {
            
            console.log(data);

            autocompletarBarrios();
            $(".limpiar_busqueda_barrio").trigger("click")
            $(".modificarBarrio").addClass("d-none");
            
               Swal.fire({
                  position: 'center',
                  type: 'success',
                  html: data.mensaje,
                  showConfirmButton: true,
                  timer: 3200
               })
            
         },
         error: function (data) {

            console.log(data);
            Swal.fire({
               position: 'center',
               type: 'error',
               title: data.responseText.mensaje,
               showConfirmButton: true,
               timer: 4200
            })

         }
         
      });
      
   });


   /*=====================================================
   ASIGNAR/QUITAR PARCELAS
   =======================================================*/


         /*==========================================
         VENTANA DE AVISO DE SELECCION DE PARCELA
         ========================================== */

         function aviso_seleccion_parcela(){

                  swal.close();

                  moduloActivado = "ASIGNAR-BARRIO";

                  $("#modalModificacionBarrio").modal("hide");
                  $("#modalBuscarBarrio").modal("hide");
                  $("#modalAltaBarrio").modal("hide");
                  $("#modalBajaBarrio").modal("hide");


                  HTML =   '<div class="row">\
                              <div class="col-sm-12">\
                                <h6 class="text-primary">Realice dibujo sobre el mapa.</h6>\
                              </div>\
                           </div>';
                  //imageUrl: './img/logo_las_heras.png',
                  Swal.fire({
                     position: 'top-start',
                     backdrop: false,
                     title: 'SELECCION DE PARCELAS',
                     height: 'auto',
                     width: 'auto',
                     html: HTML,
                     showCancelButton: true,
                     cancelButtonText: "Cerrar",
                     showConfirmButton: false,
                     onClose: () => {
                        
                        if(moduloActivado == "BARRIOS")  
                           gestionBarrios();

                     }
                  }).then((result) => {
                        
                     if (result.dismiss == "cancel") {
                        Seleccionsource.clear();//vacia el vector de datos
                        map.removeLayer(Seleccionvector);//quita el dibujo del mapa
                        map.removeInteraction(draw);
                        map.removeInteraction(snap);
                        highlightLayerSource.clear('');       
                     }
                  })


                  /*=====================================
                     ACTIVO LA CAPA BARRIOS Y LOTEOS
                  =======================================*/

                  if (!TileWMStotal[5].getVisible()) {

                     TileWMStotal[5].setVisible(true);

                     let params = {
                        LAYERS: EspacioTrabajo[2]+':' + Params[2],
                        STYLES: 'barrios'
                    };
                
                    TileWMStotal[2].getSource().updateParams(params);
                    TileWMStotal[2].setOpacity(0.65);
               
                  }

         }
            
         /*=====================================================
         HABILITO LA SELECCION DE PARCELAS POR DIBUJO SOBRE EL MAPA
         =======================================================*/
         function seleccion_parcelas(){

            //Defino que el dibujo será un polígono
            draw = new ol.interaction.Draw({ //dibujo
               source: Seleccionsource, //para el objeto vector
               type: "Polygon",
               stopClick: true
            });

            snap = new ol.interaction.Snap({ source: Seleccionsource }); //intereccion snap

            //AL comenzar el dibujo
            draw.on('drawstart', function(event) { //limpia vector al inicial dibujo
               moduloActivado = "BARRIOS"
               parcelas_intersectadas = new Array();
               polygon = "";
               X = "";
               Y = "";
               latitud = "";
               longitud = "";
               Seleccionsource.clear(); //vacia el vector de datos
              // map.removeLayer(Seleccionvector); //quita el dibujo anterior del mapa
               highlightLayerSource.clear(''); // LIMPIO LAS PARCELAS MARCADAS
               highlightLayerSourceHover.clear(''); // LIMPIO LAS PARCELAS MARCADAS

            }, this);

            //Al finalizar el dibujo
            draw.on('drawend', function(event) { //al terminar dibujo
               let currentFeature = event.feature;
               let restOfFeats = Seleccionsource.getFeatures();
               let allFeats = restOfFeats.concat(currentFeature);
               let polygon_cant = allFeats.length;
               let polygon = currentFeature.getGeometry(); //originales
               let extent_polygon = polygon.getExtent(); //extent del poligono dibujado
               let polygon_transf = currentFeature.getGeometry().transform(src, dest); //tranformados
               let polygon_transf_coords = polygon_transf.getCoordinates(); //puntos marcados de dibujado
               let coordenada_click = ol.proj.transform(polygon_transf_coords[0][0], 'EPSG:4326', 'EPSG:3857');          
               
               distrito_intersectado(coordenada_click);

               poligono_puntos = new Array();
               for (var i = 0; i < polygon_transf_coords.length; i++) { //agrego cada punto dibujado al vector poligono_puntos
                  poligono_puntos.push(polygon_transf_coords[i]);
               }
               ventanaParcelasIntersectadas();
         });

         map.addInteraction(draw);
         map.addInteraction(snap);
         }


          /*=====================================================
         HABILITO LA SELECCION DE PARCELAS POR DIBUJO SOBRE EL MAPA
         =======================================================*/
         function ventanaParcelasIntersectadas(){

                  //----------------------dibujar poligono--------------------------------
                  polygon = new ol.geom.Polygon([poligono_puntos[0]]); //variable del poligono dibujado
                  polygon.transform(dest, src);
                  var feature = new ol.Feature(polygon);
                  Seleccionsource.addFeature(feature);
                  map.addLayer(Seleccionvector); //dibujo del tramo agregado al mapa
                  var lista_puntos = poligono_puntos[0];
                  var poligono = new Array();
                  poligono.push(lista_puntos);

                  if (moduloActivado == "BARRIOS") {


                     poligono_puntos = poligono_segun_dibujo(poligono); //buscar listado de parcelas que intersectan al poligono en formato geojson

                     geojson_parcelas = intersectar_con_parcelario(poligono_puntos);

                      if (geojson_parcelas.features.length > 0) {
                        
                         //datos de las parcelas
                         var elementos = geojson_parcelas.features;
                         
                         cargar_datos_parcela(elementos); //carga los datos en variables
                     }
             
                 } else if (moduloActivado == "MEJORAS") {
             
                    //geojson_mejoras = mejoras_segun_dibujo(poligono);
             
                    //comprobar_geojson_mejoras();
             
                 }
                  
         }


          /*=====================================================
         PARSELAS SELECCIONADAS POR EL DIBUJO REALIZADO SOBRE EL MAPA
         =======================================================*/

         function poligono_segun_dibujo(lista_puntos) {
            
            var geojson;

            var parametros = { 'lista_puntos': lista_puntos };
            $.ajax({
                data: parametros,
                url: 'generar_poligono',
                type: 'get',
                async: false,
                success: function(response) {

                  geojson = response.poligono;

                },error: function(response){
                   console.log(response)
                }
            });

           // datosDelDistrito(lista_puntos);
           return geojson;

        }


        /*=====================================================
         BUSCAR INTERSECCIÓN CON PARCELARIO SEGÚN EL POLIGONO
         =======================================================*/

         function intersectar_con_parcelario(poligono){
            
            var respuesta;
            var parametros = { 'poligono': poligono, 'tabla': Params[2], 'conexion': 'pgsql'};
            
            $.ajax({
               data: parametros,
               url: 'intersectar_poligono',
               type: 'get',
               async: false,

               success: function(response) {

                   respuesta =  response.parcelas;

               },error: function(response){

                  respuesta =  null;

               }
               
           });

           return respuesta;

        }

         /*=====================================================
         BUSCAR INTERSECCIÓN CON DISTRITO PRIMER COORDENADA 
         =======================================================*/

        function distrito_intersectado(coordenada){

          distrito_nombre = null;

            $.ajax({
                     url:Capas[7].getGetFeatureInfoUrl(coordenada, view.getResolution(), view.getProjection(), { 'INFO_FORMAT': 'application/json' }),
                     jsonpCallback: 'getJson',
                     async: false,
                     success: function(data) {
                        distrito_nombre = data.features[0].properties.nom_dist;
                  },
                  error: function(resp) {
                     console.log(resp);            
                  }
            });

            $.ajax({
               type: "get",
               url: 'buscarDistrito',
               data: {"parametro": "distrito_nombre","valor": distrito_nombre},
               async: false,
               success: function (response) {
   
                     distrito = response.distrito;
                     autocompletarBarrios();

               },error: function(resp) {

                  Swal.fire({
                     position: 'center',
                     type: 'error',
                     title: resp.responseJSON.mensaje,
                     showConfirmButton: false,
                     timer: 1800
                 })         

               }
            });

        }

      /*=====================================================
         ACTIVAR EL MODAL PARA LUEGO SETEARLE LAS PARCELAS INTERCEPTADAS
         =======================================================*/
         function modal_de_parcelas_interceptadas(){

               swal.close();

               HTML =  `<div class="row">
                           <div class="col-sm-12">
                              <div class="box-header with-border">
                              <div class="col-lg-12">
                                 <button type="button" class="btn btn-box-tool btn-secondary ml-1 text-light pull-right" data-toggle="collapse" data-target=".box-body" aria-expanded="true"><i class="fa fa-minus"></i></button>
                              </div>
                                 <h5 class="text-catastro text-text-uppercase">DISTRITO:</h3><h6 class="text-catastro text-text-uppercase">`+distrito_nombre+`</h6>
                                 <input type="hidden" id="distrito_intersectado" value="`+distrito.distrito_id+`">
                                 
                              </div>
                              <div class="box-body collapse show">
                                 <table class="table table-striped mb-2">
                                    <thead class="bg-catastro">
                                          <th class="text-center text-light font-weight-bold">ELEGIR BARRIO</th>
                                    </thead>
                                    <tbody>
                                       <tr><td>
                                       <input class="form-control nombre_barrio w-100">
                                       <input type="hidden" class="barrio_id" id="barrio_seleccionado">
                                       </td></tr>
                                    </tbody>
                                 </table>
                                 <table class="table table-striped">
                                    <thead class="bg-catastro">
                                          <th class="text-center text-light font-weight-bold">PARCELAS SELLECCIONADAS</th>
                                    </thead>
                                    <tbody id="parcelas_seleccionadas" style="max-height: 30vh; overflow-y: auto; display: inline-block;">
                                    </tbody>
                                 </table>
                                 <div class="col-12"><a class="btn btn-danger rounded w-100 text-light font-weight-bold" onclick="quitarBarrioParcelasSeleccionadas()">QUITAR BARRIO</a></div>
                              </div>
                           </div>
                        </div>`;
                     //imageUrl: './img/logo_las_heras.png',
                     Swal.fire({
                     position: 'top-start',
                     backdrop: false,
                     title: '',
                     height:'auto',
                     width:'auto',
                     html: HTML,
                     showCancelButton: true,
                     confirmButtonText: "Asignar",
                     cancelButtonText: "Cerrar",
                     preConfirm: () => {
                        if($('#barrio_seleccionado').val() == ""){
                              Swal.showValidationMessage(
                                 'Error: Debe asignar un barrio'
                              )
                           }else if(distrito_seleccionado != $('#distrito_intersectado').val()){
                              Swal.showValidationMessage(
                                 'Error: El barrio no pertenese al distrito.'
                              )
                           }
                        }
                        
                     }).then((result) => {
                        
                        if (result.dismiss == "cancel") {

                           Seleccionsource.clear();//vacia el vector de datos
                           map.removeLayer(Seleccionvector);//quita el dibujo del mapa
                           map.removeInteraction(draw);
                           map.removeInteraction(snap);
                           highlightLayerSource.clear('');
                           moduloActivado == "BARRIOS";
                           gestionBarrios();


                        }else if(result.value){

                           asignarBarrio();
                           
                        }
                  })

         }
      /*=====================================================
         OBTENGO LOS DATOS DE LAS PARCELAS INTERSECTADAS POR EL POLIGONO
         =======================================================*/
         
     function cargar_datos_parcela(listado_parcelas, accion = false) { //recibo los datos de ventanaParcelasIntersectadas()

      modal_de_parcelas_interceptadas();

         moduloActivado = "BARRIOS";

         for (var i = 0; i < listado_parcelas.length; i++) { //cargar listado en tabla
         
            if(listado_parcelas[i] != null){
               
               dibujarPoligono(listado_parcelas[i]); // ENVÍO POLIGO PARA QUE SEA DIBUJADO

               let propiedades = listado_parcelas[i].features[0].properties;
               let gid = propiedades['gid'];
               if(propiedades['nomenc21'] != null){
                  var nomenclatura = propiedades['nomenc21'];
                  var nomencla20 = propiedades['nomenc21'].substring(0,20);
               }else{
                  var nomenclatura = 'SIN NOMENCLATURA';
                  var nomencla20 = 'SIN NOMENCLATURA';
               }
               let barrio_id = propiedades['barrio_id'];
               let poligono = JSON.stringify(listado_parcelas[i]);

               if(!accion)
               parcelas_intersectadas.push({"gid":gid, "nomenclatura":nomenclatura, "estado": 1, "nomencla20":nomencla20, "barrio_id":barrio_id, "poligono":poligono});
               
            }
         }

         var string_parcelas = "";

         moduloActivado = "BARRIOS-VER-PARCELA";

         for (var i = 0; i < parcelas_intersectadas.length; i++) { //cargar listado en tabla
            
            var nomenclatura = parcelas_intersectadas[i].nomenclatura;
            
            if (parcelas_intersectadas[i].estado == 2) {
               
                  string_parcelas += "<tr>\
                                          <td><i class='fa fa-times text-danger '></i></td>\
                                          <td><label class='text-danger' style='cursor:pointer' hover='true' poligono='"+(parcelas_intersectadas[i].poligono)+"' onmouseover='dibujarPoligono(this)' onmouseout='cancelarDibujarPoligono(this)' >" + (nomenclatura.substr(0,16)) + "</label></td>\
                                          <td><button class='btn btn-success rounded btn-sm'  hover='true' poligono='"+(parcelas_intersectadas[i].poligono)+"' onmouseover='dibujarPoligono(this)' onmouseout='cancelarDibujarPoligono(this)' onclick='agregarNomenclaIndex(" + i + ",this)'>AGREGAR</button></td>\
                                       </tr>";
            } else {

                  string_parcelas += "<tr>\
                                          <td><i class='fa fa-check text-success'></i></td>\
                                          <td><label class='text-info' style='cursor:pointer' hover='true' poligono='"+(parcelas_intersectadas[i].poligono)+"' onmouseover='dibujarPoligono(this)'  onmouseout='cancelarDibujarPoligono(this)'> " +(nomenclatura.substr(0,16)) + "</label></td>\
                                          <td><button class='btn btn-danger rounded btn-sm'  hover='true' poligono='"+(parcelas_intersectadas[i].poligono)+"' onmouseover='dibujarPoligono(this)' onmouseout='cancelarDibujarPoligono(this)' onclick='eliminarNomenclaIndex(" + i + ",this)'>DESELECCIONAR</button></td>\
                                       </tr>";
            }

         }

        $("#parcelas_seleccionadas").html(string_parcelas);

   }

   /*=======================================
      QUITO LA MARCA EN ROJO SOBRE EL POLIGONO QUE ESTABA EN HOVER
   ===========================================*/

   function cancelarDibujarPoligono(elem){

         $(elem).attr('hover','false');

         dibujarPoligono(elem);
   }


   /*=======================================
      QUITO NOMENCLATURA DE LA LISTA DE ASIGNADAS PARA MODULO BARRIOS
   ===========================================*/

   function eliminarNomenclaIndex(index, elem) {

      geojson_parcelas.features[index] = null;
      highlightLayerSource.clear(''); // LIMPIO LAS PARCELAS MARCADAS
      highlightLayerSourceHover.clear(''); // LIMPIO LAS PARCELAS MARCADAS

      parcelas_intersectadas[index].estado = 2;
      $("#parcelas_seleccionadas").html("");
      cargar_datos_parcela(geojson_parcelas.features, true);

      autocompletarBarrios()

    
  }

  
   /*=======================================
      AGREGO NOMENCLATURA A LA LISTA DE ASIGNADAS PARA MODULO BARRIOS
   ===========================================*/
  
  function agregarNomenclaIndex(index,elem) {

      elem = JSON.parse($(elem).attr("poligono"));
      geojson_parcelas.features[index] = elem;

      highlightLayerSource.clear(''); // LIMPIO LAS PARCELAS MARCADAS
      highlightLayerSourceHover.clear(''); // LIMPIO LAS PARCELAS MARCADAS

      parcelas_intersectadas[index].estado = 1;
      $("#parcelas_seleccionadas").html("");
      cargar_datos_parcela(geojson_parcelas.features, true);
      autocompletarBarrios()


      
  }
  

  /*============================
	REFRESCAR CAPA ENVIADA POR PARAMETRO
=============================*/

function refrescarCapa(capa){
	
	var source = capa.getSource();
	var params = source.getParams();
	params.t = new Date().getMilliseconds();
	source.updateParams(params);

}

  /*==========================================
   ASIGNO BARRIO A LAS PARCELAS SELECCIONADAS
  ============================================= */
  function asignarBarrio(){

      barrioNoPreguntar = null;

      var barrio = $("#barrio_seleccionado").val();
      $.ajax({
         type: "post",
         url: 'asignarBarrio',
         data: {
               _method:"put", 
               _token: $("meta[name='csrf-token']").attr("content"), 
               barrio_id: barrio, 
               poligono: poligono_puntos,
               parcelas: parcelas_intersectadas
         }
         ,success: function (response) {
         
            actualizarDirecciones(barrio,parcelas_intersectadas);
            actualizarBarriosDissolve();
           
           Seleccionsource.clear();//vacia el vector de datos
           map.removeLayer(Seleccionvector);//quita el dibujo del mapa
           map.removeInteraction(draw);
           map.removeInteraction(snap);
           highlightLayerSource.clear('');

           refrescarCapa(TileWMStotal[2]);
           refrescarCapa(TileWMStotal[5]);

         },error: function(response){
           
            console.log(response);

            Swal.fire({
               position: 'center',
               type: 'error',
               title: response.responseJSON.message,
               showConfirmButton: true,
               timer: 2800
           })         

         }
      });
  }

  /*==================================
  QUITAR BARRIO PARCELAS SELECCIONADAS
  ==================================== */

  function quitarBarrioParcelasSeleccionadas() {

         $("#barrio_seleccionado").val(0);
         asignarBarrio();
   }

   /*==================================
  ACTUALIZAR DIRECCIONES BARRIO
  ==================================== */
   function actualizarDirecciones(barrio_id, parcelas){

         $.ajax({
            type: "post",
            url: 'actualizarDireccion',
            async: true,
            data: {
               _method:"put", 
               _token: $("meta[name='csrf-token']").attr("content"), 
               barrio_id: barrio_id, 
               parcelas: parcelas
            },
            success: function (response) {
               
               console.log(response);
            },error: function(response){
            
               console.log(response);

            }
         });
   }


  /*==================================
  ACTUALIZAR CAPA BARRIOS DISSOLVE 
  ==================================== */
   function actualizarBarriosDissolve(){

      if(moduloActivado == "NINGUNO"){
         swal.close();
      }
      

      $.ajax({
         type: "get",
         url: 'barriosDissolve',
         async: true,
         data: {
            _method:"get", 
            _token: $("meta[name='csrf-token']").attr("content")
         },
         success: function (response) {

            console.log(response);

            
           if(moduloActivado == "NINGUNO"){

               $(".moduloBarrios").trigger("click")
          

           }else{

              moduloActivado == "BARRIOS";
              gestionBarrios();
              

           }

         },error: function(response){

            Swal.fire({
               position: 'center',
               type: 'error',
               title: response.responseJSON.message,
               showConfirmButton: true,
               timer: 2800
            })         

         }
      });

   }


   /*==================================
      VERIFICO SI EL BARRIO A ASIGNAR YA TIENE PARCELAS.
   ===================================*/
   function verificarParcelasDelBarrio(id, item){


      if(barrioNoPreguntar != id){

      $.ajax({
         type: "GET",
         url: 'zoomBarrio',
         data: {barrio_id: id},
         success: function (response) {

            Swal.fire({
               title: "El Barrio tiene parcelas",
               text: "¿Desea posicionarse?",
               type: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Ir',
               cancelButtonText: 'No',
               closeOnClickOutside: false,
             }).then((result) => {
     
               if (result.value) {

                  Seleccionsource.clear();//vacia el vector de datos
                  map.removeLayer(Seleccionvector);//quita el dibujo del mapa
                  map.removeInteraction(draw);
                  map.removeInteraction(snap);
                  highlightLayerSource.clear('');
                  
                  zoomBarrio(id)
                  geojson_parcelas = null;
                  aviso_seleccion_parcela();
                  seleccion_parcelas();

               }else{

                  cargar_datos_parcela(geojson_parcelas.features);
                  
                  $(".nombre_barrio").val(item.label);
                  $("#barrio_seleccionado").val(id);

               }

               barrioNoPreguntar = id;
               
               

            });

         },error: function(response){

            barrioNoPreguntar = null;
            console.log(response);

         }
      });

      }
   }