

// fisico 2 			04990005002175000000
// ph					04140100040000050000
// no se puede crear 	04020200020000000000

// Scripts actualizar_mejoras_temporal.php parametros tmp_mejoras_id y union_desglose_id 

// Estructura
// completarDatosDesglose
// Paso1



// FASE 2
// CREAR TEMPORALES

function desglose(cantidad){
	if(cantidad > 1){
		tipoDeDesglose = "Fisico";
		$( "#cantidad" ).val(cantidad);
		$(' #cantidad ').prop('readonly', true);
		$( "#desglose" ).show();
	}else{
		tipoDeDesglose = "PH";
		$( "#cantidad" ).val('');
		$(' #cantidad ').prop('readonly', false);
		$( "#desglose" ).show();
	}
	var res = tipoDeDesglose.toUpperCase();
	$( "#tipoDesglose" ).html("TIPO: " + res);
}


function confirmarDesglose(){
	totalDesglose = parseInt($( "#cantidad" ).val());
	if(totalDesglose > 1){
		var a = confirm("¿Confirma que desea desglosar la parcela en " + totalDesglose + " registros nuevos? " + "(" + tipoDeDesglose + ")");	
		if(a){
			// Realizar desglose temporal
			if(tipoDeDesglose == "PH"){
				var ph = "SI";				
			}else{
				var ph = "NO";				
			}
			console.log(nomenclaADesglosar);
			console.log(ph);
			console.log(totalDesglose);
			console.log(uid);
			$.ajax({
				url:"./registrar_temporal_desglose.php?",
				type:"POST",
				data:{
					'nomencla':nomenclaADesglosar,
					'ph':ph,
					'cant':totalDesglose,
					'uid':uid
				},
				success: function(data){
					alerta("AVISO",data.mensaje);
					limpiar(1);
					$('#busqueda').hide();
					cargarPendientes(0,"DESGLOSE", uid);
					map.un('click', permitirClickearPoligono);
					//completarDatosDesglose(data.operacion_desglose);
					//location.reload();
				},
				error: function(data){
					alerta("AVISO",data.estado);
				}
			})
		}
	}else{
		if(totalDesglose != 1){
			alerta("AVISO","Indique la cantidad de desgloses a realizar");			
		}else{
			alerta("AVISO","La cantidad debe ser mayor a 1");
		}
	}
}


// FASE 3
// COMPLETAR Y CARGAR LOS DATOS CORRESPONDIENTES

