
/*================
FUNCION QUE CALCULA EL EXTEND Y EL ZOOM A PARTIR DE LA NOMENCLATURA
==================*/

function searchMapNomencla(text) {

	html = "";
			console.log(text);

	$.ajax({
		type:'GET',
		url: URLBASE+'extendParcela',
		data:{nomencla : text},
		success:function(data) {

			if (data.success) {
	
						Coorxx = data.xy_parcela.xcent;
						Cooryy = data.xy_parcela.ycent;
						
						map.setView(new ol.View({
							center: ol.proj.transform([Coorxx, Cooryy], 'EPSG:4326', 'EPSG:3857'),
							zoom: map.getView().getZoom()
						}));


						if (PATH != "gestion/padron") {
							
							if(data.html != undefined){
								html = data.html;
							}
							barrio = "";
							rud = "";

									/*==============================
										SI TIENE BARRIO
									=============================== */

								if(data.barrio != null && data.barrio != 0){

									/*==============================
											SI EL MODAL DE LOS DATOS DEL BARRIO
											ESTÁ ACTIVADO, LO ACTUALIZO
										=============================== */
										if ($('#modalBuscarBarrio').is(':visible')) {
											barrioSeleccionado(data.barrio.barrio_id)
										}
										
										barrio = '<div class="col-sm-12 col-md-12 bg-dark text-light ">\
															<label><h6 class="mt-2 font-weight-bold">Barrio</h6></label>\
														</div>\
														<div class="col-sm-12 col-md-12 bg-dark">\
															<label onclick="mostrarBarrioClick('+data.barrio.barrio_id+',true)" style="cursor:pointer" ><h6 class="mt-2 font-weight-bold text-light"><u>'+nombreDelBarrio(data.barrio)+'</u></h6></label>\
														</div>';	
								}

								/*================================
									SI TIENE ETIQUETA EN EL RUD
								================================== */
								if(data.direccion_nomencla_rud_real != undefined){

									if(data.parcela.direccion_nomencla_rud_real != null){
										etiqueta = "'"+data.parcela.direccion_nomencla_rud_real+"'";

										rud = '<div class="col-sm-12 col-md-6 bg-secondary text-dark ">\
																<label><h6 class="mt-2 font-weight-bold">RUD</h6></label>\
															</div>\
															<div class="col-sm-12 col-md-6 bg-secondary">\
																<label onclick="irAlRud('+etiqueta+')" style="cursor:pointer" ><h6 class="mt-2 font-weight-bold text-dark"><u>'+data.parcela.direccion_nomencla_rud_real+'</u></h6></label>\
															</div>';	
									}
									
								}

							/*===============================================
								BUSCO LOS DATOS DE LA PARCELA SEGÚN EL PARÁMETRO
								================================================= */
							$.ajax({
								type: "GET",
								url:'parcelaPorParametro',
								data: {parametro: "parcela_nomenclatura",valor: data.nomenclatura},
								async: false,
								success: function (response) {

										if(response.success){

												html = html +'<div class="col-sm-12 col-md-6 bg-secondary text-dark ">\
																<label><h6 class="mt-2 font-weight-bold">Padron</h6></label>\
															</div>\
															<div class="col-sm-12 col-md-6 bg-secondary text-dark ">\
																<label><h6 class="mt-2 font-weight-bold"><a href="gestion/padron/'+response.parcela.parcela_id+'" class="text-dark" ><u>'+response.parcela.parcela_padron+'</u></a></h6></label>\
															</div>';
										}else{

											html = html + '<div class="col-sm-12 bg-dark text-light ">\
																	<label><h6 class="mt-2 font-weight-bold">Nomenclatura</h6></label>\
																</div>\
																<div class="col-sm-12 bg-dark text-light ">\
																	<label><h6 class="mt-2 font-weight-bold">'+data.nomenclatura+'</h6></label>\
																</div>';

											html = html + '<div class="col-sm-12  bg-secondary text-dark ">\
																	<label><h6 class="mt-2 font-weight-bold">Padrón</h6></label>\
																</div>\
																<div class="col-sm-12  bg-secondary text-dark ">\
																	<label><h6 class="mt-2 font-weight-bold"><u>No encontrado</u></h6></label>\
																</div>';
										}
								},error: function(response){
									console.log(response.responseText);
								}
							});

							html = html + barrio + rud + '</div>';
										
							SwalAlertHtml(data.mensaje,html,"top-end");

						}else{

							/*================
								VERIFICO QUE LA NOMENCLATURA SEA PROVISORIA Y CARGO LOS DATOS
							==================*/ 
								
							if(data.nomenclatura.substring(0,2) == FIJO_DEPARTAMENTO_PROVISORIO){
										
									$("#tipo_nomenclatura").val(2);
									$("#tipo_nomenclatura").trigger("change");
									$("#nomenclatura").val(data.nomenclatura);
									$(".parcela_distrito").val(data.nomenclatura.substring(2,4))
									$(".parcela_seccion").val(data.nomenclatura.substring(4,6))
									$(".parcela_manzana").val(data.nomenclatura.substring(6,10))
									$(".parcela_parcela").val(data.nomenclatura.substring(10,16))
									$(".parcela_subparcela").val(data.nomenclatura.substring(16,20))
									$(".parcela_dig_veri").val(data.nomenclatura.substring(20,21))
								
									arregloNomenclaProvisoria[1] = data.nomenclatura.substring(2,4);
									arregloNomenclaProvisoria[2] = data.nomenclatura.substring(4,6);
									arregloNomenclaProvisoria[3] = data.nomenclatura.substring(6,10);
									arregloNomenclaProvisoria[4] = data.nomenclatura.substring(10,16);
									arregloNomenclaProvisoria[5] = data.nomenclatura.substring(16,20);
									arregloNomenclaProvisoria[6] = data.nomenclatura.substring(20,21);

									$(".parcela_distrito").trigger("keyup");

							}

							/*===========================
								HACER AJAX PARA SABER SI LAS COORDENADAS ESTAN DENTRO DE LOS DATOS
							==============================*/
							else	if(data.nomenclatura.substring(0,2) == FIJO_DEPARTAMENTO && data.nomenclatura.substring(2,4) == FIJO_COORDENADA_X+'5' && data.nomenclatura.substring(9,11) == FIJO_COORDENADA_Y+'3'){
										
									var es_coordenada = null;
									
									$.ajax({
										type: "get",
										url: URLBASE+"es_coordenada",
										async: false,
										data: {
											coordenada_x: data.nomenclatura.substring(2,9),
											coordenada_y: data.nomenclatura.substring(9,16),
											_token: $("meta[name='csrf-token']").attr("content"), 
									  },success: function (response) {
										 
											es_coordenada = response.es_coordenada;

										},error: function (response) {
											console.log(response);
										}
									});

									if(es_coordenada != 0 && es_coordenada != null){

										$("#tipo_nomenclatura").val(3);
										$("#tipo_nomenclatura").trigger("change");
										$("#nomenclatura").val(data.nomenclatura);
										$(".parcela_x").val(data.nomenclatura.substring(3,9))
										$(".parcela_y").val(data.nomenclatura.substring(10,16))
										$(".parcela_subparcela").val(data.nomenclatura.substring(16,20))
										$(".parcela_dig_veri").val(data.nomenclatura.substring(20,21))
										
										arregloNomenclaPosicional[1] = data.nomenclatura.substring(3,9);
										arregloNomenclaPosicional[2] = data.nomenclatura.substring(10,16);
										arregloNomenclaPosicional[3] = data.nomenclatura.substring(16,20);
										arregloNomenclaPosicional[4] = data.nomenclatura.substring(20,21);

										$(".parcela_y").trigger("keyup");
									
									}else{

										const Toast = Swal.mixin({
											toast: true,
											position: 'top-end',
											showConfirmButton: false,
											timer: 11000,
											timerProgressBar: true,
											didOpen: (toast) => {
											  toast.addEventListener('mouseenter', Swal.stopTimer)
											  toast.addEventListener('mouseleave', Swal.resumeTimer)
											}
										 })
										 
										 Toast.fire({
											type: 'error',
											html: 'Las coordenadas en la nomenclatura caen fuera del departamento. <br/> Verifique que la nomenclatura correspondiente exista en el parcelario.'
										 })
									}

								}
							
							/*================
								VERIFICO QUE LA NOMENCLATURA SEA ANTIGUA
							==================*/ 
							else if (data.nomenclatura.substring(0,2) == FIJO_DEPARTAMENTO){
									
									$("#tipo_nomenclatura").val(1);
									$("#tipo_nomenclatura").trigger("change");
									$("#nomenclatura").val(data.nomenclatura);
									$(".parcela_distrito").val(data.nomenclatura.substring(2,4))
									$(".parcela_seccion").val(data.nomenclatura.substring(4,6))
									$(".parcela_manzana").val(data.nomenclatura.substring(6,10))
									$(".parcela_parcela").val(data.nomenclatura.substring(10,16))
									$(".parcela_subparcela").val(data.nomenclatura.substring(16,20))
									$(".parcela_dig_veri").val(data.nomenclatura.substring(20,21))
									
									arregloNomenclaDefinitiva[1] = data.nomenclatura.substring(2,4);
									arregloNomenclaDefinitiva[2] = data.nomenclatura.substring(4,6);
									arregloNomenclaDefinitiva[3] = data.nomenclatura.substring(6,10);
									arregloNomenclaDefinitiva[4] = data.nomenclatura.substring(10,16);
									arregloNomenclaDefinitiva[5] = data.nomenclatura.substring(16,20);
									arregloNomenclaDefinitiva[6] = data.nomenclatura.substring(20,21);

									$(".parcela_distrito").trigger("keyup");

							}
							
						}
					
			}

		},error: function(data){
			console.log(data);

			SwalAlertHtml(data.mensaje,"Lo sentimos, no hemos podido realizar la consulta.","top-end");
		}
	});

}


