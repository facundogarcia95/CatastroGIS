<?php
header('Content-Type: application/json');
include("configuration.php");//base de datos postgres
$parcelas_pendientes = array('estado' => 'ERROR','mensaje' => 'No se pudo realizar la operacion', 'datos' => null);
$parcelas = [];
$datos = array('nomenclatura' => '','titular' => '','direccion' => '');
$nomenclaturas = $_REQUEST['nomenclaturas'];
$db = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
//Si esta la session de usuario y viene parametro para confirmar
if($_REQUEST['uid'] && $_REQUEST['accion'] == "SI"){	
	// Traigo los datos de cada nomenclatura
	for($i = 0; $i < count($nomenclaturas); $i++){
		$nomCompleta = $nomenclaturas[$i];
		$nomenclaturas[$i] = substr($nomenclaturas[$i], 0, 20);
		$SELECT="SELECT personas.persona_denominacion AS persona_denominacion
					FROM parcelas LEFT JOIN personas_parcelas ON parcelas.parcela_id = personas_parcelas.parcela_id LEFT JOIN personas ON personas_parcelas.persona_id = personas.persona_id 
					WHERE parcelas.parcela_nomenclatura LIKE '$nomenclaturas[$i]%' AND  personas_parcelas.persona_parcela_ppal = 1 AND personas_parcelas.tipo_estado_id = 1 AND personas.tipo_estado_id = 1";
		$result = $db->query($SELECT);
		if($obj = $result->fetch_object()){
			$titular = $obj->persona_denominacion;
		}
		$SELECT="SELECT personas.persona_id AS persona_id
					FROM parcelas LEFT JOIN personas_parcelas ON parcelas.parcela_id = personas_parcelas.parcela_id LEFT JOIN personas ON personas_parcelas.persona_id = personas.persona_id 
					WHERE parcelas.parcela_nomenclatura LIKE '$nomenclaturas[$i]%' AND  personas_parcelas.persona_parcela_ppal = 1 AND personas_parcelas.tipo_estado_id = 1 AND personas.tipo_estado_id = 1";
		$result = $db->query($SELECT);
		if($obj = $result->fetch_object()){
			$persona_id = $obj->persona_id;
		}
		$SELECT="SELECT direccion_nomencla_rud_real
					FROM parcelas
					WHERE parcela_nomenclatura LIKE '$nomenclaturas[$i]%'";
		$result = $db->query($SELECT);
		
		if($obj = $result->fetch_object()){
			$direccion_etiqueta = $obj->direccion_nomencla_rud_real;
		}
		$SELECT="SELECT CONCAT(direccion_calle, ', ', direccion_numeracion) AS calleYNum
					FROM gestion_direcciones.vdirecciones
					WHERE direccion_nomencla = '$direccion_etiqueta'";
		$result = $db->query($SELECT);
		if($obj = $result->fetch_object()){
			$calleYNum = $obj->calleYNum;
		}
		$parcela['nomenclatura'] =  $nomCompleta;
		$parcela['titular'] =  utf8_encode($titular);
		$parcela['persona_id'] =  $persona_id;
		$dir['etiqueta'] = $direccion_etiqueta;
		$dir['calleYNum'] = utf8_encode($calleYNum);
		$parcela['direccion'] = $dir;
		array_push($parcelas, $parcela);		
	}
		//var_dump($parcelas);exit;
	
	// Armo array con datos finales para devolver
	$parcelas_pendientes['estado'] = 'OK';
	$parcelas_pendientes['mensaje'] = 'OK';
	$parcelas_pendientes['datos'] = $parcelas;
}else{
	if($_REQUEST['accion'] != 1){
		$parcelas_pendientes['mensaje'] = 'Sin orden para operar';
	}
	if(!$_REQUEST['uid']){
		$parcelas_pendientes['mensaje'] = 'Sin session de usuario';
	}
}
mysqli_close($db);
echo json_encode($parcelas_pendientes);
?>
