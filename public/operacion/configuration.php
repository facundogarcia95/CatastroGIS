<?php
/* Archivo de configuración
----------------------------------------------------------------------------- */
$postgres = array(
    'user' => 'postgres',
    'pass' => '615u53r',
    'port' => '5432',
    'host' => 'localhost',
    'database' => 'catastro_GLLEN',
	'esquema' => 'public'
);

$postgres2 = array(
    'user' => 'postgres',
    'pass' => '615u53r',
    'port' => '5432',
    'host' => 'localhost',
    'database' => 'catastro_GLLEN',
	'esquema' => 'public'
);

$mysql = array(
    'user' => 'root',
    'pass' => '4dm1nG15',
    'port' => '3306',
    'host' => 'localhost',
    'database' => 'catastro_guaymallen'
);

$mysql2 = array(
    'user' => 'root',
    'pass' => '4dm1nG15',
    'port' => '3306',
    'host' => 'localhost',
    'database' => 'gestion_direcciones_gllen'
);

$IP = $_SERVER['REMOTE_ADDR'];
/*
function protocolo(){
	if(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
		return 'https://';
	}else{
		return 'http://';
	}
}
*/
//$protocolo = protocolo();
$protocolo = 'http://';

$url = array(
    'rud' => $protocolo. $IP .'/gestion_direcciones/cartografia/json/?n='
);

$db = mysqli_connect($mysql['host'],$mysql['user'],$mysql['pass'],$mysql['database']);
$SQL = "SELECT nombre FROM capas_cartografia WHERE nombre_visible = 'Parcelario'";

$result = $db->query($SQL);
$capa_parcela_mysql = "";
if($obj = $result->fetch_object()){
	$capa_parcela_mysql = $obj->nombre;
}else{
	echo "NO SE ENCONTRO DEFINICION DE PARCELARIO EN LA BD";exit;
}
if(!$capa_parcela_mysql){
	echo "NO SE ENCONTRO DEFINICION DE NOMBRE PARCELA EN LA BD";exit;
}

$SQL = "SELECT sigla_dependencia FROM capas_cartografia WHERE nombre_visible = 'Parcelario'";
$result = $db->query($SQL);
$sigla_dependencia = "";
if($obj = $result->fetch_object()){
	$sigla_dependencia = $obj->sigla_dependencia;
}

$def_dependencias = explode(";",$sigla_dependencia);

$municipio = array(
	'municipio_nombre' => 'Guaymallen',
	'municipio_sigla' => $def_dependencias[0],
	'municipio_dependencia' => $def_dependencias[1],
	'capa_parcela' => $capa_parcela_mysql
);

mysqli_close($db);

$base_datos_columna = array(
	'columna_x' => 'parcela_x',
	'columna_y' => 'parcela_y'
);