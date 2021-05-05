<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Bloqueo;
use App\Mejora;
use App\MejoraConstruccion;
use App\MejoraUso;
use App\Parcela;
use App\Direccion;
use App\Persona;
use App\ParcelaDocumento;
use App\Seccion;
use App\TipoDocumentacion;
use App\TipoRegimen;
use App\TipoParcelaEstado;
use App\UnionDesglose;
use App\ParcelaServicio;
use App\PersonaParcela;
use App\TipoEstado;
use App\TipoMejora;
use App\TipoMejoraDestino;
use App\TipoServicio;
use App\TipoPersonaParcela;
use App\TipoCondicion;
use App\TipoInstrumento;
use App\TipoPersona;
use App\TipoDocumento;
use App\TipoPersonaJuridica;
use App\Paises;
use App\Http\Controllers\PersonasController as PersonasController;
use App\Observers\ParcelaAuditoria;
use App\ParcelaPos;
use App\TempUnionDesglose;
use App\TipoParcelaRyB;
use App\TipoTramite;
use App\Tramite;
use App\Http\Controllers\AvaluoController;

class ParcelaController extends Controller
{

    private $ubicacion_archivos = 'storage/archivos/parceladocs'; 

   public function __construct()
   {
       $this->middleware('auth');
        ini_set('memory_limit', -1);
   }


   public function index(Request $request){

    $order = $request->order ? $request->order : null;

    if($request->search){

        $query = Parcela::select('parcelas.*','tipos_parcelas_estados.tipo_parcela_estado_descrip as tipo_estado_parcela','tipos_parcelas_estados.tipo_parcela_estado_codigo as tipo_estado_codigo')
        ->leftJoin('tipos_parcelas_estados','tipos_parcelas_estados.tipo_parcela_estado_id','=','parcelas.tipo_parcela_estado_id')
        ->leftJoin('tipos_estados','tipos_estados.tipo_estado_id','=','parcelas.tipo_estado_id')
        ->leftJoin('personas_parcelas','personas_parcelas.parcela_id','=','parcelas.parcela_id')
        ->leftJoin('personas','personas.persona_id','=','personas_parcelas.persona_id');

        foreach($request->all() as $key => $value){
            if($value && $key != "search" && $key != "page"){
                if($key == "parcela_nomenclatura"){
                    $query->where($key,'LIKE','%'.$value.'%');
                }else{
                    if($key == "persona_denominacion"){
                        $query->where($key,'LIKE','%'.$value.'%');
                    }else{
                        $query->where($key,'=',$value);
                    }
                }
            }
        }

        if($request->persona_denominacion || $request->persona_cuit || $request->persona_nro_doc ){
            $query->where('personas_parcelas.tipo_estado_id','=',1);
        }

        $parcelas = $query->groupBy('parcelas.parcela_id');

        if($request->param && $order){
            $parcelas = $query->orderBy($request->param,$order)->paginate(10);
        }else{
            $parcelas = $query->orderBy('parcela_padron','DESC')->paginate(10);          
        }
        
    }else{

        $query = Parcela::select('parcelas.*','tipos_parcelas_estados.tipo_parcela_estado_descrip as tipo_estado_parcela','tipos_parcelas_estados.tipo_parcela_estado_codigo as tipo_estado_codigo')
        ->leftJoin('tipos_parcelas_estados','tipos_parcelas_estados.tipo_parcela_estado_id','=','parcelas.tipo_parcela_estado_id');
        $parcelas = $query->groupBy('parcelas.parcela_id');

        if($request->param){
            $parcelas = $query->orderBy($request->param,$order)->paginate(10);
        }else{
            $parcelas = $query->orderBy('parcela_padron','DESC')->paginate(10);
        }
    
    }

        $estadosParcela = TipoParcelaEstado::where('tipo_estado_id','=',1)->get();
        $rybparcela = TipoParcelaRyB::where('tipo_estado_id','=',1)->get();
        $siguientePadron = CorsController::ultimo_padron();
        
    return view("gestion.padron.index",
                                    [
                                        "parcelas" => $parcelas,
                                        "sorter" => $order,
                                        "estadosParcela" => $estadosParcela,
                                        "rybparcela"=>$rybparcela,
                                        "request" => $request->all(),
                                        "siguientePadron" => $siguientePadron
                                    ]);

   }

