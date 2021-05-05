<?php

namespace App\Http\Controllers;

use App\TipoAfectacion;
use App\Seccion;
use App\TipoEstado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;


class TipoDeAfectacionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Administrador');
    }

    public function index(Request $request)
    {
        //
    

   
            $secciones = Seccion::where('tipo_estado_id','=',1)->get();
            $estados = TipoEstado::get();

            return view('Administracion.tipo_de_afectacion.index',[ "secciones"=>$secciones, "estados"=>$estados]);
        
             
       
    }

    public function datatable(Request $request){

        $tipos_afectaciones = TipoAfectacion::orderBy('tipo_afectacion_descrip','asc')->get(); 
   
        return  DataTables::of($tipos_afectaciones)
        ->editColumn('accion', function(TipoAfectacion $tipo_afectacion) {
            return '<button type="button" class="btn btn-warning rounded text-light btn-sm" 
                        data-tipo_afectacion_id="'.$tipo_afectacion->tipo_afectacion_id.'" 
                        data-tipo_afectacion_codigo="'.$tipo_afectacion->tipo_afectacion_codigo.'" 
                        data-tipo_afectacion_descrip="'.$tipo_afectacion->tipo_afectacion_descrip.'" 
                        data-tipo_estado_id="'.$tipo_afectacion->tipo_estado_id.'" 
                        data-seccion_id="'.$tipo_afectacion->seccion_id.'" 
                        data-toggle="modal" data-target="#editarTipoParcela">
                            <i class="fa fa-edit fa-2x"></i> Editar
                    </button> ';
        })->editColumn('condicion', function(TipoAfectacion $item) {
                if($item->tipo_estado_id == 1){
                    $item->condicion = ' <label class="text-success ">                            
                    <i class="fa fa-check "></i>'.$item->estado->tipo_estado_descrip.'</label>';
                }else{
                    $item->condicion = ' <label class="text-danger ">                            
                    <i class="fa fa-times "></i>'.$item->estado->tipo_estado_descrip.'</label>';
                }
                return $item->condicion;
        })->editColumn('seccion', function(TipoAfectacion $item) {

                return $item->seccion->seccion_descrip;
         })->rawColumns(['condicion','seccion','accion'])
            ->make(true);

    }

    public function store(Request $request)
    {
        $TipoAfectacion = new TipoAfectacion();
        $TipoAfectacion->tipo_afectacion_codigo = $request->tipo_afectacion_codigo;
        $TipoAfectacion->tipo_afectacion_descrip = $request->tipo_afectacion_descrip;
        $TipoAfectacion->tipo_estado_id = $request->tipo_estado_id;
        $TipoAfectacion->seccion_id = $request->seccion_id;
        $TipoAfectacion->save();   
      
        return Redirect::to("Administracion/tipo_de_afectacion")->with("success","Agregado exitosamente");

    }

    public function update(Request $request)
    {
        $TipoAfectacion= TipoAfectacion::findOrFail($request->tipo_afectacion_id);
        $TipoAfectacion->tipo_afectacion_codigo = $request->tipo_afectacion_codigo;
        $TipoAfectacion->tipo_afectacion_descrip = $request->tipo_afectacion_descrip;
        $TipoAfectacion->tipo_estado_id = $request->tipo_estado_id;
        $TipoAfectacion->seccion_id = $request->seccion_id;
        $TipoAfectacion->save();  
        return Redirect::to("Administracion/tipo_de_afectacion")->with("success","Actualizado exitosamente");
        
    }




}
