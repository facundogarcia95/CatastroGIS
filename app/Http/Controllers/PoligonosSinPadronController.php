<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use DB;

class PoligonosSinPadronController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Administrador');
    }

    public function index(Request $request)
    {    
        /*listar los roles en ventana modal*/
        /*$tipos_estados = TipoEstado::orderBy('tipo_parcela_estado_codigo','asc')->paginate(10); */   
        return view('Administracion.poligonos_sin_padrones.index',[]);   
    }

    /*public function script_poligonos_sin_padrones(Request $request){

        return Response::json(
            array(
                "success" => true
            )
            ,200);
  
    }*/
}