        public function show($id){

                $parcela = Parcela::findOrFail($id);
                
                ParcelaAuditoria::show($parcela);

                $bloqueado = Bloqueo::where('parcela_id','=',$id)->first();

                if(!$bloqueado && $parcela && Auth::user()->idrol != 3){

                    $bloqueo = new Bloqueo();
                    $bloqueo->parcela_id = $id;
                    $bloqueo->usuario_id = Auth::user()->usuario_id;
                    $bloqueo->descrip = 'Edicion de Padron';
                    $bloqueo->fecha = date("Y-m-d H:i:s");
                    $bloqueo->save();
                    Bloqueo::where('usuario_id','=',Auth::user()->usuario_id)->where('parcela_id','!=',$id)->delete();

                }else{

                    if(Auth::user()->idrol == 3){

                        $bloqueo_provisorio = new Bloqueo();
                        $bloqueo_provisorio->usuario_id = 0;
                        $bloqueo = $bloqueo_provisorio;

                    }else{

                        $bloqueo = $bloqueado;

                    }

                }

                $estadosParcela = TipoParcelaEstado::where('tipo_estado_id','=',1)->get();
                $listadoServicios = TipoServicio::where('tipo_estado_id','=',1)->get();

                if($parcela){

                    $mejoras = Mejora::select(
                        'mejoras.*',
                        'tipo_mejora_destino_descrip',
                        'tipo_mejora_destino_abrev',
                        'tipo_mejora_uso_descrip',
                        'tipo_mejora_abrev',
                        'tipo_mejora_categoria_descrip')
                    ->leftJoin('tipos_mejoras_destinos','mejoras.tipo_mejora_destino_id','=','tipos_mejoras_destinos.tipo_mejora_destino_id')
                    ->leftJoin('tipos_mejoras_usos','mejoras.tipo_mejora_uso_id','=','tipos_mejoras_usos.tipo_mejora_uso_id')
                    ->leftJoin('tipos_mejoras','mejoras.tipo_mejora_id','=','tipos_mejoras.tipo_mejora_id')
                    ->leftJoin('tipos_mejoras_categorias','mejoras.tipo_mejora_categoria_id','=','tipos_mejoras_categorias.tipo_mejora_categoria_id')
                    ->where("parcela_id","=",$id)
                    ->orderBy('mejora_f_pro','desc')
                    ->paginate(100);

                    $mejoraph = Mejora::select(
                        'mejoras.*',
                        'tipo_mejora_destino_descrip',
                        'tipo_mejora_destino_abrev',
                        'tipo_mejora_uso_descrip',
                        'tipo_mejora_abrev',
                        'tipo_mejora_categoria_descrip')
                    ->leftJoin('tipos_mejoras_destinos','mejoras.tipo_mejora_destino_id','=','tipos_mejoras_destinos.tipo_mejora_destino_id')
                    ->leftJoin('tipos_mejoras_usos','mejoras.tipo_mejora_uso_id','=','tipos_mejoras_usos.tipo_mejora_uso_id')
                    ->leftJoin('tipos_mejoras','mejoras.tipo_mejora_id','=','tipos_mejoras.tipo_mejora_id')
                    ->leftJoin('tipos_mejoras_categorias','mejoras.tipo_mejora_categoria_id','=','tipos_mejoras_categorias.tipo_mejora_categoria_id')
                    ->where("parcela_id","=",$id)->where('tipos_mejoras_categorias.tipo_mejora_categoria_id','=',10)
                    ->orderBy('tipos_mejoras_categorias.cubierta','desc')->first();
                    
                    $parceladocumentos = ParcelaDocumento::select(
                        'parcelas_documentos.*',
                        'seccion_descrip',
                        'tipo_doc_descrip',
                        'tipo_regimen_descrip',
                        'usuario_nombre')->leftJoin('secciones','parcelas_documentos.seccion_id','=','secciones.seccion_id')
                    ->leftJoin('tipos_documentacion','parcelas_documentos.tipo_doc_id','=','tipos_documentacion.tipo_doc_id')
                    ->leftJoin('tipos_regimenes','parcelas_documentos.tipo_regimen_id','=','tipos_regimenes.tipo_regimen_id')
                    ->leftJoin('usuarios','parcelas_documentos.usuario_id','=','usuarios.usuario_id')
                    ->where("parcela_id","=",$id)
                    ->where("parcelas_documentos.tipo_regimen_id","!=",3)
                    ->where("parcelas_documentos.tipo_estado","=",1)
                    ->orderBy('parcela_document_f_proc','desc')
                    ->paginate(100);

                    $documentosPlano = ParcelaDocumento::select( 'parcelas_documentos.*','seccion_descrip','usuario_nombre')
                    ->leftJoin('usuarios','parcelas_documentos.usuario_id','=','usuarios.usuario_id')
                    ->leftJoin('secciones','secciones.seccion_id','=','usuarios.idseccion')
                    ->where("parcela_id","=",$id)
                    ->where("tipo_regimen_id","=",3)
                    ->orderBy('parcela_document_f_proc','desc')->get();

                    $personas_parcelas = PersonaParcela::select(
                        'personas_parcelas.*',
                        'tipos_personas_parcelas.tipo_persona_parcela_descrip', 
                        'tipos_instrumentos.tipo_instrumento_descrip', 
                        'personas.persona_denominacion', 
                        'personas.persona_nro_doc', 
                        'personas.persona_cuit', 
                        'tipos_personas.tipo_persona_descrip', 
                        'tipos_estados.tipo_estado_descrip', 
                        'tipos_condiciones.tipo_condicion_descrip')
                        ->leftJoin('tipos_personas_parcelas','personas_parcelas.tipo_persona_parcela_id', '=', 'tipos_personas_parcelas.tipo_persona_parcela_id')
                        ->leftJoin('tipos_instrumentos','personas_parcelas.tipo_instrumento_id', '=', 'tipos_instrumentos.tipo_instrumento_id')
                        ->leftJoin('tipos_condiciones','personas_parcelas.tipo_condicion_id', '=', 'tipos_condiciones.tipo_condicion_id')
                        ->leftJoin('personas','personas_parcelas.persona_id', '=', 'personas.persona_id')
                        ->leftJoin('parcelas','personas_parcelas.parcela_id', '=', 'parcelas.parcela_id')
                        ->leftJoin('tipos_personas','personas.tipo_persona_id', '=', 'tipos_personas.tipo_persona_id')
                        ->leftJoin('tipos_estados','personas_parcelas.tipo_estado_id', '=', 'tipos_estados.tipo_estado_id')
                        ->where('personas_parcelas.parcela_id', '=', $id)
                        ->orderBy('personas.persona_denominacion','asc')
                        ->paginate(100);

                        $origen = UnionDesglose::select(
                            'uniones_desgloses.*',
                            'parcela_padron',
                            'wkt', 
                            'parcela_nomenclatura',
                            'tipo_parcela_estado_descrip',
                            'tipo_parcela_alta_desc',
                            'tipos_mejoras_categorias.*')
                            ->leftJoin('parcelas','uniones_desgloses.parcela_id', '=', 'parcelas.parcela_id')
                            ->leftJoin('tipos_parcelas_estados','parcelas.tipo_parcela_estado_id', '=', 'tipos_parcelas_estados.tipo_parcela_estado_id')
                            ->leftJoin('mejoras','mejoras.parcela_id', '=', 'parcelas.parcela_id')
                            ->leftJoin('tipos_parcelas_altas','tipos_parcelas_altas.tipo_parcela_alta_id', '=', 'parcelas.tipo_parcela_alta_id')
                            ->leftJoin('tipos_mejoras_categorias','tipos_mejoras_categorias.tipo_mejora_categoria_id', '=', 'mejoras.tipo_mejora_categoria_id')
                            ->where('uniones_desgloses.parcela_destino_id','=',$id)
                            ->groupBy('parcelas.parcela_id')
                            ->orderBy('tipos_mejoras_categorias.cubierta','desc')->get();

                        // ->orderBy('persona_id','asc')
                    
                        $destino = UnionDesglose::select(
                        'parcelas.parcela_id as parcela_dest_id',
                        'uniones_desgloses.*',
                        'parcela_padron', 
                        'parcela_nomenclatura',
                        'tipo_parcela_estado_descrip')
                        ->leftJoin('parcelas','uniones_desgloses.parcela_destino_id', '=', 'parcelas.parcela_id')
                        ->leftJoin('tipos_parcelas_estados','parcelas.tipo_parcela_estado_id', '=', 'tipos_parcelas_estados.tipo_parcela_estado_id')
                        ->where('.uniones_desgloses.parcela_id','=',$id)->get();

                    $tempUnionDesglose = TempUnionDesglose::find($id);
                    $direccion = $this->direccion($parcela->direccion_nomencla_rud_real);
                    $tipomejoras = TipoMejora::where('tipo_estado_id','=',1)->get();
                    $mejoraconstrucciones = MejoraConstruccion::get();
                    $tipomejoradestinos = TipoMejoraDestino::where('tipo_estado_id','=',1)->get();
                    $mejorausos = MejoraUso::get();
                    $secciones = Seccion::get();
                    $tipodocumentacion = TipoDocumentacion::get();
                    $tiporegimenes = TipoRegimen::get();
                    $tipoestados = TipoEstado::get();
                    $tipopersonaparcela = TipoPersonaParcela::where('tipo_estado_id','=',1)->get();
                    $tipocondicion = TipoCondicion::where('tipo_estado_id','=',1)->get();
                    $tipoinstrumento = TipoInstrumento::where('tipo_estado_id','=',1)->get();
                    $TipoPersona = TipoPersona::get();
                    $TipoDocumento = TipoDocumento::get();
                    $TipoPersonaJuridica  = TipoPersonaJuridica::get();
                    $Paises = Paises::get();
                    $idrol = $this->CCGetGroupID();//1: administrador;4: divisiongis
                    $request = new \Illuminate\Http\Request();
                    $request->replace(['persona_id' => NULL]);
                    $request->replace(['persona_cuit' => NULL]);
                    $modulo_personas = PersonasController::moduloPersonas($request);
                    $rybparcela = TipoParcelaRyB::where('tipo_estado_id','=',1)->get();
                    $tramites = Tramite::where('parcela_id','=',$id)->paginate(10);
                    $tiposTramites = TipoTramite::where('tipo_estado_id','=',1)->get();
                    $datos = [
                        "mejoras"=>$mejoras,
                        "tipomejoras"=>$tipomejoras,
                        "mejoraconstrucciones"=>$mejoraconstrucciones,
                        "tipomejoradestinos"=>$tipomejoradestinos,
                        "mejorausos"=>$mejorausos,
                        "tipoestados"=>$tipoestados,
                        "parceladocumentos"=>$parceladocumentos,
                        "secciones"=>$secciones,
                        "tipodocumentaciones"=>$tipodocumentacion,
                        "tiporegimenes"=>$tiporegimenes,
                        "parcela_id"=>$id,
                        "idrol"=>$idrol,
                        "parcela" => $parcela,
                        "documentosPlano"=> $documentosPlano, 
                        "estadosParcela" => $estadosParcela,
                        "rybparcela" =>$rybparcela,
                        "bloqueo" => $bloqueo,
                        "listadoServicios" => $listadoServicios,
                        "tipopersonaparcela" => $tipopersonaparcela,
                        "tipocondicion" => $tipocondicion,
                        "tipoinstrumento" => $tipoinstrumento,
                        "bloqueo" => $bloqueo,
                        "TipoPersona" => $TipoPersona,
                        "TipoDocumento" => $TipoDocumento,
                        "TipoPersonaJuridica" => $TipoPersonaJuridica ,
                        "Paises" => $Paises,
                        "busqueda"=>$request->buscarTexto??NULL,
                        "modulo_personas"=>$modulo_personas,
                        "personas_parcelas"=>$personas_parcelas,
                        "direccion_real"=>$direccion,
                        "origen"=>$origen,
                        "destino"=>$destino,
                        "mejoraph"=>$mejoraph,
                        "tempUnionDesglose"=>$tempUnionDesglose,
                        "tramites"=>$tramites,
                        "tiposTramites" =>$tiposTramites
                        ];

                    return view("gestion.padron.edit",$datos);

                }else{
                    return Redirect::to('gestion/padron');
                }

        }

