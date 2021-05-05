
var map;
var view;
var highlightLayer;
var highlightLayerSource;
var jsonSource;
var totalDesglose;
var tipoDeDesglose;
var nomenclaADesglosar;
var nam;
var selected = null;
var parcelas;
var sourceParcelas;
var valCol;
var trabajo_pendiente;
var uid;
/*
var dependenciaBack = "";
var distritoBack = "";
var seccionBack = "";
var manzanaBack = "";
var parcelaBack = "";
var subparcelaBack = "";
var dependenciaBackDis = "";
var distritoBackDis = "";
var seccionBackDis = "";
var manzanaBackDis = "";
var parcelaBackDis = "";
var subparcelaBackDis = "";
var dependenciaBackBgcolor = "";
var distritoBackBgcolor = "";
var seccionBackBgcolor = "";
var manzanaBackBgcolor = "";
var parcelaBackBgcolor = "";
var subparcelaBackBgcolor = "";*/

// Carga completa
$( document ).ready(function() {
   $('#map').hide();
   $('#busqueda').hide();
   $('#completarDatosDesglose').hide();
   $('#resumenFinal').hide();
	map.on('click', permitirClickearPoligono);
   
   var loc = window.location.pathname;
   uid = CCGetParam('uid');
   //var encrypted = CryptoJS.AES.encrypt(uid,'gisuser').toString();
   //console.log(decodeURI(CCGetParam('uid')));
   //console.log(encrypted);
   //uid = CryptoJS.AES.decrypt(decodeURI(CCGetParam('uid')),'gisuser').toString(CryptoJS.enc.Utf8);
   //console.log(uid);
   if(loc.includes("desglose")){
		cargarPendientes(1, "DESGLOSE",uid);
   }
   if(loc.includes("union")){
		cargarPendientes(1, "UNION",uid);
		// Habilito click para uniones
		$('#confirmarUnion').hide();
		$('#cancelarUnion').hide();
   }
	
	// Cambio el puntero
	map.on("pointermove", function (evt) {
		var hit = this.forEachLayerAtPixel(evt.pixel, function(feature, layer) {
			return true;
		}); 
		if (hit) {
			this.getTargetElement().style.cursor = 'pointer';
		} else {
			this.getTargetElement().style.cursor = '';
		}
	});
   
	// Habilito mouse over poligonos resaltados
	map.on('pointermove', resaltarHover);
	
	// Disparo evento cada vez que cambian los hijos de parcelasAUnir
	// Mostrar boton confirmar en union
	if(document.getElementById("parcelasAUnir")){
		var observer = new MutationObserver(function(e) {mostrarConfirmarUnion();});
		observer.observe($('#parcelasAUnir')[0], {characterData: true, childList: true});
	}
});

function alerta(titulo, mensaje){
	$("<div id='dialogobasealerta'><font color='black'><b>"+mensaje+"</b></font></div>").dialog({
		title: titulo,
		resizable: false,
		modal: true,
		position: {at: "center center-75", of: window},
		buttons: {
			'Cerrar': function()  {
				$( this ).dialog( 'close' );
			}
		}
	});
}

function confirmar(mensaje){
	$("<div id='dialogobaseconfirmar'><font color='black'><b>"+mensaje+"</b></font></div>").dialog({
		title: "CONFIRMA",
		resizable: false,
		modal: true,
		  buttons : {
			"Confirmar" : function() {
				return true;
				$(this).dialog("close");
			},
			"Cerrar" : function() {
				return false;
				$(this).dialog("close");			  
			}
		  }
    });
}

function openNav() {
  document.getElementById("panelIzquierdo").style.width = "350px";
}

function closeNav() {
  document.getElementById("panelIzquierdo").style.width = "0";
}
/*
function includeJs(jsFilePath) {
    var js = document.createElement("script");
    js.type = "text/javascript";
    js.src = jsFilePath;
    document.body.appendChild(js);
}
*/
function CCGetParam(strParamName) {
  var strReturn = "";
  var strHref = window.location.href;
  if ( strHref.indexOf("?") > -1 ) {
    var strQueryString = strHref.substr(strHref.indexOf("?")).toLowerCase();
    var aQueryString = strQueryString.split("&");
    for ( var iParam = 0; iParam < aQueryString.length; iParam++ ) {
      if (aQueryString[iParam].indexOf(strParamName.toLowerCase() + "=") > -1 ) {
        var aParam = aQueryString[iParam].split("=");
        strReturn = aParam[1];
        break;
      }
    }
  }
  return strReturn;
}

function cargarPendientes(bol, pag, uid){
   // Trabajo pendiente
   $.getJSON('./trabajo_pendiente.php?uid='+uid, function (data) {
	   trabajo_pendiente = data;
	   var desglose_pendiente = data.operacion_desglose.sucess;
	   var union_pendiente = data.operacion_union.sucess;	   
		// Si no tiene pendientes permito desglosar
		if(desglose_pendiente == 0 && union_pendiente == 0){
			$('#busqueda').show();
			$('#map').show();
		}else{ // Si tiene pendientes
		   if(desglose_pendiente == 1 && union_pendiente == 1){
			   // Si tiene ambos, revisar BD
			   alerta("AVISO","El usuario posee UNION y DESGLOSE pendientes, revisar bd.");
		   }else{
				// Si es desglose pendiente
				if(desglose_pendiente){
					if(pag == "DESGLOSE"){							
						if(bol){
						   alerta("AVISO","El usuario posee un DESGLOSE pendiente.<br>Finalizar el trabajo para continuar.");						   
						}
						completarDatosDesglose(data.operacion_desglose);
					}
					if(pag == "UNION"){
						window.location.href = "./desglose.php?uid="+uid;
					}
				}
				// Si es union pendiente
				if(union_pendiente){
					if(pag == "DESGLOSE"){							
						window.location.href = "./union.php?uid="+uid;
					}
					if(pag == "UNION"){
						if(bol){
						   alerta("AVISO","El usuario posee una UNION pendiente.<br>Finalizar el trabajo para continuar.");
						}
						datosADibujar(data.operacion_union);
						$('#completarDatosUnion').show();
						$('#busqueda').show();
						$('#map').show();
					}
				}		   
		   }
		}
	   
   })	
}


