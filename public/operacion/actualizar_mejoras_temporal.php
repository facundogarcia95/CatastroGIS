<?php
header('Content-Type: application/json');
include("configuration.php");
$parcelas_pendientes_mejora = array('estado' => 'ERROR','mensaje' => 'No se pudo realizar la operacion', 'dato' => null);
if($_POST["uid"] && $_POST["union_desglose_id"] && $_POST["tmp_mejora_id"]){//si esta la session de usuario y viene parametro de nomencla
	$db = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
	$usuario_id = $_POST["uid"];
	$union_desglose_id = $_POST["union_desglose_id"];
	$tmp_mejora_id = $_POST["tmp_mejora_id"];
	$SQL = "UPDATE tmp_mejoras SET
					union_desglose_id = $union_desglose_id
					WHERE tmp_mejora_id = $tmp_mejora_id";
	$db->query($SQL);
	$db->close();
	$parcelas_pendientes_mejora['estado'] = 'OK';
	$parcelas_pendientes_mejora['mensaje'] = 'Registro actualizado';
	$parcelas_pendientes_mejora['dato'] = $dato_select;
}else{
	if(!$_POST["union_desglose_id"]){
		$parcelas_pendientes_mejora['mensaje'] = 'Sin dato de ID de temporal';
	}
	if(!$_POST["tmp_mejora_id"]){
		$parcelas_pendientes_mejora['mensaje'] = 'Sin dato de ID de temporal de mejora';
	}	
	if(!$_POST["uid"]){
		$parcelas_pendientes_mejora['mensaje'] = 'Sin session de usuario';
	}
}
echo json_encode($parcelas_pendientes_mejora);
?>
