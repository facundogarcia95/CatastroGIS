<?php
header('Content-Type: application/json');
include("configuration.php");
$uid = $_POST["uid"];
$nomencla = substr($_POST["nomencla"],0,20);
$operacion = $_POST["operacion"];
if(!$operacion){
	$operacion = "D";
}

if($_POST['padron'] && !$nomencla){
	$db = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
	$SELECT = "SELECT SUBSTRING(parcela_nomenclatura,1,20) AS parcela_nomenclatura FROM parcelas WHERE parcela_padron = ".$_POST['padron'];
	$result = $db->query($SELECT);
	if($obj = $result->fetch_object()){
		$nomencla = $obj->parcela_nomenclatura;
	}
	mysqli_close($db);
}
//base de datos postgres

$parcelas_pendientes = array('estado' => 'ERROR','mensaje' => 'No se encuentra la session de usuario o parametro de nomenclatura','datos' => null);
if($uid && $nomencla){//si esta la session de usuario y viene parametro de nomencla
	$parcelas_pendientes['mensaje'] = 'Contactar con el administrador.';
	$db = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
	$pasa = true;
//control de estructura de nomenclatura
	$dependencia = substr($nomencla,0,2);
	$distrito = substr($nomencla,2,2);
	$seccion = substr($nomencla,4,2);
	$manzana = substr($nomencla,6,4);
	$parcela = substr($nomencla,10,6);
	$subparcela = substr($nomencla,16,4);
	// Si tiene subparcela, no permite union o desglose
	if($subparcela != '0000'){
		$parcelas_pendientes['mensaje'] = 'No se puede realizar la operacion ya que la parcela seleccionada es una PH.';
		$pasa = false;
	}

//esta en alfa?
	$SELECT = "SELECT COUNT(*) AS cant FROM parcelas WHERE SUBSTRING(parcela_nomenclatura,1,20) = '$nomencla'";
	$result = $db->query($SELECT);
	if($obj = $result->fetch_object()){
		$cant_alfa = $obj->cant;
	}
	
	if(!$cant_alfa && $pasa){//sino existe la parcela
		$parcelas_pendientes['mensaje'] = "No se encuentra parcela $nomencla en el Alfanumerico para continuar con el proceso.";
		$pasa = false;
	}elseif($cant_alfa && $pasa){//si existe, que no tenga destinos
		$SELECT = "SELECT parcela_id FROM parcelas WHERE SUBSTRING(parcela_nomenclatura,1,20) = '$nomencla'";
		$result = $db->query($SELECT);
		if($obj = $result->fetch_object()){
			$parcela_id = $obj->parcela_id;
		}
		$SELECT = "SELECT COUNT(*) AS cant_dest FROM uniones_desgloses WHERE parcela_id = '$parcela_id'";
		$result = $db->query($SELECT);
		if($obj = $result->fetch_object()){
			$cant_dest = $obj->cant_dest;
		}
		$SELECT = "SELECT tipo_nomenclatura FROM parcelas WHERE parcela_id = '$parcela_id'";
		$result = $db->query($SELECT);
		if($obj = $result->fetch_object()){
			$tipo_nomenclatura = $obj->tipo_nomenclatura;
		}
		if($cant_dest && $pasa){
			$parcelas_pendientes['mensaje'] = 'Esta parcela posee destino creado';
			$pasa = false;
		}
		if($tipo_nomenclatura == 2){
			$parcelas_pendientes['mensaje'] = 'Esta parcela tiene una NOMENCLATURA PROVISORIA. Coloque una nomenclatura definitiva en la parcela para continuar.';
			$pasa = false;
		}
	}
	$nomencla16 = $dependencia.$distrito.$seccion.$manzana.$parcela;
	
//ver si es parcela matriz con PH
	$SELECT = "SELECT COUNT(*) AS cant_ph FROM parcelas WHERE SUBSTRING(parcela_nomenclatura,1,20) <> '$nomencla' AND SUBSTRING(parcela_nomenclatura,1,16) = '$nomencla16'";
	$result = $db->query($SELECT);
	if($obj = $result->fetch_object()){
		$cant_ph = $obj->cant_ph;
	}
	if($cant_ph && $pasa && $operacion == "D"){
		$parcelas_pendientes['mensaje'] = 'Esta Parcela Matriz posee PH';
		$pasa = false;
	}elseif($cant_ph && $pasa && $operacion == "U"){
		$parcelas_pendientes['mensaje'] = 'Esta Parcela Matriz posee PH, con la cantidad '.$cant_ph;
	}

//ver si esta en trabajo pendiente en temporal por otro usuario
	$SELECT = "SELECT COUNT(*) AS cant_temp FROM tmp_union_desglose WHERE udparcela_nomencla_origen = '$nomencla' AND usuario_id <> $uid";

	$result = $db->query($SELECT);
	if($obj = $result->fetch_object()){
		$cant_temp = $obj->cant_temp;
	}
	if($cant_temp && $pasa){
		$SELECT = "SELECT operacion FROM tmp_union_desglose WHERE udparcela_nomencla_origen = '$nomencla' GROUP BY operacion";
		$result = $db->query($SELECT);
		if($obj = $result->fetch_object()){
			$operacion = $obj->operacion;
		}
		if($operacion == "D"){
			$operacion = "DESGLOSE";
		}elseif($operacion == "U"){
			$operacion = "UNION";
		}else{
			$operacion = "ERROR";
		}
		$SELECT = "SELECT usuario_id FROM tmp_union_desglose WHERE udparcela_nomencla_origen = '$nomencla' GROUP BY usuario_id";
		$result = $db->query($SELECT);
		if($obj = $result->fetch_object()){
			$usuario_id = $obj->usuario_id;
		}
		$SELECT = "SELECT usuario_nombre FROM usuarios WHERE usuario_id = '$usuario_id'";
		$result = $db->query($SELECT);
		if($obj = $result->fetch_object()){
			$usuario_nombre = $obj->usuario_nombre;
		}
		$parcelas_pendientes['mensaje'] = 'Se encuentra en proceso operatorio de '.$operacion.' por el usuario '.$usuario_nombre;
		$pasa = false;
	}
//esta en carto?
	$conexion = "host=".$postgres['host']." dbname=".$postgres['database']." user=".$postgres['user']." password=".$postgres['pass'];
	$dbconn = pg_connect($conexion) or die('No se ha podido conectar: ' . pg_last_error());
	if($operacion == "D"){
		$SQL_POSTGRES = "SELECT COUNT(*) AS cant FROM public.".$municipio['capa_parcela']." WHERE nomenc21 LIKE '$nomencla%'";

		$result = pg_query($SQL_POSTGRES) or die('La consulta PostgreSQL fallo 1: '.pg_last_error());
		if($line = pg_fetch_array($result, null, PGSQL_ASSOC)){
			$cant_carto = $line['cant'];
		}
		pg_free_result($result);
		if(!$cant_alfa && $pasa){
			$parcelas_pendientes['mensaje'] = 'No existe en cartografìa la nomenclatura buscada';
			$pasa = false;
		}
		if($cant_carto > 1){//tiene definido el id_des si es desglose?
			$SQL_POSTGRES = "SELECT COUNT(*) AS cant FROM public.".$municipio['capa_parcela']." WHERE nomenc21 LIKE '$nomencla%' AND (id_des is null OR id_des = 0)";
			$result = pg_query($SQL_POSTGRES) or die('La consulta PostgreSQL fallo 2: '.pg_last_error());
			if($line = pg_fetch_array($result, null, PGSQL_ASSOC)){
				$cant_null_id = $line['cant'];
			}
			pg_free_result($result);
			if($cant_null_id && $pasa && $cant_carto > 1){
				$parcelas_pendientes['mensaje'] = 'Hay Parcelas que no tiene definido el identificador unico para desglose';
				$pasa = false;
			}
		}elseif($cant_carto == 0){
			$parcelas_pendientes['mensaje'] = 'No existe en cartografìa la nomenclatura buscada en la cartografia.';
			$pasa = false;
		}		
	}
	
//si todo es correcto
	$contador = 0;
	/*$parcelas_pendientes['mensaje'] = $cant_alfa;	// 2 
	$parcelas_pendientes['mensaje'] = $cant_carto;	// 1
	$parcelas_pendientes['mensaje'] = $pasa;		// true
	$parcelas_pendientes['mensaje'] = $operacion;	// D
	$parcelas_pendientes['mensaje'] = $nomencla;	// */
	if($cant_alfa <= $cant_carto && $pasa && $operacion == "D"){//si existen en la geodatabase
		$parcelas_pendientes['estado'] = 'OK';
		$parcelas_pendientes['mensaje'] = $cant_carto;
		if($cant_carto > 1){
			$SQL_POSTGRES = "SELECT * FROM public.".$municipio['capa_parcela']." WHERE nomenc21 LIKE '$nomencla%' AND id_des <> 0 ORDER BY id_des";
		}else{
			$SQL_POSTGRES = "SELECT * FROM public.".$municipio['capa_parcela']." WHERE nomenc21 LIKE '$nomencla%'";
		}
		
		$result = pg_query($SQL_POSTGRES) or die('La consulta PostgreSQL fallo 4: '.pg_last_error());
		while($line = pg_fetch_array($result, null, PGSQL_ASSOC)){
			$nomencla20 = substr($line['nomenc21'],0,20);
			$nomenc21 = $line['nomenc21'];
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
										'dependencia' => $dependencia,
										'distrito' => $distrito,
										'seccion' => $seccion,
										'manzana' => $manzana,
										'parcela' => $parcela,
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
		if($contador > 0){
			$parcelas_pendientes['datos'] = $parcela_carto_add;
		}
	}else{
		if($cant_alfa && $pasa && $operacion == "U"){//si existe en el alfanumerico
			$SELECT = "SELECT COUNT(*) AS cant FROM parcelas WHERE SUBSTRING(parcela_nomenclatura,1,20) = '$nomencla'";
			$result = $db->query($SELECT);
			if($obj = $result->fetch_object()){
				$cant = $obj->cant;
			}else{
				$cant = 0;
			}
			
			if($cant){		
				$SQL = "SELECT * FROM parcelas WHERE SUBSTRING(parcela_nomenclatura,1,20) = '$nomencla'";
				$result = $db->query($SQL);
				if($obj = $result->fetch_object()){
					$parcela_id = $obj->parcela_id;
					$nomenc21 = $obj->parcela_nomenclatura;
					$dependencia = $obj->parcela_dependencia;
					$distrito = $obj->parcela_distrito;
					$seccion = $obj->parcela_seccion;
					$manzana = $obj->parcela_manzana;
					$parcela = $obj->parcela_parcela;
					$subparcela = $obj->parcela_subparcela;
					$barrio_id = 0;//<-TRAER DEL RUD
					$datos_parcela_carto = array(
												'parcela_id' => $parcela_id,
												'nomenc21' => $nomenc21,
												'dependencia' => $dependencia,
												'distrito' => $distrito,
												'seccion' => $seccion,
												'manzana' => $manzana,
												'parcela' => $parcela,
												'subparcela' => $subparcela,
												'tipo_parce' => '',
												'estado_par' => '',
												'origen' => '',
												'capa' => '',
												'barrio_id' => $barrio_id,
												'id_des' => ''
												);
					$parcela_carto_add[] = $datos_parcela_carto;
					$contador++;
				}
				
			}
			if($contador > 0){			
				$parcelas_pendientes['estado'] = 'OK';
				$parcelas_pendientes['mensaje'] = $contador;
				$parcelas_pendientes['datos'] = $parcela_carto_add;
			}
		}else{
			if($cant_alfa >= $cant_carto && $pasa && $operacion == "D"){
				$parcelas_pendientes['mensaje'] = "La nomenclatura posee mas de un registro en el alfanumerico pero un solo poligono, contactar con el administrador.";
			}
		}
	}
	
	pg_free_result($result);
	pg_close($dbconn);
	mysqli_close($db);
}else{
	if(!$_POST["nomencla"]){
		$parcelas_pendientes['mensaje'] = 'Sin dato de nomenclatura';
	}
	if(!$uid){
		$parcelas_pendientes['mensaje'] = 'Sin session de usuario';
	}
}
echo json_encode($parcelas_pendientes);
?>
