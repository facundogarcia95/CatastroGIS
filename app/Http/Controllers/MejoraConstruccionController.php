<?php

namespace App\Http\Controllers;

use App\MejoraConstruccion;
use App\TipoEstado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;



class MejoraConstruccionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Administrador');
    }

    public function index(Request $request)
    {    
    

        $estados = TipoEstado::get();
        $dato = [
                "tipo_estados" => $estados
                ];
        return view('codigos.tipo_de_construccion.index',$dato);
    }

    public function datatable(Request $request){
        $mejora_construcciones = MejoraConstruccion::orderBy('tipo_mejora_categoria_codigo','asc')->get();

        foreach($mejora_construcciones as $item){

            if($item->tipo_estado_id == 1){
                $item->condicion = ' <label class="text-success ">                            
                <i class="fa fa-check "></i>'.$item->tipo_estado->tipo_estado_descrip.'</label>';
            }else{
                $item->condicion = ' <label class="text-danger ">                            
                <i class="fa fa-times "></i>'.$item->tipo_estado->tipo_estado_descrip.'</label>';
            }
        }

        return  DataTables::of($mejora_construcciones)
        ->editColumn('accion', function(MejoraConstruccion $mejora_construccion) {
            return '<button type="button" class="btn btn-warning rounded text-light btn-sm" 
                    data-tipo_mejora_categoria_id="'.$mejora_construccion->tipo_mejora_categoria_id.'" 
                    data-tipo_mejora_categoria_codigo="'.$mejora_construccion->tipo_mejora_categoria_codigo.'" 
                    data-tipo_mejora_categoria_descrip="'.$mejora_construccion->tipo_mejora_categoria_descrip.'" 
                    data-tipo_mejora_categoria_coeficiente="'.$mejora_construccion->tipo_mejora_categoria_coeficiente.'" 
                    data-tipo_estado_id="'.$mejora_construccion->tipo_estado_id.'"
                    data-toggle="modal" 
                    data-target="#editarMejoraConstruccion">
                        <i class="fa fa-edit fa-2x"></i> Editar
                </button>';
        })->editColumn('condicion', function(MejoraConstruccion $item) {
            return $item->condicion;
        })->rawColumns(['condicion','accion'])
        ->make(true);

    }

    public function store(Request $request)
    {
        $MejoraConstruccion = new MejoraConstruccion();
        $MejoraConstruccion->tipo_mejora_categoria_codigo = $request->tipo_mejora_categoria_codigo;
        $MejoraConstruccion->tipo_mejora_categoria_descrip = $request->tipo_mejora_categoria_descrip;
        $MejoraConstruccion->tipo_mejora_categoria_coeficiente = $request->tipo_mejora_categoria_coeficiente;
        $MejoraConstruccion->tipo_estado_id = $request->tipo_estado_id;
        $MejoraConstruccion->save();      
        return Redirect::to("codigos/tipo_de_construccion")->with("success","Agregado exitosamente");
    }

    public function update(Request $request)
    {
        $MejoraConstruccion = MejoraConstruccion::findOrFail($request->tipo_mejora_categoria_id);
        $MejoraConstruccion->tipo_mejora_categoria_codigo = $request->tipo_mejora_categoria_codigo;
        $MejoraConstruccion->tipo_mejora_categoria_descrip = $request->tipo_mejora_categoria_descrip;
        $MejoraConstruccion->tipo_mejora_categoria_coeficiente = $request->tipo_mejora_categoria_coeficiente;
        $MejoraConstruccion->tipo_estado_id = $request->tipo_estado_id;
        $MejoraConstruccion->save();
        return Redirect::to("codigos/tipo_de_construccion")->with("success","Actualizado exitosamente");        
    }
}