<?php
include("../configuration.php");//base de datos postgres
set_time_limit(0);
$db = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
$conexion = "host=".$postgres['host']." dbname=".$postgres['database']." user=".$postgres['user']." password=".$postgres['pass'];
$dbconn = pg_connect($conexion) or die('No se ha podido conectar: ' . pg_last_error());
$SQL_POSTGRES = "SELECT * FROM public.las_heras_parcelas_pos order by gid";
$result = pg_query($SQL_POSTGRES) or die('La consulta PostgreSQL fallo 1: '.pg_last_error());
while($line = pg_fetch_array($result, null, PGSQL_ASSOC)){
	$nomenc21 = $line['nomenc21'];
	$gid = $line['gid'];
	if($nomenc21){
		//actualizar
		$SQL = "UPDATE parcelas SET parcela_nomenclatura = '$nomenc21' WHERE parcela_id = $gid";
		
		$db->query($SQL);
		echo $SQL."<br>";
	}else{
		//eliminar
		$SQL = "DELETE FROM parcelas WHERE parcela_id = $gid";
		$db->query($SQL);
		$SQL = "DELETE FROM personas_parcelas WHERE parcela_id = $gid";
		$db->query($SQL);
		$SQL = "DELETE FROM mejoras WHERE parcela_id = $gid";
		$db->query($SQL);
	}
}
//eliminar los sobrantes
$ultimo = $gid + 1;
echo "ULTIMO: ".$ultimo."<br>";
$SQL = "DELETE FROM parcelas WHERE parcela_id >= $ultimo";
$db->query($SQL);
$SQL = "DELETE FROM personas_parcelas WHERE parcela_id >= $ultimo";
$db->query($SQL);
$SQL = "DELETE FROM mejoras WHERE parcela_id >= $ultimo";
$db->query($SQL);
pg_free_result($result);
mysqli_close($db);
?>