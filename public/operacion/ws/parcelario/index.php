<?php
header('Content-Type: application/json');
include("../../configuration.php");
$db = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
$SQL = "SELECT nombre, espacio_trabajo FROM capas_cartografia WHERE nombre_visible = 'Parcelario'";
$result = $db->query($SQL);
$datos = array("estado" => 'ERROR', "datos" => NULL);

if($obj = $result->fetch_object()){
	$nombre = $obj->nombre;
	$espacio_trabajo = $obj->espacio_trabajo;
	$datos["estado"] = 'OK';
	$datos["datos"] = array("capa_parcelario" => $nombre, "espacio_trabajo" => $espacio_trabajo);
}
echo json_encode($datos);
?>