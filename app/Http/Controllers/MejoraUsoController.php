<?php

namespace App\Http\Controllers;

use App\MejoraUso;
use App\TipoEstado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class MejoraUsoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Administrador');
    }

    public function index(Request $request)
    {    
        //dd($request->attributes);
        //dd($request->all());

        $estados = TipoEstado::get();


        return view('codigos.tipo_de_uso.index', [
            'estados' => $estados
        ]);
        
    }

    public function datatable(Request $request){

        $mejora_usos = MejoraUso::all();
        

        foreach($mejora_usos as $item){
            
                if($item->tipo_estado_id == 1){
                    $item->condicion = ' <label class="text-success ">                            
                    <i class="fa fa-check "></i>'.$item->estado->tipo_estado_descrip.'</label>';
                }else{
                    $item->condicion = ' <label class="text-danger ">                            
                    <i class="fa fa-times "></i>'.$item->estado->tipo_estado_descrip.'</label>';
                }
  
        }
           
        return  DataTables::of($mejora_usos)
        ->editColumn('accion', function(MejoraUso $item) {

            if($item->tipo_estado_id == 1){

                $desactivar = '<button type="button" class="btn btn-danger rounded  btn-sm" 
                data-id="'.$item->tipo_mejora_uso_id.'" 
                data-toggle="modal" data-target="#cambiarEstado">
                <i class="fa fa-times fa-2x"></i> Desactivar
                </button>';

            }else{

                $desactivar = ' <button type="button" class="btn btn-success rounded  btn-sm" 
                data-id="'.$item->tipo_mejora_uso_id.'" 
                data-toggle="modal" data-target="#cambiarEstado">
                <i class="fa fa-times fa-2x"></i> Activar
                </button>';

            }
            return " <button type='button' class='btn btn-warning rounded text-light btn-sm' 
                        data-tipo_mejora_uso_id='".$item->tipo_mejora_uso_id."' 
                        data-tipo_mejora_uso_codigo='".$item->tipo_mejora_uso_codigo."' 
                        data-tipo_mejora_uso_descrip='".$item->tipo_mejora_uso_descrip."' 
                        data-tipo_estado_id='".$item->tipo_estado_id."' data-toggle='modal' 
                        data-target='#editarMejoraUso'> 
                        <i class='fa fa-edit fa-2x'></i> Editar 
                    </button> ".$desactivar;

        })->editColumn('condicion', function(MejoraUso $item) {
            return $item->condicion;
        })->rawColumns(['condicion','accion'])
        ->make(true);


       
    }

    public function store(Request $request)
    {
        $MejoraUso = new MejoraUso();
        $MejoraUso->tipo_mejora_uso_codigo = $request->tipo_mejora_uso_codigo;
        $MejoraUso->tipo_mejora_uso_descrip = $request->tipo_mejora_uso_descrip;
        $MejoraUso->tipo_estado_id = $request->tipo_estado_id;
        $MejoraUso->save();      
        return Redirect::to("codigos/tipo_de_uso")->with("success","Agregado exitosamente");
    }

    public function update(Request $request)
    {
        $MejoraUso = MejoraUso::findOrFail($request->tipo_mejora_uso_id);
        $MejoraUso->tipo_mejora_uso_codigo = $request->tipo_mejora_uso_codigo;
        $MejoraUso->tipo_mejora_uso_descrip = $request->tipo_mejora_uso_descrip;
        $MejoraUso->tipo_estado_id = $request->tipo_estado_id;
        $MejoraUso->save();
        return Redirect::to("codigos/tipo_de_uso")->with("success","Actualizado exitosamente");        
    }

    public function destroy(Request $request){

        $MejoraUso= MejoraUso::find($request->id);

        if($MejoraUso->tipo_estado_id == 1){
            $MejoraUso->tipo_estado_id = 2;
        }else{
            $MejoraUso->tipo_estado_id = 1;
        }
        $MejoraUso->save();   

        return Redirect::to("codigos/tipo_de_uso")->with("success","Estado actualizado exitosamente");        

    }
}