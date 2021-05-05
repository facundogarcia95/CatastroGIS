<?php
header('Content-Type: application/json');
//define("RelativePath", "..");
//include(RelativePath . "/Common.php");
include("configuration.php");
$parcelas = array();
if($_GET['uid'] && $_GET['nomencla']){//si esta la session de usuario y dato de parcela
	$nomencla = $_GET['nomencla'];
	$limit = $_GET['limit'];	
	if(!$limit){
		$limit = 10;
	}
	$db = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
	$SELECT="SELECT SUBSTRING(parcela_nomenclatura,1,20) AS parcela_nomenclatura FROM parcelas WHERE parcela_nomenclatura LIKE '$nomencla%' ORDER BY parcela_f_proceso DESC LIMIT $limit";
	$result = $db->query($SELECT);
	while($obj = $result->fetch_object()){
		$parcelas[]=$obj->parcela_nomenclatura;
	}
	mysqli_close($db);
}
echo json_encode($parcelas);
?>