/*================
redireccionar al rud
==================*/

function irAlRud(valor){

	window.open('http://192.168.62.7/cartografia/gestion_direcciones/cartografia/?direccion_nomencla='+valor, '_blank');

}


/*================
FUNCION QUE REMARCA EN EL MAPA LA PARCELA CLICKEADA
==================*/

function dibujarPoligono(elem) {

	if(elem != undefined){

		let hover; //LO USO POR SI EN ALGÚN MODULO DEBO CAMBIAR EL COLOR AL HACER UN CAMBIO DE COLOR EN EL HOVER
		let label; //LO USO PARA EL MODULO DE ASIGNAR EN BARRIOS
		
		if(moduloActivado == "NINGUNO" ){
			//LIMPIO SI HAY UN POLIGONO MARCADO
			highlightLayerSource.clear('');
		}
		
		if(moduloActivado == "BARRIOS-VER-PARCELA"){
			
			label = elem;
			hover = JSON.parse($(elem).attr("hover"));
			elem = JSON.parse($(elem).attr("poligono"))
		}
		
		coord= [];
		
		
		
		if(elem.features[0].geometry != null){
			
			for(i=0; i < elem.features[0].geometry.coordinates[0][0].length; i++){
				
				Coorx =  elem.features[0].geometry.coordinates[0][0][i][0];
				Coory = elem.features[0].geometry.coordinates[0][0][i][1];
				coord.push([Coorx, Coory]);
				
			}
			
			var thing = new ol.geom.Polygon([coord]);
			var featurething = new ol.Feature({
				geometry: thing
			});
			
			
			
			if(moduloActivado == "BARRIOS-VER-PARCELA" && hover){
				
				highlightLayerSourceHover.addFeature(featurething);
				
				/*  ESTO HACE ZOOM SOBRE LA PARCELA SELECCIONADA EN BARRIOS
						LO DEJO COMENTADO PORQUE VISUALMENTE QUE CABIARA EL EXTENT 
						NO ERA AGRADABLE.

						var extent = highlightLayerSourceHover.getExtent();
						map.getView().fit(extent,  map.getSize());
				
				*/
				
				
			}else if(moduloActivado == "BARRIOS-VER-PARCELA" && !hover){
				
				$(label).attr('hover','true')
				highlightLayerSourceHover.clear('');
				
			}else{
				
				highlightLayerSource.addFeature(featurething);
				
				var extent = highlightLayerSource.getExtent();
				
				map.getView().fit(extent,  map.getSize());
				
			}
			
			
		}
	}
}
	
	
	/*================
	FUNCION QUE GENERA VENTANA DE ALERTA
	==================*/
	
