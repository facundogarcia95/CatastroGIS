<?php
header('Content-Type: application/json');
include("configuration.php");//base de datos postgres

$parcelas_pendientes = array('estado' => 'ERROR','mensaje' => 'No se pudo realizar la operacion', 'dato' => null);
$nomenclaturas = $_REQUEST['nomenclaturas'];

//Si esta la session de usuario y viene parametro para confirmar
if($_REQUEST['uid'] && $_REQUEST['accion'] == "SI"){

	// Verifico que sean colindantes
	$conexion = "host=".$postgres['host']." dbname=".$postgres['database']." user=".$postgres['user']." password=".$postgres['pass'];
	$dbconn = pg_connect($conexion) or die('No se ha podido conectar: ' . pg_last_error());
	
	//$SQL_POSTGRES = "SELECT ST_Touches((SELECT geom FROM public.".$municipio['capa_parcela']." WHERE nomencla20 = '$nom1'), (SELECT geom FROM public.".$municipio['capa_parcela']." WHERE nomencla20 = '$nom2')) AS resultado FROM public.".$municipio['capa_parcela']." WHERE nomencla20 = '$nom1';";
	
	// Armo SQL
	$select = "SELECT ST_GeometryType(ST_AsText(ST_Union(ARRAY[";
	$where = "";
	for($i = 0; $i < count($nomenclaturas); $i++){
		if($i == (count($nomenclaturas) - 1)){
			$where .= " (SELECT geom FROM public.".$municipio['capa_parcela']." WHERE nomenc21 LIKE '".substr($nomenclaturas[$i],0,20)."%') ";
		}else{
			$where .= " (SELECT geom FROM public.".$municipio['capa_parcela']." WHERE nomenc21 LIKE '".substr($nomenclaturas[$i],0,20)."%'), ";			
		}
	}
	$end = "]))) AS resultado;";
	
	$SQL_POSTGRES = $select . $where . $end;
	
	$result = pg_query($SQL_POSTGRES) or die('La consulta PostgreSQL fallo: '.pg_last_error());
	while ($line = pg_fetch_array($result)) {
		$val = $line['resultado'];
	}	

	$parcelas_pendientes['estado'] = 'OK';
	$parcelas_pendientes['mensaje'] = $val;
}else{
	if($_REQUEST['accion'] != 1){
		$parcelas_pendientes['mensaje'] = 'Sin orden para operar';
	}
	if(!$_REQUEST['uid']){
		$parcelas_pendientes['mensaje'] = 'Sin session de usuario';
	}
}
echo json_encode($parcelas_pendientes);
?>
