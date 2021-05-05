<?php
header('Content-Type: application/json');
include("configuration.php");
//base de datos postgres
$nomencla = $_REQUEST["parcela_nomencla"];
$tipo_nomenclatura = $_REQUEST["tipo_nomenclatura"];
$uid = $_REQUEST["uid"];
// Si existe la nomenclatura en una parcela, o existe otra de forma temporal, significa que no es unica

if($uid && $nomencla){//si esta la session de usuario y viene parametro de nomencla
	$db = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
	
	// Si tiene menos de 20 digitos es invalida
	if(strlen($nomencla) < 20){
		$db->close();
		echo (0); exit;			
	}
	
	// Si la parcela viene vacia, es invalida
	if(substr($nomencla,10, 6) == '000000'){
		mysqli_close($db);
		echo (0); exit;			
	}

	// Si es PH no permito que la subparcela sea 0
	$SELECT = "SELECT ph FROM tmp_union_desglose WHERE udparcela_nomenclatura = '$nomencla' LIMIT 1";
	$result = $db->query($SELECT);
	if($obj = $result->fetch_object()){
		$ph=$obj->ph;
	}
	if($ph == 'SI'){
		$SELECT = "SELECT udparcela_subparcela FROM tmp_union_desglose WHERE udparcela_nomenclatura = '$nomencla' LIMIT 1";
		$result = $db->query($SELECT);
		if($obj = $result->fetch_object()){
			$udparcela_subparcela=$obj->udparcela_subparcela;
		}
		if($udparcela_subparcela == '0000'){
			mysqli_close($db);
			echo (0); exit;
		}
	}
	
	// Si existe una parcela con esa nomenclatura, no permito
	$SELECT = "SELECT parcela_nomenclatura FROM parcelas WHERE parcela_nomenclatura LIKE '".$nomencla."%'";
	$result = $db->query($SELECT);
	if($obj = $result->fetch_object()){
		$nomenclaturaUnica=$obj->parcela_nomenclatura;
	}
	if($nomenclaturaUnica){
		mysqli_close($db);
		echo (0); exit;
	}
	
	if($tipo_nomenclatura == "antigua" or $tipo_nomenclatura == "posicional"){
		$SELECT = "SELECT count(udparcela_nomenclatura) AS c FROM tmp_union_desglose WHERE udparcela_nomenclatura = '$nomencla' AND tipo_nomenclatura_id != 2 AND operacion != 'U' AND usuario_id = " . $uid;
		$result = $db->query($SELECT);
		if($obj = $result->fetch_object()){
			$nomenclaturaUnicaTmp=$obj->c;
		}		
		// Si existe mas de una temporal (cuenta la actual), no permito
		if($nomenclaturaUnicaTmp > 1){
			mysqli_close($db);
			echo (0); exit;
		}	
	}		
	
	mysqli_close($db);
	echo (1); exit;
}
?>