var estiloHighlight = function(feature, resolution){
	return new ol.style.Style({
					fill: new ol.style.Fill({
						color: 'rgba(0,61,93,0.6)'
					  }),
					stroke: new ol.style.Stroke({
						color: '#003D5D',
						width: 2
					  }),
					text: new ol.style.Text({
							text: feature.get('nombre'),
							baseline: "Middle",
							font: '16px Verdana',
							weight: "bold",
							fill: new ol.style.Fill({ color: '#003D5D' }),
							stroke: new ol.style.Stroke({ color: '#FFFF00', width: 2 }),
							overflow: true
						})
				});
} 
							
var hoverStyle = function(feature, resolution){
	return new ol.style.Style({
					fill: new ol.style.Fill({
						color: 'rgba(92,73,3,0.6)'
					  }),
					stroke: new ol.style.Stroke({
						color: '#5c4903',
						width: 2
					  }),
					text: new ol.style.Text({
							text: feature.get('nombre'),
							baseline: "Middle",
							font: '16px Verdana',
							weight: "bold",
							fill: new ol.style.Fill({ color: '#5c4903' }),
							stroke: new ol.style.Stroke({ color: '#5c4903', width: 2 }),
							overflow: true
						})
				});
} 
							
							
							
// Cargo datos en evento de autocompletar inicial
$( function() {
	$( "#tags" ).autocomplete({
            source:function(request,response){
                $.ajax({
                    url:"./autocomplete_nomencla.php",
                    type:"GET",
                    dataType:"json",
                    data:{
                        'nomencla': request.term,
						'uid': uid
                    },
                    success:function(data){
                        response(data);
                    }
                })
            },
			select: function( event, ui ) {
				$('#confNom').show();
				$('#canNom').show();
			}
	});
} );


// Habilitar boton para validacion de nomenclatura
function valid(){
	if($("#tags").val().length > 6 || $("#tags").val().length == 0){
		if($("#tags").val().length < 20){
			$('#confNom').hide();
			$('#canNom').hide();
		}else{
			$('#confNom').show();
			$('#canNom').show();
		}
	}else{
		$('#confNom').show();
		$('#canNom').show();		
	}
}


// Evento de validacion de nomenclatura
// Afecta poligonos resaltados y agrega temporales
function validarNomenclatura(val, request){
	// Tipo de operacion
	if(val == 2){
		operacion = "U";
	}else{
		operacion = "D";
	}
	// Si no viene el parametro, tomo el valor del input
	if(!request){
		var request = $("#tags").val();		
	}
	
	// Si son menos de 7 digitos busco por padron
	var padron = '';
	if(request.length < 7){
		padron = request;
		nomencla = '';
	}else{
		nomencla = request;
	}
	
	// TRIN
	request = request.trim();
	$.ajax({
		url:"./buscar_nomenclatura.php",
		type:"POST",
		dataType:"json",
		data:{
			'nomencla': nomencla,
			'operacion': operacion,
			'padron': padron,
			'uid': uid
		},
		success:function(data){
			nomenclaADesglosar = '';
			console.log(data);
			// Segun el estado
			if(data.estado == "OK"){
				
				// Guardo nomenclatura en variable
				nomenclaADesglosar = data.datos[0].nomenc21;
				// Dibujo las parcelas
				// Permito hacer operacion
				if(operacion == 'D'){
					dibujarParcelas(nomenclaADesglosar, operacion, 1);
					desglose(parseInt(data.mensaje));
					
				}
				if(operacion == 'U'){
					// Valido colindantes
					var col = validarColindantes(data.datos[0].nomenc21);
					if(col){
						// Agrego temporal
						var parcela_id = data.datos[0].parcela_id;
						var el = document.getElementById(parcela_id);
						
						// Si ya existe la parcela, doy la opcion de eliminarla, sino la agrego
						if(el){
							eliminarParAUnir(el);							
						}else{
							agregarUnionTemporal(data, nomenclaADesglosar);
						}
						
					}else{
						alerta("AVISO","Parcelas no colindantes");
					}
				}
				
				
			}else if(data.estado == "ERROR"){
				if(operacion == 'D'){
					highlightLayerSource.clear(); // Vacia el vector de datos
					map.removeLayer(highlightLayer); // Quita el dibujo del mapa
					limpiar();
				}
				console.log(1);
				alerta(data.estado, data.mensaje);
				if(data.mensaje == "Sin session de usuario"){
					location.reload();
				}
				//document.getElementById("map").style.display = "none";
			}
		},
		error: function(data){
			console.log(data);
		}
	})
}