function completarDatosDesglose(data){
	// Inhabilito el click
	map.un('click', permitirClickearPoligono);
	
	// Corroboro que todos los desgloses sean PH o no lo sean
	var vtd = validarTipoDesglose(data.datos);
	if(vtd){		
	
		/////////////////////////////
		// NOMENCLATURAS DEL DESGLOSE
		/////////////////////////////
		
		if(data.datos[0].PH == "SI"){
			var tipo = "PH";
			var encabezado = "<a href='./../gestion/padron?search=true&parcela_nomenclatura="+data.datos[0].udparcela_nomencla_origen+"' class='col' target='_blank' style='color: #20A8D8; padding: 3px; margin-left: 0px; font-weight: bold; font-size: 20px;'>" + data.datos[0].udparcela_nomencla_origen + "</a> <span style='color:#0070A4; margin-left: 0px;margin-top: 0px; font-weight: bold;'><b>Tipo de Desglose: " + tipo + "</span></br></br>";
			var readonlyElement = "readonly";
			var readonlyElement2 = "";
			var lock = "background-color: #e6e6e6;";
			var lock2 = "";
		}else{
			var tipo = "FISICO";
			var encabezado = "<a href='./../gestion/padron?search=true&parcela_nomenclatura="+data.datos[0].udparcela_nomencla_origen+"' target='_blank' style='color: #20A8D8; padding: 3px; margin-left: 0px; font-weight: bold; font-size: 20;'>" + data.datos[0].udparcela_nomencla_origen + "</a> <span class='' style='color:#0070A4; margin-left: 0px;margin-top: 0px; font-weight: bold;'>Tipo de Desglose: " + tipo + "</span></br>";
			encabezado += "<input id='cancelarSeleccion' style='display:none;' type='button' onclick='cancelarSeleccionPoligono();' value='Cancelar Seleccion'></input></br></br>";
			var readonlyElement = "";
			var readonlyElement2 = "readonly";
			var lock = "";
			var lock2 = "background-color: #e6e6e6;";
		}
		
		var filas = '';
		var opcionesArr = [];
		for(var i = 0; i < data.datos.length; i++){
			// Nomenclaturas
			var union_desglose_id = data.datos[i].union_desglose_id;
			var nomenclatura = data.datos[i].nomencla.toString();
			var subindice = data.datos[i].indice;
			if(!subindice){
				subindice = i;
			}
			//console.log(data.datos[i]);
			var tipo_nomenclatura = data.datos[i].tipo_nomenclatura;
			var displayN = '';
			var chek = '';
			//console.log(tipo_nomenclatura );
			
			// Segun tipo de nomenclatura como muestro los campos
			if(tipo_nomenclatura == 1){
				var displayN1 = '  ';
				var displayN2 = '  ';
				var displayN3 = '  ';
				var displayN4 = '  ';
				var displayN5 = '  ';
				var displayN6 = ' display:none; ';
				var displayN7 = ' display:none; ';
				var displayN8 = '  ';
				var displayN9 = '  ';
				var selected1 = " selected ";
				var selected2 = "  ";
				var selected3 = "  ";
			}
			if(tipo_nomenclatura == 2){
				var displayN1 = ' display:none; ';
				var displayN2 = ' display:none; ';
				var displayN3 = ' display:none; ';
				var displayN4 = ' display:none; ';
				var displayN5 = ' display:none; ';
				var displayN6 = ' display:none; ';
				var displayN7 = ' display:none; ';
				var displayN8 = ' display:none; ';
				var displayN9 = ' display:none; ';
				var selected1 = "  ";
				var selected2 = " selected ";
				var selected3 = "  ";
			}
			if(tipo_nomenclatura == 3){
				var displayN1 = '';
				var displayN2 = ' display:none; ';
				var displayN3 = ' display:none; ';
				var displayN4 = ' display:none; ';
				var displayN5 = ' display:none; ';
				var displayN6 = '  ';
				var displayN7 = '  ';
				var displayN8 = '';
				var displayN9 = '';
				var selected1 = "  ";
				var selected2 = "  ";
				var selected3 = " selected ";
			}
			
			//console.log(data.datos[i]);
			filas += "</br><span class='subtituloFijo'>Desglose numero " + (i+1) + ": </span><div id='"+subindice+"' name='divsDesgloses' style='padding:5px; margin-top: 10px; background-color: white;width: auto;' onmouseover='resaltarPoligono("+nomenclatura+","+subindice+", this)' onmouseout='quitarResaltado(this)'>\
													<input id='dependencia' title='Dependencia' style='background-color: #e6e6e6;"+displayN1+"' readonly class='desgloses nomenclas' size='2' maxlength='2' name='" + union_desglose_id + "' onkeyup='actualizarTemporalRegistro(this.id, this.name, this.value);' type='textbox' value='" + data.datos[i].dependencia + "'></input>\
													<input id='distrito' title='Distrito' " + readonlyElement + " style='" + lock + displayN2 + "' class='desgloses nomenclas' size='2' maxlength='2' name='" + union_desglose_id + "' onkeyup='actualizarTemporalRegistro(this.id, this.name, this.value);' type='textbox' value='" + data.datos[i].distrito + "'></input>\
													<input id='seccion' title='Seccion' " + readonlyElement + " style='" + lock + displayN3 + "' class='desgloses nomenclas' size='2' maxlength='2' name='" + union_desglose_id + "' onkeyup='actualizarTemporalRegistro(this.id, this.name, this.value);' type='textbox' value='" + data.datos[i].seccion + "'></input>\
													<input id='manzana' title='Manzana' " + readonlyElement + " style='" + lock + displayN4 + "' class='desgloses nomenclas' size='4' maxlength='4' name='" + union_desglose_id + "' onkeyup='actualizarTemporalRegistro(this.id, this.name, this.value);' type='textbox' value='" + data.datos[i].manzana + "'></input>\
													<input id='parcela' title='Parcela' " + readonlyElement + " style='" + lock + displayN5 + "' class='desgloses nomenclas' size='6' maxlength='6' name='" + union_desglose_id + "' onkeyup='actualizarTemporalRegistro(this.id, this.name, this.value);' type='textbox' value='" + data.datos[i].parcela + "'></input>\
													<input id='parcelaX' title='Parcela X' style='" + displayN6 + "' class='desgloses nomenclas' size='7' maxlength='7' name='" + union_desglose_id + "' onkeyup='actualizarTemporalRegistro(this.id, this.name, this.value);' type='textbox' value='" + data.datos[i].parcelaX + "'></input>\
													<input id='parcelaY' title='Parcela Y' style='" + displayN7 + "' class='desgloses nomenclas' size='7' maxlength='7' name='" + union_desglose_id + "' onkeyup='actualizarTemporalRegistro(this.id, this.name, this.value);' type='textbox' value='" + data.datos[i].parcelaY + "'></input>\
													<input id='subparcela' title='Subparcela' " + readonlyElement2 + " style='" + lock2 + displayN8 + "' class='desgloses nomenclas' size='4' maxlength='4' name='" + union_desglose_id + "' onkeyup='actualizarTemporalRegistro(this.id, this.name, this.value);' type='textbox' value='" + data.datos[i].subparcela + "'></input>\
													<img id='validacion" + union_desglose_id + "' style='" + displayN9 + "' src='./imgs/no.png' confirmarvalue='0' alt='Validacion' width='15' height='15'>\
													</br>\
													<label for='union_desglose_id'>Tipo de Nomenclatura:</label>\
													<select id='select"+union_desglose_id+"' type='checkbox' name='" + union_desglose_id + "' onchange='nomProvisoria(this)'>\
														<option "+selected1+" value='Antigua'>Antigua</option>\
														<option "+selected2+" value='Provisoria'>Provisoria</option>\
														<option "+selected3+" value='Posicional'>Posicional</option>\
													</select>\
													</div></br>";
		
			opcionesArr.push([union_desglose_id, nomenclatura]);
		}
		
		/////////////////////////////
		// MEJORAS
		/////////////////////////////
	
		// VERIFICAR QUE LA METRIZ TIENE MEJORA DE PH //
		var url = "./verificar_matriz_mejora.php";
		var mejora_ph_estado = "NO";
		var nomencla_origen = data.datos[0].udparcela_nomencla_origen;
		$.ajax({
			url:url,
			type:"POST",
			dataType:"json",
			data: {
				'nomencla':nomencla_origen,
				'uid':uid
				},
			async: false,
			success:function(response){
				if(response.estado == "OK"){
					mejora_ph_estado = "OK";					
				}
			},
			error: function(response){
				console.log(response.mensaje);
			}
		})
	
		if(data.datos[0].PH == "NO" || (data.datos[0].PH == "SI") && mejora_ph_estado == "OK"){
			if(data.mejoras[0]){
				var mejoras = '<div style="white-space: nowrap; overflow-x: scroll;"><table style="">\
									<tr style="background-image: linear-gradient(#E6E6E6, #f5f5f5);">\
										<td style="padding:5px">TIPO MEJORA</td>\
										<td style="padding:5px">CATEGORIA</td>\
										<td style="padding:5px">USO</td>\
										<td style="padding:5px">EXPEDIENTE</td>\
										<td style="padding:5px">FECHA EXPEDIENTE</td>\
										<td style="padding:5px">SUPERFICIE CUBIERTA</td>\
										<td style="padding:5px">DESTINO</td>\
										<td style="padding:5px">NOMENCLATURA ASOCIADA</td>\
									</tr>\
										';
										
				var selected = '';
				for(var i = 0; i < data.mejoras.length; i++){
					// Selecciono el que viene de la temporal de mejoras
					var opciones = '';
					for(var k = 0; k < data.datos.length; k++){
					console.log(data.mejoras[k]);
						nm = opcionesArr[k][1];	
						if(data.datos[k].tipo_nomenclatura == 2){
							nm = "NOMENCLATURA PROVISORIA " + (k+1);								
						}
						if(opcionesArr[k][0] == data.mejoras[i][8]){
							opciones += '<option value="'+opcionesArr[k][0]+'" selected>'+nm+'</option>';												
						}else{
							opciones += '<option value="'+opcionesArr[k][0]+'">'+nm+'</option>';												
						}
						
						// En la primer vuelta, actualizo los temporales de mejoras
						if(k == 0){
							act_mej_temp(1, opcionesArr[k][0], data.mejoras[i][0]);							
						}
					}
					
					mejoras += "<tr style='background-image: linear-gradient(#E6E6E6, #f5f5f5);'>";
					mejoras += "<td style='padding:5px'>" + data.mejoras[i][4] + "</td>";
					mejoras += "<td style='padding:5px'>" + data.mejoras[i][5] + "</td>";
					mejoras += "<td style='padding:5px'>" + data.mejoras[i][3] + "</td>";
					mejoras += "<td style='padding:5px'>" + data.mejoras[i][2] + "</td>";
					mejoras += "<td style='padding:5px'>" + data.mejoras[i][1] + "</td>";
					mejoras += "<td style='padding:5px'>" + data.mejoras[i][6] + "</td>";
					if(!data.mejoras[i][7]){data.mejoras[i][7] = '';}
					mejoras += "<td style='padding:5px'>" + data.mejoras[i][7] + "</td>";
					mejoras += '<td  style="padding:5px"><select class="lists listboxMejora" style="padding: 6px 10px 6px 10px" onchange="act_mej_temp(this);" ' + selected + ' onload="act_mej_temp(this);" name="'+data.mejoras[i][0]+'">\
								  '+opciones+'\
								</select></td>';			
					mejoras += "</tr>";
				}
				
				var nomencla_origen = (data.datos[0].udparcela_nomencla_origen);
				mejoras += "<tr><span class='subtituloFijo' style='text-align:left;'>Si la mejora no corresponde a ningun desglose, o los datos de la misma no son correctos, gestione sus datos antes de realizar el desglose desde <a style='padding: 0px; font-size: 100%; display: inline;' target='_blank' href='./../gestion/padron?search=true&parcela_nomenclatura=" + nomencla_origen + "'>aqui</a></span></br></br></tr>";
				mejoras += "</table></div>";
			}else{
				var mejoras = "<span class='subtituloFijo'>SIN MEJORAS</span>";
			}
		}else{
			if((data.datos[0].PH == "SI") && mejora_ph_estado == "NO"){
				var img = '<img src="./imgs/no.png" alt="mejora" width="15" height="15">';
				var mejoras = "<span class='subtituloFijo'>La matriz no posee una mejora del tipo PH </span>" + img;
				
			}
		}
		
		
		/////////////////////////////
		// BARRIOS
		/////////////////////////////
		var url = "./listadoBarrios.php";
		var barrios = "";
		// Tomo el barrio del primer desglose (todos tienen el mismo)
		var barrio_id = data.datos[0].barrio_id;
		$.ajax({
			url:url,
			type:"POST",
			dataType:"json",
			data:{
			'barrio_id': barrio_id,
			'uid':uid
			},
			async: false,
			success:function(data){
				// Devuelve listado total de barrios
				var opciones = "<option value='-1'>SIN BARRIO</option>";
				for(var i = 0; i < data.length; i++){
					if(barrio_id == data[i][0]){
						opciones += "<option selected value='"+data[i][0]+"'>"+data[i][1]+"</option>";												
					}else{
						opciones += "<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";						
					}
				}
				barrios = ' </br><span class="" style="margin-left: 0px; color:black; font-weight:bold;">Barrios</span></br>\
								\
								<select class="lists" onchange="actualizarTemporalOtros(this, &quot;barrio_id&quot;)" name="barrios" id="barrios">\
								  '+opciones+'\
								</select>';
				barrios += '<input type="button" class="botones" value="Refrescar" onclick="actualizarListboxesBarrios()"></input></br><span class="subtituloFijo">(Si el barrio no existe, agreguelo en el <a style="font-size: 100%; padding: 0px 0px 0px 0px; display:inline;" target="_blank" href="./../cartografia">Modulo de barrios</a>)</span>';
			},
			error: function(data){
				console.log("Error al traer listado de barrios");
			}
		})		
		
		
		/////////////////////////////
		// EXPEDIENTE Y MATRICULA
		/////////////////////////////
		
		//var matVal = '';
		var expVal = '';
		/*if(data.datos[0].matricula){
			matVal = "value='"+data.datos[0].matricula+"'";
		}	*/	
		if(data.datos[0].expediente){
			expVal = "value='"+data.datos[0].expediente+"'";
		}
		
		var expediente = '</br></br><span class="" style="margin-left: 0px; color:black; font-weight:bold;">Expediente </span></br><input class="buscador" ' + expVal + 'onkeyup="actualizarTemporalOtros(this, this.id)" id="expediente" type="textbox" placeholder="Numero de expediente.."></input>';
		//var matricula = '<span>Matricula </span></br><input ' + matVal + 'onkeyup="actualizarTemporalOtros(this, this.id)" id="matricula" type="textbox" placeholder="Matricula"></input>';
		var expYMat = expediente /*+ '</br></br>' + matricula*/;
		

		/////////////////////////////
		// ASIGNAR TODO A DIV PRINCIPAL
		/////////////////////////////		
		
		var botonFinal = '<div align="center" style="padding:15px 15px 25px 15px;"><button class="botones" onclick="registrar_produccion()"><span>Confirmar</span></button><button class="botones" onclick="destruir_temporal_session()"><span>Cancelar</span></button></div>';
		document.getElementById("encabezado").innerHTML = "</br></br>" + encabezado;
		document.getElementById("completarDatosDesglose").innerHTML = "<span class='' style='margin-left: 0px; color:black; font-weight:bold;'>Desgloses</span>" + filas + "</br></br></br><span class='' style='margin-left: 0px; color:black; font-weight:bold;'>Mejoras</span></br>" + mejoras + "</br></br>" + barrios + "</br>" + expYMat + "</br></br></br></br>";
		document.getElementById("confirmarCancelarDesglose").innerHTML = botonFinal + "</br></br>";
	
		// Corroboro disponibilidad de las nomenclaturas
		nomenclaturasUnicas();
		
		// Muestro
		$('#completarDatosDesglose').show();
		$('#map').show();
		dibujarParcelas(data.datos[0].udparcela_nomencla_origen, 'D', 1);
		
	}else{
		alerta("AVISO","No todos los desgloses son del mismo tipo. Revisar tmp_union_desglose, campo 'ph'");
	}		
}