        public function direccion($direccion_nomencla_rud_real){
            if($direccion_nomencla_rud_real){
                return DB::connection('mysql2')->table("vdirecciones")->where('direccion_nomencla','=',$direccion_nomencla_rud_real)->first();
            }else{
                return '';
            }
        }

    /*================
        OBTENER LOS PADRONES PADRES A PARTIR DE LA PARCELA
    =================== */
        public function parcelas_origen($parcela_id){

            $respuesta = UnionDesglose::where('parcela_destino_id','=',$parcela_id)->get();

            return $respuesta;

        }

    /*================
        OBTENER LOS PADRONES PADRES A PARTIR DE LA PARCELA
    =================== */
        public function titulares($parcela_id){

            $parcela = Parcela::find($parcela_id);
            
            ($parcela)? $respuesta = $parcela->personas(): $respuesta = null;

            return $respuesta;
            
        }


        public function autocompleatar_titulares(){
            
        $titulares = Persona::select('persona_denominacion as value','persona_id')->where('tipo_estado_id','=',1)
        ->where('persona_denominacion','!=',"")
        ->where('persona_denominacion','!=',null)->get();
        

            return Response::json(
                array(
                    "success" => true,
                    "titulares" => $titulares
                )
                ,200);
        }

        /*============================
        OBTENER LISTADO DE PARCELAS
        ==============================*/

