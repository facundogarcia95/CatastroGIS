<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BarrioController;
use App\Parcela;
use App\ParcelaPos;
use App\Http\Controllers\ParcelaController;

class PostgresController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /*==================================
     PETICIONES AJAX / SERVICIOS WEB
     =====================================*/

        /*================
            OBTENER EL EXTEND DE LA PARCELA A PARTIR DE SU NOMENCLATURA
        =================== */

        public function get_extend_parcela(Request $request){

            $validatedData = $request->validate([
                'nomencla' => 'required'
            ]);

            if($validatedData){

                $extent = $this->extentmax($request->nomencla);

                if($extent){

                $object_barrio = new BarrioController();
                $object_parcela = new ParcelaController();
                $barrio = $object_barrio->get_barrio_por_nomencla(substr($request->nomencla,0,20));
                $parcela = Parcela::where('parcela_nomenclatura','LIKE','%'.substr($request->nomencla,0,16).'%')->first();
                $titular = null;

                if(isset($parcela)){

                    if($parcela){

                    $titular =  $object_parcela->get_titular($parcela->parcela_id);

                    }else{

                        $parcela = "NO SE ENCONTRÓ EN MYSQL";
                    }

                    if(!$barrio){

                        $html = '<div class="row bordered">
                        <div class="col-sm-12 bg-dark text-light">
                            <label><h6 class="mt-2">Nomenclatura</h6></label>
                        </div>
                        <div class="col-sm-12 bg-dark text-light">
                            <label><h6 class="mt-2"><a target="_blank" href="./gestion/padron/'.$parcela->parcela_id.'">'.$request->nomencla.'</a></h6></label>
                        </div>';

                    }else{
                        $html = '<div class="row bordered">
                        <div class="col-sm-12 col-md-6 bg-dark text-light">
                            <label><h6 class="mt-2">Nomenclatura</h6></label>
                        </div>
                        <div class="col-sm-12 col-md-6 bg-dark text-light">
                            <label><h6 class="mt-2"><a target="_blank" href="./gestion/padron/'.$parcela->parcela_id.'">'.$request->nomencla.'</a></h6></label>
                        </div>';
                    }

                }else{

                    return Response::json(
                        array(
                            "success" => true,
                            "mensaje" => "DATOS PARCELA",
                            "nomenclatura" => $request->nomencla,
                            "zoom" => $this->zoom_parcela($extent),
                            "barrio"=> $barrio??0,
                            "center" => $this->center_parcela($request->nomencla),
                            "xy_parcela" => $this->xy_parcela($request->nomencla)
                        )
                        ,200);

                }

                return Response::json(
                    array(
                        "success" => true,
                        "mensaje" => "DATOS PARCELA",
                        "nomenclatura" => $request->nomencla,
                        "titular" =>  $titular,
                        "parcela_id" => $parcela->parcela_id,
                        "barrio"=> $barrio??0,
                        "zoom" => $this->zoom_parcela($extent),
                        "center" => $this->center_parcela($request->nomencla),
                        "xy_parcela" => $this->xy_parcela($request->nomencla),
                        "html" => $html
                    )
                    ,200);

                }else{

                    return Response::json(
                        array(
                            "success" => false,
                            "mensaje" => "Parcela no encontrada",
                            "respuesta" => null
                        )
                        ,400);

                }
            }else{

                return Response::json(
                    array(
                        "success" => false,
                        "mensaje" => "Error al cargar los datos",
                        "respuesta" => null
                    )
                    ,400);

            }

        }

        /*================
            OBTENER EL DIBUJO DE LA PARCELA A PARTIR DE SU NOMENCLATURA
        =================== */
        public function get_dibujo_parcela(Request $request){

            $validatedData = $request->validate([
                'obj' => 'required'
            ]);


        
            if($validatedData){
                
                return Response::json(
                    array(
                        "success" => true,
                        "mensaje" => "Servicion web exitoso",
                        "coordenadas" => $this->coordenadas(($request->obj),"22182","4326")
                    )
                    ,200);

            }

        }

        /*================
            OBTENER LAS CALLES 
        =================== */
        public function get_calles(){


            $calles = DB::connection('pgsql')
            ->select("select t.value, min(t.rangomin), max(t.rangomax) 
            from (select concat(nombre,' - B: ',COALESCE (barrios,'SIN BARRIO'),' - D: ', distrito) as value , min(desdei) as rangoMin, max(hastad)as rangoMax from ".env('EJES_CALLES')."  where nombre != 'PUBLICA' AND nombre != 'SIN NOMBRE' group by distrito, nombre, gid order by distrito,nombre) 
            as t  group by value order by t.value");


            return Response::json(
                array(
                    "success" => true,
                    "calles" => $calles
                )
                ,200);

        }


        /*================
            OBTENER RANGO DE UNA CALLE
        =================== */
        public function get_direccion(Request $request){
            
            $validatedData = $request->validate([
                'calle' => 'required',
                'numeracion' => 'required'
            ]);

            if($validatedData && !$request->distrito){

                $eje = DB::connection('pgsql')
                ->select("select 
                            ST_X((ST_DumpPoints(ST_Transform(ST_CENTROID(geom),3857))).geom), 
                            ST_Y((ST_DumpPoints(ST_Transform(ST_CENTROID(geom),3857))).geom) 
                        from 
                            (select 
                            concat(nombre,' - B: ',
                            COALESCE (barrios,'SIN BARRIO'),
                            ' - D: ', distrito) 
                            as calle , min(desdei) 
                            as rangoMin, max(hastad) 
                            as rangoMax, geom from ".env('EJES_CALLES')." 
                            where nombre != 'PUBLICA' 
                            AND nombre != 'SIN NOMBRE' 
                            group by distrito, nombre, 
                            gid order by distrito,nombre) as t 
                        where t.calle like '%$request->calle%' and rangomin <= $request->numeracion and rangomax >= $request->numeracion 
                        order by rangomin desc limit 1");

                    if($eje){

                        return Response::json(
                            array(
                                "success" => true,
                                "eje_encontrado" => $eje
                            )
                            ,200);

                    }else{

                      
                        $eje = DB::connection('pgsql')
                        ->select("select 
                                    ST_X((ST_DumpPoints(ST_Transform(ST_CENTROID(geom),3857))).geom), 
                                    ST_Y((ST_DumpPoints(ST_Transform(ST_CENTROID(geom),3857))).geom) 
                                from 
                                    (select 
                                    concat(nombre,' - B: ',
                                    COALESCE (barrios,'SIN BARRIO'),
                                    ' - D: ', distrito) 
                                    as calle , min(desdei) 
                                    as rangoMin, max(hastad) 
                                    as rangoMax, geom from ".env('EJES_CALLES')." 
                                    where nombre != 'PUBLICA' 
                                    AND nombre != 'SIN NOMBRE' 
                                    group by distrito, nombre, 
                                    gid order by distrito,nombre) as t 
                                where t.calle like '%$request->calle%' 
                                order by rangomin desc limit 1");

                               
                            if($eje){

                                return Response::json(
                                array(
                                    "success" => true,
                                    'warning' => 'No pudimos localizar la numeración',
                                    "eje_encontrado" => $eje
                                )
                                ,200);
                            }else{

                                return Response::json(
                                array(
                                    "success" => false
                                )
                                ,400);
                            }

                    }           

            }else{

                $eje = DB::connection('pgsql')
                ->select("select 
                            ST_X((ST_DumpPoints(ST_Transform(ST_CENTROID(geom),3857))).geom), 
                            ST_Y((ST_DumpPoints(ST_Transform(ST_CENTROID(geom),3857))).geom) 
                        from 
                            (select 
                            concat(nombre,' - B: ',
                            COALESCE (barrios,'SIN BARRIO'),
                            ' - D: ', distrito) 
                            as calle, 
                            distrito,
                            min(desdei) as rangoMin, 
                            max(hastad) as rangoMax, 
                            geom from ".env('EJES_CALLES')." 
                            where nombre != 'PUBLICA' 
                            AND nombre != 'SIN NOMBRE' 
                            group by distrito, nombre, 
                            gid order by distrito,nombre) as t 
                        where t.calle like '%$request->calle%'
                        and rangomin <= $request->numeracion and rangomax >= $request->numeracion
                        and t.distrito like '%$request->distrito%'
                        order by rangomin desc limit 1");
                        
                        if($eje){

                            return Response::json(
                                array(
                                    "success" => true,
                                    "eje_encontrado" => $eje
                                )
                                ,200);
                        }else{

                            $eje = DB::connection('pgsql')
                            ->select("select 
                                        ST_X((ST_DumpPoints(ST_Transform(ST_CENTROID(geom),3857))).geom), 
                                        ST_Y((ST_DumpPoints(ST_Transform(ST_CENTROID(geom),3857))).geom) 
                                    from 
                                        (select 
                                        concat(nombre,' - B: ',
                                        COALESCE (barrios,'SIN BARRIO'),
                                        ' - D: ', distrito) 
                                        as calle, 
                                        distrito,
                                        min(desdei) as rangoMin, 
                                        max(hastad) as rangoMax, 
                                        geom from ".env('EJES_CALLES')." 
                                        where nombre != 'PUBLICA' 
                                        AND nombre != 'SIN NOMBRE' 
                                        group by distrito, nombre, 
                                        gid order by distrito,nombre) as t 
                                    where t.calle like '%$request->calle%'
                                    and t.distrito like '%$request->distrito%'
                                    order by rangomin desc limit 1");

                                    if($eje){

                                        return Response::json(
                                        array(
                                            "success" => true,
                                            'warning' => 'No pudimos localizar la numeración',
                                            "eje_encontrado" => $eje
                                        )
                                        ,200);
                                    }else{
        
                                        return Response::json(
                                        array(
                                            "success" => false
                                        )
                                        ,400);
                                    }
                        }

            }
        }

        /*==================================
        FUNCIONES INTERNAS
        =====================================*/

                /*==================================
                MAXIMO EXTENT DE LA PARCELA
                =====================================*/

                public function extentmax($nomencla16) {

                    $datos = $this->extentsimple($nomencla16);

               
                    if($datos){

                    $xmin = round($datos["xmin"],2);
                    $ymin = round($datos["ymin"],2);
                    $xmax = round($datos["xmax"],2);
                    $ymax = round($datos["ymax"],2);	
                    $x = $xmax-$xmin;
                    $y = $ymax-$ymin;
                    $z = sqrt(pow($x,2)+pow($y,2));
                    $z = $z/4;

                    $xmin = $xmin-$z;
                    $ymin = $ymin-$z;
                    $xmax = $xmax+$z;
                    $ymax = $ymax+$z;
                    $extent = array("xmin"=>$xmin,"ymin"=>$ymin,"xmax"=>$xmax,"ymax"=>$ymax);
                    return json_decode(json_encode($extent));
                    }

                    return null;

                }

                public function xy_parcela($nomencla){

                    $nomencla16 = substr(strval($nomencla), 0, 16);
            
                    $datos = $this->extentsimple($nomencla16);

                    if($datos){

                        $xmin = $datos["xmin"];
                        $ymin = $datos["ymin"];
                        $xmax = $datos["xmax"];
                        $ymax = $datos["ymax"];
                        $xcent = ($xmax + $xmin)/2;
                        $ycent = ($ymax + $ymin)/2;
                        

                        $respuesta = ParcelaPos::select(DB::raw("ST_AsText(ST_Transform(ST_GeomFromText('POINT($xcent  $ycent)',22182),4326)) as centro"))->first();
                        
                        $centro = str_replace("POINT(","",$respuesta->centro);
                        $centro = str_replace(")","",$centro);
                        $centro = explode(" ",$centro);

                        $result = array("xcent"=>floatval($centro[0]),"ycent"=>floatval($centro[1]));

                        return $result;   
                    }
                    
                    return null;
                }

                   /*==================================
                COORDENADAS DE LA PARCELA
                =====================================*/
                public function center_parcela($nomencla){

                    $nomencla16 = substr(strval($nomencla), 0, 16);
            
                    $datos = $this->geometrysimple($nomencla16);


                    $respuesta = array("features"=>[]);
                    $respuesta["features"][0] = array("geometry"=>array(
                                    "coordinates" => array(array($datos))
                                ));

                   return $respuesta;
            
                }

                public function geometrysimple($nomencla){

                    $nomencla16 = substr(strval($nomencla), 0, 16);
                    $datos = ParcelaPos::select(DB::raw('ST_AsText(ST_Transform(geom,3857)) as geometry'))
                    ->where("nomenc21",'LIKE','%'.$nomencla16.'%')->first();
    
                    if($datos){

                        $respuesta = str_replace("MULTIPOLYGON(((","",$datos->geometry);
                        $respuesta = str_replace(")))","",$respuesta);
                        $coordenadas = array();
                        $coordenadas = explode(",",$respuesta);

                        for($i=0; $i<count($coordenadas); $i++){
                            $coordenadas[$i] = array_map('floatval',explode(" ",$coordenadas[$i]));
                        }

                        return $coordenadas;

                    }

                    return null;

                }

                 /*==================================
                EXTEND DE LA PARCELA
                =====================================*/
                public function extentsimple($nomencla) {
                    $nomencla16 = substr(strval($nomencla), 0, 16);
                    $datos = ParcelaPos::select(DB::raw('ST_Extent(geom) as extent'))
                    ->where("nomenc21",'LIKE','%'.$nomencla16.'%')->first();
    
                    if($datos->extent){

                    $respuesta = str_replace("BOX(","",$datos->extent);
                    $respuesta = str_replace(")","",$respuesta);
                    $XY = array();
                    $XY = preg_split("/[\s,]+/",$respuesta);
                    $xmin = floatval($XY[0]);
                    $ymin = floatval($XY[1]);
                    $xmax = floatval($XY[2]);
                    $ymax = floatval($XY[3]);
                    $extent = array("xmin"=>$xmin,"ymin"=>$ymin,"xmax"=>$xmax,"ymax"=>$ymax);

                    return $extent;

                    }

                    return null;
                }

                 /*==================================
                ZOOM NECESARIO DE LA PARCELA
                =====================================*/
                public function zoom_parcela($extent){


                    $xmin = $extent->xmin; $xmax = $extent->xmax; 
                    $ymin = $extent->ymin; $ymax = $extent->ymax;

            
                    $anch = ($xmax - $xmin); $altu = ($ymax - $ymin);
                    $pit = sqrt(($anch * $anch) + ($altu * $altu));
                    $ZOOM = 19;

                    if ($pit < 200) {
                            $ZOOM = 18;
                    } else if ($pit < 500) {
                            $ZOOM = 17.5;
                    } else if ($pit < 1000) {
                            $ZOOM = 17;
                    } else if ($pit > 1000) {
                            $ZOOM = 16.5;
                    }

                    return $ZOOM;
                        
                }

        /*==================================
        COORDENADAS DE LAS PARCELAS
        =====================================*/
        public function coordenadas($ConjutoCoordenadas,$from,$to){
            
            
            foreach($ConjutoCoordenadas as $grupoCoordenadas){

                foreach($grupoCoordenadas as $coordenadas){

                    foreach($coordenadas as $puntos){

                        $respuesta = DB::connection('pgsql')->select("select ST_AsText(ST_Transform(ST_GeomFromText('POINT(".$puntos[0]." ".$puntos[1].")',$from),$to)) as coordenadas limit 1");

                        $coordenadas = str_replace("POINT(","",$respuesta[0]->coordenadas);
                        $coordenadas = str_replace(")","",$coordenadas);
                        $coordenadas = explode(" ",$coordenadas);
                    
                        $puntos = $coordenadas;

                    }

                }
            
            } 

            return $grupoCoordenadas[0];


        }

        public function transformarCoordenada(Request $request){

            $respuesta = DB::connection('pgsql')->select("select ST_AsText(ST_Transform(ST_GeomFromText('POINT(".$request->coordenadaX." ".$request->coordenadaY.")',$request->from),$request->to)) as coordenadas limit 1");

            $coordenadas = str_replace("POINT(","",$respuesta[0]->coordenadas);
            $coordenadas = str_replace(")","",$coordenadas);
            $coordenadas = explode(" ",$coordenadas);
            $coordenadas = array_map('floatval', $coordenadas);

            $punto = $coordenadas;

            return Response::json(
                array(
                    "coordenada" => $punto
                )
                ,200);
        }

        public function intersectar_coordenadas(Request $request){

             $respuesta = DB::connection('pgsql')->select("select * from ".env('PARCELARIO')." where st_intersects(ST_GeomFromText('POINT($request->coordenada_x $request->coordenada_y)',$request->from), ".env('PARCELARIO').".geom)");

            return Response::json(
                array(
                    "intersectado" => $respuesta
                )
                ,200);
        }
    

}
