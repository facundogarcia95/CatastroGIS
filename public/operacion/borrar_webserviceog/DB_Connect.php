<?php
error_reporting(E_ERROR | E_WARNING);
class DB_Connect {
    
    private $db;

    function __construct() {    }
 
    function __destruct() {
        $this->close();
    }
 
	 public function connect($sc) {
		$this->setconnet(pg_connect("host=".$sc["Host"]." port=".$sc["Port"]." dbname=".$sc["Database"]." user=".$sc["User"]." password=".$sc["Password"]));
		return $this->getconnet();
    }
 
    public function close() {
        pg_close($this->getconnet());
    }

    public function queryisNomencla20Existed($query){
		//busco si existe la o las parcelas que consulto
		$datos = array();
		$cont = 0;
		$return = pg_query($this->getconnet(), $query);
		while($row = pg_fetch_row($return)){
			$poligono = $this->queryPolygon($row[0]);
			$datos[$cont] = array("num"=>intval($cont),"Nomencla20"=>"$row[0]","X"=>floatval($row[1]),"Y"=>floatval($row[2]), "polygon"=>$poligono);
			$cont++;
		}
		return $datos;
    }

	public function queryPolygon($nomencla20){
		//por cada registro recuperado de la consulta
		include("../configuration.php");
		$datos = array();
		$dato = array();
		$cont = 0;
		$SQL = "SELECT row_to_json(fc)
		FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features, (SELECT '' As crs)
		FROM (SELECT 'Feature' As type, (SELECT gid As id),ST_AsGeoJSON(ST_Transform(lg.geom,4326))::json As geometry, (SELECT 'geom' As geometry_name), row_to_json((SELECT l FROM (SELECT gid, nomenc21, perimeter, shape_area, id_des as subindice ) As l)) As properties, replace(replace(replace(ST_AsText(ST_Transform(ST_GeomFromText(ST_AsText(st_centroid(geom)),22182),4326)),'POINT(',''),')',''),' ' ,',') as coord_transf
		FROM public.".$municipio['capa_parcela']." As lg WHERE nomenc21 LIKE '".$nomencla20."%'  ) As f )  As fc; ";
		$return = pg_query($this->getconnet(), $SQL);
		while($row = pg_fetch_row($return)){
			$dato = json_decode($row[0]);
			$dato->crs = array("type"=>"EPSG","properties"=>array("code"=>"22182"));
			$datos[$cont] = $dato;
			$cont++;
		}
		return $datos;
	}

    public function extent($query){
		$cont = 0;
		//traigo el extent de la consulta
		$return = pg_query($this->getconnet(), $query);
		while($row = pg_fetch_row($return)){
			$datos = $row[0];
			$cont++;
		}
		return $datos;
    }
	
    private function getconnet(){
		return $this->db;
    }

    private function setconnet($dbconn){
		$this->db = $dbconn;
    }
}
?>