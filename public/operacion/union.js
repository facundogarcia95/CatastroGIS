
// PROCESO DE CARGA DE DATOS TEMPORALES DE UNION
// La carga inicial dispara el dibujo de los poligonos
//// datosADibujar() (general)
// Una vez completa la visualizacion, armo los elementos para colocar los datos
//// union()

// Completo los datos si el usuario posee una UNION pendiente
function datosADibujar(data){
	for(var i = 0; i < data.datos.length; i++){
		//var nomencla = data.datos[i].dependencia + data.datos[i].distrito + data.datos[i].seccion + data.datos[i].manzana + data.datos[i].parcela + data.datos[i].subparcela;		
		var nomencla = data.datos[i].udparcela_nomencla_origen;
		
		// Si es la ultima vuelta, hago el zoom.. en las vueltas anteriores solo pinto la parcela
		if((i == (data.datos.length - 1)) && (i != '0' && data.datos.length != '0')){
			dibujarParcelas(nomencla, 'U', 0);			
		}else{
			dibujarParcelas(nomencla, 'U', 1);			
		}
	}		
	
	// Una vez realizado el dibujo, cargo los datos
	union(data);
}


// Al cambiar el elemento de union
function union(data){
	var tipo = 1; // fisico
	if(data){
		//console.log(data);
		if(data.datos.length){	
			for(var i = 0; i < data.datos.length; i++){
				if(data.datos[i].nomenc21){
					var nom = data.datos[i].nomenc21;
					//console.log(1);
				}else{
					//var nom = data.datos[i].dependencia + data.datos[i].distrito + data.datos[i].seccion + data.datos[i].manzana + data.datos[i].parcela + data.datos[i].subparcela;		
					var nom = data.datos[i].udparcela_nomencla_origen;
				}
				if($("#" + data.datos[i].parcela_id).length == 0){
					var parcelasAUnir = document.getElementById('parcelasAUnir');
					var elemen = "<span id='"+ data.datos[i].parcela_id +"'>"+ nom +"</span>";
					
					// Creo el elemento
					var el = document.createElement("div");
					el.id = data.datos[i].parcela_id;
					el.innerHTML = nom;
					el.onclick = function() {eliminarParAUnir(this)};
					el.style.cursor = 'pointer';
					el.title = 'Eliminar';
					el.classList.add("hov");
					el.classList.add("divsUnion");
					el.style.transition = "all 0.5s";
					el.style.padding = '5px';
					el.align = 'center';
					el.setAttribute("data-value", nom);
					el.onmouseover = function() { resaltarPoligono(this.getAttribute("data-value")) };
					el.onmouseout = function() { quitarResaltado() };

					
					// Agrego el elemento
					parcelasAUnir.appendChild(el);	

					// Cambio tipo de nomenclatura
					//console.log(data.datos[i].tipo_nomenclatura);
					if(data.datos[i].tipo_nomenclatura == 1){
						document.getElementById("tipo_nomenclatura_union").value = 'Antigua';
						document.getElementById("parcelaUnion").value = data.datos[i].parcela;
						//console.log(document.getElementById("parcelaUnion").value);
						//console.log(data.datos[i].parcela);
					}
					if(data.datos[i].tipo_nomenclatura == 2){
						document.getElementById("tipo_nomenclatura_union").value = 'Provisoria';
					}
					if(data.datos[i].tipo_nomenclatura == 3){
						document.getElementById("tipo_nomenclatura_union").value = 'Posicional';
						document.getElementById("parcelaX").value = data.datos[i].parcelaX;
						document.getElementById("parcelaY").value = data.datos[i].parcelaY;
					}
					nomProvisoriaUnion(document.getElementById("tipo_nomenclatura_union"));
					
					// Valido la nomenclatura
					validarNomenclaturaUnica(data.datos[i].udparcela_nomenclatura);
				
					
					/*
					// Si es provisoria activo checkbox para provisoria
					if(data.datos[i].tipo_nomenclatura_id == 2){
						$( "#checkProvisoria" ).prop( "checked", true );
						nomProvisoriaUnion(document.getElementById("checkProvisoria"));
					}
					
					// Si es definitiva activo checkbox para definitiva
					if(data.datos[i].tipo_nomenclatura_id == 1){
						$( "#checkProvisoria" ).prop( "checked", false );
						nomProvisoriaUnion(document.getElementById("checkProvisoria"));
					}*/

				}else{
					var a = confirm("Esta parcela ya fue agregada. ¿Desea eliminarla?");		
				}	
			}	
		}
	}
}



