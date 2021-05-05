<?php

namespace App\Http\Controllers;

use App\CamposBusquedaDinamica;
use App\Distrito;
use App\HistorialBusquedaDinamica;
use App\Mejora;
use App\Parcela;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use App\ParcelasBusquedaDinamica;
use App\Persona;
use App\TipoMejora;
use App\TipoNomenclatura;
use App\TipoParcelaRyB;
use Barryvdh\Snappy\Facades\SnappyPdf as FacadesSnappyPdf;
use SnappyPDF;
use Yajra\DataTables\Facades\DataTables;

class ReporteGeneralController  extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Operador');
        ini_set('memory_limit', -1);
        set_time_limit(0);

    }

    public function index(Request $request)
    {    
    
      session(['query' => null]);
      session(['visualizar' => null]);
      session(['formulario_html' => null]);
      session(['igualdades'=>null]);
      session(['valores'=>null]);
      session(['andor'=>null]);

      $horizont = DB::table('busqueda_dinamica_temp_nuevo')->select("visto")->orderBy('visto','DESC')->first();
      $visualizar = [];
      $distritos = Distrito::where('departamento_id','=',358)->orderBy('distrito_nombre', 'ASC') ->get();
      $listado = CamposBusquedaDinamica::where('id_tabla_busqueda','=',2)->orderBy('orden', 'ASC')->get();
      $historial = HistorialBusquedaDinamica::where('usuario_id','=',Auth::user()->usuario_id)->orderBy('historial_busqueda_dinamica_fecha','DESC')->limit(20)->get();

      return view('reportes.dinamico',["distritos" => $distritos, "listado" => $listado, "visualizar" => $visualizar, "horizont" => $horizont,"historial" => $historial]); 
      

    }
    
    public function destroy(Request $request){

      session(['query' => null]);
      session(['visualizar' => null]);
      session(['formulario_html' => null]);
      session(['igualdades'=>null]);
      session(['valores'=>null]);
      session(['andor'=>null]);

      return Redirect::to('reporteGeneral');    
    }

    /*=======================
    GENERACION DE LA CONSULTA DINAMICA
    ========================*/

    public function generarSelect($tabla,$orden,$key,$name){

      $listado = DB::table($tabla)->select('*')->where('tipo_estado_id','=',1)->orderBy($orden,'ASC')->get();

      $select = '<select class="form-control valores" name="valores[]" required>';

      foreach ($listado as $item) {
     
         $select .= '<option value="'.$item->$key.'">'.$item->$name.'</option>';
      }
      $select .= '</select>';

      return $select;

   }

    public function generarwhere(Request $request){

      $WHERE = "";
      $numeroParentesis = 0;
      $requestData = $request->all();
      $requestData["parentesis"] = str_replace("-",null, $request->parentesis);

      for($i=0; $i<count($requestData["campo_condicion"]); $i++){


            if($requestData["campo_condicion"][$i] == "parcelas.parcela_nomenclatura"){
               $requestData["campo_condicion"][$i] = "LEFT(parcelas.parcela_nomenclatura,20)";
               $requestData["valores"][$i] = substr($requestData["valores"][$i],0,20);
            }

            if($requestData["campo_condicion"][$i] == "tipos_parcelas_estados.tipo_parcela_estado_codigo"){
              $requestData["campo_condicion"][$i] = "tipos_parcelas_estados.tipo_parcela_estado_id";
            }

            if($requestData["campo_condicion"][$i] == "tipos_parcelas_ryb.tipo_parcela_ryb_codigo"){
               $requestData["campo_condicion"][$i] = "tipos_parcelas_ryb.tipo_parcela_ryb_id";
            }

            if($requestData["igualdades"][$i] == "LIKE" || $requestData["igualdades"][$i] == "LIKE"){

               $igualdad_valor = $requestData["igualdades"][$i]." '%".$requestData["valores"][$i]."%' ";
               
            }else{
               
               $igualdad_valor = $requestData["igualdades"][$i]." '".$requestData["valores"][$i]."' ";
               
            }
            
            if($requestData["andor"][$i] != null){
               
               if($requestData["campo_condicion"][$i] == "dif_declaradas_detectadas"){

                  $requestData["campo_condicion"][$i] = "cubiertas_declaradas (parcelas.parcela_id) - cubiertas_detectadas (parcelas.parcela_id) ";
   
               }else if($requestData["campo_condicion"][$i] == "dif_detectadas_declaradas"){
   
                  $requestData["campo_condicion"][$i] = "cubiertas_detectadas (parcelas.parcela_id) - cubiertas_declaradas (parcelas.parcela_id) ";
   
               }else if($requestData["campo_condicion"][$i] == "cubiertas_declaradas" || $requestData["campo_condicion"][$i] == "cubiertas_detectadas" ){
   
                  $requestData["campo_condicion"][$i] = $requestData["campo_condicion"][$i]."(parcelas.parcela_id) ";

               }

               $WHERE .= $requestData["andor"][$i]." ".$requestData["parentesis"][$numeroParentesis]." ".$requestData["campo_condicion"][$i]." ".$igualdad_valor.$requestData["parentesis"][$numeroParentesis+1];
               
            }else{
               
               if($requestData["campo_condicion"][$i] == "dif_declaradas_detectadas"){

                  $requestData["campo_condicion"][$i] = "cubiertas_declaradas (parcelas.parcela_id) - cubiertas_detectadas (parcelas.parcela_id) ";
   
               }else if($requestData["campo_condicion"][$i] == "dif_detectadas_declaradas"){
   
                  $requestData["campo_condicion"][$i] = "cubiertas_detectadas (parcelas.parcela_id) - cubiertas_declaradas (parcelas.parcela_id) ";
   
               }else if($requestData["campo_condicion"][$i] == "cubiertas_declaradas" || $requestData["campo_condicion"][$i] == "cubiertas_detectadas" ){
   
                  $requestData["campo_condicion"][$i] = $requestData["campo_condicion"][$i]."(parcelas.parcela_id) ";

               }

               $WHERE .= $requestData["parentesis"][$numeroParentesis].$requestData["andor"][$i]." ".$requestData["campo_condicion"][$i]." ".$igualdad_valor.$requestData["parentesis"][$numeroParentesis+1];
            
            }
            
         
            $numeroParentesis = $numeroParentesis+2;

      }

     $respuesta = $this->generarConsulta($WHERE, $request);

      return $respuesta;
   }


   public function generarConsulta($WHERE, Request $request){


      $SELECT  = Parcela::select(
        DB::raw('parcelas.*'),
        DB::raw('personas.persona_nro_doc'),
        DB::raw('personas.persona_cuit'),
        DB::raw('personas.persona_denominacion'),
        DB::raw('personas.razon_social'),
        DB::raw('cubiertas_declaradas(parcelas.parcela_id) AS cubiertas_declaradas'),
        DB::raw('cubiertas_detectadas(parcelas.parcela_id) AS cubiertas_detectadas'),
        DB::raw('(cubiertas_declaradas(parcelas.parcela_id) - cubiertas_detectadas(parcelas.parcela_id)) AS dif_declaradas_detectadas'),
        DB::raw('(cubiertas_detectadas(parcelas.parcela_id) - cubiertas_declaradas(parcelas.parcela_id)) AS dif_detectadas_declaradas'),
        DB::raw(env('DB_DATABASE_DIRECCIONES').'.distritos.distrito_nombre'),
        DB::raw("CONCAT(tipos_parcelas_estados.tipo_parcela_estado_codigo, ' - ',  tipos_parcelas_estados.tipo_parcela_estado_descrip) as tipo_parcela_estado_codigo"),
        DB::raw("CONCAT(tipos_parcelas_ryb.tipo_parcela_ryb_codigo, ' - ',  tipos_parcelas_ryb.tipo_parcela_ryb_descrip) as tipo_parcela_ryb_codigo"),
      )
      ->leftJoin('personas_parcelas','parcelas.parcela_id','=','personas_parcelas.parcela_id')
      ->leftJoin('personas','personas_parcelas.persona_id','=','personas.persona_id')
      ->leftJoin(env('DB_DATABASE_DIRECCIONES').'.direcciones',env('DB_DATABASE_DIRECCIONES').'.direcciones.direccion_nomencla','=','parcelas.direccion_nomencla_rud_real')
      ->leftJoin(env('DB_DATABASE_DIRECCIONES').'.distritos',env('DB_DATABASE_DIRECCIONES').'.distritos.distrito_id','=',env('DB_DATABASE_DIRECCIONES').'.direcciones.distrito_id')
      ->leftJoin('tipos_parcelas_estados','parcelas.tipo_parcela_estado_id','=','tipos_parcelas_estados.tipo_parcela_estado_id')
      ->leftJoin('tipos_parcelas_ryb','parcelas.tipo_parcela_ryb_id','=','tipos_parcelas_ryb.tipo_parcela_ryb_id')
      ->where('personas_parcelas.persona_parcela_ppal','=',1)
      ->where('personas.tipo_estado_id','=',1);

      if($request->distrito != 0){

        $SELECT->where(env('DB_DATABASE_DIRECCIONES').'.distritos.distrito_id','=',$request->distrito);

      }

      $query = $SELECT->whereRaw($WHERE)->groupBy('parcelas.parcela_id')->orderBy($request->order, $request->by)->get();

      
      if(!empty($query)){
        $historial = array();

        array_push($historial,[
          "historial_busqueda_dinamica_condicion" => json_encode($request->all()),
          "historial_busqueda_dinamica_sentencia" =>  $WHERE,
          "historial_busqueda_dinamica_fecha" => now(),
          "usuario_id" => Auth::user()->usuario_id
          ]);

        HistorialBusquedaDinamica::insert($historial);

      }
      

      session(['query'=> $query]);
      session(['visualizar'=>$request->visualizar]);
      session(['formulario_html'=>$request->html_sentencia]);
      session(['igualdades'=>$request->igualdades]);
      session(['valores'=>$request->valores]);
      session(['andor'=>$request->andor]);
      
      $horizont = DB::table('busqueda_dinamica_temp_nuevo')->select("visto")->orderBy('visto','DESC')->first();
      $distritos = Distrito::where('departamento_id','=',358)->orderBy('distrito_nombre', 'ASC') ->get();
      $listado = CamposBusquedaDinamica::where('id_tabla_busqueda','=',2)->orderBy('orden', 'ASC')->get();
      $historial = HistorialBusquedaDinamica::where('usuario_id','=',Auth::user()->usuario_id)->orderBy('historial_busqueda_dinamica_fecha','DESC')->limit(20)->get();

      return view('reportes.dinamico',["distritos" => $distritos, "listado" => $listado, "visualizar" => $request->visualizar, "horizont" => $horizont,"historial" => $historial]); 

  }


    /*=======================
    GENERACION DE LA TABLA CON LA RESPUESTA
    ========================*/

  public function datatable(Request $request){

    $respuesta = session('query');

    return DataTables::of($respuesta)
      ->editColumn('parcela_padron', function(Parcela $parcela) {
        return $parcela->parcela_padron;
      })->rawColumns(['parcela_padron'])
      ->make(true);

  }


    /*=======================
    GENERACION DE PDF
    ========================*/
  public function pdfReporte(Request $request){

    ini_set('memory_limit', -1); 
    set_time_limit(0);

    $pdf = FacadesSnappyPdf::loadView('pdf.dinamico',['resultado' => session('query'),"emision"=>date("d/m/Y H:i"),"usuario"=>Auth::user()->usuario_nombre]);
    $pdf->setTimeout(0);

    return $pdf->setPaper('a3', 'landscape')->stream();  

  }
    
      /*=======================
    GENERACION MAPA REPORTE
    ========================*/
  public function reporteCartografia(Request $request){

    ParcelasBusquedaDinamica::where('usuario_id', '=',Auth::user()->usuario_id)->delete();
    
    $registros = session('query');

    $insert = array();


    foreach ($registros as $registro) {

      array_push($insert,[
        "nomencla21" => $registro->parcela_nomenclatura,
        "usuario_id" => Auth::user()->usuario_id
        ]);
    }

    ParcelasBusquedaDinamica::insert($insert);

    /*===========
    CALCULO EL EXTENT DE LA CAPA
    ============*/
    $respuestaExtent = DB::connection('pgsql')->table('vbusqueda_dinamica')->select(DB::raw('ST_Extent(geom) as extent'))->where('usuario_id','=',Auth::user()->usuario_id)->get();
    
    $respuesta = str_replace("BOX(","",$respuestaExtent[0]->extent);
    $respuesta = str_replace(")","",$respuesta);
    $XY = array();
    $XY = preg_split("/[\s,]+/",$respuesta);
    $xmin = floatval($XY[0]);
    $ymin = floatval($XY[1]);
    $xmax = floatval($XY[2]);
    $ymax = floatval($XY[3]);
    $extent = array("xmin"=>$xmin,"ymin"=>$ymin,"xmax"=>$xmax,"ymax"=>$ymax);


    $xcent = ($extent["xmax"] + $extent["xmin"])/2;
    $ycent = ($extent["ymax"] + $extent["ymin"])/2;

    $respuesta = DB::connection('pgsql')->table('vbusqueda_dinamica')->select(DB::raw("ST_AsText(ST_Transform(ST_GeomFromText('POINT($xcent  $ycent)',22182),4326)) as centro"))->first();
    $centro = str_replace("POINT(","",$respuesta->centro);
    $centro = str_replace(")","",$centro);
    $centro = explode(" ",$centro);

    $result = array("xcent"=>floatval($centro[0]),"ycent"=>floatval($centro[1]));

    return view('cartografia.reporte',["extent" => $result]); 

  }

  
    /*=======================
    GENERACION DE VISTA HORIZONT
    ========================*/
   public function vistaHorizont(Request $request){

      $respuesta = DB::table('busqueda_dinamica_temp_nuevo')->select("visto")->orderBy('visto','DESC')->first();
      
      if($respuesta){

        return Response::json(
          array(
              "actualizada" => false
          )
          ,200);

      }else{

          DB::table('busqueda_dinamica_temp_nuevo')->truncate();
          $registros = session('query');
          $insert = array();

          foreach ($registros as $registro) {

            array_push($insert,[
              "parcela_id" => $registro->parcela_id,
              "parcela_padron" => $registro->parcela_padron,
              "titular_principal" => $registro->persona_denominacion,
              "titular_cuit" => $registro->persona_cuit,
              "sup_declarada" => $registro->cubiertas_declaradas,
              "sup_detectada" => $registro->cubiertas_detectadas,
              "dif_decla_detec" => $registro->dif_declaradas_detectadas,
              "usuario_id" => Auth::user()->usuario_id,
              "fecha" => now(),
              "direccion_real_distrito" => $registro->distrito_nombre,
              "visto" => 0
              ]);
          }

          DB::table('busqueda_dinamica_temp_nuevo')->insert($insert);

          return Response::json(
            array(
                "actualizada" => true
            )
            ,200);

      }

   }


    

   public function historialConsulta(Request $request){

    $historial = HistorialBusquedaDinamica::find($request->historial_id);
    
    $sentencia = json_decode($historial->historial_busqueda_dinamica_condicion);

    $historial->delete();
    
    $new_request = new Request();

    foreach ($sentencia as $key => $value) {
      $new_request[$key] = $value;
    }

    $respuesta = $this->generarwhere($new_request);
    
    return $respuesta;
   }

  /*===========================================
      TRAIGO EL POLIGONO DEL ELEMENTO SEGUN SU NOMENCLATURA
  ============================================= */
      
  public function get_elem_parcela(Request $request){

    $where = $request->condicion;
    $where = str_replace("&quot;","'",$where);

    $geojson = array( 'type' => 'FeatureCollection', 'features' => array());

    $respuestas = DB::connection("pgsql")->select("SELECT public.".env('PARCELARIO').".* , ST_AsGeoJSON(st_transform(geom,3857)) AS geometry FROM public.".env('PARCELARIO')." WHERE ".$where);


    foreach($respuestas as $respuesta){

       $marker = array(
          'crs' => array(
                      'type' =>'name',
                      'properties' => array('name'=>'urn:ogc:def:crs:EPSG::3857')
                   ),
          'type' => 'FeatureCollection',
          'features' => array([
                'geometry' => json_decode($respuesta->geometry,true),
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
         "success" => true,
         "respuesta" => $geojson
         )
      ,200);

  }

  /*===========================================
      LLAMO A LA VISTA DE TOTALES
  ============================================= */

  public function totales(Request $request){

    return view('totales.index');
    
  }

  /*===========================================
      TRAIGO LOS TIPOS DE MEJORAS
  ============================================= */
  public function get_tipos_mejoras(Request $request){

    $tipos = TipoMejora::where('tipo_estado_id','=',1)->get();

    $cantidades = Mejora::select(DB::raw('COUNT(mejoras.tipo_mejora_id) as cantidad, tipos_mejoras.tipo_mejora_descrip'))
    ->leftJoin('tipos_mejoras','tipos_mejoras.tipo_mejora_id','=','mejoras.tipo_mejora_id')
    ->where('mejoras.tipo_estado_id','=',1)->where('mejoras.tipo_mejora_id','>=',1)->groupBy('mejoras.tipo_mejora_id')->get();

    return Response::json(
        array(
          "success" => true,
          "cabeceras" => $tipos,
          "cantidades" => $cantidades
          )
        ,200);

  }



  /*===========================================
      TRAIGO LAS RYB DE LAS PARCELAS
  ============================================= */
  public function rybParcelas(Request $request){

    $cabeceras = TipoParcelaRyB::where('tipo_estado_id','=',1)->get();

    $cantidades = Parcela::select(DB::raw('COUNT(parcelas.tipo_parcela_ryb_id) as cantidad, tipos_parcelas_ryb.tipo_parcela_ryb_descrip'))
    ->leftJoin('tipos_parcelas_ryb','tipos_parcelas_ryb.tipo_parcela_ryb_id','=','parcelas.tipo_parcela_ryb_id')
    ->where('parcelas.tipo_estado_id','=',1)->where('parcelas.tipo_parcela_ryb_id','>=',1)->groupBy('parcelas.tipo_parcela_ryb_id')->get();

    return Response::json(
        array(
          "success" => true,
          "cabeceras" => $cabeceras,
          "cantidades" => $cantidades
          )
        ,200);

  }


    /*===========================================
      TRAIGO LAS TIPOS DE NOMENCLATURAS DE LAS PARCELAS
  ============================================= */
  public function nomenclasParcelas(Request $request){

    $cabeceras = TipoNomenclatura::orderBy('tipo_nomenclatura_descrip','ASC')->get();

    $cantidades = Parcela::select(DB::raw('COUNT(parcelas.tipo_nomenclatura) as cantidad, tipos_nomenclaturas.tipo_nomenclatura_descrip'))
    ->leftJoin('tipos_nomenclaturas','tipos_nomenclaturas.tipo_nomenclatura_id','=','parcelas.tipo_nomenclatura')
    ->where('parcelas.tipo_estado_id','=',1)->where('parcelas.tipo_nomenclatura','!=',null)->groupBy('parcelas.tipo_nomenclatura')->orderBy('tipos_nomenclaturas.tipo_nomenclatura_descrip','ASC')->get();

    return Response::json(
        array(
          "success" => true,
          "cabeceras" => $cabeceras,
          "cantidades" => $cantidades
          )
        ,200);

  }


      /*===========================================
      TRAIGO LOS ESTADOS DE LAS PERSONAS
  ============================================= */
  public function estadosPersonas(Request $request){


    $cantidades = Persona::select(DB::raw('SUM(IF(persona_nro_doc != 0,0,1)) as sin_doc, SUM(IF(persona_cuit != "",0,1)) as sin_cuit, SUM(IF(persona_sexo != "",0,1)) as sin_genero, SUM(IF(persona_email IS NOT NULL,0,1)) sin_email, SUM(IF(persona_fecha_nac IS NOT NULL,0,1)) as sin_fecha, SUM(IF(persona_tel_movil IS NOT NULL,0,1)) as sin_tel'))
    ->where('personas.tipo_estado_id','=',1)->get();

    return Response::json(
        array(
          "success" => true,
          "cantidades" => $cantidades
          )
        ,200);

  }
  /*===========================================
      TRAIGO GESTIONADO DE PARCELAS
  ============================================= */
  public function gestionadoParcelas(Request $request){

    DB::statement("SET lc_time_names = 'es_ES'");

    $altas = Parcela::select(DB::raw('MONTH(parcela_f_alta) AS mes, COUNT(parcela_f_alta) AS cantidad'))
    ->where('tipo_estado_id','=',1)
    ->where('parcela_f_alta','!=',null)
    ->whereRaw('parcela_f_alta >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)  AND parcela_f_alta <= CURDATE() + INTERVAL 1 DAY')
    ->groupBy('mes')->orderBy('mes','ASC')->get();

    $modificaciones = Parcela::select(DB::raw('MONTH(parcela_f_proceso) AS mes, COUNT(parcela_f_proceso) AS cantidad'))
    ->where('tipo_estado_id','=',1)
    ->where('parcela_f_proceso','!=',null)
    ->whereRaw('parcela_f_proceso >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)  AND parcela_f_proceso  <= CURDATE() + INTERVAL 1 DAY')
    ->groupBy('mes')->orderBy('mes','ASC')->get();
    
    return Response::json(
        array(
          "success" => true,
          "altas" => $altas,
          "modificaciones" => $modificaciones
          )
        ,200);

  }


  /*===========================================
      TRAIGO GESTIONADO DE PERSONAS
  ============================================= */
  public function gestionadoPersonas(Request $request){

    DB::statement("SET lc_time_names = 'es_ES'");

    $altas = Persona::select(DB::raw('MONTH(persona_f_alta) AS mes, COUNT(persona_f_alta) AS cantidad'))
    ->where('tipo_estado_id','=',1)
    ->where('persona_f_alta','!=',null)
    ->whereRaw('persona_f_alta >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)  AND persona_f_alta  <= CURDATE() + INTERVAL 1 DAY')
    ->groupBy('mes')->orderBy('mes','ASC')->get();

    $modificaciones = Persona::select(DB::raw('MONTH(persona_f_proce) AS mes, COUNT(persona_f_proce) AS cantidad'))
    ->where('tipo_estado_id','=',1)
    ->where('persona_f_proce','!=',null)
    ->whereRaw('persona_f_proce >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)  AND persona_f_proce  <= CURDATE() + INTERVAL 1 DAY')
    ->groupBy('mes')->orderBy('mes','ASC')->get();
    
    return Response::json(
        array(
          "success" => true,
          "altas" => $altas,
          "modificaciones" => $modificaciones
          )
        ,200);

  }

    /*===========================================
      TRAIGO LAS GETIONES DE MEJORAS
  ============================================= */
  public function gestionadoMejoras(Request $request){

    DB::statement("SET lc_time_names = 'es_ES'");

    $altas = Mejora::select(DB::raw('MONTH(mejora_f_alta) AS mes, COUNT(mejora_f_alta) AS cantidad'))
    ->where('tipo_estado_id','=',1)
    ->whereRaw('mejora_f_alta >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)  AND mejora_f_alta <= CURDATE() + INTERVAL 1 DAY')
    ->groupBy('mes')->orderBy('mes','ASC')->get();

    $modificaciones = Mejora::select(DB::raw('MONTH(mejora_f_pro) AS mes, COUNT(mejora_f_pro) AS cantidad'))
    ->where('tipo_estado_id','=',1)
    ->whereRaw('mejora_f_pro >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)  AND mejora_f_pro <= CURDATE() + INTERVAL 1 DAY')
    ->groupBy('mes')->orderBy('mes','ASC')->get();
    
    return Response::json(
        array(
          "success" => true,
          "altas" => $altas,
          "modificaciones" => $modificaciones
          )
        ,200);
  }


}