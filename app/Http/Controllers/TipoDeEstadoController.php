<?php

namespace App\Http\Controllers;

use App\TipoEstado;
use App\TipoDeEstado;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use DB;

class TipoDeEstadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Administrador');
    }

    public function index(Request $request)
    {    
        /*listar los roles en ventana modal*/
        $tipos_estados = TipoEstado::orderBy('tipo_parcela_estado_codigo','asc')->paginate(10);
        return view('codigos.tipo_de_estado.index',["tipos_estados"=>$tipos_estados]);       
    }

    public function store(Request $request)
    {
        $TipoEstado = new TipoEstado();
        $TipoEstado->tipo_parcela_estado_codigo = $request->tipo_parcela_estado_codigo;
        $TipoEstado->tipo_parcela_estado_descrip = $request->tipo_parcela_estado_descrip;
        $TipoEstado->tipo_parcela_estado_abrev = $request->tipo_parcela_estado_abrev;
        $TipoEstado->tipo_estado_id = $request->tipo_estado_id;
        $TipoEstado->save();      
        return Redirect::to("codigos/tipo_de_estado")->with("success","Agregado exitosamente");
    }

    public function update(Request $request)
    {
        $TipoEstado = TipoEstado::findOrFail($request->tipo_parcela_estado_id);
        $TipoEstado->tipo_parcela_estado_codigo = $request->tipo_parcela_estado_codigo;
        $TipoEstado->tipo_parcela_estado_descrip = $request->tipo_parcela_estado_descrip;
        $TipoEstado->tipo_parcela_estado_abrev = $request->tipo_parcela_estado_abrev;
        $TipoEstado->tipo_estado_id = $request->tipo_estado_id;
        $TipoEstado->save();
        return Redirect::to("codigos/tipo_de_estado")->with("success","Actualizado exitosamente");        
    }
}