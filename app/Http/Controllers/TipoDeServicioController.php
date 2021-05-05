<?php

namespace App\Http\Controllers;

use App\TipoServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class TipoDeServicioController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Administrador');
    }

    public function index(Request $request)
    {

            return view('Administracion.Parcelas.tipo_de_servicio.index');
               
    }

    public function datatable(Request $request){

        $tipos_servicios = TipoServicio::orderBy('tipo_servicio_descrip','asc')->get(); 
  
       return  DataTables::of($tipos_servicios)
       ->editColumn('accion', function(TipoServicio $tipo_servicio) {

            if($tipo_servicio->tipo_estado_id == 1){

                    $desactivar = '<button type="button" class="btn btn-danger rounded  btn-sm" 
                    data-tipo_servicio_id="'.$tipo_servicio->tipo_servicio_id.'" 
                    data-toggle="modal" data-target="#cambiarEstadoServicio">
                    <i class="fa fa-times fa-2x"></i> Desactivar
                    </button>';

            }else{
                    $desactivar = ' <button type="button" class="btn btn-success rounded  btn-sm" 
                    data-tipo_servicio_id="'.$tipo_servicio->tipo_servicio_id.'" 
                    data-toggle="modal" data-target="#cambiarEstadoServicio">
                    <i class="fa fa-times fa-2x"></i> Activar
                    </button>';
            }

           return ' <button type="button" class="btn btn-warning rounded text-light btn-sm" 
                        data-tipo_servicio_id="'.$tipo_servicio->tipo_servicio_id.'" 
                        data-tipo_servicio_descrip="'.$tipo_servicio->tipo_servicio_descrip.'" 
                        data-tipo_servicio_abrev="'.$tipo_servicio->tipo_servicio_abrev.'"  
                        data-toggle="modal" data-target="#editarTipoServicio">
                            <i class="fa fa-edit fa-2x"></i> Editar
                    </button> '.$desactivar;

       })->rawColumns(['accion'])
           ->make(true);

   }

    public function store(Request $request)
    {
        $TipoServicio = new TipoServicio();
        $TipoServicio->tipo_servicio_descrip = $request->tipo_servicio_descrip;
        $TipoServicio->tipo_servicio_abrev = $request->tipo_servicio_abrev;
        $TipoServicio->save();   
      
        return Redirect::to("Administracion/Parcelas/tipo_de_servicio")->with("success","Agregado exitosamente");

    }

    public function update(Request $request)
    {
        $TipoServicio= TipoServicio::findOrFail($request->tipo_servicio_id);
        if($TipoServicio){
            $TipoServicio->tipo_servicio_descrip = $request->tipo_servicio_descrip;
            $TipoServicio->tipo_servicio_abrev = $request->tipo_servicio_abrev;
            $TipoServicio->save();   
            return Redirect::to("Administracion/Parcelas/tipo_de_servicio")->with("success","Actualizado exitosamente");
        }else{
            return Redirect::to("Administracion/Parcelas/tipo_de_servicio")->with("error","El registro no existe");
        }
        
    }


    public function destroy(Request $request){

        $TipoServicio= TipoServicio::find($request->id_servicio);

        if($TipoServicio->tipo_estado_id == 1){
            $TipoServicio->tipo_estado_id = 2;
        }else{
            $TipoServicio->tipo_estado_id = 1;
        }

        $TipoServicio->save();   

      return Redirect::to("Administracion/Parcelas/tipo_de_servicio")->with("success","Estado actualizado exitosamente");
  }





}
