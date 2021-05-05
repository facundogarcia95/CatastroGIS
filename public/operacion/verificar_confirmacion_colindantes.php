<?php
header('Content-Type: application/json');
include("configuration.php");
//base de datos postgres
$parcelas_pendientes = array('estado' => 'ERROR','mensaje' => 'No se pudo realizar la operacion', 'dato' => null);
if($_POST['uid'] && $_POST['nomenclatura']){
	$db = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
	$nomenclatura = $_POST['nomenclatura'];
	$usuario_id = $_POST['uid'];
	$conexion = "host=".$postgres['host']." dbname=".$postgres['database']." user=".$postgres['user']." password=".$postgres['pass'];
	$dbconn = pg_connect($conexion) or die('No se ha podido conectar: ' . pg_last_error());
	$SQL_POSTGRES = "SELECT COUNT(*) AS cantidad FROM public.".$municipio['capa_parcela']." WHERE nomenc21 = '$nomenclatura'";
	$result = pg_query($SQL_POSTGRES) or die('La consulta PostgreSQL fallo: '.pg_last_error());
	if($line = pg_fetch_array($result, null, PGSQL_ASSOC)){//datos de la parcelas de la geoDB
		$contador = $line['cantidad'];
		if($contador){//si encontró la parcela
			$cantidad = 0;
			$nomenclaturas = array();
			//cargar temporal union, si hay mas de 2 verificar si son colindantes
			$SQL = "SELECT * FROM tmp_union_desglose WHERE usuario_id = $usuario_id AND operacion = 'U' AND udparcela_nomencla_origen <> '$nomenclatura'";
			$result = $db->query($SQL);
			while($obj = $result->fetch_object()){//parcelas cargadas que no es la seleccionada
				$udparcela_nomencla_origen = substr($obj->udparcela_nomencla_origen,0,20);
				$nomenclaturas[] = $udparcela_nomencla_origen;
				$cantidad++;
			}
			if($cantidad > 0){//verificar si es colindante
				"SELECT ST_Touches(poligonos.geom, lineas.geom) FROM datos.lineas, datos.poligonos";
			}
		}else{
			$parcelas_pendientes['mensaje'] = 'No se encontró la parcela a buscar';
		}
	}else{
		$parcelas_pendientes['mensaje'] = 'Sin resultado de la consulta de parcela en la GeoDB';
	}
	pg_free_result($result);
	pg_close($dbconn);
	mysqli_close($db);
}else{	
	if($_POST['datos'] != 1){
		$parcelas_pendientes['mensaje'] = 'Sin datos de nomenclatura';
	}
	if(!$_POST['uid']){
		$parcelas_pendientes['mensaje'] = 'Sin session de usuario';
	}
}
?>