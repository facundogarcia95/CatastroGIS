<?php

namespace App\Http\Controllers;

use App\TipoBonificacion;
use App\TipoEstado;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use DB;
use Yajra\DataTables\Facades\DataTables;

class TipoDeBonificacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Administrador');
    }

    public function index(Request $request)
    {    

        
        $estados = TipoEstado::get();

        /*listar los roles en ventana modal*/
        $tipos_bonificaciones = TipoBonificacion::orderBy('tipo_bonificacion_codigo','asc')->paginate(10);
        return view('codigos.tipo_de_bonificacion.index',["tipos_bonificaciones"=>$tipos_bonificaciones, "estados" => $estados]);       
    }

    public function store(Request $request)
    {
        $TipoBonificacion = new TipoBonificacion();
        $TipoBonificacion->tipo_bonificacion_codigo = $request->tipo_bonificacion_codigo;
        $TipoBonificacion->tipo_bonificacion_descrip = $request->tipo_bonificacion_descrip;
        $TipoBonificacion->tipo_bonificacion_porc = $request->tipo_bonificacion_porc;
        $TipoBonificacion->tipo_estado_id = $request->tipo_estado_id;
        $TipoBonificacion->save();      
        return Redirect::to("codigos/tipo_de_bonificacion")->with("success","Agregado exitosamente");
    }

    public function update(Request $request)
    {
        $TipoBonificacion = TipoBonificacion::findOrFail($request->tipo_bonificacion_id);
        $TipoBonificacion->tipo_bonificacion_codigo = $request->tipo_bonificacion_codigo;
        $TipoBonificacion->tipo_bonificacion_descrip = $request->tipo_bonificacion_descrip;
        $TipoBonificacion->tipo_bonificacion_porc = $request->tipo_bonificacion_porc;
        $TipoBonificacion->tipo_estado_id = $request->tipo_estado_id;
        $TipoBonificacion->save();
        return Redirect::to("codigos/tipo_de_bonificacion")->with("success","Actualizado exitosamente");        
    }

    public function datatable(Request $request){



        $tipos_bonificaciones = TipoBonificacion::orderBy('tipo_bonificacion_descrip','asc')->get(); 
        //dd($tipos_bonificaciones);
       return  DataTables::of($tipos_bonificaciones)
       ->editColumn('accion', function(TipoBonificacion $tipo_bonificacion) {



           return '      <button type="button" class="btn btn-warning rounded text-light btn-sm" 
                            data-tipo_bonificacion_id="'.$tipo_bonificacion->tipo_bonificacion_id.'" 
                            data-tipo_bonificacion_descrip="'.$tipo_bonificacion->tipo_bonificacion_descrip.'" 
                            data-tipo_bonificacion_codigo="'.$tipo_bonificacion->tipo_bonificacion_codigo.'"  
                            data-tipo_bonificacion_porc="'.$tipo_bonificacion->tipo_bonificacion_porc.'"  
                            data-tipo_estado_id="'.$tipo_bonificacion->tipo_estado_id.'"  
                            data-toggle="modal" data-target="#editarTipoBonificacion">
                                <i class="fa fa-edit fa-2x"></i> Editar
                         </button> ';
       })->editColumn('condicion', function(TipoBonificacion $item) {
        if($item->tipo_estado_id == 1){
            $item->condicion = ' <p class="text-success ">                            
            <i class="fa fa-check "></i>'.$item->estado->tipo_estado_descrip.'</p>';
        }else{
            $item->condicion = ' <p class="text-danger ">                            
            <i class="fa fa-times "></i>'.$item->estado->tipo_estado_descrip.'</p>';
        }
        return $item->condicion;
        })->rawColumns(['accion','condicion'])
           ->make(true);
    }
}