// Actualizar barrio temporal
function actualizarTemporalOtros(elem, campo){
	if(elem.id == "barrios"){
		var id = elem.options[elem.selectedIndex].value;	
	}
	if(elem.id == "expediente" || elem.id == "matricula"){
		var id = elem.value;	
	}
	
	var url = "./actualizar_temporal_registro_otros.php";	
	$.ajax({
		url:url,
		type:"POST",
		data:{
			'nombreCampo': campo,
			'valor':id,
			'uid':uid
			},
		dataType:"json",
		success:function(data){
			//console.log(data.mensaje);
		},
		error: function(data){
			console.log("Error al actualizar algun registro temporal");
			console.log(data.responseText);
		}
	})
}

// Seleccionar el poligono de la cartografia
function seleccionarPoligono(id){
	document.getElementById('cancelarSeleccion').style.display = 'block';
	var elem = document.getElementsByName(id);
	for(var i = 0; i < elem.length; i++){
		elem[i].style.backgroundColor = "#DDD000";
	}
	/*map.on('pointermove', permitirSeleccionarPoligono);
	map.on('click', permitirClickearPoligono);*/
	
}

function cancelarSeleccionPoligono(){
	document.getElementById('cancelarSeleccion').style.display = 'none';
	var elem = document.getElementsByClassName("desgloses");
	for(var i = 0; i < elem.length; i++){
		elem[i].style.backgroundColor = "#FFF";
	}
	/*map.un('pointermove', permitirSeleccionarPoligono);
	map.un('click', permitirClickearPoligono);*/
}

