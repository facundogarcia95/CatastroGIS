<?php
header('Content-Type: application/json');
//define("RelativePath", "..");
//include(RelativePath . "/Common.php");
include("configuration.php");
$parcelas_pendientes = array();
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
if($_GET['uid']){//si esta la session de usuario
	$usuario_id = $_GET['uid']; //<-habilitar despúes de probar	
	$db = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
	$db2 = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
	$db3 = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
	$mejoras = array();
	
	//$url2 = $protocolo . $IP ."/catastro_desarrollo/operacion/ws/parcelario/";
	//echo json_encode($url2);exit;
	/*
	$json = file_get_contents($url2);
	echo json_encode($json);exit;
	*/
	//--------------------------------DESGLOSE-------------------------------------------
	$SELECT = "SELECT COUNT(*) AS cantidad FROM tmp_union_desglose WHERE usuario_id = $usuario_id AND operacion = 'D'";
	$result = $db->query($SELECT);
	if($obj = $result->fetch_object()){
		$cant = $obj->cantidad;
	}else{
		$cant = 0;
	}
	if($cant){
		$SELECT = "SELECT * FROM tmp_union_desglose WHERE usuario_id = $usuario_id AND operacion = 'D'";
		if($result = $db->query($SELECT)){//si tiene desglose pendiente
			$parcelas_pendientes["operacion_desglose"] = array("sucess"=>1, "accion"=>"DESGLOSE");
			$parcelas = array();
			while($obj = $result->fetch_object()){
				$parcela_id = $obj->parcela_id;
				$udparcela_nomencla_origen = $obj->udparcela_nomencla_origen;
				$dependencia = $obj->udparcela_dependencia;
				$distrito = $obj->udparcela_distrito;
				$seccion = $obj->udparcela_seccion;
				$manzana = $obj->udparcela_manzana;
				$parcela = $obj->udparcela_parcela;
				$subparcela = $obj->udparcela_subparcela;
				$udX = $obj->udX;
				$udY = $obj->udY;
				$direccion_nomencla = $obj->direccion_nomencla;
				$persona_id = $obj->persona_id;
				$indice = $obj->indice;
				$tipo_parce = $obj->tipo_parce;
				$estado_par = $obj->estado_par;
				$origen = $obj->origen;
				$barrio_id = $obj->barrio_id;
				$PH = $obj->ph;
				$tipo_nomenclatura_id = $obj->tipo_nomenclatura_id;
				$expediente = $obj->expediente;
				$matricula = $obj->matricula;
				$union_desglose_id = $obj->union_desglose_id;
				$nomencla = $dependencia.$distrito.$seccion.$manzana.$parcela.$subparcela;
				$parcelas_pendientes["operacion_desglose"]["datos"][] = array(
																			'nomencla' => $nomencla,
																			'udparcela_nomencla_origen' => $udparcela_nomencla_origen,
																			'dependencia' => $dependencia,
																			'distrito' => $distrito,
																			'seccion' => $seccion,
																			'manzana' => $manzana,
																			'parcela' => $parcela,
																			'subparcela' => $subparcela,
																			'parcelaX' => $udX,
																			'parcelaY' => $udY,
																			'direccion_nomencla' => $direccion_nomencla,
																			'persona_id' => $persona_id,
																			'indice' => $indice,
																			'tipo_parce' => $tipo_parce,
																			'estado_par' => $estado_par,
																			'origen' => $origen,
																			'barrio_id' => $barrio_id,
																			'PH' => $PH,
																			'tipo_nomenclatura' => $tipo_nomenclatura_id,
																			'expediente' => $expediente,
																			'matricula' => $matricula,
																			'union_desglose_id' => $union_desglose_id
																			);
				$parcelas[] = array($parcela_id,$union_desglose_id);
			}
			
			//verificar nuevas mejoras en produccion
			$mejoras = array();
			for($i=0;$i<count($parcelas);$i++){
				$parcela_id = $parcelas[$i][0];
				$union_desglose_id = $parcelas[$i][1];
				$SQL_MEJORA_PRODUCCION = "SELECT mejora_id FROM mejoras WHERE parcela_id = $parcela_id";
				$result2 = $db2->query($SQL_MEJORA_PRODUCCION);
				while($obj2 = $result2->fetch_object()){
					$mejora_id = $obj2->mejora_id;					
					$SQL_TEMP_MEJORA = "SELECT COUNT(*) AS cantidad FROM tmp_mejoras WHERE operacion = 'D' AND usuario_id = $usuario_id AND mejora_id = $mejora_id";					
					$result3 = $db3->query($SQL_TEMP_MEJORA);
					if($obj3 = $result3->fetch_object()){
						$cantidad = $obj3->cantidad;						
						if(!$cantidad){//tiene nueva mejora hay que agregar
							$SQL_TEMP_MEJORA_INSERT = "INSERT INTO tmp_mejoras SET 
																				union_desglose_id = $union_desglose_id,
																				mejora_id = $mejora_id,
																				operacion = 'D',
																				usuario_id = $usuario_id";
							$db3->query($SQL_TEMP_MEJORA_INSERT);
						}						
					}					
				}				
			}
			//-------------------------------------------------------------buscar temporal mejoras--------------------------------------------------------
			$SQL_TEMP_MEJORA = "SELECT tmp_mejora_id, mejora_id, union_desglose_id FROM tmp_mejoras WHERE operacion = 'D' AND usuario_id = $usuario_id";
			$result2 = $db2->query($SQL_TEMP_MEJORA);
			while($obj = $result2->fetch_object()){
				$mejora_id = $obj->mejora_id;
				$tmp_mejora_id = $obj->tmp_mejora_id;
				$union_desglose_id = $obj->union_desglose_id;
				$SQL_MEJORAS = "SELECT DATE_FORMAT(mejora_fecha_exp,'%d/%m/%Y') AS fecha_expediente, 
												CONCAT(mejora_nro_exp,'-',mejora_letra_exp,'-',YEAR(mejora_fecha_exp)) AS expediente, 
												tipo_mejora_uso_descrip, 
												tipo_mejora_descrip, 
												tipo_mejora_categoria_descrip, 
												ROUND(mejora_sup_cub,2) AS mejora_sup_cub, 
												tipo_mejora_destino_descrip
												FROM mejoras 
												LEFT JOIN tipos_mejoras_usos ON mejoras.tipo_mejora_uso_id = tipos_mejoras_usos.tipo_mejora_uso_id
												LEFT JOIN tipos_mejoras ON mejoras.tipo_mejora_id = tipos_mejoras.tipo_mejora_id
												LEFT JOIN tipos_mejoras_categorias ON mejoras.tipo_mejora_categoria_id = tipos_mejoras_categorias.tipo_mejora_categoria_id
												LEFT JOIN tipos_mejoras_destinos ON mejoras.tipo_mejora_destino_id = tipos_mejoras_destinos.tipo_mejora_destino_id
												WHERE mejoras.mejora_id = $mejora_id AND mejoras.tipo_estado_id = 1
												ORDER BY mejora_fecha_exp ASC";
				$result3 = $db3->query($SQL_MEJORAS);
				if($obj2 = $result3->fetch_object()){
					$fecha_expediente = $obj2->fecha_expediente;
					$expediente = $obj2->expediente;
					$tipo_mejora_uso_descrip = $obj2->tipo_mejora_uso_descrip;
					$tipo_mejora_descrip = $obj2->tipo_mejora_descrip;
					$tipo_mejora_categoria_descrip = $obj2->tipo_mejora_categoria_descrip;
					$mejora_sup_cub = $obj2->mejora_sup_cub;
					$tipo_mejora_destino_descrip = $obj2->tipo_mejora_destino_descrip;
					$mejoras[] = array($tmp_mejora_id,$fecha_expediente,$expediente,$tipo_mejora_uso_descrip,$tipo_mejora_descrip,$tipo_mejora_categoria_descrip,$mejora_sup_cub,$tipo_mejora_destino_descrip,$union_desglose_id);
				}
			}		
			$parcelas_pendientes["operacion_desglose"]['mejoras'] = $mejoras;
		}else{
		$parcelas_pendientes["operacion_desglose"] = array("sucess"=>0, "accion"=>"DESGLOSE");
		}
	}else{
		$parcelas_pendientes["operacion_desglose"] = array("sucess"=>0, "accion"=>"DESGLOSE");
	}
	//---------------UNION---------------------------------------
	$SELECT = "SELECT COUNT(*) AS cantidad FROM tmp_union_desglose WHERE usuario_id = $usuario_id AND operacion = 'U' GROUP BY udparcela_nomenclatura";
	$result = $db->query($SELECT);
	if($obj = $result->fetch_object()){
		$cant = $obj->cantidad;
	}else{
		$cant = 0;
	}
	if($cant){
		$SELECT="SELECT * FROM tmp_union_desglose WHERE usuario_id = $usuario_id AND operacion = 'U'";
		if($result = $db->query($SELECT)){//si tiene uniones pendiente
			$parcelas = array();
			$personas = array();
			$parcelas_pendientes["operacion_union"] = array("sucess"=>1, "accion"=>"UNION");
			while($obj = $result->fetch_object()){
				$parcela_id = $obj->parcela_id;
				$udparcela_nomenclatura = $obj->udparcela_nomenclatura;
				$udparcela_nomencla_origen = $obj->udparcela_nomencla_origen;
				$dependencia = $obj->udparcela_dependencia;
				$distrito = $obj->udparcela_distrito;
				$seccion = $obj->udparcela_seccion;
				$manzana = $obj->udparcela_manzana;
				$parcela = $obj->udparcela_parcela;
				$subparcela = $obj->udparcela_subparcela;
				$udX = $obj->udX;
				$udY = $obj->udY;				
				$direccion_nomencla = $obj->direccion_nomencla;
				$persona_id = $obj->persona_id;
				$indice = $obj->indice;
				$tipo_parce = $obj->tipo_parce;
				$estado_par = $obj->estado_par;
				$origen = $obj->origen;
				$expediente = $obj->expediente;
				$barrio_id = $obj->barrio_id;
				$tipo_nomenclatura_id = $obj->tipo_nomenclatura_id;
				$union_desglose_id = $obj->union_desglose_id;
				$parcelas_pendientes["operacion_union"]["datos"][] = array(
																		'parcela_id' => $parcela_id,
																		'udparcela_nomenclatura' => $udparcela_nomenclatura,
																		'udparcela_nomencla_origen' => $udparcela_nomencla_origen,
																		'dependencia' => $dependencia,
																		'distrito' => $distrito,
																		'seccion' => $seccion,
																		'manzana' => $manzana,
																		'parcela' => $parcela,
																		'subparcela' => $subparcela,
																		'parcelaX' => $udX,
																		'parcelaY' => $udY,
																		'direccion_nomencla' => $direccion_nomencla,
																		'persona_id' => $persona_id,
																		'indice' => $indice,
																		'tipo_parce' => $tipo_parce,
																		'estado_par' => $estado_par,
																		'origen' => $origen,
																		'expediente' => $expediente,
																		'tipo_nomenclatura' => $tipo_nomenclatura_id,
																		'barrio_id' => $barrio_id,
																		'union_desglose_id' => $union_desglose_id
																		);
				if(!in_array($persona_id,$personas)){
					$personas[] = $persona_id;
				}
				$parcelas[] = array($parcela_id,$union_desglose_id);
			}
			//-------------------------------------------------------------buscar temporal mejoras--------------------------------------------------------
			$SQL_TEMP_MEJORA = "SELECT mejora_id, tmp_mejora_id, union_desglose_id FROM tmp_mejoras WHERE operacion = 'U' AND usuario_id = $usuario_id";
			$result = $db2->query($SQL_TEMP_MEJORA);
			while($obj = $result->fetch_object()){
				$mejora_id = $obj->mejora_id;
				$tmp_mejora_id = $obj->tmp_mejora_id;
				$union_desglose_id = $obj->union_desglose_id;
				$SQL_MEJORAS = "SELECT DATE_FORMAT(mejora_fecha_exp,'%d/%m/%Y') AS fecha_expediente, 
												CONCAT(mejora_nro_exp,'-',mejora_letra_exp,'-',YEAR(mejora_fecha_exp)) AS expediente, 
												tipo_mejora_uso_descrip, 
												tipo_mejora_descrip, 
												tipo_mejora_categoria_descrip, 
												ROUND(mejora_sup_cub,2) AS mejora_sup_cub, 
												tipo_mejora_destino_descrip
												FROM mejoras 
												LEFT JOIN tipos_mejoras_usos ON mejoras.tipo_mejora_uso_id = tipos_mejoras_usos.tipo_mejora_uso_id
												LEFT JOIN tipos_mejoras ON mejoras.tipo_mejora_id = tipos_mejoras.tipo_mejora_id
												LEFT JOIN tipos_mejoras_categorias ON mejoras.tipo_mejora_categoria_id = tipos_mejoras_categorias.tipo_mejora_categoria_id
												LEFT JOIN tipos_mejoras_destinos ON mejoras.tipo_mejora_destino_id = tipos_mejoras_destinos.tipo_mejora_destino_id
												WHERE mejoras.mejora_id = $mejora_id AND mejoras.tipo_estado_id = 1
												ORDER BY mejora_fecha_exp ASC";
				$result2 = $db3->query($SQL_MEJORAS);
				if($obj2 = $result2->fetch_object()){
					$fecha_expediente = $obj2->fecha_expediente;
					$expediente = $obj2->expediente;
					$tipo_mejora_uso_descrip = $obj2->tipo_mejora_uso_descrip;
					$tipo_mejora_descrip = $obj2->tipo_mejora_descrip;
					$tipo_mejora_categoria_descrip = $obj2->tipo_mejora_categoria_descrip;
					$mejora_sup_cub = $obj2->mejora_sup_cub;
					$tipo_mejora_destino_descrip = $obj2->tipo_mejora_destino_descrip;
					$mejoras[] = array($tmp_mejora_id,$fecha_expediente,$expediente,$tipo_mejora_uso_descrip,$tipo_mejora_descrip,$tipo_mejora_categoria_descrip,$mejora_sup_cub,$tipo_mejora_destino_descrip,$union_desglose_id);
				}
			}		
			$parcelas_pendientes["operacion_union"]['mejoras'] = $mejoras;
			//----------------------------------------------------------buscar titulares---------------------------------------------------------------------
			for($i=0;$i<count($personas);$i++){
				$persona_id = $personas[$i];
				$SQL_PERSONA = "SELECT tipos_personas.tipo_persona_descrip, tipos_documentos.tipo_documento_abrev, personas.persona_nro_doc, personas.persona_cuit, personas.persona_denominacion
								FROM personas 
								LEFT JOIN tipos_personas ON personas.tipo_persona_id = tipos_personas.tipo_persona_id
								LEFT JOIN tipos_documentos ON personas.tipo_documento_id= tipos_documentos.tipo_documento_id
								WHERE persona_id = $persona_id";
				$result = $db2->query($SQL_PERSONA);
				while($obj = $result->fetch_object()){
					$tipo_persona_descrip = $obj->tipo_persona_descrip;
					$tipo_documento_abrev = $obj->tipo_documento_abrev;
					$persona_nro_doc = $obj->persona_nro_doc;
					$persona_cuit = $obj->persona_cuit;
					$persona_denominacion = $obj->persona_denominacion;
					$personas_registradas[] = array($tipo_persona_descrip,$tipo_documento_abrev,$persona_nro_doc,$persona_cuit,$persona_denominacion);
				}
			}
			$parcelas_pendientes["operacion_union"]['personas'] = $personas_registradas;
		}else{
			$parcelas_pendientes["operacion_union"] = array("sucess"=>0, "accion"=>"UNION");
		}
	}else{
		$parcelas_pendientes["operacion_union"] = array("sucess"=>0, "accion"=>"UNION");
	}	
	mysqli_close($db);
	mysqli_close($db2);
	mysqli_close($db3);
}else{
	$parcelas_pendientes["operacion"] = array("accion"=>"ERROR sin session de usuario");
}
echo json_encode($parcelas_pendientes);
?>