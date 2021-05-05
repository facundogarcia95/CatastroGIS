<?php

namespace App\Http\Controllers;

use App\TipoParcelaRyB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class TipoParcelaRyBController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Administrador');
    }

    public function index(Request $request)
    {    
        /*listar los roles en ventana modal*/
        $tipo_ryb = TipoParcelaRyB::orderBy('tipo_parcela_ryb_codigo','asc')->paginate(10);
        return view('codigos.tipo_de_ryb.index',["tipo_ryb"=>$tipo_ryb]);       
    }


    public function datatable(Request $request){

      $tipos_ryb = TipoParcelaRyB::orderBy('tipo_parcela_ryb_codigo','asc')->get();
      
         
      return  DataTables::of($tipos_ryb)
      ->editColumn('accion', function(TipoParcelaRyB $tipoRyB) {

          
          if($tipoRyB->tipo_estado_id == 1){

                  $desactivar = '<button type="button" class="btn btn-danger rounded  btn-sm" 
                  data-tipo_parcela_ryb_id="'.$tipoRyB->tipo_parcela_ryb_id.'" 
                  data-toggle="modal" data-target="#cambiarEstadoRyB">
                  <i class="fa fa-times fa-2x"></i> Desactivar
                  </button>';

          }else{

                  $desactivar = ' <button type="button" class="btn btn-success rounded  btn-sm" 
                  data-tipo_parcela_ryb_id="'.$tipoRyB->tipo_parcela_ryb_id.'" 
                  data-toggle="modal" data-target="#cambiarEstadoRyB">
                  <i class="fa fa-times fa-2x"></i> Activar
                  </button>';

          }

          return '<button type="button" class="btn btn-warning rounded text-light btn-sm" 
                              data-tipo_parcela_ryb_id="'.$tipoRyB->tipo_parcela_ryb_id.'" 
                              data-tipo_parcela_ryb_codigo="'.$tipoRyB->tipo_parcela_ryb_codigo.'" 
                              data-tipo_parcela_ryb_descrip="'.$tipoRyB->tipo_parcela_ryb_descrip.'" 
                              data-tipo_parcela_ryb_abrev="'.$tipoRyB->tipo_parcela_ryb_abrev.'"
                              data-tipo_parcela_utm="'.$tipoRyB->tipo_parcela_utm.'"
                              data-tipo_estado_id="'.$tipoRyB->tipo_estado_id.'"
                              data-toggle="modal" 
                              data-target="#editarTipoRyB">
                      <i class="fa fa-edit fa-2x"></i> Editar
                  </button> '.$desactivar;
                  
      })->editColumn('condicion', function(TipoParcelaRyB $item) {
              if($item->tipo_estado_id == 1){
                  $item->condicion = ' <p class="text-success ">                            
                  <i class="fa fa-check "></i>'.$item->estado->tipo_estado_descrip.'</p>';
              }else{
                  $item->condicion = ' <p class="text-danger ">                            
                  <i class="fa fa-times "></i>'.$item->estado->tipo_estado_descrip.'</p>';
              }
              return $item->condicion;
      })->rawColumns(['condicion','accion'])
          ->make(true);

  }


    public function store(Request $request)
    {
        $TipoRyB = new TipoParcelaRyB();
        $TipoRyB->tipo_parcela_ryb_codigo = $request->tipo_parcela_ryb_codigo;
        $TipoRyB->tipo_parcela_ryb_descrip = $request->tipo_parcela_ryb_descrip;
        $TipoRyB->tipo_parcela_ryb_abrev = $request->tipo_parcela_ryb_abrev;
        $TipoRyB->tipo_estado_id = 1;
        $TipoRyB->tipo_parcela_utm = $request->tipo_parcela_utm;
        $TipoRyB->save();      

        return Redirect::to("codigos/tipo_de_ryb")->with("success","Agregado exitosamente");
    }

    public function update(Request $request)
    {
        $TipoRyB = TipoParcelaRyB::findOrFail($request->tipo_parcela_ryb_id);
        
        $TipoRyB->tipo_parcela_ryb_codigo = $request->tipo_parcela_ryb_codigo;
        $TipoRyB->tipo_parcela_ryb_descrip = $request->tipo_parcela_ryb_descrip;
        $TipoRyB->tipo_parcela_ryb_abrev = $request->tipo_parcela_ryb_abrev;
        $TipoRyB->tipo_estado_id = 1;
        $TipoRyB->tipo_parcela_utm = $request->tipo_parcela_utm;
        $TipoRyB->save();   

        return Redirect::to("codigos/tipo_de_ryb")->with("success","Actualizado exitosamente");        
    }


    public function destroy(Request $request)
    {
        $TipoRyB = TipoParcelaRyB::findOrFail($request->tipo_parcela_ryb_id);
        
         if($TipoRyB->tipo_estado_id == 1){
            $TipoRyB->tipo_estado_id = 2;
         }else{
            $TipoRyB->tipo_estado_id = 1;
         }
        $TipoRyB->save();   

        return Redirect::to("codigos/tipo_de_ryb")->with("success","Actualizado exitosamente");        
    }

}