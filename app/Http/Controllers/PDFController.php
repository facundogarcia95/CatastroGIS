<?php

namespace App\Http\Controllers;

use App\Parcela;
use App\Mejora;
use App\PersonaParcela;
use App\Http\Controllers\ParcelaController;
use App\Observers\ParcelaAuditoria;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PDFController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function reporte($id)
    {
        

        $parcela = Parcela::select(
            'parcelas.*',
            'tipo_parcela_estado_codigo',
            'tipo_parcela_estado_descrip',
            'tipo_parcela_destino_abrev',
            'tipo_parcela_destino_descrip',
            'tipo_parcela_zona_cod',
            'tipo_parcela_zona_descrip')
        ->leftJoin('tipos_parcelas_estados','parcelas.tipo_parcela_estado_id','=','tipos_parcelas_estados.tipo_parcela_estado_id')
        ->leftJoin('tipos_parcelas_destinos','parcelas.tipo_parcela_destino_id','=','tipos_parcelas_destinos.tipo_parcela_destino_id')
        ->leftJoin('tipos_parcelas_zonas','parcelas.tipo_parcela_zona_id','=','tipos_parcelas_zonas.tipo_parcela_zona_id')
        ->where("parcela_id","=",$id)
        ->first();
        if(!$parcela){//sino existe la parcela 
            return Redirect::to('gestion/padron');
        }

        ParcelaAuditoria::reporte($parcela);

        $parcela_f_alta = $parcela->parcela_f_alta;
        $parcela_f_proceso = $parcela->parcela_f_proceso;
        $parcela_plano_fecha = $parcela->parcela_plano_fecha;
        if($parcela_f_alta == "0000-00-00 00:00:00"){
            $parcela_f_alta = "";
        }else{
            $parcela_f_alta = \Carbon\Carbon::parse($parcela->parcela_f_alta)->format('d/m/Y H:i');
        }
        if($parcela_f_proceso == "0000-00-00 00:00:00"){
            $parcela_f_proceso = "";
        }else{
            $parcela_f_proceso = \Carbon\Carbon::parse($parcela->parcela_f_proceso)->format('d/m/Y H:i');
        }
        if($parcela_plano_fecha == "0000-00-00 00:00:00"){
            $parcela_plano_fecha = "";
        }else{
            $parcela_plano_fecha = \Carbon\Carbon::parse($parcela->parcela_plano_fecha)->format('d/m/Y');
        }
        $mejoras = Mejora::select(
            'mejora_nro_exp',
            'mejora_letra_exp',
            'mejora_fecha_exp',
            'tipo_mejora_uso_codigo',
            'tipo_mejora_uso_descrip',
            'tipo_mejora_estado_descrip',
            'tipo_mejora_destino_descrip',
            'tipo_mejora_categoria_codigo',
            'tipo_mejora_categoria_descrip',
            'mejora_sup_cub')
        ->leftJoin('tipos_mejoras_usos','mejoras.tipo_mejora_uso_id','=','tipos_mejoras_usos.tipo_mejora_uso_id')
        ->leftJoin('tipos_mejoras_estados','mejoras.tipo_mejora_estado_id','=','tipos_mejoras_estados.tipo_mejora_estado_id')
        ->leftJoin('tipos_mejoras_destinos','mejoras.tipo_mejora_destino_id','=','tipos_mejoras_destinos.tipo_mejora_destino_id')
        ->leftJoin('tipos_mejoras_categorias','mejoras.tipo_mejora_categoria_id','=','tipos_mejoras_categorias.tipo_mejora_categoria_id')
        ->where("parcela_id","=",$id)
        ->where("mejoras.tipo_estado_id","=",1)
        ->get();

        $titulares = PersonaParcela::select(
            'tipo_persona_parcela_descrip',
            'tipo_persona_descrip',
            'persona_denominacion',
            'persona_nro_doc',
            'persona_cuit',
            'persona_parcela_ppal')
        ->leftJoin('tipos_personas_parcelas','personas_parcelas.tipo_persona_parcela_id','=','tipos_personas_parcelas.tipo_persona_parcela_id')
        ->leftJoin('personas','personas_parcelas.persona_id','=','personas.persona_id')
        ->leftJoin('tipos_personas','personas.tipo_persona_id','=','tipos_personas.tipo_persona_id')
        ->where("parcela_id","=",$id)
        ->where("personas_parcelas.tipo_estado_id","=",1)
        ->get();

        //----------------------DIRECCIONES----------------------------------
        $direccion_nomencla_rud_real = $parcela->direccion_nomencla_rud_real;
        $direccion_nomencla_rud_postal = $parcela->direccion_nomencla_rud_postal;
        $ParcelaController = new ParcelaController();
        $direccion_real = $ParcelaController->direccion($direccion_nomencla_rud_real);
        $direccion_postal = $ParcelaController->direccion($direccion_nomencla_rud_postal);
        $servicios = $ParcelaController->get_servicios($id);
        $tipo_servicio_descrip = array();
        $pasa = false;
        foreach($servicios as $servicio){
            $tipo_servicio_descrip[] = $servicio->servicio->tipo_servicio_descrip;
            $pasa = true;
        }
        
        if(!$pasa){
            $listado_servicios = "NO TIENE SERVICIOS REGISTRADOS";
        }else{
            $listado_servicios = implode(", ",$tipo_servicio_descrip);
        }
        $parcela_nomenclatura = $parcela->parcela_nomenclatura;
        //----------------------POSTGRESQL-----------------------------------
        $tamanio = strlen($parcela_nomenclatura);
        //CONSULTA AL PARCELARIO
        $tamanio = 20;
        $where = DB::raw('SUBSTRING(nomenc21,1,'.$tamanio.')');
        $Parcelario = DB::connection('mysql')->table('capas_cartografia')->select('nombre')->where("nombre_visible",'=','Parcelario')->first();
        $tabla = $Parcelario->nombre;
        //dd("SELECT * FROM $tabla WHERE SUBSTRING(nomenc21,1,($tamanio-1)) = '".substr($parcela_nomenclatura,0,20)."'");
		$subparcela = substr($parcela_nomenclatura,16,4);
		if($subparcela != '0000'){
			$parcela_nomenclatura = substr($parcela_nomenclatura,0,16)."0000";			
		}
        $carto = DB::connection('pgsql')->table($tabla)->where($where,'=',substr($parcela_nomenclatura,0,20))->first();
        //dd($parcela_nomenclatura);
        //dd($carto);
        $urlImg = "";
        if(!is_null($carto)){
            $box_extent = DB::raw('ST_Extent(geom) as box_extent');
            $bbox_extent = DB::connection('pgsql')->table($tabla)->select($box_extent)->where("gid",'=',$carto->gid)->first();
            $protocolo = $this->protocolo();
            $espacio_trabajo = env('ESPACIO_DE_TRABAJO');
            $municipio = env('MUNICIPIO');
            $municipio_down = strtolower($municipio);
            $municipio = str_replace("_","+",$municipio);
            $municipio = str_replace(" ","+",$municipio);
            //busco en el rest del goeserver:
            $output = json_decode(exec('curl -u '.env('GEOSERVER_USER').':'.env('GEOSERVER_PASS').' -H "Content-type: application/json" "'.$protocolo.$_SERVER['HTTP_HOST'].'/geoserver/rest/layers.json"'));

            $array_layers_parcela = $output->layers->layer;
            $array_layers_calle = $array_layers_parcela;
            $capas = array();
            //----------------PARCELAS------------------------
            foreach($array_layers_parcela as $layer){     
                if( strpos($layer->name,$municipio_down."_parcelas_pos")  ){
                    $capas[] = $layer->name;
                }
            }
            if(count($capas) > 1){//si hay + 2 capas con 'pos' filtrar solo la del municipio actual
                $array_layers = $capas;
                $capas = array();
                foreach($array_layers as $layer){     
                    if( strpos($layer->name,$municipio_down)  ){
                        $capas[] = $layer->name;
                    }
                }
            }            
            if(count($capas) == 1){//desde el servicio de rest de goserver, si encontró
                $parcelario_certif = $capas[0];
            }else{//desde el .env o base de datos        
                $parcelario_certif = $espacio_trabajo.":".$tabla;
            }
            //----------------EJES----------------------------
			$EJES_CALLES = DB::connection('mysql')->table('capas_cartografia')->select('nombre')->where("nombre_visible",'=','Ejes')->first();
            $capas_calle = array();
            foreach($array_layers_calle as $layer){     
                if( strpos($layer->name,$EJES_CALLES->nombre)  ){
                    $capas_calle[] = $layer->name;
                }
            }
            if(count($capas_calle) > 1){//si hay + 2 capas con 'pos' filtrar solo la del municipio actual
                $array_layers = $capas_calle;
                $capas_calle = array();
                foreach($array_layers as $layer){     
                    if( strpos($layer->name,$municipio_down)  ){
                        $capas_calle[] = $layer->name;
                    }
                }
            }
            if(count($capas_calle) == 1){//desde el servicio de rest de goserver, si encontró
                $ejes_calles = $capas_calle[0];
            }else{//desde el .env o base de datos
                $ejes_calles = $espacio_trabajo.":".$EJES_CALLES->nombre;
            }
            $estilos = env('STYLE_EJES').",".env('STYLE_PARCELAS').",".env('STYLE_PARCELAS_ROJAS');
            $zoom = 50;
            $bbox_extent->box_extent = str_replace("BOX(", "",$bbox_extent->box_extent);
            $bbox_extent->box_extent = str_replace(")", "",$bbox_extent->box_extent);
            $bbox_extent->box_extent = str_replace(" ", ",",$bbox_extent->box_extent);
            $bbox_extent->box_extent = explode(',',$bbox_extent->box_extent);
            $bbox_extent->box_extent[0] = $bbox_extent->box_extent[0] - $zoom;
            $bbox_extent->box_extent[1] = $bbox_extent->box_extent[1] - $zoom;
            $bbox_extent->box_extent[2] = $bbox_extent->box_extent[2] + $zoom;
            $bbox_extent->box_extent[3] = $bbox_extent->box_extent[3] + $zoom;
            $box = $bbox_extent->box_extent[0] . "," . $bbox_extent->box_extent[1] . "," . $bbox_extent->box_extent[2] . "," . $bbox_extent->box_extent[3];
            $nomencla20 = substr($parcela_nomenclatura,0,20);
            //SIN CAPA DE DIRECCIONES DEL RUD:
            $urlImg = $protocolo.$_SERVER['HTTP_HOST']."/geoserver/$espacio_trabajo/wms?";
            $urlImg .= "service=WMS&";
            $urlImg .= "version=1.1.1&";
            $urlImg .= "request=GetMap&";
            $urlImg .= "layers=$ejes_calles,$parcelario_certif,$parcelario_certif&";
            $urlImg .= "styles=$estilos&";
            $urlImg .= "bbox=$box&";
            $urlImg .= "width=875&";
            $urlImg .= "height=700&";
            $urlImg .= "srs=EPSG:22182&";
            $urlImg .= "format=image%2Fpng&";
            $urlImg .= "CQL_FILTER=municipio=%27$municipio%27;1=1;nomenc21+LIKE+%27$nomencla20%25%27";
            //dd($urlImg);
        }
        //#################### DATOS #################################
        $datos = [
            "emision"=>date("d/m/Y H:i"),
            "usuario"=>$this->CCGetUserNombre(),
            "parcela"=>$parcela,
            "listado_servicios"=>$listado_servicios,
            "mejoras"=>$mejoras,
            "titulares"=>$titulares,
            "direccion_real"=>$direccion_real,
            "direccion_postal"=>$direccion_postal,
            "parcela_f_alta"=>$parcela_f_alta,
            "parcela_f_proceso"=>$parcela_f_proceso,
            "parcela_plano_fecha"=>$parcela_plano_fecha,
            "urlImg"=>$urlImg
        ];
        //dd($datos);
        $pdf = \PDF::loadView('pdf.reporte',$datos);
        return $pdf->stream();
    }
}
