<?php
include("configuration.php");

// Create connection
$conn = new mysqli($mysql2['host'],$mysql2['user'],$mysql2['pass'],$mysql2['database']);

$barrio_id = $_POST['barrio_id'];

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$response = [];
if($barrio_id){//si la parcela tiene barrio
	$sql = "SELECT distrito_id FROM barrios WHERE barrio_id = $barrio_id";
	//echo json_encode($sql);exit;
	$result = $conn->query($sql);
	if($row = $result->fetch_assoc()) {	
		$distrito_id = $row['distrito_id'];
	}
	$sql = "SELECT barrio_id, IFNULL(IFNULL(barrio_nombre, barrio_loteo),barrio_empresa) AS barrio_nombre_completo 
				FROM barrios 
				WHERE distrito_id = $distrito_id 
						AND tipo_estado_id = 1 AND NOT ISNULL(barrio_nombre) 
						AND IFNULL(IFNULL(barrio_nombre, barrio_loteo),barrio_empresa) IS NOT NULL
				GROUP BY barrio_nombre_completo
				ORDER BY barrio_nombre_completo";
	$result = $conn->query($sql);

	if($result->num_rows > 0) {
	  while($row = $result->fetch_assoc()) {		  
		  array_push($response, [$row['barrio_id'],utf8_encode($row['barrio_nombre_completo'])]);		  
	  }
	}
}else{//si la parcela no tiene barrio
	$sql = "SELECT barrio_id, IFNULL(IFNULL(barrio_nombre, barrio_loteo),barrio_empresa) AS barrio_nombre_completo 
				FROM barrios 
				WHERE tipo_estado_id = 1 AND NOT ISNULL(barrio_nombre) AND IFNULL(IFNULL(barrio_nombre, barrio_loteo),barrio_empresa) IS NOT NULL
				GROUP BY barrio_nombre_completo
				ORDER BY barrio_nombre_completo";
	$result = $conn->query($sql);

	if($result->num_rows > 0) {
	  while($row = $result->fetch_assoc()) {		  
		  array_push($response, [$row['barrio_id'],utf8_encode($row['barrio_nombre_completo'])]);		  
	  }
	}
}
echo json_encode($response);
$conn->close();
?>