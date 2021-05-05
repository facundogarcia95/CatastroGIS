<?php
header('Content-Type: application/json');
include("configuration.php");
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

function protocolo(){
	if(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
		return 'https://';
	}else{
		return 'http://';
	}
}

$parcelas_pendientes = array('estado' => 'ERROR','mensaje' => 'No se pudo realizar la operacion', 'dato' => null);
if($_POST['uid'] && $_POST['registrar'] == 1){//si esta la session de usuario y viene parametro para registrar
	echo $_POST['uid']; exit;
	$db = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
	$db2 = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
	$db3 = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
	$usuario_id = $_POST['uid'];
	$audit_string = implode('|',array($usuario_id,$_SERVER['REMOTE_ADDR'],substr(strrchr ($_SERVER['PHP_SELF'], "/"), 1)));
	$estado_id = 2;
	$SQL = "SELECT COUNT(*) AS cantidad FROM tmp_union_desglose WHERE usuario_id = $usuario_id AND operacion = 'D'";
	$result = $db->query($SQL);
	
	if($obj = $result->fetch_object()){//si hay registros para crear
		$cantidad = $obj->cantidad;		
		if($cantidad){//si tiene registros temporal pendientes
	
		
			$SELECT = "SELECT ph FROM tmp_union_desglose WHERE usuario_id = $usuario_id AND operacion = 'D' GROUP BY ph";
			$result = $db->query($SELECT);
			if($obj = $result->fetch_object()){
				$es_ph = $obj->ph;
			}
			
			if($es_ph == "SI"){//si es PH verificar que no repita subparcela y parcelas igual para todos			
				// Si la PH tiene mejora del tipo PH permito, sino no
				$SELECT = "SELECT udparcela_nomencla_origen FROM tmp_union_desglose WHERE usuario_id = $usuario_id LIMIT 1";
				$result = $db->query($SELECT);
				if($obj = $result->fetch_object()){
					$nomencla = $obj->udparcela_nomencla_origen;
				}
				$SELECT = "SELECT parcela_id FROM parcelas WHERE SUBSTRING(parcela_nomenclatura,1,20) = '$nomencla'";
				$result = $db->query($SELECT);
				if($obj = $result->fetch_object()){
					$parcela_id = $obj->parcela_id;
				}
				
				$SELECT = "SELECT persona_id FROM personas_parcelas WHERE parcela_id = $parcela_id ";
				$result = $db->query($SELECT);
				if($obj = $result->fetch_object()){					
				}else{
					$parcelas_pendientes['mensaje'] = 'La parcela no posee titular. Dar de alta un titular para continuar.';
					echo json_encode($parcelas_pendientes); exit;
				}					
				
				if($parcela_id){//si encontró la parcela
					$tipo_mejora_categoria_id = 0;
					$SELECT = "SELECT tipo_mejora_categoria_id FROM tipos_mejoras_categorias WHERE ph = 1";
					$result = $db->query($SELECT);
					if($obj = $result->fetch_object()){
						$tipo_mejora_categoria_id = $obj->tipo_mejora_categoria_id;
					}
				
					$SELECT = "SELECT mejora_id FROM mejoras WHERE parcela_id = $parcela_id AND tipo_mejora_categoria_id=$tipo_mejora_categoria_id AND mejora_sup_cub > 0";
					$result = $db->query($SELECT);
					if($obj = $result->fetch_object()){
						$mejora_id = $obj->mejora_id;
					}
					
					if($mejora_id){//si encontró la mejora para PH que permite la registracion en propiedad horizontal			
						if($cantidad){//si hay cantidades de registros con sus correpondiente REGISTRAR
							$ph = "SI";
							$operacion  = "D";
							$udparcela_subparcela_prov = 0;
							$SQL = "SELECT * FROM tmp_union_desglose WHERE usuario_id = $usuario_id AND operacion = 'D'";
							$result_temp = $db->query($SQL);							
							while($obj = $result_temp->fetch_object()){//por cada una de las PH en el temporal
								$parcela_id = $obj->parcela_id;
								$fecha = $obj->fecha;
								$usuario_id = $obj->usuario_id;
								$udparcela_nomencla_origen = $obj->udparcela_nomencla_origen;
								$udparcela_nomenclatura = $obj->udparcela_nomenclatura;
								$udparcela_dependencia = $obj->udparcela_dependencia;
								$udparcela_distrito = $obj->udparcela_distrito;
								$udparcela_seccion = $obj->udparcela_seccion;
								$udparcela_manzana = $obj->udparcela_manzana;
								$udparcela_parcela = $obj->udparcela_parcela;
								$udparcela_subparcela = $obj->udparcela_subparcela;
								$udparcela_dig_veri = $obj->udparcela_dig_veri;
								$udX = $obj->udX;
								$udY = $obj->udY;
								$udparcela_fraccion = $obj->udparcela_fraccion;
								$persona_id = $obj->persona_id;
								$direccion_nomencla = $obj->direccion_nomencla;
								$tipo_parce = $obj->tipo_parce;
								$estado_par = $obj->estado_par;
								$origen = $obj->origen;
								$barrio_id = $obj->barrio_id;
								$tipo_nomenclatura_id = $obj->tipo_nomenclatura_id;
								$expediente = $obj->expediente;
								$matricula = $obj->matricula;
								$union_desglose_id = $obj->union_desglose_id;
								/*
								$SELECT = "SELECT (MAX(parcelas.parcela_padron) + 1) AS siguiente FROM parcelas";
								$result2 = $db2->query($SELECT);
								if($obj2 = $result2->fetch_object()){
									$ultimo_padron = $obj2->siguiente;
									$ul_p = $ultimo_padron;
								}
								*/
								$ultimo_padron = file_get_contents(protocolo().$_SERVER['HTTP_HOST']."/desarrollo_catastro/public/ultimoPadron");
								$ul_p = $ultimo_padron;
								
								if($tipo_nomenclatura_id == 2){
									$udparcela_dependencia  = $municipio['municipio_sigla'];
									$udparcela_seccion = "00";
									$udparcela_distrito = "00";
									$udparcela_manzana = "0000";
									$udparcela_parcela = str_pad($ultimo_padron,6,"0",STR_PAD_LEFT);
									$udparcela_subparcela_prov = $udparcela_subparcela_prov + 1;
									$udparcela_subparcela = str_pad($udparcela_subparcela_prov,4,"0",STR_PAD_LEFT);
									$udparcela_dig_veri = "0";
									$udparcela_nomenclatura = $udparcela_dependencia.$udparcela_distrito.$udparcela_seccion.$udparcela_manzana.$udparcela_parcela.$udparcela_subparcela.$udparcela_dig_veri;
								}
								$INS = "INSERT INTO parcelas 
										SET 
										parcela_nomenclatura = '" . $udparcela_nomenclatura . "',
										parcela_padron	 =  '". $ultimo_padron  . "',
										parcela_dependencia	 =  '".$udparcela_dependencia."',
										parcela_distrito	 =  '". $udparcela_distrito . "',
										parcela_seccion	 =  '". $udparcela_seccion . "',
										parcela_manzana	 =  '". $udparcela_manzana . "',
										parcela_parcela	 =  '". $udparcela_parcela . "',
										parcela_subparcela	 =  '". $udparcela_subparcela . "',
										parcela_dig_veri	 =  '". $udparcela_dig_veri . "',
										parcela_x	 =  '". $udX . "',
										parcela_y	 =  '". $udY . "',
										tipo_parcela_estado_id = '" . $estado_id . "' ,
										tipo_estado_id	 =  1 ,
										tipo_parcela_alta_id = 2 ,
										parcela_f_alta	= NOW(),
										parcela_f_proceso	= NOW(),
										parcela_f_estado	= NOW(),
										usuario_id = '". $usuario_id . "',
										direccion_nomencla_rud_real	= '". $direccion_nomencla ."',
										direccion_nomencla_rud_postal	= '". $direccion_nomencla ."',
										tipo_nomenclatura = $tipo_nomenclatura_id,
										parcela_expediente = '$expediente'";
								if($db2->query($INS)){
									$SELECT = "SELECT MAX(parcela_id) AS parcela_id FROM parcelas";
									$result = $db2->query($SELECT);
									if($obj = $result->fetch_object()){
										$parcela_destino_id = $obj->parcela_id;
									}
								}
								
								$INSERT = "INSERT INTO uniones_desgloses SET parcela_id  = '". $parcela_id . "', 
													parcela_destino_id = '" . $parcela_destino_id . "',
													tipo_union_desglose_id =  2,
													union_desglose_fecha = NOW(),
													usuarios_id = '" . $usuario_id ."'";
								$db2->query($INSERT);
								
								if($matricula){
									$tipo_instrumento_id = "1";
									$persona_parcela_num_int = "'$matricula'";
								}else{
									$tipo_instrumento_id = "bper.tipo_instrumento_id";
									$persona_parcela_num_int = "bper.persona_parcela_num_int";
								}
								
								$INSERT = "INSERT INTO personas_parcelas
									(persona_id              		,
									parcela_id          			,
									tipo_instrumento_id  			,
									persona_parcela_num_int         ,
									persona_parcela_f_int      		,
									persona_parcela_dominio         ,
									tipo_persona_parcela_id       	,
									tipo_condicion_id   			,
									persona_parcela_origen          ,
									persona_parcela_f_pro      		,
									usuario_id             			,
									tipo_estado_id         			,
									persona_parcela_ppal)
									(
									SELECT bper.persona_id       		, " .
										$parcela_destino_id . "         , " .
										$tipo_instrumento_id . "        , " .
										$persona_parcela_num_int . "  	,
										bper.persona_parcela_f_int      ,
										bper.persona_parcela_dominio    ,
										bper.tipo_persona_parcela_id    ,
										bper.tipo_condicion_id       	,
										bper.persona_parcela_origen   	,
										NOW()          					, " .
										$usuario_id . " 				,
										bper.tipo_estado_id             ,
										bper.persona_parcela_ppal
									FROM  personas_parcelas as bper
									WHERE bper.parcela_id = " . $parcela_id . ");";
								$db2->query($INSERT);
								
								// hereda los servicios
								$INSERT = "INSERT INTO parcelas_servicios
												(servicio_id              	,
												parcela_id  				,
												parcela_servicio_f_proce  	,
												usuario_id          		,
												estado_id       )
												(
												SELECT bps.servicio_id , " .
													$parcela_destino_id . " ,
													NOW()          , " .
													$usuario_id . " ,
													bps.estado_id 
												FROM  parcelas_servicios as bps
												WHERE bps.parcela_id = " . $parcela_id . ");";
								$db2->query($INSERT);
								
								//MEJORAS
								$MEJORAS = "SELECT * FROM tmp_mejoras WHERE union_desglose_id = $union_desglose_id AND operacion = 'D'";
								$result2 = $db2->query($MEJORAS);
								if($obj2 = $result2->fetch_object()){
									$ultimo_padron = $obj2->siguiente;
									$mejora_id = $obj2->mejora_id;
									$SELECT = "SELECT mejora_nro_exp,
														mejora_letra_exp,
														mejora_fecha_exp,
														tipo_mejora_categoria_id,
														mejora_sup_cub,
														mejora_sup_semi_cub,
														mejora_porc_dominio,
														mejora_f_alta,
														mejora_f_pro,
														tipo_mejora_uso_id,
														tipo_mejora_id,
														tipo_exp_avaluo_id,
														mejora_categoria_dpc,
														tipo_estado_id 
												FROM mejoras 
												WHERE mejora_id = $mejora_id";
									$result3 = $db3->query($SELECT);
									if($obj3 = $result3->fetch_object()){
										$tipo_mejora_categoria_id = $obj3->tipo_mejora_categoria_id;
										if($tipo_mejora_categoria_id != 10){//para PH no se hereda el codigo 11 - PH - Edific - Torre
											$INS = "INSERT INTO mejoras SET 
															parcela_id = $parcela_destino_id, 
															mejora_nro_exp = '". $obj3->mejora_nro_exp . "', 
															mejora_letra_exp = '". $obj3->mejora_letra_exp . "',
															mejora_fecha_exp = '". $obj3->mejora_fecha_exp . "', 
															tipo_mejora_categoria_id = $tipo_mejora_categoria_id,
															mejora_sup_cub = '". $obj3->mejora_sup_cub . "', 
															mejora_sup_semi_cub = '". $obj3->mejora_sup_semi_cub . "',
															mejora_porc_dominio = '". $obj3->mejora_porc_dominio . "', 
															mejora_f_alta = '".$obj3->mejora_f_alta . "',
															mejora_f_pro = NOW(),
															tipo_mejora_uso_id = '". $obj3->tipo_mejora_uso_id . "',
															tipo_mejora_id = '". $obj3->tipo_mejora_id . "',
															tipo_exp_avaluo_id = '". $obj3->tipo_exp_avaluo_id . "',
															mejora_categoria_dpc = '". $obj3->mejora_categoria_dpc ."' ,
															usuario_id = $usuario_id,
															tipo_estado_id = 1"; 
											$db3->query($INS);
										}
									}									
								}
								
								//SELECCIONAR TITULAR PRINCIPAL DE ESTA PARCELA?
								$SELECT = "SELECT persona_id FROM personas_parcelas WHERE parcela_id = " . $parcela_id;
								$result2 = $db2->query($SELECT);
								if($obj2 = $result2->fetch_object()){
									$persona_id_ = $obj2->persona_id;
								}
								$SELECT = "SELECT persona_denominacion FROM personas WHERE persona_id = '$persona_id_'";
								$result2 = $db2->query($SELECT);
								if($obj2 = $result2->fetch_object()){
									$titular = $obj2->persona_denominacion;
								}								
								$SELECT = "SELECT usuario_nombre FROM usuarios WHERE usuario_id = '$usuario_id'";
								$result2 = $db2->query($SELECT);
								if($obj2 = $result2->fetch_object()){
									$usuario_nombre = $obj2->usuario_nombre;
								}
								if(!$barrio_id){
									$barrio_id = 0;
								}else{									
									$SELECT = "SELECT gestion_direcciones.barrios.barrio_nombre AS barrio_nombre FROM gestion_direcciones.barrios WHERE gestion_direcciones.barrios.barrio_id = '$barrio_id'";
									$result2 = $db2->query($SELECT);
									if($obj2 = $result2->fetch_object()){
										$barrio_nombre = $obj2->barrio_nombre;
									}
								}
								//registrar en la geo el barrio de la parcela matriz
								$conexion = "host=".$postgres['host']." dbname=".$postgres['database']." user=".$postgres['user']." password=".$postgres['pass'];
								$dbconn = pg_connect($conexion) or die('No se ha podido conectar: ' . pg_last_error());
								
								$SQL_POSTGRES = "UPDATE public.".$municipio['capa_parcela']." SET barrio_id = $barrio_id WHERE nomenc21 LIKE '$udparcela_nomencla_origen%'";
								$result = pg_query($SQL_POSTGRES) or die('La consulta PostgreSQL fallo: '.pg_last_error());
								
								//registra poligono actual en el origen
								$SQL_POSTGRES = "SELECT ST_AsText(st_transform(geom,4326)) AS wkt FROM public.".$municipio['capa_parcela']." WHERE nomenc21 LIKE '$udparcela_nomencla_origen%'";
								$result = pg_query($SQL_POSTGRES) or die('La consulta PostgreSQL fallo: '.pg_last_error());
								if($line = pg_fetch_array($result)){
									$wkt = $line['wkt'];
								}
								if($wkt){
									$sql_mysql = "UPDATE parcelas SET wkt = '$wkt', geom = MULTIPOLYGONFROMTEXT('$wkt') WHERE parcela_id = $parcela_id";
									$result2 = $db2->query($sql_mysql);
								}								
								
								//echo json_encode("SQL_POSTGRES: ".$SQL_POSTGRES);
								
								$reporte[] = array(
												'fecha' => $fecha,
												'usuario_id' => $usuario_id,
												'titular' => $titular,
												'usuario_nombre' => $usuario_nombre,
												'barrio_nombre' => $barrio_nombre,
												'udparcela_nomencla_origen' => $udparcela_nomencla_origen,
												'udparcela_nomenclatura' => $udparcela_nomenclatura,
												'udparcela_padron' => $ul_p,
												'persona_id' => $persona_id
												);								
							}//en WHILE
							
							
							
							$parcelas_pendientes['estado'] = 'OK';
							$parcelas_pendientes['mensaje'] = 'Se crearon los nuevos padrones';
							$parcelas_pendientes['dato'] = $reporte;
							
							//---------------------------------Limpiar temporales------------------------------
							$SQL = "DELETE FROM tmp_mejoras WHERE usuario_id = $usuario_id";
							$db->query($SQL);
							$SQL = "DELETE FROM tmp_union_desglose WHERE usuario_id = $usuario_id";
							$db->query($SQL);
							
						}else{
							$parcelas_pendientes['mensaje'] = 'No corresponde la cantidades a crear para las PH';
						}
						
					}else{
						$parcelas_pendientes['mensaje'] = 'La matriz no posee una mejora del tipo PH';
					}
				}
			}elseif($es_ph == "NO"){//si no es PH verificar que no repita parcela y subparcelas en cero						
				//----------------------------------controlar cantidades en GeoDB---------------------------------------
				$conexion = "host=".$postgres['host']." dbname=".$postgres['database']." user=".$postgres['user']." password=".$postgres['pass'];
				$dbconn = pg_connect($conexion) or die('No se ha podido conectar: ' . pg_last_error());
				$SELECT = "SELECT udparcela_nomencla_origen FROM tmp_union_desglose WHERE usuario_id = $usuario_id AND operacion = 'D' GROUP BY udparcela_nomencla_origen";
				$result = $db->query($SELECT);
				if($obj = $result->fetch_object()){
					$nomencla = $obj->udparcela_nomencla_origen;
				}
				$SQL_POSTGRES = "SELECT count(*) AS cantidad FROM public.".$municipio['capa_parcela']." WHERE nomenc21 LIKE '$nomencla%'";
				$result = pg_query($SQL_POSTGRES) or die('La consulta PostgreSQL fallo: '.pg_last_error());
				if($line = pg_fetch_array($result, null, PGSQL_ASSOC)){
					$cantidad_geo = $line['cantidad'];
				}
				if($cantidad == $cantidad_geo){//si son iguales las cantidades de registros con sus correpondiente REGISTRAR
					/*********************************************************************************************************************************/
					//echo json_encode($cantidad);exit;
					$ph = "NO";
					$operacion  = "D";
					$parcela_id = 0;//actualiza en el while
					$wkt_matriz = "";
					//--------------GUARDAR EL ACTUAL POLIGONO PARA UNIR Y REGISTRAR EN EL MATRIZ--------------------
					for($i=1;$i<=$cantidad_geo;$i++){
						$where_union_parcelas[] = "(SELECT ST_Multi(geom) FROM public.".$municipio['capa_parcela']." WHERE nomenc21 LIKE '$nomencla%' AND id_des = $i)";
					}
					$end = "])) AS wkt_matriz;";
					$SQL_POSTGRES = "SELECT ST_AsText(ST_Multi(ST_Union(ARRAY[".implode(",",$where_union_parcelas)."]))) AS wkt_matriz;";

					$result = pg_query($SQL_POSTGRES) or die('La consulta PostgreSQL fallo: '.pg_last_error());
					if($line = pg_fetch_array($result)){
						$wkt_matriz = $line['wkt_matriz'];
						$SQL_POSTGRES = "SELECT ST_AsText(ST_Transform(ST_GeomFromText('$wkt_matriz',22182),4326)) As wgs_geom;";
						$result = pg_query($SQL_POSTGRES) or die('La consulta PostgreSQL fallo: '.pg_last_error());
						if($line = pg_fetch_array($result)){
							$wkt_matriz = $line['wgs_geom'];
						}
					}
					//------------------------------------------------------------------------------------------------
					$SQL = "SELECT * FROM tmp_union_desglose WHERE usuario_id = $usuario_id AND operacion = 'D'";
					$result_temp = $db->query($SQL);
					while($obj = $result_temp->fetch_object()){//por cada registro temporal
						$indice = $obj->indice;
						$parcela_id = $obj->parcela_id;
						$fecha = $obj->fecha;
						$usuario_id = $obj->usuario_id;
						$udparcela_nomencla_origen = $obj->udparcela_nomencla_origen;
						$udparcela_nomenclatura = $obj->udparcela_nomenclatura;
						$udparcela_dependencia = $obj->udparcela_dependencia;
						$udparcela_distrito = $obj->udparcela_distrito;
						$udparcela_seccion = $obj->udparcela_seccion;
						$udparcela_manzana = $obj->udparcela_manzana;
						$udparcela_parcela = $obj->udparcela_parcela;
						$udparcela_subparcela = $obj->udparcela_subparcela;
						$udparcela_fraccion = $obj->udparcela_fraccion;						
						$udX = $obj->udX;
						$udY = $obj->udY;
						$persona_id = $obj->persona_id;
						$direccion_nomencla = $obj->direccion_nomencla;
						$tipo_parce = $obj->tipo_parce;
						$estado_par = $obj->estado_par;
						$origen = $obj->origen;
						$barrio_id = $obj->barrio_id;
						$tipo_nomenclatura_id = $obj->tipo_nomenclatura_id;
						if(!$barrio_id){
							$barrio_id = 0;
						}
						$expediente = $obj->expediente;
						$matricula = $obj->matricula;
						$union_desglose_id = $obj->union_desglose_id;
						
						/*
						$SELECT = "SELECT (MAX(parcelas.parcela_padron) + 1) AS ultimo_padron FROM parcelas";
						$result = $db2->query($SELECT);
						if($obj = $result->fetch_object()){
							$ultimo_padron = $obj->ultimo_padron;
						}
						*/
						
						$ultimo_padron = file_get_contents(protocolo().$_SERVER['HTTP_HOST']."/desarrollo_catastro/public/ultimoPadron");
						
						if($tipo_nomenclatura_id == 2){
							$udparcela_dependencia  = $municipio['municipio_sigla'];
							$udparcela_seccion = "00";
							$udparcela_distrito = "00";
							$udparcela_manzana = "0000";
							$udparcela_parcela = str_pad($ultimo_padron,6,"0",STR_PAD_LEFT);
							$udparcela_subparcela = "0000";
							$udparcela_dig_veri = "0";
							$udparcela_nomenclatura = $udparcela_dependencia.$udparcela_distrito.$udparcela_seccion.$udparcela_manzana.$udparcela_parcela.$udparcela_subparcela.$udparcela_dig_veri;
						}
						
						// Validar si tiene titular
						$SELECT = "SELECT persona_id FROM personas_parcelas WHERE parcela_id = $parcela_id ";
						$result = $db->query($SELECT);
						if($obj = $result->fetch_object()){					
						}else{
							$parcelas_pendientes['mensaje'] = 'La parcela no posee titular. Dar de alta un titular para continuar.';
							echo json_encode($parcelas_pendientes); exit;
						}					
						
						
						$INS = "INSERT INTO parcelas SET 
								parcela_nomenclatura = '" . $udparcela_nomenclatura . "',
								parcela_padron	 =  '". $ultimo_padron  . "',
								parcela_dependencia	 =  '".$municipio['municipio_dependencia']."',
								parcela_distrito	 =  '". $udparcela_distrito . "',
								parcela_seccion	 =  '". $udparcela_seccion . "',
								parcela_manzana	 =  '". $udparcela_manzana . "',
								parcela_parcela	 =  '". $udparcela_parcela . "',
								parcela_subparcela	 =  '". $udparcela_subparcela . "',
								parcela_dig_veri	 =  '0',
								parcela_x	 =  '".$udX."',
								parcela_y	 =  '".$udY."',
								tipo_parcela_estado_id = '" . $estado_id . "' ,
								tipo_estado_id	 =  1,
								tipo_parcela_alta_id = 2,
								parcela_f_alta	= NOW(),
								parcela_f_proceso	= NOW(),
								parcela_f_estado	= NOW(),
								usuario_id = '". $usuario_id . "',
								direccion_nomencla_rud_real	= '". $direccion_nomencla ."',
								direccion_nomencla_rud_postal	= '". $direccion_nomencla ."',
								tipo_nomenclatura = $tipo_nomenclatura_id,
								parcela_expediente = '$expediente'";
						if($db2->query($INS)){
							$SELECT = "SELECT MAX(parcela_id) AS parcela_id FROM parcelas";
							$result = $db2->query($SELECT);
							if($obj = $result->fetch_object()){
								$parcela_destino_id = $obj->parcela_id;
							}
						}				
						
						$INSERT = "INSERT INTO uniones_desgloses SET
											parcela_id  = '". $parcela_id . "', 
											parcela_destino_id = '" . $parcela_destino_id . "',
											tipo_union_desglose_id =  2,
											union_desglose_fecha = NOW(),
											usuarios_id = '" . $usuario_id ."'";
						$db2->query($INSERT);

						if($matricula){
							$tipo_instrumento_id = "1";
							$persona_parcela_num_int = "'$matricula'";
						}else{
							$tipo_instrumento_id = "bper.tipo_instrumento_id";
							$persona_parcela_num_int = "bper.persona_parcela_num_int";
						}						
						$INSERT = "INSERT INTO personas_parcelas
							(persona_id              		,
							parcela_id          			,
							tipo_instrumento_id  			,
							persona_parcela_num_int         ,
							persona_parcela_f_int      		,
							persona_parcela_dominio         ,
							tipo_persona_parcela_id       	,
							tipo_condicion_id   			,
							persona_parcela_origen          ,
							persona_parcela_f_pro      		,
							usuario_id             			,
							tipo_estado_id         			,
							persona_parcela_ppal)
							(
							SELECT bper.persona_id       		, " .
								$parcela_destino_id . "         , " .
								$tipo_instrumento_id . "        , " .
								$persona_parcela_num_int . "  	,
								bper.persona_parcela_f_int      ,
								bper.persona_parcela_dominio    ,
								bper.tipo_persona_parcela_id    ,
								bper.tipo_condicion_id       	,
								bper.persona_parcela_origen   	,
								NOW()          					, " .
								$usuario_id . " 				,
								bper.tipo_estado_id             ,
								bper.persona_parcela_ppal
							FROM  personas_parcelas as bper
							WHERE bper.parcela_id = " . $parcela_id . ");";
						$db2->query($INSERT);

						// hereda los servicios
						$INSERT = "INSERT INTO parcelas_servicios
										(servicio_id              	,
										parcela_id  				,
										parcela_servicio_f_proce  	,
										usuario_id          		,
										estado_id       )
										(
										SELECT bps.servicio_id , " .
											$parcela_destino_id . " ,
											NOW()          , " .
											$usuario_id . " ,
											bps.estado_id 
										FROM  parcelas_servicios as bps
										WHERE bps.parcela_id = " . $parcela_id . ");";
						$db2->query($INSERT);
						
						//MEJORAS
						$MEJORAS = "SELECT * FROM tmp_mejoras WHERE union_desglose_id = $union_desglose_id AND operacion = 'D'";
						$result = $db2->query($MEJORAS);
						while($obj = $result->fetch_object()){
							$mejora_id = $obj->mejora_id;
							$SELECT = "SELECT mejora_nro_exp,
												mejora_letra_exp,
												mejora_fecha_exp,
												tipo_mejora_categoria_id,
												mejora_sup_cub,
												mejora_sup_semi_cub,
												mejora_porc_dominio,
												mejora_f_alta,
												mejora_f_pro,
												tipo_mejora_uso_id,
												tipo_mejora_id,
												tipo_exp_avaluo_id,
												mejora_categoria_dpc,
												tipo_estado_id 
										FROM mejoras 
										WHERE mejora_id = $mejora_id";
							$result2 = $db3->query($SELECT);
							if($obj2 = $result2->fetch_object()){
								$INS = "INSERT INTO mejoras SET 
												parcela_id = $parcela_destino_id, 
												mejora_nro_exp = '". $obj2->mejora_nro_exp . "', 
												mejora_letra_exp = '". $obj2->mejora_letra_exp . "',
												mejora_fecha_exp = '". $obj2->mejora_fecha_exp . "', 
												tipo_mejora_categoria_id = '". $obj2->tipo_mejora_categoria_id . "',
												mejora_sup_cub = '". $obj2->mejora_sup_cub . "', 
												mejora_sup_semi_cub = '". $obj2->mejora_sup_semi_cub . "',
												mejora_porc_dominio = '". $obj2->mejora_porc_dominio . "', 
												mejora_f_alta = '". $obj2->mejora_f_alta . "',
												mejora_f_pro = NOW(),
												tipo_mejora_uso_id = '". $obj2->tipo_mejora_uso_id . "',
												tipo_mejora_id = '". $obj2->tipo_mejora_id . "',
												tipo_exp_avaluo_id = '". $obj2->tipo_exp_avaluo_id . "',
												mejora_categoria_dpc = '". $obj2->mejora_categoria_dpc ."' ,
												usuario_id = $usuario_id,
												tipo_estado_id = 1"; 
								$db3->query($INS);
							}
						}
						
						/**************************************Actualizar datos en GeoDB************************************/
						if(strlen($udparcela_nomenclatura) < 21){
							$udparcela_nomenclatura_21 = str_pad($udparcela_nomenclatura,21,"0",STR_PAD_RIGHT);
						}else{
							$udparcela_nomenclatura_21 = $udparcela_nomenclatura;
						}
						$udparcela_nomenclatura_16 = substr($udparcela_nomenclatura,0,16);
						if($udparcela_distrito == 99){
							$tipo_parce = "RURAL";
						}else{
							$tipo_parce = "URBANO";
						}
						//------------------------------POLIGONO ACTUAL-----------------------------------------
						//POLIGONO EN PARCELA
						$SQL_POSTGRES = "SELECT ST_AsText(st_transform(geom,4326)) AS wkt FROM public.".$municipio['capa_parcela']." WHERE nomenc21 LIKE '$nomencla%' AND id_des = $indice";
						$result = pg_query($SQL_POSTGRES) or die('La consulta PostgreSQL fallo: '.pg_last_error());
						if($line = pg_fetch_array($result)){
							$wkt = $line['wkt'];
						}
						//ACTUALIZAR LA PARCELA DESGLOSADA
						if($wkt){
							$sql_mysql = "UPDATE parcelas SET wkt = '$wkt', geom = MULTIPOLYGONFROMTEXT('$wkt') WHERE parcela_id = $parcela_destino_id";
							$result = $db2->query($sql_mysql);
						}	
						/*
						$SQL_POSTGRES = "UPDATE public.".$municipio['capa_parcela']." SET
											nomenc21 = '$udparcela_nomenclatura_21',
											tipo_parce = '$tipo_parce',
											origen = '$udparcela_nomencla_origen',
											barrio_id = $barrio_id,
											id_des = null
											WHERE nomenc21 = '$nomencla' AND id_des = $indice";
						*/
						$SQL_POSTGRES = "UPDATE public.".$municipio['capa_parcela']." SET
											nomenc21 = '$udparcela_nomenclatura_21',
											id_des = null
											WHERE nomenc21 LIKE '$nomencla%' AND id_des = $indice";
											
						$result = pg_query($SQL_POSTGRES) or die('La consulta PostgreSQL fallo: '.pg_last_error());
						pg_free_result($result);
						//--------------------------------------------------------------------------------------
						$SQL = "SELECT persona_id FROM personas_parcelas WHERE parcela_id = " . $parcela_id;
						$result = $db2->query($SQL);
						if($obj = $result->fetch_object()){
							$persona_id_ = $obj->persona_id;
						}
						$SQL = "SELECT persona_denominacion FROM personas WHERE persona_id = '$persona_id_'";
						$result = $db2->query($SQL);
						if($obj = $result->fetch_object()){
							$titular = $obj->persona_denominacion;
						}
						$SQL = "SELECT usuario_nombre FROM usuarios WHERE usuario_id = '$usuario_id'";
						$result = $db2->query($SQL);
						if($obj = $result->fetch_object()){
							$usuario_nombre = $obj->usuario_nombre;
						}
						$SQL = "SELECT gestion_direcciones.barrios.barrio_nombre AS barrio_nombre FROM gestion_direcciones.barrios WHERE gestion_direcciones.barrios.barrio_id = '$barrio_id'";
						$result = $db2->query($SQL);
						if($obj = $result->fetch_object()){
							$barrio_nombre = $obj->barrio_nombre;
						}					
						
						$reporte[] = array(
										'fecha' => $fecha,
										'usuario_id' => $usuario_id,
										'titular' => $titular,
										'usuario_nombre' => $usuario_nombre,
										'barrio_nombre' => $barrio_nombre,
										'udparcela_nomencla_origen' => $udparcela_nomencla_origen,
										'udparcela_nomenclatura' => $udparcela_nomenclatura,
										'persona_id' => $persona_id
										);
					}//fin WHILE
					
					//REGISTRAR EN EL MATRIZ EL POLIGONO
					if($wkt_matriz && $parcela_id){
						$sql_mysql = "UPDATE parcelas SET wkt = '$wkt_matriz', geom = MULTIPOLYGONFROMTEXT('$wkt_matriz') WHERE parcela_id = $parcela_id";
						$result = $db2->query($sql_mysql);						
					}
					//---------------------------baja de padron matriz---------------------------------
					$SQL = "UPDATE parcelas SET tipo_estado_id = 2 WHERE parcela_id = $parcela_id";
					$db->query($SQL);
					$parcelas_pendientes['estado'] = 'OK';
					$parcelas_pendientes['mensaje'] = 'Se crearon los nuevos padrones';
					$parcelas_pendientes['dato'] = $reporte;
					//---------------------------------Limpiar temporales------------------------------
					pg_close($dbconn);
					$SQL = "DELETE FROM tmp_mejoras WHERE usuario_id = $usuario_id";
					$db->query($SQL);
					$SQL = "DELETE FROM tmp_union_desglose WHERE usuario_id = $usuario_id";
					$db->query($SQL);					
				}else{
					$parcelas_pendientes['mensaje'] = 'No corresponde la cantidades a crear para los degloses fisicos';
				}
			}
		}else{
			$parcelas_pendientes['mensaje'] = 'No se encontró trabajo pendiente';
		}		
	}else{
		$parcelas_pendientes['mensaje'] = 'No tiene registros pendientes a crear';
	}
	mysqli_close($db);
	mysqli_close($db2);
	mysqli_close($db3);
}else{
	if($_POST['registrar'] != 1){
		$parcelas_pendientes['mensaje'] = 'Si orden para registrar';
	}
	if(!$_POST['uid']){
		$parcelas_pendientes['mensaje'] = 'Sin session de usuario';
	}
}
echo json_encode($parcelas_pendientes);
?>
