<?php

namespace App\Http\Controllers;

use App\PersonaParcela;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use PhpParser\Node\Stmt\TryCatch;

class PersonaParcelaController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Operador');
    }

    public function index(Request $request)
    {        
        return view('gestion.padron.dominio.index',[]);
    }

    public function store(Request $request)
    {
        $persona_parcela = PersonaParcela::where("persona_id","=",$request->persona_id)->where("parcela_id","=",$request->parcela_id)->first();
        if($persona_parcela){
            return back()->with("error","El titular ya se encuentra vinculado a esta parcela");
        }else{
            unset($request['_token']);
            $persona_parcela = new PersonaParcela;        
            $persona_parcela->insert($request->all()); 
            $persona_parcela->save();
        /* $persona_parcela = new PersonaParcela();
            $persona_parcela->persona_id = $request->persona_id;
            $persona_parcela->save();*/
            return back()->with("success","Titular agregado exitosamente");
        }
    }
    
    public function update(Request $request)
    {
        try{
            // Paso todos los titulares a no principal
            $persona_parcelas = DB::table('personas_parcelas')->where("parcela_id","=",$request->parcela_id)->where('persona_parcela_id','!=',$request->persona_parcela_id)->update(['persona_parcela_ppal' => 0]); 

    
            // Actualizo
            $persona_parcela = PersonaParcela::where('persona_parcela_id','=',$request->persona_parcela_id)->first();
            $request["usuario_id"] = Auth::user()->usuario_id;


            $persona_parcela->parcela_id = $request->parcela_id;
            $persona_parcela->persona_id = $request->persona_id;
            $persona_parcela->tipo_persona_parcela_id = $request->tipo_persona_parcela_id;
            $persona_parcela->persona_parcela_ppal = $request->persona_parcela_ppal;
            $persona_parcela->persona_parcela_origen = $request->persona_parcela_origen;
            $persona_parcela->tipo_instrumento_id = $request->tipo_instrumento_id;
            $persona_parcela->tipo_condicion_id = $request->tipo_condicion_id;
            $persona_parcela->persona_parcela_dominio = $request->persona_parcela_dominio;
            $persona_parcela->persona_parcela_num_int = $request->persona_parcela_num_int;
            $persona_parcela->persona_parcela_f_int = $request->persona_parcela_f_int;
            $persona_parcela->tipo_estado_id = $request->tipo_estado_id;
            $persona_parcela->usuario_id = Auth::user()->usuario_id;
            $persona_parcela->save();  

            return back()->with("success","Titular actualizado exitosamente");
        }
        catch(Exception $e){
            return back()->with("error", $e);
        }
    }

}