        public function listadoNomenclaturasOrigen(Request $request){
             
            $parcelas = Parcela::select('parcela_nomenclatura as value','parcela_id','parcela_padron','tipo_estado_descrip','tipo_parcela_ryb_descrip','parcela_nomenclatura')
            ->leftJoin('tipos_estados','tipos_estados.tipo_estado_id','=','parcelas.tipo_estado_id')
            ->leftJoin('tipos_parcelas_ryb','tipos_parcelas_ryb.tipo_parcela_ryb_id','=','parcelas.tipo_parcela_ryb_id')
            ->where('parcelas.parcela_subparcela',"!=","0000")
            ->get();

            return Response::json(
                array(
                    "success" => true,
                    "parcelas" => $parcelas
                )
                ,200);

        }

        public function listadoPadronesOrigen(Request $request){
             
            $parcelas = Parcela::select('parcela_padron as value','parcela_id','parcela_padron','tipo_estado_descrip','tipo_parcela_ryb_descrip','parcela_nomenclatura')
            ->leftJoin('tipos_estados','tipos_estados.tipo_estado_id','=','parcelas.tipo_estado_id')
            ->leftJoin('tipos_parcelas_ryb','tipos_parcelas_ryb.tipo_parcela_ryb_id','=','parcelas.tipo_parcela_ryb_id')
            ->where('parcelas.parcela_subparcela',"!=","0000")
            ->get();

            return Response::json(
                array(
                    "success" => true,
                    "parcelas" => $parcelas
                )
                ,200);

        }

        public function listadoNomenclaturasDestino(Request $request){
             
            $parcelas = Parcela::select('parcela_nomenclatura as value','parcela_id','parcela_padron','tipo_estado_descrip','tipo_parcela_ryb_descrip','parcela_nomenclatura')
            ->leftJoin('tipos_estados','tipos_estados.tipo_estado_id','=','parcelas.tipo_estado_id')
            ->leftJoin('tipos_parcelas_ryb','tipos_parcelas_ryb.tipo_parcela_ryb_id','=','parcelas.tipo_parcela_ryb_id')
            ->get();

            return Response::json(
                array(
                    "success" => true,
                    "parcelas" => $parcelas
                )
                ,200);

        }


