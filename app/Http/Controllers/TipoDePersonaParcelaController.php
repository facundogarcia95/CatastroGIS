<?php

namespace App\Http\Controllers;

use App\TipoPersonaParcela;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class TipoDePersonaParcelaController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Administrador');
    }

    public function index(Request $request)
    {

        return view('Administracion.Personas.tipo_de_persona_parcela.index');
         
    }

    public function datatable(Request $request){

        $tipos_personas_parcelas = TipoPersonaParcela::orderBy('tipo_persona_parcela_descrip','asc')->get(); 
  
       return  DataTables::of($tipos_personas_parcelas)
       ->editColumn('accion', function(TipoPersonaParcela $tipo_persona_parcela) {

            if($tipo_persona_parcela->tipo_estado_id == 1){

                    $desactivar = '<button type="button" class="btn btn-danger rounded  btn-sm" 
                    data-tipo_persona_parcela_id="'.$tipo_persona_parcela->tipo_persona_parcela_id.'" 
                    data-toggle="modal" data-target="#cambiarEstadoPersonaParcela">
                    <i class="fa fa-times fa-2x"></i> Desactivar
                    </button>';

            }else{

                    $desactivar = ' <button type="button" class="btn btn-success rounded  btn-sm" 
                    data-tipo_persona_parcela_id="'.$tipo_persona_parcela->tipo_persona_parcela_id.'" 
                    data-toggle="modal" data-target="#cambiarEstadoPersonaParcela">
                    <i class="fa fa-times fa-2x"></i> Activar
                    </button>';

            }

           return '<button type="button" class="btn btn-warning rounded text-light btn-sm" 
                        data-tipo_persona_parcela_id="'.$tipo_persona_parcela->tipo_persona_parcela_id.'" 
                        data-tipo_persona_parcela_descrip="'.$tipo_persona_parcela->tipo_persona_parcela_descrip.'" 
                        data-tipo_persona_parcela_abrev="'.$tipo_persona_parcela->tipo_persona_parcela_abrev.'"  
                        data-toggle="modal" data-target="#editarTipoPersonaParcela">
                            <i class="fa fa-edit fa-2x"></i> Editar
                    </button> '.$desactivar;
       })->rawColumns(['accion'])
           ->make(true);

   }

    public function store(Request $request)
    {
        $TipoPersonaParcela = new TipoPersonaParcela();
        $TipoPersonaParcela->tipo_persona_parcela_descrip = $request->tipo_persona_parcela_descrip;
        $TipoPersonaParcela->tipo_persona_parcela_abrev = $request->tipo_persona_parcela_abrev;
        $TipoPersonaParcela->save();   
      
        return Redirect::to("Administracion/Personas/tipo_de_persona_parcela")->with("success","Agregado exitosamente");

    }

    public function update(Request $request)
    {
        $TipoPersonaParcela= TipoPersonaParcela::find($request->tipo_persona_parcela_id);
        
        if($TipoPersonaParcela){

            $TipoPersonaParcela->tipo_persona_parcela_descrip = $request->tipo_persona_parcela_descrip;
            $TipoPersonaParcela->tipo_persona_parcela_abrev = $request->tipo_persona_parcela_abrev;
            $TipoPersonaParcela->save();   
            return Redirect::to("Administracion/Personas/tipo_de_persona_parcela")->with("success","Actualizado exitosamente");
            
        }else{

            return Redirect::to("Administracion/Personas/tipo_de_persona_parcela")->with("success","El registro no existe");

        }

    }


    public function destroy(Request $request){

        $TipoPersonaParcela= TipoPersonaParcela::find($request->tipo_persona_parcela_id);

        if($TipoPersonaParcela->tipo_estado_id == 1){
            $TipoPersonaParcela->tipo_estado_id = 2;
        }else{
            $TipoPersonaParcela->tipo_estado_id = 1;
        }
        $TipoPersonaParcela->save();   

      return Redirect::to("Administracion/Personas/tipo_de_persona_parcela")->with("success","Estado actualizado exitosamente");

  }



}
