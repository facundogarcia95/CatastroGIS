<?php

namespace App\Http\Controllers;

use App\TipoCondicion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class TipoDeCondicionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Administrador');
    }

    public function index(Request $request)
    {

            return view('Administracion.Parcelas.tipo_de_condicion.index');

    }

    public function datatable(Request $request){

        $tipos_condiciones = TipoCondicion::orderBy('tipo_condicion_descrip','asc')->get(); 
  
       return  DataTables::of($tipos_condiciones)
       ->editColumn('accion', function(TipoCondicion $tipo_condicion) {
                
                if($tipo_condicion->tipo_estado_id == 1){

                        $desactivar = '<button type="button" class="btn btn-danger rounded  btn-sm" 
                        data-id_condicion="'.$tipo_condicion->tipo_condicion_id.'" 
                        data-toggle="modal" data-target="#cambiarEstadoCondicion">
                        <i class="fa fa-times fa-2x"></i> Desactivar
                        </button>';

                }else{
                        $desactivar = ' <button type="button" class="btn btn-success rounded  btn-sm" 
                        data-id_condicion="'.$tipo_condicion->tipo_condicion_id.'" 
                        data-toggle="modal" data-target="#cambiarEstadoCondicion">
                        <i class="fa fa-times fa-2x"></i> Activar
                        </button>';
                }

           return '    <button type="button" class="btn btn-warning rounded text-light btn-sm" 
                            data-tipo_condicion_id="'.$tipo_condicion->tipo_condicion_id.'" 
                            data-tipo_condicion_descrip="'.$tipo_condicion->tipo_condicion_descrip.'" 
                            data-tipo_condicion_abrev="'.$tipo_condicion->tipo_condicion_abrev.'"  
                            data-toggle="modal" data-target="#editarTipoCondicion">
                                <i class="fa fa-edit fa-2x"></i> Editar
                        </button> '.$desactivar;

       })->rawColumns(['accion'])
           ->make(true);

   }

    public function store(Request $request)
    {
        $TipoCondicion = new TipoCondicion();
        $TipoCondicion->tipo_condicion_descrip = $request->tipo_condicion_descrip;
        $TipoCondicion->tipo_condicion_abrev = $request->tipo_condicion_abrev;
        $TipoCondicion->save();   
      
        return Redirect::to("Administracion/Parcelas/tipo_de_condicion")->with("success","Agregado exitosamente");

    }

    public function update(Request $request)
    {
        $TipoCondicion= TipoCondicion::find($request->tipo_condicion_id);

        if($TipoCondicion){
            $TipoCondicion->tipo_condicion_descrip = $request->tipo_condicion_descrip;
            $TipoCondicion->tipo_condicion_abrev = $request->tipo_condicion_abrev;
            $TipoCondicion->save();   
            return Redirect::to("Administracion/Parcelas/tipo_de_condicion")->with("success","Actualizado exitosamente");
        }else{
            return Redirect::to("Administracion/Parcelas/tipo_de_condicion")->with("error","El usuario no existe");
        }
        
    }

    public function destroy(Request $request){

        $TipoCondicion= TipoCondicion::find($request->id_condicion);

        if($TipoCondicion->tipo_estado_id == 1){
            $TipoCondicion->tipo_estado_id = 2;
        }else{
            $TipoCondicion->tipo_estado_id = 1;
        }
        $TipoCondicion->save();   

        return Redirect::to("Administracion/Parcelas/tipo_de_condicion")->with("success","Estado actualizado exitosamente");
    }




}