function SwalAlertHtml(title, html, position){

	swal.close();
//imageUrl: './img/logo_las_heras.png',
	Swal.fire({
		position: position,
		backdrop: false,
		title: title,
		width: 'auto',
		height:'max-height: 500px',
		html: html,
		showCancelButton: true,
		cancelButtonText: "Cerrar",
		showConfirmButton: false,
		onClose: () => {
			map.removeInteraction(draw);
			$(".tooltip").remove()
			highlightLayerSource.clear('');
			source.clear();
			$('#modalBuscarBarrio').modal("hide");

		}
  }).then((result) => {

	if (result.dismiss == "cancel") {

		if(moduloActivado == "BARRIOS-ASIGNAR"){
			ventanaParcelasIntersectadas();

		}else{
			moduloActivado = "NINGUNO";
		}

	}
})

}



/*==========================
VISUALIZAR LISTADO DE LEYENDAS / PUNTOS DE INTERES
=============================*/

$(".leyendas").on("click",function(){

	HTML = '<ul class="sub-menu">';

	$.ajax({
		type: "GET",
		url: "capas_cartografia",
		async: false,
		data: {
			 _token: $("meta[name='csrf-token']").attr("content"),
			 grupo: true 
		},
		success: function (response) {

			capas_tabla = response.capas;
			grupoanterior = '';

				for (let i = 0; i < capas_tabla.length; i++) {
					
						if(grupoanterior != capas_tabla[i].grupo && grupoanterior != ""){
							if(capas_tabla[i].nombre_visible != ""){
								HTML = HTML + '</div><li  class="bg-catastro"><a class="text-light" data-toggle="collapse" data-parent="#accordion" href="#collapse'+capas_tabla[i].nombre+'"><i class="fa text-light fa-id-card-o"></i> '+capas_tabla[i].grupo+' <i id="collapse'+capas_tabla[i].nombre+'Icon" class="collapseIconFlecha fa fa-angle-right text-light "></i></a></li>\
										  <div class="collapse collapseNavbarFlecha" id="collapse'+capas_tabla[i].nombre+'">';
							}
						}else if(grupoanterior == ""){
							if(capas_tabla[i].nombre_visible != ""){
								HTML = HTML + '<li  class="bg-catastro"><a class="text-light" data-toggle="collapse" data-parent="#accordion" href="#collapse'+capas_tabla[i].nombre+'"><i class="fa text-light fa-id-card-o"></i> '+capas_tabla[i].grupo+' <i id="collapse'+capas_tabla[i].nombre+'Icon" class="collapseIconFlecha fa fa-angle-right text-light "></i></a></li>\
										  <div class="collapse collapseNavbarFlecha" id="collapse'+capas_tabla[i].nombre+'">';
							}
						}

						if(TileWMStotal[capas_tabla[i].orden].getVisible()){
							if(capas_tabla[i].nombre_visible != ""){
							HTML = HTML + '<li onclick="activarCapa(this)" class="bg-blue"><a class="text-light font-weight-bold"  numeroCapa="'+capas_tabla[i].orden+'" > '+capas_tabla[i].nombre_visible+'</a></li>';
							}
						}else{
							if(capas_tabla[i].nombre_visible != ""){
								HTML = HTML + '<li onclick="activarCapa(this)"><a class="text-light font-weight-bold"  numeroCapa="'+capas_tabla[i].orden+'" > '+capas_tabla[i].nombre_visible+'</a></li>';
							}
						}

						grupoanterior = capas_tabla[i].grupo;
					
				}
				
				
				HTML = HTML +'</ul></nav></div>';
				

			}

		});
	
				//imageUrl: './img/logo_las_heras.png',
				Swal.fire({
					position: 'top-start',
					backdrop: false,
					title: 'VISUALIZAR CAPAS',
					
					width:'100%',
					html: HTML,
					showCloseButton: true,
					showCancelButton: true,
					cancelButtonText: "Cerrar",
					showConfirmButton: false,
					onClose: () => {
						highlightLayerSource.clear('');
						source.clear();
					}
			})

});

