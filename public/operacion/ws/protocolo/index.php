<?php
header('Content-Type: application/json');
include("../../configuration.php");
if(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
	$protocolo = 'https://';
}else{
	$protocolo = 'http://';
}
echo json_encode($protocolo);
?>