// PROCESO DE ACTUALIZACION DE DATOS DE UNION
// Cada vez que se agrega o quita un registro de la tabla de uniones, corroboro la cantidad de registros que quedan
// (se dispara tambien en la carga inicial si tiene un proceso temporal)
////  mostrarConfirmarUnion()
// Si existe mas de uno, armo los listboxes de titulares y direcciones y los datos de union
////  titularesYDirecciones()
// Si el proceso es correcto, traigo los datos de la tabla temporal 
//// cargarDatosUnion()

// Si tiene registros la columna de parcelas, muestro botones
function mostrarConfirmarUnion(){
	var e = document.getElementById("parcelasAUnir");
	if(e.childElementCount){
		$('#cancelarUnion').show();
		if(e.childElementCount > 1){
			$('#confirmarUnion').show();				
			$('#nuevaNomenclaturaDiv').show();	
			$('#completarDatosUnion').show();
		}else{
			$('#confirmarUnion').hide();	
			if(e.childElementCount == 1){
				$('#nuevaNomenclaturaDiv').show();							
				$('#completarDatosUnion').show();				
			}else{
				$('#nuevaNomenclaturaDiv').hide();							
				$('#completarDatosUnion').hide();							
			}
		}
	}else{
		$('#confirmarUnion').hide();
		$('#cancelarUnion').hide();
		$('#nuevaNomenclaturaDiv').hide();				
		$('#completarDatosUnion').hide();							
	}
	
	// Colocar opciones de titulares principales y direcciones
	titularesYDirecciones(e);
}


// Trae todos los titulares y las direcciones de las parcelas
// Una vez finalizada la carga, traigo los datos de la tabla temporal
function titularesYDirecciones(e){
	
	var noms = [];
	for(var i = 0; i < e.childNodes.length; i++){
		noms.push(e.childNodes[i].getAttribute("data-value"));
	}

	$.ajax({
		url:"./titularesYDirecciones.php?",
		type:"POST",
		async: false,
		data:{
			accion:'SI',
			nomenclaturas: noms,
			uid: uid
		},
		success: function(data){
			// Armo listboxes de titulares y direcciones
			var nuevoTitular = document.getElementById("nuevoTitular");
			$('#nuevoTitular')
				.empty()
				.append('<option selected="selected" value="primerOpcion">Seleccionar..</option>')
			;
			var nuevaDireccion = document.getElementById("nuevaDireccion");
			$('#nuevaDireccion')
				.empty()
				.append('<option selected="selected" value="primerOpcion">Seleccionar..</option>')
			;
			
			for(var i = 0; i < data.datos.length; i++){
				
				// Titulares
				var option = document.createElement("option");
				option.title = data.datos[i].nomenclatura;
				option.setAttribute("persona_id", data.datos[i].persona_id);
				if(data.datos[i].titular){
					option.text = data.datos[i].titular;
					nuevoTitular.add(option);
				}
				
				// Direcciones
				var option2 = document.createElement("option");
				option2.title = data.datos[i].nomenclatura + " - " + data.datos[i].direccion.calleYNum;
				if(data.datos[i].direccion){
					if(data.datos[i].direccion.etiqueta){
						option2.text = data.datos[i].direccion.etiqueta;
						nuevaDireccion.add(option2);
					}
				}

				// Nomenclatura
				if(data.datos.length == 1){
					nuevaNomenclaturaUnion(data.datos[0].nomenclatura, 1);					
				}
				
			}
			
			// Una vez armados los listboxes de titulares y direcciones, cargo los datos
			cargarDatosUnion();

			
		},
		error: function(data){
			console.log(data);
		}
	})
	
}


