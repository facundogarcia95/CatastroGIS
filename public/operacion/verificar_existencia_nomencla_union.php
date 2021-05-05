<?php
header('Content-Type: application/json');
include("configuration.php");
//base de datos postgres
$validacion = array('estado' => 'ERROR','mensaje' => 'No se encuentra la session de usuario o parametro de nomenclatura destino o parcela o unificar');
if($_POST["uid"] && $_POST["nomencla"]){//si esta la session de usuario y viene parametro de nomencla
	$usuario_id = $_POST["uid"];
	$nomencla = substr($_POST["nomencla"],0,20);
	$db = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
	//parcela destino
	$dependencia = substr($nomencla,0,2);
	$distrito = substr($nomencla,2,2);
	$seccion = substr($nomencla,4,2);
	$manzana = substr($nomencla,6,4);
	$parcela = substr($nomencla,10,6);
	$subparcela = substr($nomencla,16,4);
	$cant_string = strlen($nomencla);
	//existe en la GeoDB?
	$contador = 0;
	$conexion = "host=".$postgres['host']." dbname=".$postgres['database']." user=".$postgres['user']." password=".$postgres['pass'];
	$dbconn = pg_connect($conexion) or die('No se ha podido conectar: ' . pg_last_error());
	$SQL_POSTGRES = "SELECT COUNT(*) AS cantidad FROM public.".$municipio['capa_parcela']." WHERE nomenc21 LIKE '$nomencla%'";
	$result = pg_query($SQL_POSTGRES) or die('La consulta PostgreSQL fallo: '.pg_last_error());
	if($line = pg_fetch_array($result, null, PGSQL_ASSOC)){//datos de la parcelas de la geoDB
		$contador = $line['cantidad'];
	}
	$SELECT = "SELECT COUNT(*) AS cant FROM parcelas WHERE SUBSTRING(parcela_nomenclatura,1,20) = '$nomencla'";
	$result = $db->query($SELECT);
	if($obj = $result->fetch_object()){
		$cant_parcela = $obj->cant;
	}
	$SELECT = "SELECT COUNT(*) AS cant FROM tmp_union_desglose WHERE SUBSTRING(udparcela_nomenclatura,1,20) = '$nomencla' AND usuario_id <> $usuario_id";
	$result = $db->query($SELECT);
	if($obj = $result->fetch_object()){
		$cant_temp = $obj->cant;
	}
	if($contador > 0 && $cant_string == 20){//si es union, se controla que no haya cambiado en el proceso de creacion
		$validacion['mensaje'] = 'La nomenclatura ya existe en la GeoDB';
	}elseif($cant_parcela > 0 && $cant_string == 20){
		$validacion['mensaje'] = 'La nomenclatura ya existe en la Base de datos Alfanumerica en produccion';
	}elseif($cant_temp > 0 && $cant_string == 20){
		$validacion['mensaje'] = 'La nomenclatura ya existe en la Base de datos Alfanumerica en proceso de creacion';
	}elseif($cant_string < 20){
		$validacion['mensaje'] = 'La nomenclatura no tiene la cantidad de digitos requeridos (20)';
	}else{
		//que se va a unir? ph o fisicos
		$SQL = "SELECT * FROM tmp_union_desglose WHERE SUBSTRING(udparcela_nomenclatura,1,20) = '$nomencla' AND usuario_id = $usuario_id AND operacion = 'U'";
		
		$validacion['estado'] = 'OK';
		$validacion['mensaje'] = 'Se ha creado el trabajo en el temporal de union';
	}
	pg_free_result($result);
	pg_close($dbconn);
	mysqli_close($db);
}else{
	if(!$_POST["nomencla"]){
		$validacion['mensaje'] = 'Sin dato de nomenclatura';
	}
	if(!$_POST["uid"]){
		$validacion['mensaje'] = 'Sin session de usuario';
	}
}
echo json_encode($validacion);
?>