        public function listadoPadronesDestino(Request $request){
             
            $parcelas = Parcela::select('parcela_padron as value','parcela_id','parcela_padron','tipo_estado_descrip','tipo_parcela_ryb_descrip','parcela_nomenclatura')
            ->leftJoin('tipos_estados','tipos_estados.tipo_estado_id','=','parcelas.tipo_estado_id')
            ->leftJoin('tipos_parcelas_ryb','tipos_parcelas_ryb.tipo_parcela_ryb_id','=','parcelas.tipo_parcela_ryb_id')
            ->get();

            return Response::json(
                array(
                    "success" => true,
                    "parcelas" => $parcelas
                )
                ,200);

        }

        /*================
        OBTENER LA PARCELA A PARTIR DEL PADRON 
        =================== */

        public function get_parcela(Request $request){

                    $parcela = Parcela::where($request->parametro,'like','%'.substr($request->valor,0,20).'%')->first();
                    
                    if($parcela){
                        $parcela->geom = null;


                        return Response::json(
                            array(
                                "success" => true,
                                "mensaje" => "Servicion web exitoso",
                                "parcela" => $parcela
                            )
                            ,200);

                    }else{

                        return Response::json(
                            array(
                                "success" => false,
                                "mensaje" => "Parcela no encontrada",
                                "parcela" => null
                            )
                            ,200);

                    }

        }

        public function get_titulares(Request $request){
                
                $personas = Persona::select(DB::raw('persona_id as id, persona_denominacion as value, persona_cuit, persona_nro_doc'))->where('personas.tipo_estado_id','=',1)
                ->get();
            
                return Response::json(
                    array(
                        "mensaje" => "Listado de personas",
                        "personas" => $personas
                    )
                    ,200);

        }

        public function get_personas_parcelas(Request $request){

                try{
                    $parcelas = Persona::select('parcelas.*','tipos_personas_parcelas.*')->join('personas_parcelas','personas.persona_id','=','personas_parcelas.persona_id')
                    ->join('parcelas','personas_parcelas.parcela_id','=','parcelas.parcela_id')
                    ->leftJoin('tipos_personas_parcelas','personas_parcelas.tipo_persona_parcela_id','=','tipos_personas_parcelas.tipo_persona_parcela_id')
                    ->where('personas.persona_denominacion','LIKE', '%'.$request->persona.'%')->get();

                    
                    return Response::json(
                        array(
                            "mensaje" => "Listado de parcelas por persona",
                            "parcelas" => $parcelas
                        )
                        ,200);

                }catch(Exception $e){

                    return Response::json(
                        array(
                            "mensaje" => "Persona no encontrada",
                            "parcelas" => []

                        )
                        ,200);

                }

        }

        public function get_titular($parcela_id){

            $respuesta = Persona::join('personas_parcelas','personas_parcelas.persona_id','=','personas.persona_id')
            ->where('personas_parcelas.tipo_estado_id','=',1)
            ->where('personas_parcelas.parcela_id','=',$parcela_id)
            ->first();

            return $respuesta;

        }
    
    /*================
       ACTUALIZAR SERVICIOS
    =================== */
        public function servicios(Request $request){
            if(Auth::user()->idrol == 1 || Auth::user()->idrol == 4 || Auth::user()->idrol == 2){
                $parcela = Parcela::find($request->parcela_id);
                session(['redirectElement' => 'collapseServicios']);
                if($parcela){
                    $bloqueo = Bloqueo::where('parcela_id','=',$request->parcela_id)->first();
                    if($bloqueo && $bloqueo->usuario_id != Auth::user()->usuario_id){
                        return back()->with('error','Padrón bloqueado por '.$bloqueo->user->usuario_nombre);
                    }                    
                    $ParcelaServicio = ParcelaServicio::where("parcela_id","=",$request->parcela_id)->update(['estado_id' => 0]);                
                    if($ParcelaServicio){                
                        foreach($request->servicios as $servicio_id){                    
                            $serv = ParcelaServicio::where('parcela_id','=',$request->parcela_id)->where('servicio_id','=',$servicio_id)->first();                        
                            if($serv){
                                $serv->parcela_servicio_f_proce = date("Y-m-d H:i:s");
                                $serv->usuario_id = Auth::user()->usuario_id;
                                $serv->estado_id = 1;
                                $serv->save();

                            }else{
                                $serv = new ParcelaServicio();
                                $serv->parcela_id = $request->parcela_id;
                                $serv->servicio_id = $servicio_id;
                                $serv->parcela_servicio_f_proce = date("Y-m-d H:i:s");
                                $serv->usuario_id = Auth::user()->usuario_id;
                                $serv->estado_id = 1;
                                $serv->save();
                            }
                        }
                        $parcela->usuario_id = Auth::user()->usuario_id;
                        $parcela->parcela_f_proceso = date("Y-m-d H:i:s");
                        $parcela->save();
                        $this->calcular_avaluo($request->parcela_id);
                        return back()->with('success','Servicios actualizados exitosamente');
                    }else{
                        return back()->with('error','No se encontraron servicios para asociar');
                    }
                }else{
                    return back()->with('error','Parcela no encontrada. Linea: '.__LINE__);
                }
            }
            return back()->with('error','No se pudieron actualizar los servicios');
        }

