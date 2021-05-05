<?php
header('Content-Type: application/json');
include("configuration.php");//base de datos postgres
//base de datos postgres
$parcelas_pendientes = array('estado' => 'ERROR','mensaje' => 'No se encuentra la session de usuario o parametro de nomenclatura','datos' => null);
if($_POST['uid'] && $_POST["nomencla"]){//si esta la session de usuario y viene parametro de nomencla
	$nomencla = $_POST["nomencla"];
	$conexion = "host=".$postgres['host']." dbname=".$postgres['database']." user=".$postgres['user']." password=".$postgres['pass'];
	$dbconn = pg_connect($conexion) or die('No se ha podido conectar: ' . pg_last_error());
	$SQL_POSTGRES = "SELECT COUNT(*) AS cantidad FROM public.".$municipio['capa_parcela']." WHERE nomenc21 LIKE '$nomencla%'";
	$result = pg_query($SQL_POSTGRES) or die('La consulta PostgreSQL fallo: '.pg_last_error());
	if($line = pg_fetch_array($result, null, PGSQL_ASSOC)){
		$cantidad = $line['cantidad'];
		if($cantidad == 0){
			$parcelas_pendientes['mensaje'] = "No existe poligono de parcela segun nomenclatura.";
		}elseif($cantidad > 1){
			$parcelas_pendientes['mensaje'] = "Existen $cantidad poligonos de parcelas, segun nomenclatura.";
		}elseif($cantidad == 1){
			$parcelas_pendientes['estado'] = 'OK';
			$parcelas_pendientes['mensaje'] = 'Se encontro solo un poligono correspondiente a la nomenclatura';
		}
	}
	pg_free_result($result);
	pg_close($dbconn);
}else{
	if(!$_POST["nomencla"]){
		$parcelas_pendientes['mensaje'] = 'Sin dato de nomenclatura';
	}
	if(!$_POST['uid']){
		$parcelas_pendientes['mensaje'] = 'Sin session de usuario';
	}
}
echo json_encode($parcelas_pendientes);
?>
