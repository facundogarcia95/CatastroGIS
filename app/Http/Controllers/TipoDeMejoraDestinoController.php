<?php

namespace App\Http\Controllers;

use App\TipoMejoraDestino;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class TipoDeMejoraDestinoController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Administrador');
    }

    public function index(Request $request)
    {
        return view('Administracion.Mejoras.tipo_de_mejora_destino.index');
    }

    public function datatable(Request $request){

        $tipos_mejoras_destinos = TipoMejoraDestino::orderBy('tipo_mejora_destino_descrip','asc')->get(); 
   
        return  DataTables::of($tipos_mejoras_destinos)
        ->editColumn('accion', function(TipoMejoraDestino $tipo_mejora_destino) {

            
            if($tipo_mejora_destino->tipo_estado_id == 1){

                $desactivar = '<button type="button" class="btn btn-danger rounded  btn-sm" 
                data-tipo_mejora_destino_id="'.$tipo_mejora_destino->tipo_mejora_destino_id.'" 
                data-toggle="modal" data-target="#cambiarEstadoMejoraDestino">
                <i class="fa fa-times fa-2x"></i> Desactivar
                </button>';

        }else{

                $desactivar = ' <button type="button" class="btn btn-success rounded  btn-sm" 
                data-tipo_mejora_destino_id="'.$tipo_mejora_destino->tipo_mejora_destino_id.'" 
                data-toggle="modal" data-target="#cambiarEstadoMejoraDestino">
                <i class="fa fa-times fa-2x"></i> Activar
                </button>';

        }

            return '<button type="button" class="btn btn-warning rounded text-light btn-sm" 
                        data-tipo_mejora_destino_id="'.$tipo_mejora_destino->tipo_mejora_destino_id.'" 
                        data-tipo_mejora_destino_descrip="'.$tipo_mejora_destino->tipo_mejora_destino_descrip.'" 
                        data-tipo_mejora_destino_abrev="'.$tipo_mejora_destino->tipo_mejora_destino_abrev.'"  
                        data-toggle="modal" data-target="#editarTipoMejoraDestino">
                            <i class="fa fa-edit fa-2x"></i> Editar
                    </button> '.$desactivar;
        })->rawColumns(['accion'])
            ->make(true);

    }

    public function store(Request $request)
    {
        $TipoMejoraDestino = new TipoMejoraDestino();
        $TipoMejoraDestino->tipo_mejora_destino_abrev = $request->tipo_mejora_destino_abrev;
        $TipoMejoraDestino->tipo_mejora_destino_descrip = $request->tipo_mejora_destino_descrip;
        $TipoMejoraDestino->save();   
      
        return Redirect::to("Administracion/Mejoras/tipo_de_mejora_destino")->with("success","Agregado exitosamente");

    }

    public function update(Request $request)
    {
        $TipoMejoraDestino= TipoMejoraDestino::find($request->tipo_mejora_destino_id);
        if($TipoMejoraDestino){

            $TipoMejoraDestino->tipo_mejora_destino_abrev = $request->tipo_mejora_destino_abrev;
            $TipoMejoraDestino->tipo_mejora_destino_descrip = $request->tipo_mejora_destino_descrip;
            $TipoMejoraDestino->save();  
            return Redirect::to("Administracion/Mejoras/tipo_de_mejora_destino")->with("success","Actualizado exitosamente");
            
        }else{

            return Redirect::to("Administracion/Mejoras/tipo_de_mejora_destino")->with("error","El registro no existe");

        }
    }

    public function destroy(Request $request){

        $TipoMejoraDestino= TipoMejoraDestino::find($request->tipo_mejora_destino_id);

        if($TipoMejoraDestino->tipo_estado_id == 1){
            $TipoMejoraDestino->tipo_estado_id = 2;
        }else{
            $TipoMejoraDestino->tipo_estado_id = 1;
        }
        $TipoMejoraDestino->save();   

      return Redirect::to("Administracion/Mejoras/tipo_de_mejora_destino")->with("success","Estado actualizado exitosamente");
      
  }




}
