<?php

namespace App\Http\Controllers;

use App\Barrio;
use App\BarrioDissolve;
use App\Direccion;
use App\Parcela;
use Exception;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ParcelaPos;
use File;
use Illuminate\Support\Facades\Auth;

class BarrioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Operador');

    }


    /*===========================================
        BUSCAR BARRIO CON PARAMETROS DINAMICOS
    ============================================= */

    public function get_barrio(Request $request)
    {
  

      $query = DB::connection('mysql2')->table("barrios");
      
        $validar = false;

        foreach($request->all() as $key => $valor ){
            
            if($valor != null){
                $query->where($key,'=',$valor);
                $validar = true;
            }
        
        }

        if($validar){
        
            $respuesta = $query->get();

        
            if($respuesta){

                return Response::json(
                    array(
                        "success" => true,
                        "mensaje" => "Servicion web exitoso",
                        "barrios" => $respuesta
                    )
                    ,200);

            }else{

                return Response::json(
                    array(
                        "mensaje" => "Error al procesar la búsqueda"
                    )
                    ,401);

            }
        }else{

            return Response::json(
                array(
                    "mensaje" => "Debe completar al menos un campo"
                )
                ,401);
        }

    }


    /*===========================================
        LISTADO DE LOS BARRIOS ACTIVOS PARA EL AUTOCOMPLETADO
    ============================================= */

    public function get_barrios_autocompletar(Request $request){


        $barrios = Barrio::select(DB::raw("IFNULL(CONCAT(barrio_nombre,' - BARRIO'),
                          IFNULL(CONCAT(barrio_loteo,' - LOTEO'),
                          IFNULL(CONCAT(barrio_empresa,' - EMPRESA'),'SIN BARRIO'))) AS 'value'"), "barrio_id", "distrito_id");
        $barrios->where('tipo_estado_id','=',1);  

        if($request->distrito != null){
            $barrios->where('distrito_id','=',$request->distrito);  
        }                   
        
        $barrios = $barrios->get();

        return Response::json(
            array(
                "success" => true,
                "barrios" => $barrios
            )
            ,200);

    }

    /*===========================================
        OBTENER EL BARRIO A PARTIR DE LA NOMENCLATURA DE LA PARCELA
    ============================================= */

    public function get_barrio_por_nomencla($nomenclatura){

        
        $barrioPG = DB::connection('pgsql')->table(env('PARCELARIO'))
        ->select("barrio_id")->where("nomenc21","LIKE","%".$nomenclatura."%")->first();

        if($barrioPG){
            $barrio = Barrio::where('barrio_id','=',$barrioPG->barrio_id)->first();
            return $barrio;
        }

        return null;


    }


    
   /*===========================================
        DAR DE ALTA UN BARRIO
   ============================================= */

   public function alta_barrio(Request $request){

        
      $validatedData = $request->validate([
          'estado_barrio_id' => 'required',
          'fuente_barrio_id' => 'required',
          'dominio_barrio_id' => 'required',
          'distrito_id' => 'required'
      ]);


      if(!$validatedData)
      {
              /*===========================================
                  SI LOS CAMPOS OBLIGATORIOS FALTAN, ES DECIR VIENEN VACIO 
                  =======================================*/
                  return Response::json(
                     array(
                           "mensaje" => "Debe completar los campos obligatorios (Fuente, Estado, Dominio y Distrito).",
                           "success" => false
                     )
                     ,401);
      }


      if($request->barrio_nombre == null && $request->barrio_loteo == null && $request->barrio_empresa == null)
      {
            /*===========================================
                  SI NO TIENE NOMBRE, ES DECIR VIENEN VACIO 
                  =======================================*/
            return Response::json(
            array(
                  "mensaje" => "El barrio, loteo o empresa debe tener nombre",
                  "success" => false
            )
            ,401);
      }

      /*===========================================
         VALIDO QUE EL BARRIO SEA UNICO PARA EL DISTRITO
      ============================================= */

      if(isset($request->barrio_nombre))
      {
        $existe = DB::connection('mysql2')->table("barrios")
        ->where('barrio_nombre','=',$request->barrio_nombre)
        ->where('distrito_id','=',$request->distrito_id)
        ->count();

         if($existe > 0)
         {
               return Response::json(
                  array(
                     "mensaje" => "Ya existe un barrio con ese nombre para el distrito seleccionado",
                     "success" => false
                  )
                  ,401);
         }

         /*===========================================
         GUARDO EL BARRIO 
      ============================================= */
         $barrio = new Barrio();
         $barrio->barrio_nombre = $request->barrio_nombre;
         $barrio->barrio_loteo = $request->barrio_loteo;
         $barrio->barrio_empresa = $request->barrio_empresa;
         $barrio->id_empresa = $request->id_empresa;
         $barrio->departamento_id = 358;
         $barrio->distrito_id = $request->distrito_id;
         $barrio->nombre_alternativo = $request->nombre_alternativo;
         $barrio->estado_barrio_id = $request->estado_barrio_id;
         $barrio->dominio_barrio_id = $request->dominio_barrio_id;
         $barrio->fuente_barrio_id = $request->fuente_barrio_id;
         $barrio->zona_barrio = $request->zona_barrio;
         $barrio->nro_zona_barrio = $request->nro_zona_barrio;
         $barrio->nro_plano_barrio = $request->nro_plano_barrio;
         $barrio->fecha_plano_barrio = $request->fecha_plano_barrio;
         $barrio->matricula_profesional = $request->matricula_profesional;
         $barrio->expediente_barrio = $request->expediente_barrio;
         $barrio->observacion = $request->observacion;
         $barrio->usuario_f_alta = Auth::user()->usuario_id;
         $barrio->usuario_alta_id = now();
         $barrio->tipo_estado_id = 1;
         $barrio->save();

         return Response::json(
               array(
                  "mensaje" => "Creado exitosamente.",
                  "barrio" => $barrio
                  )
               ,200);

      }else{

         return Response::json(
            array(
                  "mensaje" => "Debe completar los campos obligatorios.",
               
            )
            ,401);

      }

   }

    /*===========================================
        DAR DE BAJA UN BARRIO
    ============================================= */

    public function baja_barrio(Request $request){

      $barrio= Barrio::findOrFail($request->barrio_id);

      if($barrio->tipo_estado_id == 1)
      {

          $barrio->usuario_modif_id= Auth::user()->usuario_id;
          $barrio->usuario_f_modif= now();
          $barrio->tipo_estado_id= 2;
          $barrio->save();

          $direcciones = Direccion::where("barrio_id","=",$request->barrio_id)->update(['barrio_id' => 0]);
          
          $parcelas = ParcelaPos::where("barrio_id","=",$request->barrio_id)->update(['barrio_id' => 0]);

          return Response::json(
              array(
                  "mensaje" => "Eliminado exitosamente.",
                  "barrio" => $barrio,
                  "direcciones" => $direcciones,
                  "parcelas" => $parcelas
                  )
              ,200);


      }
      else{

          $barrio->usuario_modif_id= Auth::user()->usuario_id;
          $barrio->usuario_f_modif= now();
          $barrio->tipo_estado_id= 1;
          $barrio->save();

          return Response::json(
              array(
                  "mensaje" => "Actualizado exitosamente.",
                  "barrio" => $barrio
                  )
              ,200);

       }

  }

    /*===========================================
      MODIFICAR UN BARRIO
  ============================================= */

  public function modificacion_barrio(Request $request){

    
          /*===========================================
              VALIDO QUE CONTENGAN LOS CAMPOS OBLIGATORIOS
           ============================================= */

          $validatedData = $request->validate([
              'barrio_id' => 'required',
              'estado_barrio_id' => 'required',
              'fuente_barrio_id' => 'required',
              'dominio_barrio_id' => 'required',
              'distrito_id' => 'required'
          ]);
  
          if(!$validatedData){
              return Response::json(
                  array(
                      "mensaje" => "Debe completar los campos obligatorios."
                      )
                  ,401); 
          }

          $barrio= Barrio::findOrFail($request->barrio_id);

             /*===========================================
                  SI EL DISTRITO ES DISTINTO - NO LE PERMITO MODIFICAR
              ============================================= */

          if($request->distrito_id == $barrio->distrito_id){

              $request->usuario_modif_id = Auth::user()->usuario_id;
              $request->usuario_f_modif = now();
              $barrio->update($request->all());
              
              return Response::json(
                  array(
                      "mensaje" => "Modificado exitosamente",
                      "barrio" => $barrio
                      )
                  ,200);

          }else{

              return Response::json(
              array(
                  "mensaje" => "No puede cambiar el distrito del barrio"
                  )
              ,401);

          }
    
  }


    /*===========================================
      GENERO POLIGONO A PARTIR DE UNA LISTA DE PUNTOS
  ============================================= */

  public function generar_poligono(Request $request){

      $validatedData = $request->validate([
         'lista_puntos' => 'required',
      ]);

      if($validatedData){

         $lista_puntos = $request->lista_puntos;

         if(count($lista_puntos) >0){//si el listado viene con datos

            $poligono = array();
            for($i=0;$i<count($lista_puntos);$i++){//arma listados de puntos del dibujo
                  $listado = $lista_puntos[$i];
                  $puntos = array();
                  for($j=0;$j<count($listado);$j++){//arma listados de puntos del dibujo
                     $x = $listado[$j][0];
                     $y = $listado[$j][1];
                     $puntos[] = $x." ".$y;
                  }
                  $polygon = "((".implode(",", $puntos)."))";
                  $poligono[] = $polygon;
                  }	

                  return Response::json(
                     array(
                        "mensaje" => "Poligono generado",
                        "poligono" => $poligono
                        )
                     ,200);
         } 

      }

      return Response::json(array("mensaje" => "No encontramos poligono"),401);

  }


      /*===========================================
      INTERSECTO EL POLIGONO CON LA TABLA QUE DEFINA DESDE EL FRONTEND
  ============================================= */
      
  public function intersectar_poligono(Request $request){


      $geojson = array( 'type' => 'FeatureCollection', 'features' => array());
      $datos = "MULTIPOLYGON(".implode(",", $request->poligono).")";

      $respuestas = DB::connection("".$request->conexion."")
      ->select("SELECT public.".$request->tabla.".* , ST_AsGeoJSON(st_transform(geom,3857)) AS geometry FROM public.".$request->tabla." WHERE st_intersects(geom,ST_Transform(ST_GeomFromText('SRID=4326;$datos'),22182))");


      foreach($respuestas as $respuesta){

         $respuesta->geometry = json_decode($respuesta->geometry,true);

         $marker = array(
            'crs' => array(
                        'type' =>'name',
                        'properties' => array('name'=>'urn:ogc:def:crs:EPSG::3857')
                     ),
            'type' => 'FeatureCollection',
            'features' => array([
                  'geometry' => $respuesta->geometry,
                  'id'=> $request->tabla.".".$respuesta->gid,
                  'geometry_name' => "geom",
                  'properties' => $respuesta,
                  'type' => "Feature"]
            )
            
         );

         array_push($geojson['features'], $marker);
      
      }
   
      return Response::json(
         array(
            "mensaje" => "Parcelas intersectadas",
            "parcelas" => $geojson
            )
         ,200);

   }


     /*===========================================
        ASIGNAR BARRIO SELECCIONADO A LAS PARCELAS
    ============================================= */

    public function asignar_barrio(Request $request){
    

      $validatedData = $request->validate([
          'barrio_id' => 'required',
          'parcelas' => 'required',
          'poligono' => 'required'
      ]);

      if(!$validatedData){
          return Response::json(
              array(
                  "message" => "Debe completar los campos obligatorios."
                  )
              ,401); 
      }

      if($request->barrio_id != 0){
          
          try{

          $barrio= Barrio::findOrFail($request->barrio_id);

          }catch(Exception $e){

              return Response::json(
                  array(
                      "message" => "El barrio no existe."
                      )
                  ,401); 
          }

      }

      $poli = "MULTIPOLYGON(".implode(",", $request->poligono).")";

      $query = ParcelaPos::select();

      $query->where(DB::raw("st_intersects(geom,ST_Transform(ST_GeomFromText('SRID=4326;$poli'),22182))"),"=","true");

      foreach($request->parcelas as $parcela){

          if(isset($parcela["estado"]) && $parcela["estado"] == 2){

              $query->where('nomenc21',"NOT LIKE","%".$parcela["nomenc21"]."%");
          }
          
      }
      
      $afectadas = $query->update(['barrio_id' => $request->barrio_id]);
      

      return Response::json(
          array(
              "mensaje" => "Solicitud realizada",
              "afectadas" => $afectadas
              )
          ,200); 

  }



  /*===========================================
        ACTUALIZAR DIRECCIONES ASIGNADAS A UN BARRIO
    ============================================= */
    public function actualizar_direccion(Request $request){

      $validatedData = $request->validate([
          'barrio_id' => 'required',
          'parcelas' => 'required'
      ]);

      if(!$validatedData){
          return Response::json(
              array(
                  "message" => "Debe completar los campos obligatorios."
                  )
          ,401); 
      }


      $query = Parcela::select();

      foreach($request->parcelas as $parcela){



          if(isset($parcela["estado"]) && $parcela["estado"] == 1){

              $query->orWhere('parcela_nomenclatura',"like","%".$parcela["nomenclatura"]."%");
          }

          
      }

      $parcelario = $query->get();

      $query = Direccion::select();

      foreach($parcelario as $parcela){

          if(isset($parcela->direccion_nomencla_rud_real)){

              $query->orWhere('direccion_nomencla',"=",$parcela->direccion_nomencla_rud_real);
          }

      }

      $afectadas = $query->update(['barrio_id' => $request->barrio_id]);

      if($afectadas > 0){

              return Response::json(
                  array(
                      "message" => "Se actualizaron $afectadas direcciones.",
                      "afectadas" => $afectadas
                      )
              ,200); 

      }else{

          return Response::json(
              array(
                  "message" => "No se actualizaron direcciones.",
                  "afectadas" => 0
                  )
          ,401); 

      }
  }


  /*==================================
         ZOOM DEL BARRIO SELECCIONADO
    =====================================*/
   public function zoom_barrio(Request $request){

      $validatedData = $request->validate([
          'barrio_id' => 'required'
      ]);

      if(!$validatedData){
          return Response::json(
              array(
                  "message" => "El barrio es obligatorio."
                  )
          ,401); 
      }

      $existencia = ParcelaPos::where("barrio_id","=",$request->barrio_id)->count();

      if($existencia > 0){

         $extent = $this->extentmax($request->barrio_id);

            return Response::json(
               array(
                     "zoom" => $this->zoom($extent),
                     "center" => $this->center($request->barrio_id),
                     "parcelas" => $this->parcelas_barrio($request->barrio_id)
               )
            ,200);

      }else{

         
         return Response::json(
            array(
                  "message" => "No encontramos parcelas para dicho barrio.",
               
            )
         ,401);


      }

   }

   
      /*==================================
            ACTUALIZAR CAPA BARRIOS DISSOLVE
      =====================================*/
    public function barrios_dissolve(Request $request = null){

         BarrioDissolve::query()->truncate();

         $barrios = Barrio::select(DB::raw(" 
         IFNULL(barrio_id, 'null') AS barrio_id,
         IFNULL(barrio_nombre,IFNULL(barrio_loteo,IFNULL(barrio_empresa, 'null'))) AS barrio_nombre,
         IFNULL(id_empresa, 0)  AS id_empresa,
         IFNULL(departamentos.departamento_nombre, 'SIN DEPTO') AS departamento,
         IFNULL(distritos.distrito_nombre, 'SIN DISTRITO') AS distrito,
         IFNULL(nombre_alternativo, 'SIN NOMBRE') AS nombre_alternativo,
         IFNULL(estado_barrio.descripcion , 'SIN ESTADO') AS estado_barrio,
         IFNULL(dominio_barrio.descripcion, 'SIN DOMINIO') AS dominio_barrio,
         IFNULL(fuente_barrio.descripcion, 'SIN FUENTE') AS fuente_barrio,
         IFNULL(nro_plano_barrio, 'SIN NRO PLANO') AS nro_plano_barrio,
         IFNULL(fecha_plano_barrio, 'SIN FECHA') AS fecha_plano_barrio,
         IFNULL(matricula_profesional, 'SIN MAT PROFESIONAL') AS matricula_profesional,
         IFNULL(expediente_barrio, 'SIN EXP') AS expediente_barrio,
         IFNULL(observacion, 'SIN OBSERVACION') AS observacion,
         IFNULL(usuario_f_alta, 'null') AS usuario_f_alta,
         IFNULL(usuario_alta_id, 0) AS usuario_alta_id,
         IFNULL(usuario_f_modif, 'SIN MODIFICACION') AS usuario_f_modif,
         IFNULL(usuario_modif_id, 0) AS usuario_modif_id"))
         ->leftJoin("distritos","distritos.distrito_id","=","barrios.distrito_id")
         ->leftJoin("departamentos","departamentos.departamento_id","=","barrios.departamento_id")
         ->leftJoin("estado_barrio","estado_barrio.estado_barrio_id","=","barrios.estado_barrio_id")
         ->leftJoin("dominio_barrio","dominio_barrio.dominio_barrio_id","=","barrios.dominio_barrio_id")
         ->leftJoin("fuente_barrio","fuente_barrio.fuente_barrio_id","=","barrios.fuente_barrio_id")
         ->where("barrios.tipo_estado_id","=",1)
         ->orderBy("barrios.barrio_id","ASC")->get();

         $geometrias = DB::connection('pgsql')
         ->select('select t.barrio_id, ST_Multi(ST_Union(t.geometria)) as geom from (select  barrio_id, geom as geometria from '.env('PARCELARIO').' where barrio_id > 0 order by barrio_id desc) t where ST_IsValid(t.geometria) group by t.barrio_id order by t.barrio_id');

         foreach($barrios as $barrio){

            foreach ($geometrias as $llave => $geometria){

               if($barrio->barrio_id == $geometria->barrio_id){

                     $barrio->geom = $geometria->geom;
            
                     $dissolve = new BarrioDissolve();
                     $dissolve->geom = $geometria->geom;
                     $dissolve->barrio_id = $barrio->barrio_id;
                     $dissolve->barrio_nom = $barrio->barrio_nombre;
                     $dissolve->id_empresa = $barrio->id_empresa;
                     $dissolve->departamen = $barrio->departamento;
                     $dissolve->distrito = $barrio->distrito;
                     $dissolve->nombre_alt = $barrio->nombre_alternativo;
                     $dissolve->estado_bar = $barrio->estado_barrio;
                     $dissolve->dominio_ba = $barrio->dominio_barrio;
                     $dissolve->fuente_bar = $barrio->fuente_barrio;
                     $dissolve->nro_plano = $barrio->nro_plano_barrio;
                     $dissolve->fecha_plano = $barrio->fecha_plano_barrio;
                     $dissolve->matricula = $barrio->matricula_profesional;
                     $dissolve->expediente = $barrio->expediente_barrio;
                     $dissolve->observacion = $barrio->observacion;
                     $dissolve->usuario_f_alta = $barrio->usuario_f_alta;
                     $dissolve->usuario_alta_id = $barrio->usuario_alta_id;
                     $dissolve->usuario_f_modif = $barrio->usuario_f_modif;
                     $dissolve->usuario_modif_id = $barrio->usuario_modif_id;
                     $dissolve->save();

                     unset($geometrias[$llave]);
                     break;  

               }

            }

         }

         return Response::json(
            array(
               "barrios" => $barrios,
               "geometrias" => $geometrias
               )
         ,200); 

   }

      /*==================================
            DESCARGAR LOS BARRIOS EN FORMATO JSON
      =====================================*/
    public function json_barrios(){

            $barrios = BarrioDissolve::get();
          
            $file = now().'_barrios.json';
            $destinationPath = public_path()."/storage/archivos/json_barrio/";

            if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
            
            File::put($destinationPath.$file,$barrios);

            $datos_barrios = array(
               "type" => "FeatureCollection",
               "name" => "Barrios_y_loteos",
               "crs" => [ "type"=> "name", "properties"=> ["name"=> "urn:ogc:def:crs:EPSG::22182"] ],
               "features"=> []
            );

            foreach($barrios as $barrio){
               $datos[] = array( "type"=> "Feature", 
                                 "properties"=> [
                                    "barrio_id" => $barrio->barrio_id, 
													"barrio_nombre" => $barrio->barrio_nombre, 
													"departamento_id" => $barrio->departamento, 
													"distrito_id" => $barrio->distrito, 
													"nombre_alternativo" => $barrio->nombre_alternativo, 
													"estado_barrio_id"=> $barrio->estado_barrio, 
													"dominio_barrio_id"=> $barrio->dominio_barrio, 
													"fuente_barrio_id"=> $barrio->fuente_barrio, 
													"nro_plano_barrio"=> $barrio->nro_plano_barrio, 
													"fecha_plano_barrio"=> $barrio->fecha_plano_barrio, 
													"matricula_profesional"=> $barrio->matricula_profesional, 
													"expediente_barrio"=> $barrio->expediente_barrio, 
													"observacion"=> $barrio->observacion, 
													"usuario_f_alta"=> $barrio->usuario_f_alta, 
													"usuario_alta_id"=> $barrio->usuario_alta_id, 
													"usuario_f_modif"=> $barrio->usuario_f_modif,
													"usuario_modif_id"=> $barrio->usuario_modif_id
                                    ]
                                    ,
                                 "geometry"=> $barrio->geom
                              );
            }

            $datos_barrios['features'] = $datos;

            header('Content-disposition: attachment; filename=barrios.json');

            echo json_encode($datos_barrios);

    }


       /*==================================
            LISTADO DE BARRIOS
      =====================================*/

    public function listadoBarrios(Request $request){

        ini_set('memory_limit', -1); 
        set_time_limit(0);

        $barrios = Barrio::select(DB::raw(" 
         IFNULL(barrio_id, 'null') AS barrio_id,
         IFNULL(barrio_nombre,IFNULL(barrio_loteo,IFNULL(barrio_empresa, 'null'))) AS barrio_nombre,
         IFNULL(id_empresa, 0)  AS id_empresa,
         IFNULL(departamentos.departamento_nombre, 'SIN DEPTO') AS departamento,
         IFNULL(distritos.distrito_nombre, 'SIN DISTRITO') AS distrito,
         IFNULL(nombre_alternativo, 'SIN NOMBRE') AS nombre_alternativo,
         IFNULL(estado_barrio.descripcion , 'SIN ESTADO') AS estado_barrio,
         IFNULL(dominio_barrio.descripcion, 'SIN DOMINIO') AS dominio_barrio,
         IFNULL(fuente_barrio.descripcion, 'SIN FUENTE') AS fuente_barrio,
         IFNULL(nro_plano_barrio, 'SIN NRO PLANO') AS nro_plano_barrio,
         IFNULL(fecha_plano_barrio, 'SIN FECHA') AS fecha_plano_barrio,
         IFNULL(matricula_profesional, 'SIN MAT PROFESIONAL') AS matricula_profesional,
         IFNULL(expediente_barrio, 'SIN EXP') AS expediente_barrio,
         IFNULL(observacion, 'SIN OBSERVACION') AS observacion,
         IFNULL(usuario_f_alta, 'null') AS usuario_f_alta,
         IFNULL(usuario_alta_id, 0) AS usuario_alta_id,
         IFNULL(usuario_f_modif, 'SIN MODIFICACION') AS usuario_f_modif,
         IFNULL(usuario_modif_id, 0) AS usuario_modif_id"))
         ->leftJoin("distritos","distritos.distrito_id","=","barrios.distrito_id")
         ->leftJoin("departamentos","departamentos.departamento_id","=","barrios.departamento_id")
         ->leftJoin("estado_barrio","estado_barrio.estado_barrio_id","=","barrios.estado_barrio_id")
         ->leftJoin("dominio_barrio","dominio_barrio.dominio_barrio_id","=","barrios.dominio_barrio_id")
         ->leftJoin("fuente_barrio","fuente_barrio.fuente_barrio_id","=","barrios.fuente_barrio_id")
         ->where("barrios.tipo_estado_id","=",1)
         ->orderBy("barrios.barrio_id","ASC")->get();

        
        $pdf = \SnappyPDF::loadView('pdf.barrios',['resultado' => $barrios,"emision"=>date("d/m/Y H:i"),"usuario"=>$this->CCGetUserNombre()]);
        return $pdf->setPaper('a3', 'landscape')->stream();  

    }

   /*==================================
        FUNCIONES INTERNAS
        =====================================*/

                /*==================================
                MAXIMO EXTENT DE LA PARCELA
                =====================================*/

                private function extentmax($barrio_id) {

                  $datos = $this->extentsimple($barrio_id);

                  return $datos;
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

              /*==================================
              CENTRO DEL BARRIO
              =====================================*/
              private function center($barrio_id){
          
                  $datos = $this->extentsimple($barrio_id);

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

               /*==================================
              EXTEND DEL BARRIO
              =====================================*/
              private function extentsimple($barrio_id) {

                  $datos = ParcelaPos::select(DB::raw('ST_Extent(geom) as extent'))
                  ->where("barrio_id",'=',$barrio_id)->first();
                  
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

               /*==================================
              ZOOM NECESARIO DEL BARRIO
              =====================================*/
              private function zoom($extent){

                  $xmin = $extent["xmin"]; $xmax = $extent["xmax"]; 
                  $ymin = $extent["ymin"]; $ymax = $extent["ymax"];

          
                  $anch = ($xmax - $xmin); $altu = ($ymax - $ymin);
                  $pit = sqrt(($anch * $anch) + ($altu * $altu));
                  $ZOOM = 19;

                  if ($pit < 200) {
                          $ZOOM = 18;
                  } else if ($pit < 500) {
                          $ZOOM = 17.5;
                  } else if ($pit < 1000) {
                          $ZOOM = 17;
                  } else if ($pit >= 1000) {
                          $ZOOM = 16;
                  }

                  return $ZOOM;
                      
              }
          
              /*====================================
              PARCELAS QUE PERTENECEN AL BARRIO SELECCIONADO
              ====================================== */
              private function parcelas_barrio($barrio_id){

                  $geojson = array( 'type' => 'FeatureCollection', 'features' => array());
                  $respuestas = ParcelaPos::select(DB::raw("".env('PARCELARIO').".*, ST_AsGeoJSON(st_transform(geom,3857)) AS geometry"))->where("barrio_id","=",$barrio_id)->get();

                  foreach($respuestas as $respuesta){

                      $respuesta->geometry = json_decode($respuesta->geometry,true);
          
                      $marker = array(
                          'crs' => array(
                                      'type' =>'name',
                                      'properties' => array('name'=>'urn:ogc:def:crs:EPSG::3857')
                                  ),
                          'type' => 'FeatureCollection',
                          'features' => array([
                              'geometry' => $respuesta->geometry,
                              'id'=> $respuesta->gid,
                              'geometry_name' => "geom",
                              'properties' => $respuesta,
                              'type' => "Feature"]
                          )
                          
                      );
          
                      array_push($geojson['features'], $marker);
                  
                  }

                  return $geojson;

            }


}