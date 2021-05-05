<?php
header('Content-Type: application/json');
include("configuration.php");
//base de datos postgres
$operacion = array('estado' => 'ERROR','mensaje' => 'No se encuentra la session de usuario o no se permite la accion');
if($_GET['uid'] && $_GET['accion'] && $_GET['accion']){//si esta la session de usuario
	if($_GET['accion'] == "SI"){
		$usuario_id = $_GET['uid'];
		$db = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
		$SQL = "DELETE FROM tmp_mejoras WHERE usuario_id = $usuario_id";
		$db->query($SQL);
		// Si viene la nomenclatura, elimino solo ese registro
		$where = '';
		if($_GET['parcela_nomenclatura']){
			$nom = substr($_GET['parcela_nomenclatura'],0,20);
			$where = " AND udparcela_nomencla_origen = '$nom' ";			
		}
		
		$SQL = "DELETE FROM tmp_union_desglose WHERE usuario_id = $usuario_id" . $where;
		if($db->query($SQL)){
				$operacion['estado'] = 'OK';
				$operacion['mensaje'] = 'Se eliminaron los registros de su session';	
		}else{
				$operacion['mensaje'] = 'No se pudo realizar la operacion de limpieza'; 
		}
		mysqli_close($db);
	}else{
		$operacion['mensaje'] = 'No se permite la accion'; 
	}
}
echo json_encode($operacion);
?>
