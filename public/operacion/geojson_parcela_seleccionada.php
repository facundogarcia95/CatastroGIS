<?php
//error_reporting(E_ERROR | E_WARNING );
//ini_set('max_execution_time', 300); //300 seconds = 5 minutes
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
header('Access-Control-Allow-Origin: *');//cualquier origen
header('Content-Type: application/json');//salida json
include("configuration.php");
$nomencla20 = $_GET['nomencla20'];
$nomencla20 = 10;
$geojson = array( 'type' => 'FeatureCollection', 'features' => array());
if($_GET['uid'] && $nomencla20){
	$conexion = "host=".$postgres['host']." dbname=".$postgres['database']." user=".$postgres['user']." password=".$postgres['pass'];
	$dbconn = pg_connect($conexion) or die('No se ha podido conectar: ' . pg_last_error());		
	$result = pg_query($dbconn, "select * from parcelas where gid = 10");	
	$geojson = (pg_fetch_all($result));	
}
echo json_encode($geojson);
?>