/*==========================
ACTIVAR LEYENDAS / PUNTOS DE INTERES
=============================*/

function activarCapa(elemento){

		numero = $(elemento).children().attr("numeroCapa"); // Se usa para trae datos del POI en otra función.


		if (TileWMStotal[numero].getVisible()) {

				TileWMStotal[numero].setVisible(false);

				
					if( TileWMStotal[numero].getSource().f.LAYERS != undefined && TileWMStotal[numero].getSource().f.LAYERS.split(':')[1] == "barrios_dissolve"){
						let params = {
							LAYERS: EspacioTrabajo[2]+':' + Params[2],
							STYLES: 'gllen_parcelas_pos'
						  };
			
						  TileWMStotal[2].getSource().updateParams(params);
					
					}else if(TileWMStotal[numero].getSource().c.LAYERS != undefined && TileWMStotal[numero].getSource().c.LAYERS.split(':')[1] == "barrios_dissolve"){
							let params = {
								LAYERS: EspacioTrabajo[2]+':' + Params[2],
								STYLES: 'gllen_parcelas_pos'
							};
					
							TileWMStotal[2].getSource().updateParams(params);

					}	
				
				$(elemento).removeClass("bg-blue");

				
		} else {

				TileWMStotal[numero].setVisible(true);

				if(TileWMStotal[numero].getSource().f.LAYERS != undefined){

						if(TileWMStotal[numero].getSource().f.LAYERS.split(':')[1] == "barrios_dissolve"){
							let params = {
								LAYERS: EspacioTrabajo[2]+':' + Params[2],
								STYLES: 'barrios'
							};
					
							TileWMStotal[2].getSource().updateParams(params);
						}

				}else{

					if(TileWMStotal[numero].getSource().c.LAYERS != undefined){

						if(TileWMStotal[numero].getSource().c.LAYERS.split(':')[1] == "barrios_dissolve"){
							let params = {
								LAYERS: EspacioTrabajo[2]+':' + Params[2],
								STYLES: 'barrios'
							};
					
							TileWMStotal[2].getSource().updateParams(params);
						}

					}

				}

				$(elemento).addClass("bg-blue");

		}

}

/*============================
AL AMPLIAR O CONTRAER LA BARRA DE MENU
===============================*/

$(".brand-minimizer").click(function () {

	ancho = $(".ol-unselectable").parent().width() + 150;
	alto = $(".ol-unselectable").parent().height();
	map.setSize([ancho,alto]);
	
})


/*============================
TRAER EXTENCION DE LA NOMENCLATURA
==============================*/

function get_elem_parcela(where){

	moduloActivado = "REPORTE" ;
				
	$.ajax({
		type:'POST',
		url: URLBASE+'get_elem_parcela',
		data:{condicion : where, '_token': $('input[name=_token]').val()},
		success:function(data) {	
			data.respuesta.features.forEach(parcela => {
				dibujarPoligono(parcela)
			});
			$("#map").removeClass("animacion")
		},error: function(data){
			console.log(data);
		}
	});

}