// Validacion simple de nomenclatura
function validarNomenclaturaUnica(nomenclatura, nam){

	if(!nomenclatura){
		nomenclatura = document.getElementById("dependenciaUnion").value + document.getElementById("distritoUnion").value + document.getElementById("seccionUnion").value + document.getElementById("manzanaUnion").value + document.getElementById("parcelaUnion").value + document.getElementById("subparcelaUnion").value ;
	}
	$.ajax({
		url:"./nomenclaturaUnica.php",
		type:"POST",
		async: false,
		dataType:"json",
		data:{
			'parcela_nomencla': nomenclatura,
			'tipo_nomenclatura': 'definitiva',
			'uid': uid
		},
		success:function(data){
			console.log(nomenclatura);
			console.log(data);
			if(data == 1){
				if(document.getElementById("nuevaNomenclaturaDiv")){
					document.getElementById("nuevaNomenclaturaDiv").setAttribute("confirmarvalue",1);					
				}
				if(document.getElementById("nuevaNomenclaturaDiv")){
					document.getElementById("validacionNomenclaUnion").style.display = "block";
					document.getElementById("validacionNomenclaUnion").src = "./imgs/ok.png";
				}
				// Desglose
				if(document.getElementById("validacion" + nam)){
					document.getElementById("validacion" + nam).src = "./imgs/ok.png";
					document.getElementById("validacion" + nam).setAttribute("confirmarvalue", 1);
				}
			}else{
				console.log(document.getElementById("tipo_nomenclatura_union").value);
				if(document.getElementById("tipo_nomenclatura_union").value == "Provisoria"){

					document.getElementById("validacionNomenclaUnion").style.display = "block";
						document.getElementById("validacionNomenclaUnion").src = "./imgs/ok.png";
				}else{

					if(document.getElementById("nuevaNomenclaturaDiv")){
						document.getElementById("nuevaNomenclaturaDiv").setAttribute("confirmarvalue",0);					
					}
					if(document.getElementById("nuevaNomenclaturaDiv")){
						document.getElementById("validacionNomenclaUnion").style.display = "block";
						document.getElementById("validacionNomenclaUnion").src = "./imgs/no.png";
					}
					// Desglose
					if(document.getElementById("validacion" + nam)){
						document.getElementById("validacion" + nam).src = "./imgs/ok.png";
						document.getElementById("validacion" + nam).setAttribute("confirmarvalue", 1);
					}

				}
			}
		},
		error: function(data){
			console.log(data);
		}
	})
}

function dibujarParcelas(nomenclatura, operacion, z, d) {
	//console.log(nomenclatura);
	$.ajax({
		url: '../webserviceog_gllen/?nomencla20=' + nomenclatura,
		dataType: 'json',
		success: function(data) {
			if (data.success == 1) {
				
				if(operacion == 'D'){
					// Dibujar parcelas seleccionadas
					highlightLayerSource.clear(); // Vacia el vector de datos
					
					// Quita el dibujo del mapa si es desglose
					map.removeLayer(highlightLayer); 		
					
					// Agrupo todos los features del json en un array para agregar al source
					console.log(data);
					var features = [];
					for(i = 0; i < data.data.length; i++){				
						var dibujo = data.data[0].polygon[0].features[i];
						var features2 = (new ol.format.GeoJSON()).readFeatures( dibujo ,{featureProjection: 'EPSG:3857'});
						features[i] = features2[0];
					}
					// Asigno los features al source			
					highlightLayerSource = new ol.source.Vector({
						features: features
					});

					// Asigno el source a la capa
					highlightLayer = new ol.layer.Vector({
						id: 'vectorLayer',
						source: highlightLayerSource,
						style: estiloHighlight
					});
					
					// Asigno la capa al mapa
					map.addLayer(highlightLayer);

					// Zoom
					if(z){
						zoom();					
					}
				}
				
				if(operacion == 'U'){
					// Quita el dibujo del mapa si es desglose
					map.removeLayer(highlightLayer);
					// Agrupo todos los features del json en un array para agregar al source
					var features = [];
					if(highlightLayer.getSource()){
						var sourceExistente = highlightLayer.getSource();
						if(sourceExistente){
							features = sourceExistente.getFeatures();						
						}
					}
					for(i = 0; i < data.data.length; i++){				
						var dibujo = data.data[0].polygon[0].features[i];
						var features2 = (new ol.format.GeoJSON()).readFeatures( dibujo ,{featureProjection: 'EPSG:3857'});
						features.push(features2[0]);
					}
					// Asigno los features al source			
					highlightLayerSource = new ol.source.Vector({
						features: features
					});

					// Asigno el source a la capa
					highlightLayer = new ol.layer.Vector({
						id: 'vectorLayer',
						source: highlightLayerSource,
						style: estiloHighlight
					});

					// Asigno la capa al mapa
					map.addLayer(highlightLayer);
					
					// Zoom
					if(z){
						zoom();
					}
					
					// Cargo datos en cliente solo si dibuja correctamente
					union(d);
				}
				
				
				// Zoom
				function zoom(){
					view.animate(
						{duration: 2500}, 
						function(){
							view.fit(
								highlightLayer.getSource().getExtent(),/*,  
								map.getSize(), */
								{padding : [30, 30, 30, 30], duration: 2500}
							);
						}
					);
				}
			} else {
				//alert("Consulta no encontrada dibujarParcelas()");
				alerta("AVISO","No se puede dibujar esta parcela. " + data.error_msg);
			}

		},
		error: function(data) {
			console.log(data.responseText);
		}
	});
}

function desdibujarParcela(obj){
				// Limpio capa
				map.removeLayer(highlightLayer);
				
				// Agrupo todos los features en un array
				var features = [];
				if(highlightLayer.getSource()){
					var sourceExistente = highlightLayer.getSource();
					if(sourceExistente){
						features = sourceExistente.getFeatures();						
					}
				}
				
				// Hago un for para seleccionar el mismo elemento que me envian
				// Elimino dicho elemento
				for(i = 0; i < features.length; i++){
					if(features[i].values_.nomenc21.substring(0, 20) == obj.getAttribute("data-value").substring(0, 20)){
						// Si el elemento que se elimina se encuentra en el dibujo, lo elimino
						features = jQuery.grep(features, function(value) {
						  return value != features[i];
						});
					}
				}
				
				// Asigno los features al source			
				highlightLayerSource = new ol.source.Vector({
					features: features
				});

				// Asigno el source a la capa
				highlightLayer = new ol.layer.Vector({
					id: 'vectorLayer',
					source: highlightLayerSource,
					style: estiloHighlight
				});

				// Asigno la capa al mapa
				map.addLayer(highlightLayer);
}


