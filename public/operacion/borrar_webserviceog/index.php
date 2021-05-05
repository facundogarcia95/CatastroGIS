<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
header('Content-Type: application/json; charset=UTF8');
header('Access-Control-Allow-Origin: *');
error_reporting(E_ERROR | E_WARNING);
$nomencla20 = '';
$nomencla20 = substr($_GET['nomencla20'],0,20);
$response = array("query" => "data", "success" => 0, "error" => 0);
$response["query"] = $nomencla20;

if($nomencla20){
 	require_once 'DB_Functions.php';
 	$db = new DB_Functions();
       $return = $db->isNomencla20Existed($nomencla20);
      if ($return != false) {
          $response["success"] = 1;
          $response["data"] = $return;
          $response["extent"] = $db->extentmax($nomencla20);
          $response["center"] = $db->center($nomencla20);
          echo json_encode($response);
		  die();
      }
}	
$response["error"] = 1;
$response["error_msg"] = "Revisar el estado de la nomenclatura de la parcela en el alfanumerico y en la cartografia.";
echo json_encode($response);
?>
