<?php

namespace App\Http\Controllers;

use App\TipoDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class TipoDeDocumentoController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Administrador');
    }

    public function index(Request $request)
    {

        return view('Administracion.Personas.tipo_de_documento.index');
 
    }

    public function datatable(Request $request){

        $tipos_documentos = TipoDocumento::orderBy('tipo_documento_descrip','asc')->get(); 
  
       return  DataTables::of($tipos_documentos)
       ->editColumn('accion', function(TipoDocumento $tipo_documento) {

            if($tipo_documento->tipo_estado_id == 1){

                    $desactivar = '<button type="button" class="btn btn-danger rounded  btn-sm" 
                    data-id_documento="'.$tipo_documento->tipo_documento_id.'" 
                    data-toggle="modal" data-target="#cambiarEstadoDocumento">
                    <i class="fa fa-times fa-2x"></i> Desactivar
                    </button>';

            }else{

                    $desactivar = ' <button type="button" class="btn btn-success rounded  btn-sm" 
                    data-id_documento="'.$tipo_documento->tipo_documento_id.'" 
                    data-toggle="modal" data-target="#cambiarEstadoDocumento">
                    <i class="fa fa-times fa-2x"></i> Activar
                    </button>';

            }

           return '  <button type="button" class="btn btn-warning rounded text-light btn-sm" 
                        data-tipo_documento_id="'.$tipo_documento->tipo_documento_id.'" 
                        data-tipo_documento_descrip="'.$tipo_documento->tipo_documento_descrip.'" 
                        data-tipo_documento_abrev="'.$tipo_documento->tipo_documento_abrev.'"  
                        data-toggle="modal" data-target="#editarTipoDocumento">
                            <i class="fa fa-edit fa-2x"></i> Editar
                    </button> '.$desactivar;

       })->rawColumns(['accion'])
           ->make(true);

   }

    public function store(Request $request)
    {
      
        //dd($request->all());
        $TipoDocumento = new TipoDocumento();
        $TipoDocumento->tipo_documento_descrip = $request->tipo_documento_descrip;
        $TipoDocumento->tipo_documento_abrev = $request->tipo_documento_abrev;
        $TipoDocumento->save();   
      
        return Redirect::to("Administracion/Personas/tipo_de_documento")->with("success","Agregado exitosamente");

    }

    public function update(Request $request)
    {
        $TipoDocumento= TipoDocumento::find($request->tipo_documento_id);

        if($TipoDocumento){
            $TipoDocumento->tipo_documento_descrip = $request->tipo_documento_descrip;
            $TipoDocumento->tipo_documento_abrev = $request->tipo_documento_abrev;
            $TipoDocumento->save();   
            return Redirect::to("Administracion/Personas/tipo_de_documento")->with("success","Actualizado exitosamente");
        }else{
            return Redirect::to("Administracion/Personas/tipo_de_documento")->with("success","El registro no existe");
        }
        
    }

    public function destroy(Request $request){

        $TipoDocumento= TipoDocumento::find($request->id_documento);

        if($TipoDocumento->tipo_estado_id == 1){
            $TipoDocumento->tipo_estado_id = 2;
        }else{
            $TipoDocumento->tipo_estado_id = 1;
        }
        $TipoDocumento->save();   

      return Redirect::to("Administracion/Personas/tipo_de_documento")->with("success","Estado actualizado exitosamente");
      
  }



}