    /*================
       ACTUALIZAR PLANO
    =================== */
        public function plano(Request $request){
            if(Auth::user()->idrol == 1 || Auth::user()->idrol == 4 || Auth::user()->idrol == 2){
                $parcela = Parcela::find($request->parcela_id);            
                session(['redirectElement' => 'collapsePlano']);            
                if($parcela){
                    $bloqueo = Bloqueo::where('parcela_id','=',$request->parcela_id)->first();
                    if($bloqueo && $bloqueo->usuario_id != Auth::user()->usuario_id){
                        return back()->with('error','Padrón bloqueado por '.$bloqueo->user->usuario_nombre);
                    }
                    
                    $datos = $request->all();
                    $datos["usuario_id"] = Auth::user()->usuario_id;
                    $datos["parcela_f_proceso"] = date("Y-m-d H:i:s");  
                    $parcela->update($datos);
                    $this->calcular_avaluo($parcela->parcela_id);
                    
                    if($request->hasFile('documento_plano')){
                        $extension = $request->file('documento_plano')->guessClientExtension();
                        if($extension == "jpg" || $extension == "png" || $extension == "jpeg"){
                            $tipo=1;
                        }else if($extension == "cad" || $extension == "dwg" || $extension == "dxf"){
                            $tipo=2;
                        }else if($extension == "txt"){
                            $tipo=3;
                        }else if($extension == "pdf"){
                            $tipo=4;
                        }else{
                            $tipo=5;
                        }                    
                        $ParcelaDocumento = new ParcelaDocumento();
                        $ParcelaDocumento->parcela_id = $parcela->parcela_id;
                        $ParcelaDocumento->seccion_id = Auth::user()->seccion_id;
                        $ParcelaDocumento->usuario_id = Auth::user()->usuario_id;
                        $ParcelaDocumento->tipo_regimen_id = 3;
                        $ParcelaDocumento->tipo_doc_id = $tipo;
                        $ParcelaDocumento->parcela_document_origen = 'Documento del Plano';
                        $ParcelaDocumento->parcela_document_f_origen = date("Y-m-d H:i:s");
                        $ParcelaDocumento->parcela_document_expediente = $parcela->parcela_expediente;
                        $file = $request->file('documento_plano');
                        $nombre_real = $file->getClientOriginalName();//nombre completo con la extensión
                        $nombre_alternativo = str_replace(" ","_",$nombre_real);
                        $nombre_alternativo = Auth::user()->usuario_id."___".$nombre_alternativo;
                        $path = public_path($this->ubicacion_archivos)."/". $parcela->parcela_padron;
                        if(!File::exists($path)) {//existe el directorio del padron?
                                File::makeDirectory($path);//sino existe crear directorio
                        }
                        $parcela_document_archivo = "/".$parcela->parcela_padron."/".$nombre_alternativo;               
                        Storage::disk('parceladocs')->putFileAs($parcela->parcela_padron,$file,$nombre_alternativo);
                        $ParcelaDocumento->parcela_document_archivo = $parcela_document_archivo;
                        $ParcelaDocumento->parcela_document_original = $nombre_real;
                        $ParcelaDocumento->parcela_document_f_proc = date("Y-m-d H:i:s");
                        $ParcelaDocumento->save();                        
                        return back()->with('success','Datos del Plano actualizados exitosamente');
                    }
                    return back()->with('error','No se pudieron actualizar los datos del Plano');
                }
            }else{
                return back()->with('error','No tiene autorizacion para modificar datos');
            }            
        }

