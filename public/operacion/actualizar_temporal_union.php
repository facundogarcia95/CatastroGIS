<?php
header('Content-Type: application/json');
include("configuration.php");
//base de datos postgres
$parcelas_pendientes = array('estado' => 'ERROR','mensaje' => 'No se pudo realizar la operacion', 'dato' => null);

$udparcela_nomenclatura = $_POST["udparcela_nomenclatura"];
$persona_id = $_POST["persona_id"];
$direccion_nomencla = $_POST["direccion_nomencla"];
$expediente = $_POST["expediente"];
$tipo_nomenclatura_id = $_POST["tipo_nomenclatura"];
$operacion = $_POST["operacion"];
$uid = $_POST["uid"];

if($uid && $tipo_nomenclatura_id && $operacion){	//si esta la session de usuario y viene parametro de union
	$db = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
	$usuario_id = $uid;
	
	$udparcela_dependencia = $municipio['municipio_sigla'];
	$parcela_x = "";
	$parcela_y = "";
	$parcela_distrito = "";
	$parcela_seccion = "";
	$parcela_manzana = "";
	$parcela_parcela = "";
	//echo $tipo_nomenclatura_id;exit;
	if($tipo_nomenclatura_id == 1){
		$udparcela_dependencia = substr($udparcela_nomenclatura,0,2);
		$parcela_distrito = substr($udparcela_nomenclatura,2,2);
		$parcela_seccion = substr($udparcela_nomenclatura,4,2);
		$parcela_manzana = substr($udparcela_nomenclatura,6,4);
		$parcela_parcela = substr($udparcela_nomenclatura,10,6);
		$parcela_x = "";
		$parcela_y = "";
	}elseif($tipo_nomenclatura_id == 3){
		$udparcela_dependencia = substr($udparcela_nomenclatura,0,2);
		$parcela_x = substr($udparcela_nomenclatura,2,7);
		$parcela_y = substr($udparcela_nomenclatura,9,7);
		$parcela_distrito = "";
		$parcela_seccion = "";
		$parcela_manzana = "";
		$parcela_parcela = "";
	}
	$SQL = "UPDATE tmp_union_desglose SET
								fecha = NOW(),
								udparcela_nomenclatura = '$udparcela_nomenclatura',
								udparcela_dependencia = '$udparcela_dependencia',
								udparcela_distrito = '$parcela_distrito',
								udparcela_seccion = '$parcela_seccion',
								udparcela_manzana = '$parcela_manzana',
								udparcela_parcela = '$parcela_parcela',
								udparcela_subparcela = '0000',
								udparcela_dig_veri = '0',
								udX = '$parcela_x',
								udY = '$parcela_y',
								persona_id = '$persona_id',
								direccion_nomencla = '$direccion_nomencla',
								expediente = '$expediente'								
				WHERE usuario_id = $usuario_id AND operacion = '$operacion'";
	$db->query($SQL);
	
	mysqli_close($db);
	$parcelas_pendientes['estado'] = 'OK';
	$parcelas_pendientes['mensaje'] = 'Registro actualizado';
	//$parcelas_pendientes['dato'] = $dato_select;
}else{
	if(!$uid){
		$parcelas_pendientes['mensaje'] = 'Sin session de usuario';
	}
}
echo json_encode($parcelas_pendientes);
?>
