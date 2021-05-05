<?php
header('Content-Type: application/json');
include("configuration.php");
//base de datos postgres
$parcelas_pendientes = array('estado' => 'ERROR','mensaje' => 'No se pudo realizar la operacion', 'dato' => null);

function protocolo(){
	if(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
		return 'https://';
	}else{
		return 'http://';
	}
}

if($_POST['uid'] && $_POST['registrar'] == 1){//si esta la session de usuario y viene parametro para registrar
	$usuario_id = $_POST['uid'];
	$dbg = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
	$dbg1 = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
	$audit_string = implode('|',array($usuario_id,$_SERVER['REMOTE_ADDR'],substr(strrchr ($_SERVER['PHP_SELF'], "/"), 1)));
	
	// Selecciono nomenclaturas de la tabla temporal segun el usuario
	$nomenclaturas = array();
	$SELECT = "SELECT * FROM tmp_union_desglose WHERE operacion = 'U' AND usuario_id = $usuario_id";
	$dbg->query($SELECT);
	$result = $dbg->query($SELECT);
	while($obj = $result->fetch_object()){
		array_push($nomenclaturas,$obj->udparcela_nomencla_origen);
	}	

	// Verifico conexion postgres
	$conexion = "host=".$postgres['host']." dbname=".$postgres['database']." user=".$postgres['user']." password=".$postgres['pass'];
	$dbconn = pg_connect($conexion) or die('No se ha podido conectar: ' . pg_last_error());
	
	// Obtengo nueva geometrica (union de las parcelas a unir)
	$geom = '';
	$where_eliminar = '';
	$select = "SELECT ST_Multi(ST_Union(ARRAY[";
	$where = "";
	for($i = 0; $i < count($nomenclaturas); $i++){
		if($i == (count($nomenclaturas) - 1)){
			$where .= " (SELECT ST_Multi(geom) FROM public.".$municipio['capa_parcela']." WHERE nomenc21 LIKE '".$nomenclaturas[$i]."%') ";			
			$where_eliminar .= " nomenc21 LIKE '".$nomenclaturas[$i]."%'";
		}else{
			$where .= " (SELECT ST_Multi(geom) FROM public.".$municipio['capa_parcela']." WHERE nomenc21 LIKE '".$nomenclaturas[$i]."%'), ";			
			$where_eliminar .= " nomenc21 LIKE '".$nomenclaturas[$i]."%' OR ";
		}
	}
	$end = "])) AS resultado;";
	$SQL_POSTGRES = $select . $where . $end;	
	
	$result = pg_query($SQL_POSTGRES) or die('La consulta PostgreSQL fallo: '.pg_last_error());
	if($line = pg_fetch_array($result)) {
		$geom = $line['resultado'];
	}	
	
	$SELECT = "SELECT udparcela_nomenclatura FROM tmp_union_desglose WHERE operacion = 'U' AND usuario_id = $usuario_id GROUP BY udparcela_nomenclatura";
	$result = $dbg1->query($SELECT);
	if($obj = $result->fetch_object()){
		$nomenclatura = $obj->udparcela_nomenclatura;
	}

	//CREAR NUEVA PARCELA
	$SELECT = "SELECT direccion_nomencla FROM tmp_union_desglose WHERE operacion = 'U' AND usuario_id = $usuario_id GROUP BY direccion_nomencla";
	$result = $dbg1->query($SELECT);
	if($obj = $result->fetch_object()){
		$direccion_nomencla_rud_real = $obj->direccion_nomencla;
	}	
	/*
	$SELECT = "SELECT (MAX(parcela_padron) + 1) AS siguiente FROM parcelas";
	$result = $dbg1->query($SELECT);
	if($obj = $result->fetch_object()){
		$parcela_padron_nuevo = $obj->siguiente;
	}
	*/
	
	$parcela_padron_nuevo = file_get_contents(protocolo().$_SERVER['HTTP_HOST']."/desarrollo_catastro/public/ultimoPadron");
	
	$SELECT = "SELECT expediente FROM tmp_union_desglose WHERE operacion = 'U' AND usuario_id = $usuario_id GROUP BY expediente";
	$result = $dbg1->query($SELECT);
	if($obj = $result->fetch_object()){
		$expediente = $obj->expediente;
	}	
	$SELECT = "SELECT tipo_nomenclatura_id FROM tmp_union_desglose WHERE operacion = 'U' AND usuario_id = $usuario_id GROUP BY tipo_nomenclatura_id";
	$result = $dbg1->query($SELECT);
	if($obj = $result->fetch_object()){
		$tipo_nomenclatura_id = $obj->tipo_nomenclatura_id;
	}
	$parcela_dependencia = substr($nomenclatura,0,2);	
	$parcela_subparcela = substr($nomenclatura,16,4);
	$parcela_dig_veri = substr($nomenclatura,20,1);
	if($tipo_nomenclatura_id == 2){
		$parcela_dependencia = $municipio['municipio_sigla'];
		$parcela_distrito = "00";
		$parcela_seccion = "00";
		$parcela_manzana = "0000";
		$parcela_parcela = str_pad($parcela_padron_nuevo,6,"0",STR_PAD_LEFT);
		$parcela_subparcela = "0000";
		$parcela_dig_veri = "0";
		$nomenclatura = $parcela_dependencia.$parcela_distrito.$parcela_seccion.$parcela_manzana.$parcela_parcela.$parcela_subparcela.$parcela_dig_veri;
	}elseif($tipo_nomenclatura_id == 1){
		$parcela_distrito = substr($nomenclatura,2,2);
		$parcela_seccion = substr($nomenclatura,4,2);
		$parcela_manzana = substr($nomenclatura,6,4);
		$parcela_parcela = substr($nomenclatura,10,6);
		$direccion_x = "";
		$direccion_y = "";
	}elseif($tipo_nomenclatura_id == 3){
		$direccion_x = substr($nomenclatura,2,7);
		$direccion_y = substr($nomenclatura,9,7);
		$parcela_distrito = "";
		$parcela_seccion = "";
		$parcela_manzana = "";
		$parcela_parcela = "";
	}else{
		$parcelas_pendientes['mensaje'] = "No se puede definir tipo de nomenclatura";
		exit;
	}
		
	//traer poligonos a unir para agregar al WKT
	//---------------------------------------------------------------------------------
	for($i = 0; $i < count($nomenclaturas); $i++){
		$SQL_POSTGRES = "SELECT ST_AsText(st_transform(geom,4326)) AS wkt FROM public.".$municipio['capa_parcela']." WHERE nomenc21 LIKE '".$nomenclaturas[$i]."%'";
		$result = pg_query($SQL_POSTGRES) or die('La consulta PostgreSQL fallo: '.pg_last_error());
		if($line = pg_fetch_array($result)){
			$wkt = $line['wkt'];
		}
		if($wkt){
			$sql_mysql = "UPDATE parcelas SET wkt = '$wkt', geom = MULTIPOLYGONFROMTEXT('$wkt') WHERE parcela_nomenclatura LIKE '".$nomenclaturas[$i]."%'";
			$result = $dbg->query($sql_mysql);
		}
	}
	//---------------------------------------------------------------------------------
	// Realizo insercion postgres
	$SQL_POSTGRES_INSERT = "INSERT INTO ".$municipio['capa_parcela']." (geom, nomenc21) VALUES ('$geom', '$nomenclatura')";
	$result = pg_query($SQL_POSTGRES_INSERT) or die('La consulta PostgreSQL fallo: '.pg_last_error());

	// Elimino matrices
	$SQL_POSTGRES_DELETE = "DELETE FROM ".$municipio['capa_parcela']." WHERE " . $where_eliminar;
	$result = pg_query($SQL_POSTGRES_DELETE) or die('La consulta PostgreSQL fallo: '.pg_last_error());
	
	$wkt_nuevo = '';
	$geom_nuevo = '';
	$SQL_POSTGRES = "SELECT ST_AsText(st_transform(geom,4326)) AS wkt FROM public.".$municipio['capa_parcela']." WHERE nomenc21 LIKE '$nomenclatura%'";
	$result = pg_query($SQL_POSTGRES) or die('La consulta PostgreSQL fallo: '.pg_last_error());
	if($line = pg_fetch_array($result)){
		$wkt_nuevo = $line['wkt'];
	}
	
	// Realizo insercion mysql						
	$INSERT = "INSERT INTO parcelas SET 
							parcela_nomenclatura = '" . $nomenclatura . "',
							parcela_dependencia = '".$parcela_dependencia."',
							parcela_distrito = '" . $parcela_distrito . "',
							parcela_seccion = '" . $parcela_seccion . "',
							parcela_manzana = '" . $parcela_manzana . "',
							parcela_parcela = '" . $parcela_parcela . "',
							parcela_subparcela = '" . $parcela_subparcela . "',
							parcela_dig_veri = '" . $parcela_dig_veri . "',
							parcela_padron = '" . $parcela_padron_nuevo . "',
							direccion_nomencla_rud_real = '" . $direccion_nomencla_rud_real . "',
							direccion_nomencla_rud_postal = '" . $direccion_nomencla_rud_real.  "',
							parcela_super_mensura = '"  . $parcela_super_mensura . "', 
							parcela_super_titulo = '"  . $parcela_super_titulo . "', 
							parcela_super_cultivada = '"  . $parcela_super_cultivada . "', 
							parcela_sup_uf = '"  . $parcela_sup_uf . "', 
							parcela_porc_uf = '"  . $parcela_porc_uf . "',
							tipo_parcela_estado_id = 2,
							tipo_estado_id = 1,
							tipo_parcela_alta_id = 3,
							usuario_id = $usuario_id,
							parcela_f_alta = NOW(),
							parcela_expediente = '" . $expediente . "',
							tipo_nomenclatura = '" . $tipo_nomenclatura_id . "',
							parcela_x = '" . $direccion_x . "',
							parcela_y = '" . $direccion_y . "',
							parcela_f_proceso = NOW(),
							parcela_f_estado = NOW(),
							wkt = '$wkt_nuevo',
							geom = MULTIPOLYGONFROMTEXT('$wkt_nuevo')";
	$dbg->query($INSERT);
	$SELECT = "SELECT MAX(parcela_id) AS parcela_id FROM parcelas";
	$result = $dbg->query($SELECT);
	if($obj = $result->fetch_object()){
		$idparcela = $obj->parcela_id;
	}
	
	$SELECT = "SELECT tmp_union_desglose.* , 
					parcelas.parcela_id as pp,
					ifnull(parcelas.parcela_super_mensura,0) as parcela_super_mensura,
					ifnull(parcelas.parcela_super_titulo,0) as parcela_super_titulo,
					ifnull(parcelas.parcela_super_cultivada,0) as parcela_super_cultivada,
					ifnull(parcelas.parcela_sup_uf,0) as parcela_sup_uf,
					ifnull(parcelas.parcela_porc_uf,0) as parcela_porc_uf
				FROM tmp_union_desglose 
				LEFT JOIN parcelas ON parcelas.parcela_id = tmp_union_desglose.parcela_id
				WHERE tmp_union_desglose.operacion = 'U' AND tmp_union_desglose.usuario_id = $usuario_id";
	$result = $dbg->query($SELECT);
	while($obj = $result->fetch_object()){
		// cargo en union desglose entre la nueva y las uniones
		$INSERT = "INSERT INTO uniones_desgloses SET parcela_id = '". $obj->pp . "', 
										parcela_destino_id =  $idparcela,
										tipo_union_desglose_id =  1,
										union_desglose_fecha =  NOW(),
										usuarios_id = $usuario_id";
		$dbg1->query($INSERT);

		// le doy la baja a la parcela origen
		$UPDATE = "UPDATE parcelas SET 
						tipo_estado_id = 2, 
						parcela_f_proceso = NOW()
						WHERE parcela_id = " . $obj->pp ;
		$dbg1->query($UPDATE);
		
		$parcela_super_mensura = $parcela_super_mensura + $obj->parcela_super_mensura;
		$parcela_super_titulo = $parcela_super_titulo + $obj->parcela_super_titulo;
		$parcela_super_cultivada = $parcela_super_cultivada + $obj->parcela_super_cultivada;
		$parcela_sup_uf = $parcela_sup_uf + $obj->parcela_sup_uf;
		$parcela_porc_uf = $parcela_porc_uf + $obj->parcela_porc_uf;
	}
	
	//AGREGAR PERSONAS EN ALTA

	$SELECT = "SELECT persona_id FROM tmp_union_desglose WHERE operacion = 'U' AND usuario_id = $usuario_id GROUP BY persona_id";
	$result = $dbg1->query($SELECT);
	if($obj = $result->fetch_object()){
		$persona_idss = $obj->persona_id;
	}	
	$SELECT = "SELECT personas_parcelas.persona_id as persona_id,
		personas.persona_id as ppersona_id,
		personas.persona_denominacion, 
		personas_parcelas.persona_parcela_num_int,
		personas_parcelas.persona_parcela_f_int,
		personas_parcelas.tipo_instrumento_id,
		personas_parcelas.tipo_condicion_id,
		personas_parcelas.persona_parcela_origen,
		personas_parcelas.tipo_persona_parcela_id,
		'-----',
		tmp_union_desglose.*
	FROM tmp_union_desglose 
	INNER JOIN parcelas ON parcelas.parcela_id = tmp_union_desglose.parcela_id
	INNER JOIN personas_parcelas On personas_parcelas.parcela_id = parcelas.parcela_id
	INNER JOIN personas on personas.persona_id = personas_parcelas.persona_id
	WHERE tmp_union_desglose.operacion = 'U' AND personas_parcelas.tipo_estado_id = 1 AND tmp_union_desglose.usuario_id = $usuario_id
	GROUP BY personas_parcelas.persona_id;";
	$result = $dbg->query($SELECT);
	while($obj = $result->fetch_object()){
		$tipo_persona_parcela_id = $obj->tipo_persona_parcela_id;
		$persona_parcela_ppal = 0; 
		$a = $obj->persona_id;
		if ($obj->ppersona_id == $persona_idss) {
			$tipo_persona_parcela_id = 1;
			$persona_parcela_ppal = 1;
		}

		$INS = "INSERT INTO personas_parcelas SET
					persona_id = '". $obj->ppersona_id . "',
					parcela_id = '" . $idparcela . "',
					persona_parcela_num_int =  '". $obj->persona_parcela_num_int . "', 
					persona_parcela_f_int =  '". $obj->persona_parcela_f_int . "', 
					persona_parcela_f_pro =  NOW(), 
					tipo_instrumento_id = '" . $obj->tipo_instrumento_id ."',
					tipo_condicion_id =  '". $obj->tipo_condicion_id . "', 
					persona_parcela_origen =  '". $obj->persona_parcela_origen . "', 
					tipo_estado_id = 1 ,
					usuario_id = $usuario_id,
					persona_parcela_ppal = '" . $persona_parcela_ppal . "',
					tipo_persona_parcela_id =  '". $tipo_persona_parcela_id ."'"; 
		if( ($obj->persona_id) AND ($idparcela) ) $dbg1->query($INS);
	}

	//AGREGA SERVICIOS
	$SELECT = "SELECT parcelas_servicios.servicio_id
				FROM tmp_union_desglose 
				INNER JOIN parcelas ON parcelas.parcela_id = tmp_union_desglose.parcela_id
				INNER JOIN parcelas_servicios On parcelas_servicios.parcela_id = parcelas.parcela_id
				WHERE tmp_union_desglose.operacion = 'U' AND tmp_union_desglose.usuario_id = $usuario_id
				GROUP BY parcelas_servicios.servicio_id;";
	$result = $dbg->query($SELECT);
	while($obj = $result->fetch_object()){
		$INS = "INSERT INTO parcelas_servicios SET
					servicio_id = '". $obj->servicio_id . "',
					parcela_id = '" . $idparcela . "',
					parcela_servicio_f_proce =  NOW(), 
					usuario_id = $usuario_id";
		if( ($obj->servicio_id) AND ($idparcela) ) $dbg1->query($INS);
	}
	
	$SELECT = "SELECT parcelas.parcela_padron,
				mejora_nro_exp,
				mejora_letra_exp,
				mejora_fecha_exp,
				tipo_mejora_categoria_id,
				mejora_sup_cub, 
				mejora_sup_semi_cub,
				mejora_f_alta,
				mejora_f_pro,
				tipo_mejora_uso_id,
				tipo_mejora_id,
				tipo_exp_avaluo_id,
				mejora_categoria_dpc,
				mejora_id_old,
				mejoras.tipo_estado_id
				FROM tmp_union_desglose 
				INNER JOIN parcelas ON parcelas.parcela_id = tmp_union_desglose.parcela_id
				INNER JOIN mejoras ON mejoras.parcela_id = parcelas.parcela_id
				WHERE tmp_union_desglose.operacion = 'U' AND tmp_union_desglose.usuario_id = $usuario_id AND mejoras.tipo_estado_id = 1";
	$result = $dbg->query($SELECT);
	while($obj = $result->fetch_object()){
		$INS = "INSERT INTO mejoras
							SET 
							parcela_id = '". $idparcela . "',
							mejora_nro_exp = '". $obj->mejora_nro_exp . "',
							mejora_letra_exp = '". $obj->mejora_letra_exp . "',
							mejora_fecha_exp = '". $obj->mejora_fecha_exp . "',
							tipo_mejora_categoria_id = '". $obj->tipo_mejora_categoria_id . "',
							mejora_sup_cub = '". $obj->mejora_sup_cub . "',
							mejora_sup_semi_cub = '". $obj->mejora_sup_semi_cub . "',
							mejora_f_alta = NOW(),
							mejora_f_pro = NOW(),
							tipo_mejora_uso_id = '". $obj->tipo_mejora_uso_id . "',
							tipo_mejora_id = '". $obj->tipo_mejora_id . "',
							tipo_exp_avaluo_id = '". $obj->tipo_exp_avaluo_id . "',
							mejora_categoria_dpc = '". $obj->mejora_categoria_dpc ."' ,
							mejora_id_old = '". $obj->mejora_id_old ."' ,
							tipo_estado_id = '". $obj->tipo_estado_id ."'"; 
		$dbg1->query($INS) ;
	}

	$DELETE = " DELETE FROM tmp_union_desglose WHERE operacion = 'U' AND usuario_id = $usuario_id";
	$dbg1->query($DELETE);

	mysqli_close($dbg);
	mysqli_close($dbg1);
	$reporte[] = array(
						'nomenclatura' => $nomenclatura
						);
	
	$parcelas_pendientes['mensaje'] = "Realizado la Union de las parcelas";
	$parcelas_pendientes['estado'] = 'OK';
	$parcelas_pendientes['datos'] = $reporte;
	
}else{
	if($_POST['registrar'] != 1){
		$parcelas_pendientes['mensaje'] = 'Sin orden para registrar';
	}
	if(!$_POST['uid']){
		$parcelas_pendientes['mensaje'] = 'Sin session de usuario';
	}
}
echo json_encode($parcelas_pendientes);
?>
