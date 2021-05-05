<?php

namespace App\Http\Controllers;

use App\TipoEstado;
use App\TipoParcelaEstado;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use DB;
use DataTables;


class ParcelaEstadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Administrador');
    }

    public function index(Request $request)
    {    
        /*listar los roles en ventana modal*/
    
        $estados = TipoEstado::get();
        return view('codigos.tipo_de_estado.index',["estados"=>$estados]);       
    }

    public function datatable(Request $request){

        $parcela_estados = TipoParcelaEstado::orderBy('tipo_parcela_estado_codigo','asc')->get();
        
           
        return  DataTables::of($parcela_estados)
        ->editColumn('accion', function(TipoParcelaEstado $parcela_estado) {

            
            if($parcela_estado->tipo_estado_id == 1){

                    $desactivar = '<button type="button" class="btn btn-danger rounded  btn-sm" 
                    data-tipo_parcela_estado_id="'.$parcela_estado->tipo_parcela_estado_id.'" 
                    data-toggle="modal" data-target="#cambiarEstadoParcela">
                    <i class="fa fa-times fa-2x"></i> Desactivar
                    </button>';

            }else{

                    $desactivar = ' <button type="button" class="btn btn-success rounded  btn-sm" 
                    data-tipo_parcela_estado_id="'.$parcela_estado->tipo_parcela_estado_id.'" 
                    data-toggle="modal" data-target="#cambiarEstadoParcela">
                    <i class="fa fa-times fa-2x"></i> Activar
                    </button>';

            }

            return '<button type="button" class="btn btn-warning rounded text-light btn-sm" 
                                data-tipo_parcela_estado_id="'.$parcela_estado->tipo_parcela_estado_id.'" 
                                data-tipo_parcela_estado_codigo="'.$parcela_estado->tipo_parcela_estado_codigo.'" 
                                data-tipo_parcela_estado_descrip="'.$parcela_estado->tipo_parcela_estado_descrip.'" 
                                data-tipo_parcela_estado_abrev="'.$parcela_estado->tipo_parcela_estado_abrev.'"
                                data-tipo_estado_id="'.$parcela_estado->tipo_estado_id.'"
                                data-toggle="modal" 
                                data-target="#editarTipoEstado">
                        <i class="fa fa-edit fa-2x"></i> Editar
                    </button> '.$desactivar;
                    
        })->editColumn('condicion', function(TipoParcelaEstado $item) {
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
        $ParcelaEstado = new TipoParcelaEstado();
        $ParcelaEstado->tipo_parcela_estado_codigo = $request->tipo_parcela_estado_codigo;
        $ParcelaEstado->tipo_parcela_estado_descrip = $request->tipo_parcela_estado_descrip;
        $ParcelaEstado->tipo_parcela_estado_abrev = $request->tipo_parcela_estado_abrev;
        $ParcelaEstado->tipo_estado_id = $request->tipo_estado_id;
        $ParcelaEstado->save();      
        return Redirect::to("codigos/tipo_de_estado")->with("success","Agregado exitosamente");
    }

    public function update(Request $request)
    {
        $ParcelaEstado = TipoParcelaEstado::find($request->tipo_parcela_estado_id);
        if($ParcelaEstado){

            $ParcelaEstado->tipo_parcela_estado_codigo = $request->tipo_parcela_estado_codigo;
            $ParcelaEstado->tipo_parcela_estado_descrip = $request->tipo_parcela_estado_descrip;
            $ParcelaEstado->tipo_parcela_estado_abrev = $request->tipo_parcela_estado_abrev;
            $ParcelaEstado->tipo_estado_id = $request->tipo_estado_id;
            $ParcelaEstado->save();
            return Redirect::to("codigos/tipo_de_estado")->with("success","Actualizado exitosamente");        

        }else{
            return Redirect::to("codigos/tipo_de_estado")->with("error","El registro no existe");        

        }
    }

    public function destroy(Request $request){

        $ParcelaEstado= TipoParcelaEstado::find($request->tipo_parcela_estado_id);

        if($ParcelaEstado->tipo_estado_id == 1){
            $ParcelaEstado->tipo_estado_id = 2;
        }else{
            $ParcelaEstado->tipo_estado_id = 1;
        }
        $ParcelaEstado->save();   

        return Redirect::to("codigos/tipo_de_estado")->with("success","Estado actualizado exitosamente");        

  }

}