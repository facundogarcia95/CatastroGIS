<?php

namespace App\Http\Controllers;

use App\TipoTramite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class TipoDeTramiteController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Administrador');
    }

    public function index(Request $request)
    {
        return view('Administracion.Mejoras.tipo_de_tramite.index');
    }

    public function datatable(Request $request){

        $tipos_tramites = TipoTramite::orderBy('tipo_tramite_descrip','asc')->get(); 
   
        return  DataTables::of($tipos_tramites)
        ->editColumn('accion', function(TipoTramite $tipo_tramite) {

            
            if($tipo_tramite->tipo_estado_id == 1){

                $desactivar = '<button type="button" class="btn btn-danger rounded  btn-sm" 
                data-tipo_tramite_id="'.$tipo_tramite->tipo_tramite_id.'" 
                data-toggle="modal" data-target="#cambiarEstadoTipoTramite">
                <i class="fa fa-times fa-2x"></i> Desactivar
                </button>';

        }else{

                $desactivar = ' <button type="button" class="btn btn-success rounded  btn-sm" 
                data-tipo_tramite_id="'.$tipo_tramite->tipo_tramite_id.'" 
                data-toggle="modal" data-target="#cambiarEstadoTipoTramite">
                <i class="fa fa-times fa-2x"></i> Activar
                </button>';

        }

            return '<button type="button" class="btn btn-warning rounded text-light btn-sm" 
                        data-tipo_tramite_id="'.$tipo_tramite->tipo_tramite_id.'" 
                        data-tipo_tramite_descrip="'.$tipo_tramite->tipo_tramite_descrip.'" 
                        data-tipo_tramite_codigo="'.$tipo_tramite->tipo_tramite_codigo.'"  
                        data-toggle="modal" data-target="#editarTipoTramite">
                            <i class="fa fa-edit fa-2x"></i> Editar
                    </button> '.$desactivar;
        })->rawColumns(['accion'])
            ->make(true);

    }

    public function store(Request $request)
    {
        $TipoTramite = new TipoTramite();
        $TipoTramite->tipo_tramite_codigo = $request->tipo_tramite_codigo;
        $TipoTramite->tipo_tramite_descrip = $request->tipo_tramite_descrip;
        $TipoTramite->save();   
      
        return Redirect::to("Administracion/Mejoras/tipo_de_tramite")->with("success","Agregado exitosamente");

    }

    public function update(Request $request)
    {
        $TipoTramite= TipoTramite::find($request->tipo_tramite_id);
        if($TipoTramite){

            $TipoTramite->tipo_tramite_codigo = $request->tipo_tramite_codigo;
            $TipoTramite->tipo_tramite_descrip = $request->tipo_tramite_descrip;
            $TipoTramite->save();  
            return Redirect::to("Administracion/Mejoras/tipo_de_tramite")->with("success","Actualizado exitosamente");
            
        }else{

            return Redirect::to("Administracion/Mejoras/tipo_de_tramite")->with("error","El registro no existe");

        }
    }

    public function destroy(Request $request){

        $TipoTramite= TipoTramite::find($request->tipo_tramite_id);

        if($TipoTramite->tipo_estado_id == 1){
            $TipoTramite->tipo_estado_id = 2;
        }else{
            $TipoTramite->tipo_estado_id = 1;
        }
        $TipoTramite->save();   

      return Redirect::to("Administracion/Mejoras/tipo_de_tramite")->with("success","Estado actualizado exitosamente");
      
  }




}