// Actualizo las mejoras en la tabla
function act_mej_temp(listbox, union_desglose_id, tmp_mejora_id){
	if(!union_desglose_id){
		var union_desglose_id = listbox.options[listbox.selectedIndex].value;		
	}
	if(!tmp_mejora_id){
		var tmp_mejora_id = listbox.name;		
	}
	var url = "./actualizar_mejoras_temporal.php";
	$.ajax({
		url:url,
		type:"POST",
		data:{
			'tmp_mejora_id':tmp_mejora_id,
			'union_desglose_id':union_desglose_id,
			'uid':uid
			},
		dataType:"json",
		success:function(data){
			// 
		},
		error: function(data){
			console.log("Error al actualizar mejoras temporales");
		}
	})
}

// Registro desglose
function registrar_produccion(){
	var a = confirm("¿Desea confirmar el desglose?");
	if(a){
		// Validacion extra
		var b = validarDesgloses();
		if(b){
			var url = "./registrar_produccion.php";
			$.ajax({
				url:url,
				type:"POST",
				data:{
					'registrar':1,
					'uid':uid
					},
				dataType:"json",
				success:function(data){
					console.log(data);
					/*if(data.estado == "OK"){
						resumen_final_desglose(data);						
					}else if(data.estado == "ERROR"){
						alerta(data.estado,data.mensaje);	
					}*/
				},
				error: function(data){
					console.log("Error al registrar produccion");
					console.log(data);
				}
			})		
		}else{
			alerta("AVISO","Nomenclaturas invalidas. Revisar las nuevas nomenclaturas.");
		}
	}
}

