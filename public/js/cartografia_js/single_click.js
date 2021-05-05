// Evento de click en el mapa		
map.on('singleclick', function(evt) {

    $(".btn-generar").addClass("d-none");
    
    /*=================
    SI HACE CLICK SOBRE LA PARCELA SIN NUNGÚN MÓDULO ACTIVADO
    ====================*/
    if (moduloActivado == "NINGUNO") {
    
        var Info = new Array();
            Info[0] =Capas[2].getGetFeatureInfoUrl(
                evt.coordinate, view.getResolution(), view.getProjection(), { 'INFO_FORMAT': 'application/json' });           
     

         $.ajax({
                    url: Info[0],
                    jsonpCallback: 'getJson',
                    success: function(data) {
                                  
                        if (data.features[0] != undefined) {

                                if(data.features[0].properties.nomenc21 != null){

                                    Nom = data.features[0].properties.nomenc21.slice(0, 20);
                                    datosPoligono ={"features": data.features};

                                    /*=========================
                                    BUSCO LA PARCELA CLICKEADO
                                    =========================== */
                                    searchMapNomencla(Nom); 

                                    /*=========================
                                    REMARCO LA PARCELA CLICKEADO
                                    =========================== */
                                    
                                    dibujarPoligono(datosPoligono);

                                }else{

                                    html = "";

                                    html = html +'<div class="col-sm-12 bg-dark text-light ">\
																<label><h6 class="mt-2 font-weight-bold">Nomenclatura</h6></label>\
															</div>\
															<div class="col-sm-12 bg-dark text-light ">\
																<label><h6 class="mt-2 font-weight-bold"><u>NO POSEE NOMENCLATURA</u></h6></label>\
															</div>';

                                    html = html + '</div>';
										
                                    SwalAlertHtml(data.mensaje,html,"top-end");
                                    datosPoligono = data;
                                    dibujarPoligono(datosPoligono);
        
                                }

                        }
                    },
                    error: function() {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'Ocurrió un error',
                                    showConfirmButton: false,
                                    timer: 1800
                                })
                                
                    }
                });

    }

});




