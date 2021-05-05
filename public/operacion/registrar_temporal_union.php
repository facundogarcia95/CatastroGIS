<?php
header('Content-Type: application/json');
include("configuration.php");//base de datos postgres
//base de datos postgres
$parcelas_pendientes = array('estado' => 'ERROR','mensaje' => 'No se encuentra la session de usuario o parametro de nomenclatura destino o parcela o unificar');

if($_POST["uid"] && $_POST["nomencla"] && $_POST["parcela_id"]){//si esta la session de usuario y viene parametro de nomencla
	$usuario_id = $_POST["uid"];
	$nomencla = $_POST["nomencla"];
	$parcela_id = $_POST["parcela_id"];
	$db = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
	$db2 = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);	

	$SELECT = "SELECT ".$base_datos_columna['columna_x']." FROM parcelas WHERE parcela_nomenclatura = '$nomencla'";	
	$result = $db->query($SELECT);
	if($obj = $result->fetch_row()){
		$direccion_x = $obj[0];
	}

	$SELECT = "SELECT ".$base_datos_columna['columna_y']." FROM parcelas WHERE parcela_nomenclatura = '$nomencla'";

	$result = $db->query($SELECT);
	if($obj = $result->fetch_row()){
		$direccion_y = $obj[0];
	}
	if($direccion_x && $direccion_y){
		$tipo_nomenclatura_id = 3;
	}else{
		$tipo_nomenclatura_id = 1;
	}

	//parcela destino
	$dependencia = substr($nomencla,0,2);
	$parcela_dig_veri = substr($nomencla,20,1);
	if($tipo_nomenclatura_id == 1){//tipo definitivo				
		$distrito = substr($nomencla,2,2);
		$seccion = substr($nomencla,4,2);
		$manzana = substr($nomencla,6,4);
		$parcela = substr($nomencla,10,6);		
		$x = "";
		$y = "";		
	}elseif($tipo_nomenclatura_id == 3){//tipo posicional
		$x = substr($nomencla,2,7);
		$y = substr($nomencla,9,7);
		$distrito = "";
		$seccion = "";
		$manzana = "";
		$parcela = "";
	}else{
		$parcelas_pendientes['mensaje'] = 'No se puede definir el tipo de nomenclatura';
		echo json_encode($parcelas_pendientes);
		exit;
	}
	//existe en la GeoDB?
	$tipo_nomenclatura_id = 2;
	$contador = 0;
	$conexion = "host=".$postgres['host']." dbname=".$postgres['database']." user=".$postgres['user']." password=".$postgres['pass'];
	$dbconn = pg_connect($conexion) or die('No se ha podido conectar: ' . pg_last_error());
	$nomencla_sql = substr($nomencla,0,20);
	$SQL_POSTGRES = "SELECT COUNT(*) AS cantidad FROM public.".$municipio['capa_parcela']." WHERE nomenc21 LIKE '$nomencla_sql%'";
	$result_pg = pg_query($SQL_POSTGRES) or die('La consulta PostgreSQL fallo: '.pg_last_error());
	if($line = pg_fetch_array($result_pg, null, PGSQL_ASSOC)){//datos de la parcelas de la geoDB
		$contador = $line['cantidad'];
	}
	// Reviso que el id de la parcela no haya sido insertado
	$SELECT = "SELECT parcela_id FROM tmp_union_desglose WHERE parcela_id = $parcela_id AND usuario_id <> $usuario_id";
	$result = $db->query($SELECT);
	if($obj = $result->fetch_object()){
		$parcelaUnica = $obj->parcela_id;
	}
	
	if(!$parcelaUnica){
		if($contador == 1 && $parcela_id){//si es union, se controla que no haya cambiado en el proceso de creacion		
			//buscar datos de parcela
			$SQL = "SELECT parcela_nomenclatura, direccion_nomencla_rud_real FROM parcelas WHERE parcela_id = $parcela_id";
			$result = $db->query($SQL);
			if($obj = $result->fetch_object()){
				$org_nomencla = $obj->parcela_nomenclatura;
				$direccion_nomencla = $obj->direccion_nomencla_rud_real;
			}
			//titular principal:
			$SELECT="SELECT persona_id FROM personas_parcelas WHERE parcela_id= $parcela_id  AND persona_parcela_ppal = 1";
			$result = $db->query($SELECT);
			if($obj = $result->fetch_object()){
				$persona_id=$obj->persona_id;
			}
			$barrio_id = 0;
			$db3 = mysqli_connect($mysql2['host'],$mysql2['user'],$mysql2['pass'],$mysql2['database']);
			if($resultado = $db3->query("SELECT barrio_id FROM direcciones WHERE direccion_nomencla = '$direccion_nomencla'")) {
				if($row = $resultado->fetch_object()){
					$barrio_id = $row->barrio_id;
				}
				mysqli_close($db3);
			}
			$SQL = "INSERT INTO tmp_union_desglose SET
													parcela_id = $parcela_id,
													fecha = NOW(),
													usuario_id = $usuario_id,
													operacion = 'U',
													udparcela_nomencla_origen = '$org_nomencla',
													udparcela_nomenclatura = '$nomencla',
													udparcela_dependencia = '$dependencia',
													udparcela_distrito = '$distrito',
													udparcela_seccion = '$seccion',
													udparcela_manzana = '$manzana',
													udparcela_parcela = '$parcela',
													udparcela_subparcela = '0000',
													udparcela_dig_veri = '$parcela_dig_veri',
													udX = '$x',
													udY = '$y',
													persona_id = '$persona_id',
													direccion_nomencla = '$direccion_nomencla',
													barrio_id = '$barrio_id',
													tipo_nomenclatura_id = $tipo_nomenclatura_id";
			//echo json_encode($SQL);exit;
			$result = $db->query($SQL);
			//mejoras
			$SQL = "SELECT mejora_id FROM mejoras WHERE parcela_id = $parcela_id AND tipo_estado_id = 1";
			$result = $db->query($SQL);
			while($obj = $result->fetch_object()){
				$mejora_id = $obj->mejora_id;
				$SQL = "INSERT INTO tmp_mejoras SET mejora_id = $mejora_id, operacion = 'U', usuario_id = $usuario_id";
				$db2->query($SQL);
			}
			$parcelas_pendientes['estado'] = 'OK';
			$parcelas_pendientes['mensaje'] = 'Se ha creado el trabajo en el temporal de union';
		}else{
			$parcelas_pendientes['mensaje'] = 'No se puede definir si se crea una union por no existir el poligono de parcela';
		}
	}
	pg_free_result($result_pg);		
	pg_close($dbconn);
	mysqli_close($db);
	mysqli_close($db2);
}else{
	if(!$_POST["parcela_id"]){
		$parcelas_pendientes['mensaje'] = 'Sin dato de parcela a registrar';
	}
	if(!$_POST["nomencla"]){
		$parcelas_pendientes['mensaje'] = 'Sin dato de nomenclatura';
	}
	if(!$_POST["tipo_nomenclatura_id"]){
		$parcelas_pendientes['mensaje'] = 'Sin dato de tipo nomenclatura';
	}	
	if(!$_POST["uid"]){
		$parcelas_pendientes['mensaje'] = 'Sin session de usuario';
	}
}
echo json_encode($parcelas_pendientes);
?>