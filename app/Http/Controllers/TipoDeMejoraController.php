<?php

namespace App\Http\Controllers;

use App\TipoMejora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class TipoDeMejoraController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Administrador');
    }

    public function index(Request $request)
    {
            return view('Administracion.Mejoras.tipo_de_mejora.index');
    }

    public function datatable(Request $request){

         $tipos_mejoras = TipoMejora::orderBy('tipo_mejora_descrip','asc')->get(); 
   
        return  DataTables::of($tipos_mejoras)
        ->editColumn('accion', function(TipoMejora $tipo_mejora) {

            if($tipo_mejora->tipo_estado_id == 1){

                $desactivar = '<button type="button" class="btn btn-danger rounded  btn-sm" 
                data-tipo_mejora_id="'.$tipo_mejora->tipo_mejora_id.'" 
                data-toggle="modal" data-target="#cambiarEstadoTipoMejora">
                <i class="fa fa-times fa-2x"></i> Desactivar
                </button>';

            }else{

                    $desactivar = ' <button type="button" class="btn btn-success rounded  btn-sm" 
                    data-tipo_mejora_id="'.$tipo_mejora->tipo_mejora_id.'" 
                    data-toggle="modal" data-target="#cambiarEstadoTipoMejora">
                    <i class="fa fa-times fa-2x"></i> Activar
                    </button>';

            }

            return '<button type="button" class="btn btn-warning rounded text-light btn-sm" 
                        data-tipo_mejora_id="'.$tipo_mejora->tipo_mejora_id.'" 
                        data-tipo_mejora_descrip="'.$tipo_mejora->tipo_mejora_descrip.'" 
                        data-tipo_mejora_abrev="'.$tipo_mejora->tipo_mejora_abrev.'"  
                        data-toggle="modal" data-target="#editarTipoMejora">
                            <i class="fa fa-edit fa-2x"></i> Editar
                    </button> '.$desactivar;

        })->rawColumns(['accion'])
            ->make(true);

    }

    public function store(Request $request)
    {
        $TipoMejora = new TipoMejora();
        $TipoMejora->tipo_mejora_abrev = $request->tipo_mejora_abrev;
        $TipoMejora->tipo_mejora_descrip = $request->tipo_mejora_descrip;
        $TipoMejora->save();   
      
        return Redirect::to("Administracion/Mejoras/tipo_de_mejora")->with("success","Agregado exitosamente");

    }

    public function update(Request $request)
    {
        $TipoMejora= TipoMejora::find($request->tipo_mejora_id);
        if($TipoMejora){
            $TipoMejora->tipo_mejora_abrev = $request->tipo_mejora_abrev;
            $TipoMejora->tipo_mejora_descrip = $request->tipo_mejora_descrip;
            $TipoMejora->save();  
            return Redirect::to("Administracion/Mejoras/tipo_de_mejora")->with("success","Actualizado exitosamente");
        }else{
            return Redirect::to("Administracion/Mejoras/tipo_de_mejora")->with("error","El registro no existe");
        }

    }


    public function destroy(Request $request){

        $TipoMejora= TipoMejora::find($request->tipo_mejora_id);

        if($TipoMejora->tipo_estado_id == 1){
            $TipoMejora->tipo_estado_id = 2;
        }else{
            $TipoMejora->tipo_estado_id = 1;
        }
        $TipoMejora->save();   

      return Redirect::to("Administracion/Mejoras/tipo_de_mejora")->with("success","Estado actualizado exitosamente");
      
  }



}