// Traigo datos de la tabla temporal
function cargarDatosUnion(){
		if(trabajo_pendiente.operacion_union.sucess){
			var primer_desglose = trabajo_pendiente.operacion_union.datos[0];
			
			// Cargo Nomenclatura
			var tipo = 1;			
			nuevaNomenclaturaUnion(primer_desglose.udparcela_nomencla_origen, tipo);			
			
			// Titular
			var nuevoTitular = document.getElementById("nuevoTitular");
			for(var i = 0; i < nuevoTitular.childElementCount; i++){
				if(nuevoTitular.options[i].getAttribute("persona_id") == primer_desglose.persona_id){
					nuevoTitular.selectedIndex = nuevoTitular.options[i].index;
				}
			}
			// Direccion
			var nuevaDireccion = document.getElementById("nuevaDireccion");
			for(var i = 0; i < nuevaDireccion.childElementCount; i++){
				if(nuevaDireccion.options[i].value == primer_desglose.direccion_nomencla){
					nuevaDireccion.selectedIndex = nuevaDireccion.options[i].index;
				}
			}

			// Expediente
			document.getElementById("nuevoExpediente").value = primer_desglose.expediente;
			
			// Actualizo temporales
			datosUnionATemporal();
			validarNom(document.getElementById("nuevaNomenclatura"));
		}
}





function nuevaNomenclaturaUnion(nom, tipo, dependencia, distrito, seccion, manzana, parcela, subparcela){
	
	// nom completa 
	// tipo si es union fisica o de ph
	
	// Si viene la nomenclatura, uso esos datos
	
	var nomencla = '';
	if(nom){
		nomencla = nom;
	}else{
		nomencla = dependencia + distrito + seccion + manzana + parcela + subparcela;
	}
		
	document.getElementById('dependenciaUnion').value = nomencla.substring(0, 2);
	document.getElementById('distritoUnion').value = nomencla.substring(2, 4);
	document.getElementById('seccionUnion').value = nomencla.substring(4, 6);
	document.getElementById('manzanaUnion').value = nomencla.substring(6, 10);
	//document.getElementById('parcelaUnion').value = nomencla.substring(10, 16);		
	//document.getElementById('subparcelaUnion').value = nomencla.substring(16, 20);
	if(tipo == 1){ // Union de poligonos fisicos
		if(!document.getElementById('parcelaUnion').value){
			document.getElementById('parcelaUnion').value = '000000';					
		}
		document.getElementById('parcelaUnion').style.backgroundColor = '#FFFFFF';
		document.getElementById('parcelaUnion').readOnly = false;
		document.getElementById('subparcelaUnion').value = '0000';
	}else{	// Union de PH
		document.getElementById('parcelaUnion').value = nomencla.substring(10, 16);
		document.getElementById('subparcelaUnion').style.backgroundColor = '#FFFFFF';
		document.getElementById('subparcelaUnion').readOnly = false;
		document.getElementById('subparcelaUnion').value = '0000';
	}	
}

function eliminarParAUnir(el){
	var con = el.getAttribute("data-value");
	var a = confirm("¿Desea quitar la parcela?");
	if(a){
		// Corroboro que los poligonos resultantes de la eliminacion sigan siendo colindantes
		var b = validarColindantes(con, 1);
		if(b){
			// Remuevo la temporal
			$.ajax({
				url:"./destruir_temporal_session.php?",
				type:"GET",
				data:{
					'accion':'SI',
					'parcela_nomenclatura': con,
					'uid':uid
				},
				success: function(data){
					el.remove();
					desdibujarParcela(el);
				},
				error: function(data){
					alerta("AVISO",data.estado);
				}
			})
		}else{
			alerta("AVISO","No es posible eliminar la parcela ya que al hacerlo los poligonos restantes no tendran lados en comun.");
		}
	}
}


function agregarUnionTemporal(data, request){
	console.log(data.datos[0].nomenc21);
	console.log(data.datos[0].parcela_id);
	console.log(uid);
	$.ajax({
		url:"./registrar_temporal_union.php",
		type:"POST",
		data:{
			nomencla: data.datos[0].nomenc21,
			parcela_id: data.datos[0].parcela_id,
			uid:uid
		},
		success: function(datas){
			console.log(datas);
			// Dibujo parcela
			// Si dibuja, cargo datos en cliente (data)
			dibujarParcelas(request, operacion, 1, data);
			
		},
		error: function(data){
			alerta("AVISO",data.estado);
		}
	})
}








