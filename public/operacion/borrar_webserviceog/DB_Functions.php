<?php
error_reporting(E_ERROR | E_WARNING );
class DB_Functions {
 
    private $db;
 
    function __construct() {
		//constructor del objeto
        require_once 'DB_Connect.php';
		require_once '../configuration.php';
        $this->db = new DB_Connect();

		$string_conexion = array(
			"Database" => $postgres['database'],
			"Host" => $postgres['host'],
			"Port" => "5432",
			"User" => $postgres['user'],
			"Password" => $postgres['pass']
		);
		if(!$this->db->connect($string_conexion)) echo "error de conexion con postgres ".__LINE__;
    }
 
    function __destruct() {
         
    }
 
    public function isNomencla20Existed($nomencla20) {
		//busca parcela o parcelas en la base de datos
		include("../configuration.php");
		$SQL = "SELECT nomenc21, ST_X (st_centroid(geom)), ST_Y(st_centroid(geom)), ST_AsText(st_centroid(geom)), replace(replace(replace(ST_AsText(ST_Transform(ST_GeomFromText(ST_AsText(st_centroid(geom)),22182),4326)),'POINT(',''),')',''),' ' ,',') as coord_transf FROM public.".$municipio['capa_parcela']." WHERE nomenc21 LIKE '".$nomencla20."%';";
        return $this->db->queryisNomencla20Existed($SQL);
    }

    public function center($nomencla20){
        $datos = $this->extentsimple($nomencla20);
		$xmin = $datos["xmin"];
		$ymin = $datos["ymin"];
		$xmax = $datos["xmax"];
		$ymax = $datos["ymax"];
		$xcent = ($xmax + $xmin)/2;
		$ycent = ($ymax + $ymin)/2;
		$result = array("xcent"=>$xcent,"ycent"=>$ycent);
		return $result;
    }
 
    public function extentsimple($nomencla20) {
		include("../configuration.php");		
        $datos = $this->db->extent("SELECT ST_Extent(geom) as extent 
					FROM public.".$municipio['capa_parcela']." 
					WHERE nomenc21 LIKE '".$nomencla20."%';");					
		$datos = str_replace("BOX(","",$datos);
		$datos = str_replace(")","",$datos);
		$XY = array();
		$XY = preg_split("/[\s,]+/",$datos);
		$xmin = floatval($XY[0]);
		$ymin = floatval($XY[1]);
		$xmax = floatval($XY[2]);
		$ymax = floatval($XY[3]);
		$extent = array("xmin"=>$xmin,"ymin"=>$ymin,"xmax"=>$xmax,"ymax"=>$ymax);
        return $extent;
    }

    public function extentmax($nomencla20) {
		$datos = $this->extentsimple($nomencla20);
		$xmin = round($datos["xmin"],2);
		$ymin = round($datos["ymin"],2);
		$xmax = round($datos["xmax"],2);
		$ymax = round($datos["ymax"],2);	
		$x = $xmax-$xmin;
		$y = $ymax-$ymin;
		$z = sqrt(pow($x,2)+pow($y,2))."<br>";		
		$z = $z/4;
		$xmin = $xmin-$z;
		$ymin = $ymin-$z;
		$xmax = $xmax+$z;
		$ymax = $ymax+$z;
		$extent = array("xmin"=>$xmin,"ymin"=>$ymin,"xmax"=>$xmax,"ymax"=>$ymax);
		return $extent;
    }
} 
?>