<?php
header('Content-Type: application/json');
include("configuration.php");
//base de datos postgres
$parcelas_pendientes = array('estado' => 'ERROR','mensaje' => 'No se pudo realizar la operacion', 'dato' => null);
if($_POST["uid"] && $_POST["nombreCampo"] && $_POST["valor"] && $_POST["union_desglose_id"]){//si esta la session de usuario y viene parametro de nomencla
	$db = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
	$usuario_id = $_POST["uid"];
	$nombreCampo = $_POST["nombreCampo"];
	$valor = $_POST["valor"];
	$union_desglose_id = $_POST["union_desglose_id"];
	// SI VIENE TODO, ACTUALIZO TODOS LAS PARCELAS PARA NOMENCLATURA PROVISORIA
	if($union_desglose_id == 'TODO'){
		$SQL = "UPDATE tmp_union_desglose SET
									fecha = NOW(),
									tipo_nomenclatura_id = '$valor'
					WHERE usuario_id = $usuario_id AND operacion = 'U'";
		$db->query($SQL);		
	}else{
		if($nombreCampo == "dependencia"){
			$dependencia = $valor;
		}else{
			$SELECT="SELECT udparcela_dependencia FROM tmp_union_desglose WHERE union_desglose_id = $union_desglose_id";
			$result = $db->query($SELECT);
			if($obj = $result->fetch_object()){
				$dependencia = $obj->udparcela_dependencia;
			}
		}
		if($nombreCampo == "distrito"){
			$distrito = $valor;
		}else{
			$SELECT="SELECT udparcela_distrito FROM tmp_union_desglose WHERE union_desglose_id = $union_desglose_id";
			$result = $db->query($SELECT);
			if($obj = $result->fetch_object()){
				$distrito = $obj->udparcela_distrito;
			}		
		}
		if($nombreCampo == "seccion"){
			$seccion = $valor;
		}else{
			$SELECT="SELECT udparcela_seccion FROM tmp_union_desglose WHERE union_desglose_id = $union_desglose_id";
			$result = $db->query($SELECT);
			if($obj = $result->fetch_object()){
				$seccion = $obj->udparcela_seccion;
			}
		}	
		if($nombreCampo == "manzana"){
			$manzana = $valor;
		}else{
			$SELECT="SELECT udparcela_manzana FROM tmp_union_desglose WHERE union_desglose_id = $union_desglose_id";
			$result = $db->query($SELECT);
			if($obj = $result->fetch_object()){
				$manzana = $obj->udparcela_manzana;
			}
		}
		if($nombreCampo == "parcela"){
			$parcela = $valor;
		}else{
			$SELECT="SELECT udparcela_parcela FROM tmp_union_desglose WHERE union_desglose_id = $union_desglose_id";
			$result = $db->query($SELECT);
			if($obj = $result->fetch_object()){
				$parcela = $obj->udparcela_parcela;
			}
		}	
		if($nombreCampo == "subparcela"){
			$subparcela = $valor;
		}else{
			$SELECT="SELECT udparcela_subparcela FROM tmp_union_desglose WHERE union_desglose_id = $union_desglose_id";
			$result = $db->query($SELECT);
			if($obj = $result->fetch_object()){
				$subparcela = $obj->udparcela_subparcela;
			}
		}
		if($nombreCampo == "fraccion"){
			$fraccion = $valor;
		}else{
			$SELECT="SELECT udparcela_fraccion FROM tmp_union_desglose WHERE union_desglose_id = $union_desglose_id";
			$result = $db->query($SELECT);
			if($obj = $result->fetch_object()){
				$fraccion = $obj->udparcela_fraccion;
			}
		}
		if($nombreCampo == "parcelaX"){
			$direccion_x = $valor;
		}else{
			$SELECT="SELECT udX FROM tmp_union_desglose WHERE union_desglose_id = $union_desglose_id";
			$result = $db->query($SELECT);
			if($obj = $result->fetch_object()){
				$direccion_x = $obj->udX;
			}
		}
		if($nombreCampo == "parcelaY"){
			$direccion_y = $valor;
		}else{
			$SELECT="SELECT udY FROM tmp_union_desglose WHERE union_desglose_id = $union_desglose_id";
			$result = $db->query($SELECT);
			if($obj = $result->fetch_object()){
				$direccion_y = $obj->udY;
			}
		}			
		if($nombreCampo == "persona_id"){
			$persona_id = $valor;
		}else{
			$SELECT="SELECT persona_id FROM tmp_union_desglose WHERE union_desglose_id = $union_desglose_id";
			$result = $db->query($SELECT);
			if($obj = $result->fetch_object()){
				$persona_id = $obj->persona_id;
			}
		}
		if($nombreCampo == "direccion_nomencla"){
			$direccion_nomencla = $valor;
		}else{
			$SELECT="SELECT direccion_nomencla FROM tmp_union_desglose WHERE union_desglose_id = $union_desglose_id";
			$result = $db->query($SELECT);
			if($obj = $result->fetch_object()){
				$direccion_nomencla = $obj->direccion_nomencla;
			}			
		}
		if($nombreCampo == "tipo_parce"){
			$tipo_parce = $valor;
		}else{
			$SELECT="SELECT tipo_parce FROM tmp_union_desglose WHERE union_desglose_id = $union_desglose_id";
			$result = $db->query($SELECT);
			if($obj = $result->fetch_object()){
				$tipo_parce = $obj->tipo_parce;
			}
		}
		if($nombreCampo == "estado_par"){
			$estado_par = $valor;
		}else{
			$SELECT="SELECT estado_par FROM tmp_union_desglose WHERE union_desglose_id = $union_desglose_id";
			$result = $db->query($SELECT);
			if($obj = $result->fetch_object()){
				$estado_par = $obj->estado_par;
			}
		}
		if($nombreCampo == "origen"){
			$origen = $valor;
		}else{
			$SELECT="SELECT origen FROM tmp_union_desglose WHERE union_desglose_id = $union_desglose_id";
			$result = $db->query($SELECT);
			if($obj = $result->fetch_object()){
				$origen = $obj->origen;
			}
		}
		if($nombreCampo == "barrio_id"){
			$barrio_id = $valor;
		}else{
			$SELECT="SELECT barrio_id FROM tmp_union_desglose WHERE union_desglose_id = $union_desglose_id";
			$result = $db->query($SELECT);
			if($obj = $result->fetch_object()){
				$barrio_id = $obj->barrio_id;
			}
		}	
		if($nombreCampo == "tipo_nomenclatura_id"){
			$tipo_nomenclatura_id = $valor;
		}else{
			$SELECT="SELECT tipo_nomenclatura_id FROM tmp_union_desglose WHERE union_desglose_id = $union_desglose_id";
			$result = $db->query($SELECT);
			if($obj = $result->fetch_object()){
				$tipo_nomenclatura_id = $obj->tipo_nomenclatura_id;
			}
		}
		
		////////////////////////////
		/// DIFERENCIAR POR TIPO ///
		////////////////////////////
		switch ($tipo_nomenclatura_id) {
		  case 1:
			$nomencla = $dependencia.$distrito.$seccion.$manzana.$parcela.$subparcela;
			break;
		  case 2:
			$nomencla = '';
			break;
		  case 3:
			$nomencla = $dependencia.$direccion_x.$direccion_y.$subparcela;
			break;
		  default:
			echo "Error actualizar_temporal_registro"; exit;
		}
		
		
		$SQL = "UPDATE tmp_union_desglose SET
									fecha = NOW(),
									usuario_id = $usuario_id,
									udparcela_nomenclatura = '$nomencla',
									udparcela_dependencia = '$dependencia',
									udparcela_distrito = '$distrito',
									udparcela_seccion = '$seccion',
									udparcela_manzana = '$manzana',
									udparcela_parcela = '$parcela',
									udparcela_subparcela = '$subparcela',
									udX = '$direccion_x',
									udY = '$direccion_y',
									direccion_nomencla = '$direccion_nomencla',
									udparcela_fraccion = '$fraccion',
									persona_id = '$persona_id',
									tipo_parce = '$tipo_parce',
									estado_par = '$estado_par',
									origen = '$origen',
									barrio_id = '$barrio_id',
									tipo_nomenclatura_id = '$tipo_nomenclatura_id'
					WHERE union_desglose_id = $union_desglose_id";
		$db->query($SQL);
		$SQL = "SELECT * FROM tmp_union_desglose WHERE union_desglose_id = $union_desglose_id";
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
			$udX = $obj->udX;
			$udY = $obj->udY;
			$udparcela_subparcela = $obj->udparcela_subparcela;
			$udparcela_fraccion = $obj->udparcela_fraccion;
			$persona_id = $obj->persona_id;
			$direccion_nomencla = $obj->direccion_nomencla;
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
							'parcelaX' => $udX,
							'parcelaY' => $udY,
							'udparcela_subparcela' => $udparcela_subparcela,
							'udparcela_fraccion' => $udparcela_fraccion,
							'persona_id' => $persona_id,
							'direccion_nomencla' => $direccion_nomencla,
							'tipo_parce' => $tipo_parce,
							'estado_par' => $estado_par,
							'origen' => $origen,
							'barrio_id' => $barrio_id
							);
		}
	}
	mysqli_close($db);
	$parcelas_pendientes['estado'] = 'OK';
	$parcelas_pendientes['mensaje'] = 'Registro actualizado';
	$parcelas_pendientes['dato'] = $dato_select;
}else{
	if(!$_POST["nombreCampo"]){
		$parcelas_pendientes['mensaje'] = 'Sin dato de NOMBRE DE CAMPO de temporal';
	}
	if(!$_POST["valor"]){
		$parcelas_pendientes['mensaje'] = 'Sin dato de VALOR de temporal';
	}
	if(!$_POST["uid"]){
		$parcelas_pendientes['mensaje'] = 'Sin session de usuario';
	}
}
echo json_encode($parcelas_pendientes);
?>