function limpiar(can){
	$( "#tipoDesglose" ).html('');
	$(' #cantidad ').prop('readonly', true);
	$( "#cantidad" ).val('');
	$( "#desglose" ).hide();
	nomenclaADesglosar = '';
	if(can){
		$( "#tags" ).val('');
		$('#confNom').hide();
		$('#canNom').hide();
		// Zoom
		var loc = window.location.pathname;
		if(loc.includes("desglose")){
			highlightLayerSource.clear(); // Vacia el vector de datos
			map.removeLayer(highlightLayer); // Quita el dibujo del mapa si es desglose			
		}
	}
	
	// Limpio la tabla de parcelas a unir
	/*if(document.getElementById('parcelasAUnir')){
		document.getElementById('parcelasAUnir').innerHTML = '';		
	}*/
}

// Corroboro que todos los desgloses sean PH o no lo sean
function validarTipoDesglose(datos){
	var phInicial = datos[0].PH;
	for(var i = 0; i < datos.length; i++){
		if(phInicial != datos[i].PH){
			return 0;
		}
	}
	return 1;
}

function validarTipoUnion(datos){
	//console.log(datos);
}

// Hover poligono
function resaltarHover(e){
	if (selected !== null) {
		selected.setStyle(undefined);
		selected = null;
	}else{
		document.body.style.cursor = "default";
		// Vuelvo registros al background normal
		var divs = document.getElementsByName("divsDesgloses");
		for(var i = 0; i < divs.length; i++){
			divs[i].style.backgroundColor = "#FFFFFF";		
		}	
	}
	
	// Remuevo el elemento resaltado en la lista si el mouse no esta encima de un feature
	var loc = window.location.pathname;
	if(loc.includes("union")){
		var divs = document.getElementById("parcelasAUnir");
		for(var i = 0; i < divs.childElementCount; i++){
			divs.childNodes[i].classList.remove("hovSel");			
		}
	}
			
	map.forEachFeatureAtPixel(e.pixel, function(f) {
		selected = f;
		f.setStyle(hoverStyle);
			
		var loc = window.location.pathname;
			
		// Pinto el registro del poligono en el que se encuentra el mouse
		if(loc.includes("desglose")){			
			var divs = document.getElementsByName("divsDesgloses");
			for(var i = 0; i < divs.length; i++){
				if(f.values_.subindice == divs[i].id ){
					divs[i].style.backgroundColor = "#DF8482";						
				}else{
					divs[i].style.backgroundColor = "#FFFFFF";						
				}
			}
			return true;
		}
		
		if(loc.includes("union")){
			var divs = document.getElementById("parcelasAUnir");
			for(var i = 0; i < divs.childElementCount; i++){				
				if(f.values_.nomenc21.substring(0, 20) == divs.childNodes[i].getAttribute("data-value").substring(0, 20)){
					divs.childNodes[i].classList.add("hovSel");						
				}else{
					divs.childNodes[i].classList.remove("hovSel");						
				}		
			}
			return true;
		}
		
	});	
}


// Añado el evento en el mapa de seleccion (hover)
/*function permitirSeleccionarPoligono(e) {
	if (selected !== null) {
		selected.setStyle(undefined);
		selected = null;
	}else{
		document.body.style.cursor = "default";
	}

	map.forEachFeatureAtPixel(e.pixel, function(f) {
		selected = f;
		f.setStyle(hoverStyle);
		document.body.style.cursor = "pointer";
		return true;
	});
	
	//if (selected) {
	//	alert(123);
	//} else {
	//	alert(456);
	//}
}
*/

// Añado el evento en el mapa de click sobre poligonos
function permitirClickearPoligono(e) {
	
	// Para seleccionar sobre los features (poligonos resaltados)
	/*var poligonoSeleccionado = map.forEachFeatureAtPixel(e.pixel, function(f) {
		return f;
	});	
	if(poligonoSeleccionado){
		console.log(poligonoSeleccionado.values_);		
	}*/
	
	// Para seleccionar sobre las parcelas
	map.forEachLayerAtPixel(e.pixel, function(layer) {
		if(layer){
			if(layer.values_){
				if(layer.values_.source){
					if(layer.values_.source.params_){
						if(layer.values_.source.params_){
							if(layer.values_.source.params_.LAYERS){
								if(layer.values_.source.params_.LAYERS == 'catastro:las_heras_parcelas_pos'){
									var Info = sourceParcelas.getGetFeatureInfoUrl( e.coordinate, view.getResolution(), view.getProjection(), {'INFO_FORMAT': 'application/json'});
									$.ajax({
										url: Info,
										jsonpCallback: 'getJson',
										success: function(response) {	
											var loc = window.location.pathname;										
											if(loc.includes("union")){
												validarNomenclatura(2, response.features[0].properties.nomenc21);												
											}
											if(loc.includes("desglose")){
												validarNomenclatura(1, response.features[0].properties.nomenc21);												
											}
										},
										error: function(response) {								
											console.log("error, permitirClickearPoligono()");
										}
									})
									//var a = layer.getSource();
									//console.log(a.getAttributions());									
								}							
							}
						}
					}
				}
			}
		}
		
    });
	
	/*var poligonoSeleccionado = map.forEachFeatureAtPixel(e.pixel, function(f) {
		return f;
	});	
	if(poligonoSeleccionado){
		console.log(poligonoSeleccionado.values_);		
	}*/	
	
}

// Resalto el poligono por nomenclatura y subindice en caso de tenerlo
function resaltarPoligono(nomenclatura, subindice, el){
	nomenclatura = nomenclatura.toString();
	if(el){
		el.style.backgroundColor = "#DF8482";		
	}
	if(subindice){
		highlightLayer.getSource().forEachFeature(function(features) {
			if(subindice == features.values_.subindice){
				features.setStyle(hoverStyle);
			}
		});
	}else{
		highlightLayer.getSource().forEachFeature(function(features) {
			if(features){				
				if(features.values_){
					if(nomenclatura.substring(0, 20) == features.values_.nomenc21.substring(0, 20)){
						features.setStyle(hoverStyle);
					}else{
						console.log(1);
					}
				}
			}
		});
	}
}

function quitarResaltado(el){
	highlightLayer.getSource().forEachFeature(function(features) {
		features.setStyle(estiloHighlight);						
	});
	if(el){
		el.style.backgroundColor = "#FFFFFF";		
	}
}