// Confirmacion del proceso de union
// Primer paso realizar la union de los poligonos y registrar alfanumerico
// Segundo paso el registro en alfanumerico y limpieza de temporales
function confirmarUnion(){
	var a = confirm("¿Desea unir las parcelas seleccionadas?");
	if(a){		
		// Si tiene elementos, corroboro que haya nomenclatura, titular, direccion y expediente
		var confirmarvalueNomenclatura = document.getElementById("nuevaNomenclaturaDiv").getAttribute("confirmarvalue");
		var e = document.getElementById("nuevoTitular");
		var titular = e.options[e.selectedIndex].value;			
		var e = document.getElementById("nuevaDireccion");
		var direccion = e.options[e.selectedIndex].value;
		var expediente = document.getElementById("nuevoExpediente");
		if((titular != 'primerOpcion') && (direccion != 'primerOpcion') && expediente && (confirmarvalueNomenclatura == 1)){
			
			// Los datos de departamento, distrito, seccion o manzana no coinciden, proceder?
			// con verdadero si hay datos que no coinciden
			/*var divs = document.getElementById("parcelasAUnir");
			var primerNomencla = divs.childNodes[0].getAttribute("data-value").substring(0, 10);
			var con = false;
			for(var i = 0; i < divs.childElementCount; i++){
				if(primerNomencla != divs.childNodes[i].getAttribute("data-value").substring(0, 10) ){
					con = true;
				}
			}
			if(con){
				var b = confirm("Hay datos de las parcelas a unir que no coinciden. Se tomaran los datos de la primer parcela seleccionada. ¿Desea proceder?");				
			}else{
				var b = true;
			}
			if(b){*/
				$.ajax({
					url:"./registrar_produccion_union.php?",
					type:"POST",
					data: {'registrar':1, 'uid': uid},					
					success: function(data){
						console.log(data);
						
						// Limpio dibujo
						highlightLayerSource.clear();
						map.removeLayer(highlightLayer);
						
						// Quito click 
						map.un('click', permitirClickearPoligono);
						
						// Oculto busqueda
						$('#busqueda').hide();
						
						// Actualizo servicio
						parcelas.getSource().updateParams({CQL_FILTER:"1=1"});
						
						// Pinto parcela final
						dibujarParcelas(data.datos[0].nomenclatura, 'U', 1);
						
						// Destruyo tabla temporal
						destruir_temporal_session(1);
						
						// Elimino del listado los matrices
						if(document.getElementById('parcelasAUnir')){
							document.getElementById('parcelasAUnir').innerHTML = '';		
						}
						
						// 
						resumen_final_union(data);

					},
					error: function(data){
						console.log(data);
						alerta("AVISO",data.estado);
					}
				})	
			//}
		}else{
			if(confirmarvalueNomenclatura == 1){
				alerta("AVISO","Complete todos los datos para confirmar el procedimiento.");				
			}else{
				alerta("AVISO","La nomenclatura indicada es invalida.");				
			}
		}
	}
}


// Armo resumen final
function resumen_final_union(data){
	if(data.estado == "OK"){
		$('#completarDatosUnion').hide();
		var resumenFinal = "<div style='font-size:15px; color:white;' align='center'>Union realizada correctamente </br>\
							<span>Nueva parcela: </span>  <a style='font-weight:bold; padding:0px; color:white; display:inline; font-size: 110%;' target='_parent' href='./../../public/gestion/padron?search=true&parcela_nomenclatura=" + data.datos[0].nomenclatura + "' >" + data.datos[0].nomenclatura + "</a></div>";
		document.getElementById("resumenFinal").innerHTML = resumenFinal;
		//$('#map').hide();
		$('#resumenFinal').show();
	}else{
		alerta(data.estado,data.mensaje);		
		console.log(1);
	}
}