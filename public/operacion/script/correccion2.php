<?php
include("../configuration.php");//base de datos postgres
set_time_limit(0);
$db = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
$db2 = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
$SELECT = "SELECT * FROM parcelas WHERE parcela_nomenclatura LIKE '04%'";
$result = $db->query($SELECT);
while($obj = $result->fetch_object()){
	$parcela_nomenclatura=$obj->parcela_nomenclatura;
	$parcela_id=$obj->parcela_id;
	$SQL = "DELETE FROM parcelas WHERE parcela_id = $parcela_id";
	echo $SQL."<br>";
	$db2->query($SQL);
	$SQL = "DELETE FROM personas_parcelas WHERE parcela_id = $parcela_id";
	$db2->query($SQL);
	$SQL = "DELETE FROM mejoras WHERE parcela_id = $parcela_id";
	$db2->query($SQL);
}
mysqli_close($db);
mysqli_close($db2);
?>