function nomProvisoria(elem){
	var name = elem.name;
	//var name = elem.name = "tipo_nomenclatura_id";
	var elem = elem.options[elem.selectedIndex];
	if(elem.value == "Provisoria"){
		// Si clickea el checkbox guardo los datos y armo nomenclatura provisoria
		// Guardar datos
		$(elem.parentElement.parentElement.children.dependencia).slideUp(500);
		$(elem.parentElement.parentElement.children.distrito).slideUp(500);
		$(elem.parentElement.parentElement.children.seccion).slideUp(500);
		$(elem.parentElement.parentElement.children.manzana).slideUp(500);
		$(elem.parentElement.parentElement.children.parcela).slideUp(500);
		$(elem.parentElement.parentElement.children.parcelaX).slideUp(500);
		$(elem.parentElement.parentElement.children.parcelaY).slideUp(500);
		$(elem.parentElement.parentElement.children.subparcela).slideUp(500);
		// Oculto primer imagen
		$(elem.parentElement.getElementsByTagName('img')[0]).slideUp(500);
		// Actualizo tabla temporal
		actualizarTemporalRegistro('tipo_nomenclatura_id', name, 2);
		// Permito confirmar union 
		if(document.getElementById("validacionNomenclaUnion")){
			document.getElementById("validacionNomenclaUnion").src = "./imgs/ok.png";				
		}
		/*var v = "validacion" + name;
		var velem = document.getElementById(v);
		console.log(velem);
		if(velem){
			velem.src = "./imgs/ok.png";				
		}		
		console.log(velem.src);*/
	}
	if(elem.value == "Antigua"){
		//console.log(1);
		$(elem.parentElement.parentElement.children.dependencia).slideDown(500);
		$(elem.parentElement.parentElement.children.distrito).slideDown(500);
		$(elem.parentElement.parentElement.children.seccion).slideDown(500);
		$(elem.parentElement.parentElement.children.manzana).slideDown(500);
		$(elem.parentElement.parentElement.children.parcela).slideDown(500);
		$(elem.parentElement.parentElement.children.parcelaX).slideUp(500);
		$(elem.parentElement.parentElement.children.parcelaY).slideUp(500);
		$(elem.parentElement.parentElement.children.subparcela).slideDown(500);		
		// Muestro primer imagen
		$(elem.parentElement.getElementsByTagName('img')[0]).slideDown(500);
		// Actualizo tabla temporal
		actualizarTemporalRegistro('tipo_nomenclatura_id', name, 1);
		// No permito confirmar  
		nuevaNomenclaturaDiv = document.getElementById("dependencia").value.padStart(2,'0') + document.getElementById("distrito").value.padStart(2,'0') + document.getElementById("seccion").value.padStart(2,'0') + document.getElementById("manzana").value.padStart(2,'0') + document.getElementById("parcela").value.padStart(6,'0') + document.getElementById("subparcela").value.padStart(4,'0') ;		
		validarNomenclaturaUnica(nuevaNomenclaturaDiv, name);
	}
	if(elem.value == "Posicional"){
		//console.log(1);
		$(elem.parentElement.parentElement.children.dependencia).slideDown(500);
		$(elem.parentElement.parentElement.children.distrito).slideUp(500);
		$(elem.parentElement.parentElement.children.seccion).slideUp(500);
		$(elem.parentElement.parentElement.children.manzana).slideUp(500);
		$(elem.parentElement.parentElement.children.parcela).slideUp(500);
		$(elem.parentElement.parentElement.children.parcelaX).slideDown(500);
		$(elem.parentElement.parentElement.children.parcelaY).slideDown(500);
		$(elem.parentElement.parentElement.children.subparcela).slideDown(500);		
		// Muestro primer imagen
		$(elem.parentElement.getElementsByTagName('img')[0]).slideDown(500);
		// Actualizo tabla temporal
		actualizarTemporalRegistro('tipo_nomenclatura_id', name, 3);
		// No permito confirmar  
		nuevaNomenclaturaDiv = document.getElementById("dependencia").value + document.getElementById("parcelaX").value.padStart(7,'0') + document.getElementById("parcelaY").value.padStart(7,'0') + document.getElementById("subparcela").value ;		
		validarNomenclaturaUnica(nuevaNomenclaturaDiv, name);		
	}
	
	
}


// Actualizo al momento los datos
function actualizarTemporalRegistro(nombreCampo, id, value){
	var url = "./actualizar_temporal_registro.php";
	$.ajax({
		url:url,
		type:"POST",
		data:{
			'nombreCampo':nombreCampo,
			'valor':value,
			'union_desglose_id':id,
			'uid': uid
			},
		dataType:"json",
		success:function(data){
			// Cada vez que actualizado un registro corroboro que todas las nomenclaturas sean unica
			nomenclaturasUnicas();
			// Cada vez que actualizado un registro actualizo los listbox de las mejoras
			actualizarListboxes(id);
		},
		error: function(data){
			console.log("Error al actualizar nomenclatura");
			console.log(data.responseText);
		}
	})
}

