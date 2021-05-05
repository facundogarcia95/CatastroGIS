<?php
header('Content-Type: application/json');
include("configuration.php");
$parcelas_pendientes = array('estado' => 'ERROR','mensaje' => 'No se pudo realizar la operacion', 'dato' => null);
if($_POST["uid"] && $_POST["nombreCampo"] && $_POST["valor"]){//si esta la session de usuario y viene parametro de nomencla
	$db = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
	$usuario_id = $_POST["uid"];
	$nombreCampo = $_POST["nombreCampo"];
	$valor = $_POST["valor"];
	if($valor < 0){
		$valor = 0;
	}
	// Barrio
	if($nombreCampo == "barrio_id"){
		$barrio_id = $valor;
		$SQL = "UPDATE tmp_union_desglose SET barrio_id = '$barrio_id' WHERE usuario_id = $usuario_id AND operacion = 'D'";
		$db->query($SQL);
	}
	
	// Matricula
	if($nombreCampo == "matricula"){
		$matricula = $valor;
		$SQL = "UPDATE tmp_union_desglose SET matricula = '$matricula' WHERE usuario_id = $usuario_id AND operacion = 'D'";
		$db->query($SQL);
	}
	
	// Expediente
	if($nombreCampo == "expediente"){
		$expediente = $valor;
		$SQL = "UPDATE tmp_union_desglose SET expediente = '$expediente' WHERE usuario_id = $usuario_id AND operacion = 'D'";
		$db->query($SQL);
	}	
	
	$SQL = "SELECT * FROM tmp_union_desglose WHERE usuario_id = $usuario_id AND operacion = 'D'";
	$result = $db->query($SQL);
	if($obj = $result->fetch_object()){
		$fecha = $obj->fecha;
		$usuario_id = $obj->usuario_id;
		$udparcela_nomenclatura = $obj->udparcela_nomenclatura;
		$udparcela_dependencia = $obj->udparcela_dependencia;
		$udparcela_distrito = $obj->udparcela_distrito;
		$udparcela_seccion = $obj->udparcela_seccion;
		$udparcela_manzana = $obj->udparcela_manzana;
		$udparcela_parcela = $obj->udparcela_parcela;
		$udparcela_subparcela = $obj->udparcela_subparcela;
		$udparcela_dig_veri = $obj->udparcela_dig_veri;
		$udX = $obj->udX;
		$udY = $obj->udY;
		$udparcela_fraccion = $obj->udparcela_fraccion;
		$persona_id = $obj->persona_id;
		$direccion_nomencla = $obj->direccion_nomencla;
		$tipo_nomenclatura_id = $obj->tipo_nomenclatura_id;
		$tipo_parce = $obj->tipo_parce;
		$estado_par = $obj->estado_par;
		$origen = $obj->origen;
		$barrio_id = $obj->barrio_id;
		
		$dato_select = array(
						'fecha' => $fecha,
						'usuario_id' => $usuario_id,
						'udparcela_nomenclatura' => $udparcela_nomenclatura,
						'udparcela_dependencia' => $udparcela_dependencia,
						'udparcela_distrito' => $udparcela_distrito,
						'udparcela_seccion' => $udparcela_seccion,
						'udparcela_manzana' => $udparcela_manzana,
						'udparcela_parcela' => $udparcela_parcela,
						'udparcela_subparcela' => $udparcela_subparcela,
						'udparcela_dig_veri' => $udparcela_dig_veri,
						'parcelaX' => $udX,
						'parcelaY' => $udY,
						'udparcela_fraccion' => $udparcela_fraccion,
						'persona_id' => $persona_id,
						'direccion_nomencla' => $direccion_nomencla,
						'tipo_nomenclatura' => $tipo_nomenclatura_id,
						'tipo_parce' => $tipo_parce,
						'estado_par' => $estado_par,
						'origen' => $origen,
						'barrio_id' => $barrio_id
						);
	}
	mysqli_close($db);
	$parcelas_pendientes['estado'] = 'OK';
	$parcelas_pendientes['mensaje'] = 'Registro temporal actualizado';
	$parcelas_pendientes['dato'] = $dato_select;
}else{
	if(!$_POST["nombreCampo"]){
		$parcelas_pendientes['mensaje'] = 'Sin dato de NOMBRE DE CAMPO de temporal';
	}
	if(!$_POST["valor"]){
		$parcelas_pendientes['mensaje'] = 'Sin dato de VALOR de temporal';
	}	
	if(!CCGetUserID()){
		$parcelas_pendientes['mensaje'] = 'Sin session de usuario';
	}
}
echo json_encode($parcelas_pendientes);
?>
