<?php
header('Content-Type: application/json');
include("configuration.php");
//base de datos postgres
$parcelas_pendientes = array('estado' => 'ERROR','mensaje' => 'No se encuentra la session de usuario o parametro de nomenclatura o cantidad o tipo');
if($_POST["uid"] && $_POST["nomencla"] && $_POST["cant"] && $_POST["ph"]){//si esta la session de usuario y viene parametro de nomencla
	$usuario_id = $_POST["uid"];
	$nomencla = substr($_POST["nomencla"],0,20);
	$cant = $_POST["cant"];
	$ph = $_POST["ph"];
	$db = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
	$db2 = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
	
	$contador = 0;
	$conexion = "host=".$postgres['host']." dbname=".$postgres['database']." user=".$postgres['user']." password=".$postgres['pass'];
	$dbconn = pg_connect($conexion) or die('No se ha podido conectar: ' . pg_last_error());
	if($ph == "NO"){//no es PH debe tener màs de una parcela a desglosar
		$SQL_POSTGRES = "SELECT * FROM public.".$municipio['capa_parcela']." WHERE nomenc21 LIKE '$nomencla%' AND id_des <> 0 ORDER BY id_des";
	}else{
		$SQL_POSTGRES = "SELECT * FROM public.".$municipio['capa_parcela']." WHERE nomenc21 LIKE '$nomencla%'";
	}
	$result = pg_query($SQL_POSTGRES) or die('La consulta PostgreSQL fallo: '.pg_last_error());
	while($line = pg_fetch_array($result, null, PGSQL_ASSOC)){//datos de la parcelas de la geoDB
		$nomenc21 = $line['nomenc21'];
		$nomencla20 = substr($line['nomenc21'],0,20);
		$nomencla16 = substr($line['nomenc21'],0,16);
		$tipo_parce = $line['tipo_parce'];
		$estado_par = $line['estado_par'];
		$origen = $line['origen'];
		$capa = $line['capa'];
		$barrio_id = $line['barrio_id'];
		$id_des = $line['id_des'];
		$datos_parcela_carto = array(
									'nomenc21' => $nomenc21,
									'nomencla20' => $nomencla20,
									'nomencla16' => $nomencla16,
									'tipo_parce' => $tipo_parce,
									'estado_par' => $estado_par,
									'origen' => $origen,
									'capa' => $capa,
									'barrio_id' => $barrio_id,
									'id_des' => $id_des
									);
		$parcela_carto_add[] = $datos_parcela_carto;
		$contador++;
	}
	if($cant == $contador && $ph == "NO"){//si es desglose fisico, se controla que no haya cambiado en el proceso de creacion
		$SELECT = "SELECT parcela_id FROM parcelas WHERE SUBSTRING(parcela_nomenclatura,1,20) = '$nomencla'";
		$result = $db->query($SELECT);
		if($obj = $result->fetch_object()){
			$parcela_id = $obj->parcela_id;
		}
		$SELECT = "SELECT direccion_nomencla_rud_real FROM parcelas WHERE parcela_id= $parcela_id";
		$result = $db->query($SELECT);
		if($obj = $result->fetch_object()){
			$direccion_nomencla = $obj->direccion_nomencla_rud_real;
		}
		$SELECT = "SELECT tipo_nomenclatura FROM parcelas WHERE parcela_id= $parcela_id";
		$result = $db->query($SELECT);
		if($obj = $result->fetch_object()){
			$tipo_nomenclatura_id = $obj->tipo_nomenclatura;
		}
		$dependencia = substr($nomencla,0,2);
		$subparcela = "0000";
		$parcela_dig_veri = substr($nomencla,20,1);
		if($tipo_nomenclatura_id == 3){//tipo posicional							
			$x = substr($nomencla,2,7);
			$y = substr($nomencla,9,7);
			$distrito = "";
			$seccion = "";
			$manzana = "";
			$parcela = "";			
			$nomencla_nuevo = $dependencia.str_pad($x,7,"0",STR_PAD_LEFT).str_pad($y,7,"0",STR_PAD_LEFT)."0000".str_pad($parcela_dig_veri,1,"0",STR_PAD_LEFT);
		}else{//tipo definitivo
			$tipo_nomenclatura_id = 1;
			$distrito = substr($nomencla,2,2);
			$seccion = substr($nomencla,4,2);
			$manzana = substr($nomencla,6,4);
			$parcela = substr($nomencla,10,6);
			$x = "";
			$y = "";
			$nomencla_nuevo = $dependencia.str_pad($distrito,2,"0",STR_PAD_LEFT).str_pad($seccion,2,"0",STR_PAD_LEFT).str_pad($manzana,4,"0",STR_PAD_LEFT).str_pad($parcela,6,"0",STR_PAD_LEFT)."0000".str_pad($parcela_dig_veri,1,"0",STR_PAD_LEFT);
		}
		for($i=0;$i<$contador ;$i++){
			$SQL = "INSERT INTO tmp_union_desglose SET
													parcela_id = $parcela_id,
													fecha = NOW(),
													usuario_id = $usuario_id,
													operacion = 'D',
													udparcela_nomencla_origen = '$nomencla',
													udparcela_nomenclatura = '$nomencla_nuevo',
													udparcela_dependencia = '$dependencia',
													udparcela_distrito = '$distrito',
													udparcela_seccion = '$seccion',
													udparcela_manzana = '$manzana',
													udparcela_parcela = '$parcela',
													udparcela_subparcela = '0000',
													udparcela_dig_veri = '$parcela_dig_veri',
													udX = '$x',
													udY = '$y',
													direccion_nomencla = '$direccion_nomencla',
													tipo_nomenclatura_id = $tipo_nomenclatura_id,
													indice = '".$parcela_carto_add[$i]['id_des']."',
													tipo_parce = '".$parcela_carto_add[$i]['tipo_parce']."',
													estado_par = '".$parcela_carto_add[$i]['estado_par']."',
													origen = '".$parcela_carto_add[$i]['origen']."',
													barrio_id = '".$parcela_carto_add[$i]['barrio_id']."',
													PH = 'NO'";
			$db->query($SQL);
		}
		//mejoras
		$SQL = "SELECT mejora_id FROM mejoras WHERE parcela_id = $parcela_id AND tipo_estado_id = 1";
		$result = $db->query($SQL);
		while($obj = $result->fetch_object()){
			$mejora_id = $obj->mejora_id;
			$SQL = "INSERT INTO tmp_mejoras SET mejora_id = $mejora_id, operacion = 'D', usuario_id = $usuario_id";
			$db2->query($SQL);
		}
		$parcelas_pendientes['estado'] = 'OK';
		$parcelas_pendientes['mensaje'] = 'Se ha creado el trabajo en el temporal del desglose fisico';
	}elseif($cant >= 1 && $contador == 1 && $ph == "SI"){//crear un PH
		$SELECT = "SELECT parcela_id FROM parcelas WHERE SUBSTRING(parcela_nomenclatura,1,20) = '$nomencla'";
		$result = $db->query($SELECT);
		if($obj = $result->fetch_object()){
			$parcela_id = $obj->parcela_id;
		}
		$SELECT = "SELECT direccion_nomencla_rud_real FROM parcelas WHERE parcela_id= $parcela_id";
		$result = $db->query($SELECT);
		if($obj = $result->fetch_object()){
			$direccion_nomencla = $obj->direccion_nomencla_rud_real;
		}
		$SELECT = "SELECT tipo_nomenclatura FROM parcelas WHERE parcela_id= $parcela_id";
		$result = $db->query($SELECT);
		if($obj = $result->fetch_object()){
			$tipo_nomenclatura_id = $obj->tipo_nomenclatura;
		}
		$dependencia = substr($nomencla,0,2);
		$subparcela = "0000";
		$parcela_dig_veri = substr($nomencla,20,1);
		if($tipo_nomenclatura_id == 3){//tipo posicional							
			$x = substr($nomencla,2,7);
			$y = substr($nomencla,9,7);
			$distrito = "";
			$seccion = "";
			$manzana = "";
			$parcela = "";			
			$nomencla_nuevo = $dependencia.str_pad($x,7,"0",STR_PAD_LEFT).str_pad($y,7,"0",STR_PAD_LEFT)."0000".str_pad($parcela_dig_veri,1,"0",STR_PAD_LEFT);
		}else{//tipo definitivo
			$tipo_nomenclatura_id = 1;
			$distrito = substr($nomencla,2,2);
			$seccion = substr($nomencla,4,2);
			$manzana = substr($nomencla,6,4);
			$parcela = substr($nomencla,10,6);
			$x = "";
			$y = "";
			$nomencla_nuevo = $dependencia.str_pad($distrito,2,"0",STR_PAD_LEFT).str_pad($seccion,2,"0",STR_PAD_LEFT).str_pad($manzana,4,"0",STR_PAD_LEFT).str_pad($parcela,6,"0",STR_PAD_LEFT)."0000".str_pad($parcela_dig_veri,1,"0",STR_PAD_LEFT);
		}		
		for($i=0;$i<$cant ;$i++){			
			$SQL = "INSERT INTO tmp_union_desglose SET
													parcela_id = $parcela_id,
													fecha = NOW(),
													usuario_id = $usuario_id,
													operacion = 'D',
													udparcela_nomencla_origen = '$nomencla',
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
													direccion_nomencla = '$direccion_nomencla',
													tipo_nomenclatura_id = $tipo_nomenclatura_id,
													tipo_parce = '$tipo_parce',
													estado_par = '$estado_par',
													origen = '$origen',
													barrio_id = '$barrio_id',
													PH = 'SI'";
			$db->query($SQL);
		}
		//mejoras
		$SQL = "SELECT mejora_id FROM mejoras WHERE parcela_id = $parcela_id AND tipo_estado_id = 1";
		$result = $db->query($SQL);
		while($obj = $result->fetch_object()){
			$mejora_id = $obj->mejora_id;
			$SQL = "INSERT INTO tmp_mejoras SET mejora_id = $mejora_id, operacion = 'D', usuario_id = $usuario_id";
			$db2->query($SQL);
		}
		$parcelas_pendientes['estado'] = 'OK';
		$parcelas_pendientes['mensaje'] = 'Se ha creado el trabajo en el temporal de las PH';
	}else{
		$parcelas_pendientes['mensaje'] = 'No se puede definir si se crea un desglose Fisico o PH';
	}
	pg_free_result($result);
	pg_close($dbconn);
	mysqli_close($db);
	mysqli_close($db2);
}else{
	if(!$_POST["ph"]){
		$parcelas_pendientes['mensaje'] = 'Sin dato de que si es PH o no';
	}
	if(!$_POST["cant"]){
		$parcelas_pendientes['mensaje'] = 'Sin dato de cantidad';
	}
	if(!$_POST["nomencla"]){
		$parcelas_pendientes['mensaje'] = 'Sin dato de nomenclatura';
	}
	if(!$_POST["uid"]){
		$parcelas_pendientes['mensaje'] = 'Sin session de usuario';
	}
}
echo json_encode($parcelas_pendientes);
?>