// Valido del lado del cliente que no haya nomenclaturas invalidas
function validarDesgloses(){
	var divs = document.getElementsByName("divsDesgloses");
	for(var i = 0; i < divs.length; i++){
		// No es provisoria
		if(!divs[i].children[8].checked){
			for(var j = 0; j < divs[i].children.length; j++){	
				if(divs[i].children[j].getAttribute("confirmarvalue")){
					if(divs[i].children[j].getAttribute("confirmarvalue") != 1){
							return false;						
					}
				}
			}			
		}
		// Si es provisoria dejo pasar
	}
	return true;
}

// Muestro Resumen Final
function resumen_final_desglose(data){
	$('#completarDatosDesglose').hide();	
	$('#confirmarCancelarDesglose').hide();	
	if(data.estado == "OK"){
		var filas = '';
		for(var i = 0; i < data.dato.length; i++){
			filas += "<tr>\
						<td><a target='_blank' style='font-size: 100%' href='./../gestion/padron?search=true&parcela_nomenclatura=" + data.dato[i].udparcela_nomenclatura + "'>" + data.dato[i].udparcela_nomenclatura + "</a></td>\
						<td>" + data.dato[i].udparcela_padron + "</td>\
						<td><a target='_blank' style='font-size: 100%' href='./../gestion/padron?search=true&parcela_nomenclatura=" + data.dato[i].udparcela_nomencla_origen + "'>" + data.dato[i].udparcela_nomencla_origen + "</a></td>\
						<td>" + data.dato[i].titular + "</td>\
						<td>" + data.dato[i].barrio_nombre + "</td>\
						<td>" + data.dato[i].fecha + "</td>\
						<td>" + data.dato[i].usuario_nombre + "</td>\
					</tr>";		

					// <td>" + data.dato[i].mejora + "</td>\		
		}
		var resumenFinal = "</br><span class='spanFijo' style='color: #000000; background-color:transparent !important; padding: 3px; margin-left: 0px; font-weight: bold; font-size: 17px;'>RESUMEN FINAL</span></br>";
		resumenFinal += "<div style='white-space: nowrap; overflow-x: scroll;'><table border='1' class='spanFijo' style='padding: 0px; background-image: linear-gradient(#e6c3bc, #EEDAD6);'>\
								<tr>\
									<td>\
										NOMENCLATURA\
									</td>\
									<td>\
										PADRON\
									</td>\
									<td>\
										PARCELA ORIGEN\
									</td>\
									<td>\
										TITULAR\
									</td>\
									<td>\
										BARRIO\
									</td>\
									<td>\
										FECHA DE DESGLOSE\
									</td>\
									<td>\
										USUARIO DE DESGLOSE\
									</td>\
								</tr>" + filas + "</br></table></br></div></br><input type='button' onclick='continuar("+data.dato[0].udparcela_nomencla_origen+");' value='Continuar' class='botones'></input>";
								
		document.getElementById("resumenFinal").innerHTML = resumenFinal;
		$('#resumenFinal').show();
	}else{
		alerta(data.estado,data.mensaje);		
	}
	
}