function nomProvisoriaUnion(elem){

	var elem = elem.options[elem.selectedIndex];
	if(elem.value == "Provisoria"){
		// Si clickea el checkbox guardo los datos y armo nomenclatura provisoria
		// Guardar datos
		$(elem.parentElement.parentElement.children.dependenciaUnion).slideUp(500);
		$(elem.parentElement.parentElement.children.distritoUnion).slideUp(500);
		$(elem.parentElement.parentElement.children.seccionUnion).slideUp(500);
		$(elem.parentElement.parentElement.children.manzanaUnion).slideUp(500);
		$(elem.parentElement.parentElement.children.parcelaUnion).slideUp(500);
		$(elem.parentElement.parentElement.children.parcelaX).slideUp(500);
		$(elem.parentElement.parentElement.children.parcelaY).slideUp(500);
		$(elem.parentElement.parentElement.children.subparcelaUnion).slideUp(500);
		// Oculto primer imagen
		$(elem.parentElement.getElementsByTagName('img')[0]).slideUp(500);
		// Actualizo tabla temporal
		actualizarTemporalRegistro('tipo_nomenclatura_id', 'TODO', 2);
		// Permito confirmar union 
		document.getElementById("nuevaNomenclaturaDiv").setAttribute("confirmarvalue",1);
		document.getElementById("validacionNomenclaUnion").src = "./imgs/ok.png";		
	}else{
		if(elem.value == "Antigua"){
			$(elem.parentElement.parentElement.children.dependenciaUnion).slideDown(500);
			$(elem.parentElement.parentElement.children.distritoUnion).slideDown(500);
			$(elem.parentElement.parentElement.children.seccionUnion).slideDown(500);
			$(elem.parentElement.parentElement.children.manzanaUnion).slideDown(500);
			$(elem.parentElement.parentElement.children.parcelaUnion).slideDown(500);
			$(elem.parentElement.parentElement.children.parcelaX).slideUp(500);
			$(elem.parentElement.parentElement.children.parcelaY).slideUp(500);
			$(elem.parentElement.parentElement.children.subparcelaUnion).slideDown(500);		
			// Muestro primer imagen
			$(elem.parentElement.getElementsByTagName('img')[0]).slideDown(500);
			// Actualizo tabla temporal
			actualizarTemporalRegistro('tipo_nomenclatura_id', 'TODO', 1);
			// No permito confirmar union 
			document.getElementById("nuevaNomenclaturaDiv").setAttribute("confirmarvalue",0);	
			nuevaNomenclaturaDiv = document.getElementById("dependenciaUnion").value.padStart(2,'0') + document.getElementById("distritoUnion").value.padStart(2,'0') + document.getElementById("seccionUnion").value.padStart(2,'0') + document.getElementById("manzanaUnion").value.padStart(2,'0') + document.getElementById("parcelaUnion").value.padStart(6,'0') + document.getElementById("subparcelaUnion").value.padStart(4,'0') ;		
			validarNomenclaturaUnica(nuevaNomenclaturaDiv);
		}else{
			if(elem.value == "Posicional"){
				$(elem.parentElement.parentElement.children.dependenciaUnion).slideDown(500);
				$(elem.parentElement.parentElement.children.distritoUnion).slideUp(500);
				$(elem.parentElement.parentElement.children.seccionUnion).slideUp(500);
				$(elem.parentElement.parentElement.children.manzanaUnion).slideUp(500);
				$(elem.parentElement.parentElement.children.parcelaUnion).slideUp(500);
				$(elem.parentElement.parentElement.children.parcelaX).slideDown(500);
				$(elem.parentElement.parentElement.children.parcelaY).slideDown(500);
				$(elem.parentElement.parentElement.children.subparcelaUnion).slideDown(500);		
				// Muestro primer imagen
				$(elem.parentElement.getElementsByTagName('img')[0]).slideDown(500);
				// Actualizo tabla temporal
				actualizarTemporalRegistro('tipo_nomenclatura_id', 'TODO', 3);
				// No permito confirmar union 
				document.getElementById("nuevaNomenclaturaDiv").setAttribute("confirmarvalue",0);
				nuevaNomenclaturaDiv = document.getElementById("dependenciaUnion").value + document.getElementById("parcelaX").value.padStart(7,'0') + document.getElementById("parcelaY").value.padStart(7,'0') + document.getElementById("subparcelaUnion").value ;		
				validarNomenclaturaUnica(nuevaNomenclaturaDiv);		
			}else{
				document.getElementById("validacionNomenclaUnion").src = "./imgs/ok.png";
				document.getElementById("nuevaNomenclaturaDiv").setAttribute("confirmarvalue",1);
			}
		}
	}
	/*return;
	if(elem.checked){
		// Si clickea el checkbox guardo los datos y armo nomenclatura provisoria
		// Guardar datos
		$(elem.parentElement.children.dependenciaUnion).slideUp(500);
		$(elem.parentElement.children.distritoUnion).slideUp(500);
		$(elem.parentElement.children.seccionUnion).slideUp(500);
		$(elem.parentElement.children.manzanaUnion).slideUp(500);
		$(elem.parentElement.children.parcelaUnion).slideUp(500);
		$(elem.parentElement.children.subparcelaUnion).slideUp(500);
		// Oculto primer imagen
		$(elem.parentElement.getElementsByTagName('img')[0]).slideUp(500);
		// Actualizo tabla temporal
		actualizarTemporalRegistro('tipo_nomenclatura_id', 'TODO', 2);
		// Permito confirmar union 
		document.getElementById("nuevaNomenclaturaDiv").setAttribute("confirmarvalue",1);
	}else{
		$(elem.parentElement.children.dependenciaUnion).slideDown(500);
		$(elem.parentElement.children.distritoUnion).slideDown(500);
		$(elem.parentElement.children.seccionUnion).slideDown(500);
		$(elem.parentElement.children.manzanaUnion).slideDown(500);
		$(elem.parentElement.children.parcelaUnion).slideDown(500);
		$(elem.parentElement.children.subparcelaUnion).slideDown(500);		
		// Muestro primer imagen
		$(elem.parentElement.getElementsByTagName('img')[0]).slideDown(500);
		// Actualizo tabla temporal
		actualizarTemporalRegistro('tipo_nomenclatura_id', 'TODO', 1);
		// No permito confirmar union 
		document.getElementById("nuevaNomenclaturaDiv").setAttribute("confirmarvalue",0);
	}*/
}

// Si la nomnclatura es unica permito actualizar
/*function nomenclaturaUnica(nom, id){
	var url = "./nomenclaturaUnica.php?direccion_nomencla=" + nom;
	$.ajax({
		url:url,
		type:"POST",
		dataType:"json",
		success:function(data){
			if(data){
				document.getElementById("validacion" + id).src = "./imgs/ok.png";
			}else{
				document.getElementById("validacion" + id).src = "./imgs/no.png";
			}
		},
		error:function(data){
			console.log("error");
		}
	})
}*/