     /*================
       ACTUALIZAR DATOS GENERALES
    =================== */
        public function actualizardatosGenerales(Request $request){
            
            session(['redirectElement' => null]);

            if(Auth::user()->idrol == 2){

                $parcela = Parcela::find($request->parcela_id)->first();
                
                $bloqueo = Bloqueo::where('parcela_id','=',$request->parcela_id)->first();

                if($bloqueo && $bloqueo->usuario_id != Auth::user()->usuario_id){

                    return back()->with('error','Padrón bloqueado por '.$bloqueo->user->usuario_nombre);
                }
                    

            }
            
            if(Auth::user()->idrol == 1 || Auth::user()->idrol == 2 || Auth::user()->idrol == 4){

                $elementosNomencla = explode("-", $request->parcela_nomenclatura);
                $request["parcela_nomenclatura"]  = str_replace("-","",$request->parcela_nomenclatura);
                $request["parcela_nomenclatura"]  = str_replace("_","",$request->parcela_nomenclatura);
                $request["parcela_nomenclatura"]  = str_replace("__","",$request->parcela_nomenclatura);

                if(strlen($request["parcela_nomenclatura"])<21){
                    return back()->with('error','La nomenclatura '.$request->parcela_nomenclatura.' contiene menos de 21 dígitos.');
                }
        
                $parcelaPadron = Parcela::where('parcela_padron_terr','=',$request->parcela_padron_terr)->first();
                $parcelaNomenclatura = Parcela::where('parcela_nomenclatura','=',$request["parcela_nomenclatura"])->first();
                
                $parcela = Parcela::find($request->parcela_id);

                if($parcelaPadron){
                    if($parcelaPadron->parcela_id != $parcela->parcela_id && $request->parcela_padron_terr != 0 && $request->parcela_padron_terr != $parcela->parcela_padron_terr ){
                        return back()->with('error','El padrón provincial '.$request->parcela_padron_terr.' ya está siendo usado.');
                    }
                }
                
                if($parcelaNomenclatura){
                    if($parcelaNomenclatura->parcela_id != $parcela->parcela_id){
                        return back()->with('error','La Nomenclatura '.$request->parcela_nomenclatura.' ya está siendo usada.');
                    }
                }



                if($parcela){

                    if(substr($parcela->parcela_nomenclatura,0,20) != substr($request["parcela_nomenclatura"],0,20)){
                        
                        if($request["parcela_subparcela"] == "0000"){
                            
                            $cantidad = ParcelaPos::where('nomenc21','LIKE','%'.substr($request["parcela_nomenclatura"],0,16)."%")->count();
                            if($cantidad == 0){
                                ParcelaPos::where('nomenc21','LIKE','%'.substr($parcela->parcela_nomenclatura,0,16)."%")->update(["nomenc21" => $request["parcela_nomenclatura"]]);
                            }else{
                                return back()->with('error','Ya existe un polígono con la nomenclatura '.$request["parcela_nomenclatura"]);
                            }
                            
                        }

                    }

                    if($request->tipo_nomenclatura !=3){
                        $request["parcela_dependencia"]= env('FIJO_DEPARTAMENTO');
                        $request["parcela_distrito"]= $elementosNomencla[1];
                        $request["parcela_seccion"]= $elementosNomencla[2];
                        $request["parcela_manzana"]= $elementosNomencla[3];
                        $request["parcela_parcela"]= $elementosNomencla[4];
                        $request["parcela_subparcela"]= $elementosNomencla[5];
                        $request["parcela_dig_veri"]= $elementosNomencla[6];    
                    }else{
                        $request["parcela_dependencia"]= env('FIJO_DEPARTAMENTO');
                        $request["parcela_x"] = $elementosNomencla[1];
                        $request["parcela_y"] = $elementosNomencla[2];
                        $request["parcela_subparcela"]= $elementosNomencla[3];
                        $request["parcela_dig_veri"]= $elementosNomencla[4];  
                    }

                    $request["usuario_id"] = Auth::user()->usuario_id;
                    $request["parcela_f_proceso"] = date("Y-m-d H:i:s");
                    $request["produccion"] = 1;
                    $parcela->update($request->all());

                    return back()->with('success','Datos Generales actualizados exitosamente');
                }
        
            }
            
            return back()->with('error','No se pudieron actualizar los Datos Generales');
            

        }

    
        /*======================
        ALTA PURA DE PADRÓN
        ======================= */

