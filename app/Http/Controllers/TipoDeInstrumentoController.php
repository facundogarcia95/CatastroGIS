<?php

namespace App\Http\Controllers;

use App\TipoInstrumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class TipoDeInstrumentoController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Administrador');
    }

    public function index(Request $request)
    {
            return view('Administracion.Parcelas.tipo_de_instrumento.index');
       
    }

    public function datatable(Request $request){

        $tipos_instrumentos = TipoInstrumento::orderBy('tipo_instrumento_descrip','asc')->get(); 
  
       return  DataTables::of($tipos_instrumentos)
       ->editColumn('accion', function(TipoInstrumento $tipo_instrumento) {

            if($tipo_instrumento->tipo_estado_id == 1){

                    $desactivar = '<button type="button" class="btn btn-danger rounded  btn-sm" 
                    data-id_instrumento="'.$tipo_instrumento->tipo_instrumento_id.'" 
                    data-toggle="modal" data-target="#cambiarEstadoInstrumento">
                    <i class="fa fa-times fa-2x"></i> Desactivar
                    </button>';

            }else{
                    $desactivar = ' <button type="button" class="btn btn-success rounded  btn-sm" 
                    data-id_instrumento="'.$tipo_instrumento->tipo_instrumento_id.'" 
                    data-toggle="modal" data-target="#cambiarEstadoInstrumento">
                    <i class="fa fa-times fa-2x"></i> Activar
                    </button>';
            }

           return ' <button type="button" class="btn btn-warning rounded text-light btn-sm" 
                        data-tipo_instrumento_id="'.$tipo_instrumento->tipo_instrumento_id.'" 
                        data-tipo_instrumento_descrip="'.$tipo_instrumento->tipo_instrumento_descrip.'" 
                        data-tipo_instrumento_abrev="'.$tipo_instrumento->tipo_instrumento_abrev.'"  
                        data-toggle="modal" data-target="#editarTipoInstrumento">
                            <i class="fa fa-edit fa-2x"></i> Editar
                    </button> '.$desactivar;

       })->rawColumns(['accion'])
           ->make(true);

   }

    public function store(Request $request)
    {
        $TipoInstrumento = new TipoInstrumento();
        $TipoInstrumento->tipo_instrumento_descrip = $request->tipo_instrumento_descrip;
        $TipoInstrumento->tipo_instrumento_abrev = $request->tipo_instrumento_abrev;
        $TipoInstrumento->save();   
      
        return Redirect::to("Administracion/Parcelas/tipo_de_instrumento")->with("success","Agregado exitosamente");

    }

    public function update(Request $request)
    {
    
        $TipoInstrumento= TipoInstrumento::find($request->tipo_instrumento_id);
        if($TipoInstrumento){

            $TipoInstrumento->update($request->all());
            $TipoInstrumento->save();   
    
            return Redirect::to("Administracion/Parcelas/tipo_de_instrumento")->with("success","Actualizado exitosamente");
            
        }else{
            return Redirect::to("Administracion/Parcelas/tipo_de_instrumento")->with("error","El registro no existe");
        }

    }


    public function destroy(Request $request){

          $TipoInstrumento= TipoInstrumento::find($request->id_instrumento);

        if($TipoInstrumento->tipo_estado_id == 1){

            $TipoInstrumento->tipo_estado_id = 2;
        }else{

            $TipoInstrumento->tipo_estado_id = 1;
            
        }
        $TipoInstrumento->save();   

        return Redirect::to("Administracion/Parcelas/tipo_de_instrumento")->with("success","Estado actualizado exitosamente");
    }



}