// Funcion que corrobora que todas las nomenclaturas temporales
// escritas sean validas y unicas
function nomenclaturasUnicas(){

	var divs = document.getElementsByName("divsDesgloses");

	for(var i = 0; i < divs.length; i++){
		var nom = '';
		var p = '';
		var nam = '';
		var c = '';
		
		var n = divs[i].children[0].name;
		var selectNomenclaADesglosar = document.getElementById("select"+n);
		var nameNomenclaADesglosar = selectNomenclaADesglosar.options[selectNomenclaADesglosar.selectedIndex].value;
		
		nam = divs[i].children[0].name;
		console.log(nameNomenclaADesglosar);
		switch(nameNomenclaADesglosar) {
		  case 'Antigua':
			nom = divs[i].children[0].value + divs[i].children[1].value + divs[i].children[2].value + divs[i].children[3].value + divs[i].children[4].value + divs[i].children[7].value;
			break;
		  case 'Provisoria':
			//nom = '';
			nom = divs[i].children[0].value + divs[i].children[1].value + divs[i].children[2].value + divs[i].children[3].value + divs[i].children[4].value + divs[i].children[7].value;
			break;		  
		  case 'Posicional':
			nom = divs[i].children[0].value + divs[i].children[5].value + divs[i].children[6].value + divs[i].children[7].value;
			break;
		  default:
			console.log("Error nomenclaturasUnicas()"); 
		}
		
		var url = "./nomenclaturaUnica.php";
		nameNomenclaADesglosar = nameNomenclaADesglosar.toLowerCase();
		console.log(nameNomenclaADesglosar);
		$.ajax({
			url:url,
			type:"POST",
			async: false,
			dataType:"json",
			data:{
				'parcela_nomencla': nom,
				'tipo_nomenclatura': nameNomenclaADesglosar,
				'uid': uid
			},
			success:function(data){
				console.log(nom);
				console.log(data);
				document.getElementById("validacion" + nam).style.display = "";
				if(data || nameNomenclaADesglosar == "provisoria"){
					if(document.getElementById("validacion" + nam)){
						document.getElementById("validacion" + nam).src = "./imgs/ok.png";
						document.getElementById("validacion" + nam).setAttribute("confirmarvalue", 1);
					}
				}else{
					if(document.getElementById("validacion" + nam)){
						document.getElementById("validacion" + nam).src = "./imgs/no.png";					
						document.getElementById("validacion" + nam).setAttribute("confirmarvalue", 0);
					}
				}
			},
			error: function(data){
				console.log(data);
			}
		});	
	}

}	

// Actualizo los listboxes de las mejoras en caso de existir
function actualizarListboxes(id){
	var listboxesMejoras = document.getElementsByClassName("listboxMejora");
	if(listboxesMejoras){
		var divs = document.getElementsByName("divsDesgloses");
		for(var i = 0; i < listboxesMejoras.length; i++){
			var nom = '';
			var opciones = '';
			// Guardo seleccionados
			var selected = listboxesMejoras[i].options[listboxesMejoras[i].selectedIndex].value;			
			for(var j = 0; j < divs.length; j++){
				union_desglose_id = divs[j].children[0].name;
				nom = divs[j].children[0].value + divs[j].children[1].value + divs[j].children[2].value + divs[j].children[3].value + divs[j].children[4].value + divs[j].children[5].value;
				var union_desglose_id_tmp = '';
				
				// Tipo de nomenclatura segun checkbox
				// Si es provisoria, cambio la opcion del select
				if (divs[j].children[8].type && divs[j].children[8].type === 'checkbox' && divs[j].children[8].checked) {
					var numDesglose = (j+1);
					nom = "NOMENCLATURA PROVISORIA " + numDesglose;
				}
				// El que coincide con el seleccionado previamente lo dejo como selected
				if(union_desglose_id == selected ){
					opciones += "<option selected value='"+union_desglose_id+"'>"+nom+"</option>";
				}else{
					opciones += "<option value='"+union_desglose_id+"'>"+nom+"</option>";		
				}
			}
			listboxesMejoras[i].innerHTML = opciones;
			listboxesMejoras[i].onchange = function(){act_mej_temp(this);};
		}
	}
}

// Actualizo el listbox de los barrios
function actualizarListboxesBarrios(){
	var url = "./listadoBarrios.php";
	$.ajax({
		url:url,
		type:"POST",
		dataType:"json",
		async: false,
		success:function(data){
			// Devuelve listado total de barrios
			var opciones = "<option selected value='0'>SIN BARRIO</option>";
			for(var i = 0; i < data.length; i++){
				opciones += "<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";												
			}
			document.getElementById("barrios").innerHTML = opciones;
		},
		error: function(data){
			console.log("Error al traer listado de barrios");
		}
	})	
}

function continuar(nom){
	window.parent.location.href = "./../gestion/padron?search=true&parcela_nomenclatura=" + nom;
}

// Cancelar procedimiento
function destruir_temporal_session(conf){
	if(conf){
		var a = true;
	}else{
		var a = confirm("¿Desea cancelar el procedimiento?");		
	}
	if(a){
		var url = "./destruir_temporal_session.php";
			$.ajax({
				url:url,
				type:"GET",
				data:{
					'accion':'SI',
					'uid':uid
					},
				dataType:"json",
				success:function(data){
					if(!conf){
						location.reload();						
					}
				},
				error: function(data){
					console.log("Error al destruir la session temporal");
					console.log(data);
				}
			})		
	}
}