        public function altapura(Request $request){

            //dd($request->all());

            session(['redirectElement' => null]);

            if(Auth::user()->idrol == 1 || Auth::user()->idrol == 4){

                
                $elementosNomencla = explode("-", $request->parcela_nomenclatura);
                $request["parcela_nomenclatura"]  = str_replace("-","",$request->parcela_nomenclatura);
                $request["parcela_nomenclatura"]  = str_replace("_","",$request->parcela_nomenclatura);
                $request["parcela_nomenclatura"]  = str_replace("__","",$request->parcela_nomenclatura);
                
                if(strlen($request["parcela_nomenclatura"])<20){
                    return back()->with('error','La nomenclatura '.$request->parcela_nomenclatura.' contiene menos de 20 dígitos');
                }
                
                $parcelaNomenclatura = Parcela::where('parcela_nomenclatura','=',$request["parcela_nomenclatura"])->first();
                
                if($parcelaNomenclatura){
                    return back()->with('error','La Nomenclatura '.$request->parcela_nomenclatura.' ya está siendo usada');
                }

                if($request->tipo_nomenclatura !=3){

                    $request["parcela_dependencia"]= env('FIJO_DEPARTAMENTO');
                    $request["parcela_distrito"]= $elementosNomencla[1];
                    $request["parcela_seccion"]= $elementosNomencla[2];
                    $request["parcela_manzana"]= $elementosNomencla[3];
                    $request["parcela_parcela"]= $elementosNomencla[4];
                    $request["parcela_subparcela"]= $elementosNomencla[5];
                    $request["parcela_dig_veri"]= $elementosNomencla[6]; 

                }else{
                    $request["parcela_dependencia"]= env('FIJO_DEPARTAMENTO');
                    $request["parcela_x"] = $elementosNomencla[1];
                    $request["parcela_y"] = $elementosNomencla[2];
                    $request["parcela_subparcela"]= $elementosNomencla[3];
                    $request["parcela_dig_veri"]= $elementosNomencla[4]; 
                }

                $ultimoPadron = CorsController::ultimo_padron();
                $datos = $request->all();
                $datos["parcela_padron"] = $ultimoPadron;
                $datos["tipo_parcela_estado_id"] = $request->tipo_parcela_estado_id;
                $datos["tipo_parcela_ryb_id"] = $request->tipo_parcela_ryb_id;
                $datos["usuario_id"] = Auth::user()->usuario_id;
                $datos["parcela_f_proceso"] = date("Y-m-d H:i:s");
                $datos["produccion"] = 1;

                if($datos["parcela_subparcela"] != "0000"){

                    $parcelaOrigen = Parcela::where('parcela_nomenclatura','LIKE','%'.substr($datos["parcela_nomenclatura"],0,16).'%')
                    ->where('parcela_subparcela','=','0000')->first();

                    if($parcelaOrigen){

                        
                        $mejoraph = Mejora::leftJoin('tipos_mejoras_destinos','mejoras.tipo_mejora_destino_id','=','tipos_mejoras_destinos.tipo_mejora_destino_id')
                        ->leftJoin('tipos_mejoras_categorias','mejoras.tipo_mejora_categoria_id','=','tipos_mejoras_categorias.tipo_mejora_categoria_id')
                        ->where("parcela_id","=",$parcelaOrigen->parcela_id)->where('tipos_mejoras_categorias.tipo_mejora_categoria_id','=',10)
                        ->orderBy('tipos_mejoras_categorias.cubierta','desc')->first();
                    
                        if(!$mejoraph){

                            return back()->with('error-ph',true)->withInput();

                        }
                        
                        $parcela = Parcela::create($datos);

                        $unionDesglose = new UnionDesglose();
                        $unionDesglose->parcela_id = $parcelaOrigen->parcela_id;
                        $unionDesglose->parcela_destino_id = $parcela->parcela_id;
                        $unionDesglose->tipo_union_desglose_id = 2;
                        $unionDesglose->union_desglose_fecha = date("Y-m-d H:i:s");
                        $unionDesglose->usuarios_id = Auth::user()->usuario_id;
                        $unionDesglose->save();

                    }else{

                        return back()->with('error','No se encontró la matriz de la PH. Verifique su existencia.');

                    }

                }else{

                    $parcela = Parcela::create($datos);

                }

                

                return Redirect::to('gestion/padron/'.$parcela->parcela_id)->with('success','Padrón generado exitosamente');

            }else{
                return back()->with('error','No posee permisos de administrador');
            }

        }


          /*================
        OBTENER LOS SERVICIOS DE LA PARCELA
        =================== */

        public function get_servicios($id){
            $parcela = Parcela::where('parcela_id','=',$id)->first();
            if($parcela){
                return ParcelaServicio::where('parcela_id','=',$parcela->parcela_id)->get();
            }else{
                return null;
            }

        }

       
        public function cambiarDireccion(Request $request){
            
            $direccion = Direccion::find($request->direccion_id);
            $parcela = Parcela::find($request->parcela_id)->update(['direccion_nomencla_rud_real' => $direccion->direccion_nomencla]);
            session(['redirectElement' => 'collapseDireccion']);

            return Redirect::to('gestion/padron/'.$request->parcela_id)->with('success','Dirección asociada exitosamente');

        } 


        public function asociarMatrizPH(Request $request){
            

            $matriz = substr($request->nomenclatura,0,16)."0000";
            $parcela = Parcela::where('parcela_nomenclatura','LIKE','%'.$matriz.'%')->first();

            if($parcela){

                $unionDesglose = new UnionDesglose();
                $unionDesglose->parcela_id = $parcela->parcela_id;
                $unionDesglose->parcela_destino_id = $request->destino;
                $unionDesglose->tipo_union_desglose_id = 2;
                $unionDesglose->union_desglose_fecha = date("Y-m-d H:i:s");
                $unionDesglose->usuarios_id = Auth::user()->usuario_id;
                $unionDesglose->save();

                if($unionDesglose){
                    return Response::json(
                        array(
                            "success" => true
                        )
                        ,200);
                }
                
            }
           
            return Response::json(
                array(
                    "success" => false
                )
                ,200);
        }

        private function calcular_avaluo($parcela_id){
            if($parcela_id){            
                $AvaluoController = new AvaluoController();
                $AvaluoController->precarga_avaluo($parcela_id);
                $output = json_decode($AvaluoController->avaluo_js(0), true);
                $parcela = Parcela::where('parcela_id','=',$parcela_id)->first();
                $parcela->parcela_avaluo = floatval($output["calculadoa"]);
                $parcela->parcela_avaluo_utm = $output["calculadob"];
                $parcela->parcela_avaluo_imp = $output["calculado"];
                $parcela->save();
                return true;
            }else{
                return false;
            }
        }
}