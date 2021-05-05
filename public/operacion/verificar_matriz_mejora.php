<?php
header('Content-Type: application/json');
include("configuration.php");
$nomencla = $_POST["nomencla"];
$uid = $_POST["uid"];
$parcelas_pendientes = array('estado' => 'ERROR','mensaje' => 'No se encuentra la session de usuario o parametro de nomenclatura');
if($uid && $nomencla){//si esta la session de usuario y viene parametro de nomencla
	$db = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
	$SELECT = "SELECT parcela_id FROM parcelas WHERE SUBSTRING(parcela_nomenclatura,1,20) = '$nomencla'";
	
	$result = $db->query($SELECT);
	if($obj = $result->fetch_object()){
		$parcela_id = $obj->parcela_id;
	}
	if($parcela_id){//si encontró la parcela
		$SELECT = "SELECT mejora_id FROM mejoras WHERE parcela_id = $parcela_id AND tipo_mejora_categoria_id=10 AND mejora_sup_cub > 0";
		$result = $db->query($SELECT);
		if($obj = $result->fetch_object()){
			$mejora_id = $obj->mejora_id;
		}
		if($mejora_id){//si encontró la mejora para PH
			$parcelas_pendientes['estado'] = 'OK';
			$parcelas_pendientes['mensaje'] = 'Se encuentra la superficie de PH en mejora en la parcela matriz';
		}else{
			$parcelas_pendientes['mensaje'] = 'No tiene mejora de registro de PH en la parcela matriz';
		}
	}else{
		$parcelas_pendientes['mensaje'] = 'No se encontró la parcela';
	}
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