function validarColindantes(ultimaNom, eliminacion){
		// Traigo todas las nomenclaturas agregadas
		// La ultima nomenclatura agregada debe colindar con algun de las anteriores
		// valCol vuelve verdadero si permite la union y falso si no
		valCol = false;
		var divs = document.getElementById("parcelasAUnir");
		var noms = [];
		
		for(var i = 0; i < divs.childElementCount; i++){
			noms.push(divs.childNodes[i].getAttribute("data-value"));
		}
		
		if(eliminacion){
			if(noms.length > 1){			
				noms = noms.filter(e => e !== ultimaNom); 
			}
		}else{
			noms.push(ultimaNom);			
		}
		console.log(divs.childElementCount);
		if(divs.childElementCount > 0){
			$.ajax({
				url:"./validar_colindantes.php",
				type:"POST",
				async: false,
				data:{
					'accion':'SI',
					'nomenclaturas': noms,
					'uid':uid
				},
				success: function(data){
					console.log(data);
					// Si viene ST_MultiPolygon es porque no son colindantes
					// Si es poligono si dejo pasar
					if(data.mensaje == "ST_Polygon"){
						valCol = true;											
					}else{
						if(data.mensaje == "ST_MultiPolygon"){
							if(eliminacion){
								if(divs.childElementCount < 3){
									valCol = true;
								}
							}
						}
					}
				},
				error: function(data){
					console.log("No se pudo validar que las parcelas sean colindantes");
					console.log(data);
				}
			})		
		}else{
			// Si es la primera
			valCol = true;
		}	
		return valCol;

}



function validarNom(el){
	/*if(el.value){
		$.ajax({
			url:"./verificar_existencia_nomencla_union.php?",
			type:"POST",
			async: false,
			data:{
				nomencla: el.value
			},
			success: function(data){
				console.log(data);
				if(data.estado == "OK"){
					document.getElementById("nuevaNomenclatura").setAttribute("confirmarvalue", 1);
					document.getElementById("nuevaNomenclatura").style.background = "#7fdb87";
				}else{
					document.getElementById("nuevaNomenclatura").setAttribute("confirmarvalue", 0);
					document.getElementById("nuevaNomenclatura").style.background = "#DF8482";				
				}
			},
			error: function(data){
				console.log(data);
				document.getElementById("nuevaNomenclatura").setAttribute("confirmarvalue", 0);
				document.getElementById("nuevaNomenclatura").style.background = "#DF8482";	
			}
		})	
	}else{
		document.getElementById("nuevaNomenclatura").setAttribute("confirmarvalue", 0);
		document.getElementById("nuevaNomenclatura").style.background = "#FFFFFF";			
	}*/
}

function datosUnionATemporal(validar){
	// Nueva nomenclatura a insertar 
	var nuevaNomenclaturaDiv = '';
	
	var nuevoTitular = '';
	var nuevaDireccion = '';
	var nuevoExpediente = '';
	
	if(document.getElementById("nuevaNomenclaturaDiv")){
		var tipo_nomenclatura_union = document.getElementById("tipo_nomenclatura_union");
		//tipo_nomenclatura_union.options[elem.selectedIndex]
		if(tipo_nomenclatura_union.options[tipo_nomenclatura_union.selectedIndex].value == "Antigua"){
			nuevaNomenclaturaDiv = document.getElementById("dependenciaUnion").value.padStart(2,'0') + document.getElementById("distritoUnion").value.padStart(2,'0') + document.getElementById("seccionUnion").value.padStart(2,'0') + document.getElementById("manzanaUnion").value.padStart(2,'0') + document.getElementById("parcelaUnion").value.padStart(6,'0') + document.getElementById("subparcelaUnion").value.padStart(4,'0') ;		
		}
		if(tipo_nomenclatura_union.options[tipo_nomenclatura_union.selectedIndex].value == "Posicional"){
			nuevaNomenclaturaDiv = document.getElementById("dependenciaUnion").value + document.getElementById("parcelaX").value.padStart(7,'0') + document.getElementById("parcelaY").value.padStart(7,'0') + document.getElementById("subparcelaUnion").value ;		
		}
	}
	if(document.getElementById("nuevoTitular")){
		nuevoTitularOBJ = document.getElementById("nuevoTitular");
		nuevoTitular = nuevoTitularOBJ.options[nuevoTitularOBJ.selectedIndex].getAttribute("persona_id");		
	}

	if(document.getElementById("nuevaDireccion")){
		nuevaDireccionOBJ = document.getElementById("nuevaDireccion");
		if(nuevaDireccionOBJ.options[nuevaDireccionOBJ.selectedIndex].value != 'primerOpcion'){
			nuevaDireccion = nuevaDireccionOBJ.options[nuevaDireccionOBJ.selectedIndex].value;
		}
	}
	if(document.getElementById("nuevoExpediente")){
		nuevoExpediente = document.getElementById("nuevoExpediente").value;		
	}

	
	var tipo = document.getElementById("tipo_nomenclatura_union").options[document.getElementById("tipo_nomenclatura_union").selectedIndex].value;
	if(tipo == 'Antigua'){
		var tipo_nomenclatura = 1;
	}
	if(tipo == 'Provisoria'){
		var tipo_nomenclatura = 2;
	}
	if(tipo == 'Posicional'){
		var tipo_nomenclatura = 3;
	}
	
	$.ajax({
		url:"./actualizar_temporal_union.php",
		type:"POST",
		async: false,
		data:{
			'udparcela_nomenclatura': nuevaNomenclaturaDiv,
			'persona_id': nuevoTitular,
			'direccion_nomencla': nuevaDireccion,
			'expediente': nuevoExpediente,
			'tipo_nomenclatura': tipo_nomenclatura,
			'operacion': 'U',
			'uid': uid			
		},
		success: function(data){
			//console.log(data);
			if(data.estado == 'OK'){
				// Primero carga en temporales
				// Una vez cargado, valida la nomenclatura
				if(validar){
					validarNomenclaturaUnica(nuevaNomenclaturaDiv);
				}
			}else{
				console.log('Error actualizar_temporal_union');
			}
		},
		error: function(data){
			console.log(data);
		}
	})	
}