<?php

namespace App\Http\Controllers;

use App\Persona;
use App\TipoPersona;
use App\TipoDocumento;
use App\TipoPersonaJuridica;
use App\Paises;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;

class PersonasController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Operador');
        ini_set('memory_limit', -1);
        set_time_limit(-1);
    }

    public static function moduloPersonas(Request $request){
      
        $personas = Persona::select(
            'personas.*',
            'tipo_persona_descrip', 
            'pais_nombre')
            ->leftJoin('tipos_personas','personas.tipo_persona_id', '=', 'tipos_personas.tipo_persona_id')
            ->leftJoin('paises','personas.pais_id', '=', 'paises.pais_id')
            ->orderBy('persona_id','asc');

            if($request){
            /* Si viene persona_id por parametro */
                $persona_id = $request->persona_id; //por parametro
                if($persona_id){
                    $persona = Persona::where('persona_id','=', $persona_id)->first();
                    if($persona){
                        $personas->where('persona_id','=', $persona_id); 
                    } 
                }

                /* Si viene persona_cuit por parametro */
                $persona_cuit = $request->persona_cuit; //por parametro
                if($persona_cuit){
                    $persona = Persona::where('persona_cuit','=', $persona_cuit)->first();
                    if($persona){
                        $personas->where('persona_cuit','=', $persona_cuit); 
                    } 
                }
                
                if($request->buscarTexto){
                    $personas->where('persona_id','=', $request->buscarTexto); 
                    $personas->orWhere('persona_denominacion','LIKE', "%" . $request->buscarTexto . "%"); 
                    $personas->orWhere('persona_cuit','LIKE', "%" . $request->buscarTexto . "%"); 
                    if(is_numeric($request->buscarTexto) ){
                        $personas->orWhere('persona_nro_doc','=', $request->buscarTexto); 
                    }
                }

            }

            $personas = $personas->paginate(10);
            return $personas;
            //dd($personas);
    }

    public function index(Request $request)
    {
        //
            $personas = $this->moduloPersonas($request);

            $TipoPersona = TipoPersona::get();
            $TipoPersonaJuridica = TipoPersonaJuridica::get();
            $TipoDocumento = TipoDocumento::where('tipo_estado_id','=',1)->get();
            $Paises = Paises::get();

            return view('gestion.personas.index',["modulo_personas"=>$personas, "TipoPersona"=>$TipoPersona, "TipoPersonaJuridica"=>$TipoPersonaJuridica, "TipoDocumento"=>$TipoDocumento, "Paises"=>$Paises, "busqueda"=>$request->buscarTexto??NULL]);
    }


    public function store(Request $request)
    {
        $personas = new Persona();

        $personas->tipo_persona_id = $request->tipo_persona_id;
        $personas->tipo_persona_juridica_id = $request->tipo_persona_juridica_id;
        $personas->persona_denominacion = $request->persona_denominacion;
        $personas->persona_cuit = $request->persona_cuit;
        $personas->persona_es_cuit = $request->persona_es_cuit;
        $personas->tipo_documento_id = $request->tipo_documento_id;
        $personas->persona_nro_doc = $request->persona_nro_doc;
        $personas->persona_nombre = $request->persona_nombre;
        $personas->persona_apellido = $request->persona_apellido;
        $personas->persona_fecha_nac = $request->persona_fecha_nac;
        $personas->pais_id = $request->pais_id;
        $personas->persona_sexo = $request->persona_sexo;
        $personas->persona_fallecida = $request->persona_fallecida;
        $personas->persona_email = $request->persona_email;
        $personas->persona_conyuge = $request->persona_conyuge;
        $personas->tipo_estado_id = 1;   
        $personas->save();   

        return back()->with("success","Agregado exitosamente");
        
    }
    
    public function update(Request $request)
    {
        $personas= Persona::findOrFail($request->persona_id);
        $personas->tipo_persona_id = $request->tipo_persona_id;
        $personas->tipo_persona_juridica_id = $request->tipo_persona_juridica_id;
        $personas->persona_denominacion = $request->persona_denominacion;
        $personas->persona_cuit = $request->persona_cuit;
        $personas->persona_es_cuit = $request->persona_es_cuit;
        $personas->tipo_documento_id = $request->tipo_documento_id;
        $personas->persona_nro_doc = $request->persona_nro_doc;
        $personas->persona_nombre = $request->persona_nombre;
        $personas->persona_apellido = $request->persona_apellido;
        $personas->persona_fecha_nac = $request->persona_fecha_nac;
        $personas->pais_id = $request->pais_id;
        $personas->persona_sexo = $request->persona_sexo;
        $personas->persona_fallecida = $request->persona_fallecida;
        $personas->persona_email = $request->persona_email;
        $personas->persona_conyuge = $request->persona_conyuge;
        $personas->save();  
        return Redirect::to("gestion/personas")->with("success","Actualizado exitosamente");
        
    }

    public function consultarCuit(Request $request){
        $cuit = Persona::where("persona_cuit","=",$request->cuit)->first();
        $t = false;
        if($cuit){
            $t = true;
        }
        return Response::json(
            array(
                "existe" => $t
            )
            ,200);
    }

    

    public function iframe(Request $request){

        if(!isset($request)){
            $request = new \Illuminate\Http\Request();
            $request->replace(['persona_cuit' => NULL]);
            $request->replace(['persona_id' => NULL]);
        }

        $personas = $this->moduloPersonas($request);
        $TipoPersona = TipoPersona::get();
        $TipoPersonaJuridica = TipoPersonaJuridica::get();
        $TipoDocumento = TipoDocumento::get();
        $Paises = Paises::get();

        return view('gestion.personas.grillaPersonas',["modulo_personas"=>$personas, "TipoPersona"=>$TipoPersona, "TipoPersonaJuridica"=>$TipoPersonaJuridica, "TipoDocumento"=>$TipoDocumento, "Paises"=>$Paises, "busqueda"=>$request->buscarTexto??NULL]);
    }

}







