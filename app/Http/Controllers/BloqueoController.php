<?php

namespace App\Http\Controllers;

use App\Bloqueo;
use App\Parcela;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\DataTables;

class BloqueoController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Operador');
    }

    public function index(Request $request)
    {

        $padron = $request->padron ? $request->padron : null;
    
            return view('Usuarios.bloqueo.index',["padron"=>$padron]);

    }

    public function datatable(Request $request){

        $bloqueos = Bloqueo::orderBy('descrip','asc')->get(); 
  
       return  DataTables::of($bloqueos)
       ->editColumn('padron', function(Bloqueo $bloqueo) {
           if($bloqueo){
               return '<a href="../gestion/padron/'.$bloqueo->parcela->parcela_id.'">'.$bloqueo->parcela->parcela_padron.'</a>';
           }else{
               return null;
           }
        })->editColumn('descripcion', function(Bloqueo $bloqueo) {
            if($bloqueo){
                return $bloqueo->descrip;
            }else{
                return null;
            }
         })->editColumn('accion', function(Bloqueo $bloqueo) {
            if($bloqueo){
                return ' <button type="button" class="btn btn-danger rounded  btn-sm" 
                                data-parcela_id="'.$bloqueo->parcela_id.'" 
                                data-toggle="modal" data-target="#cambiarEstado">
                                    <i class="fa fa-times fa-2x"></i> Eliminar
                                </button>';
            }else{
                return null;
            }
       })->editColumn('usuario', function(Bloqueo $bloqueo) {
            if($bloqueo){
                return $bloqueo->user->usuario_nombre;
            }else{
                return null;
            }
        })
       ->rawColumns(['padron','usuario','descripcion','accion'])
           ->make(true);

   }


    public function store(Request $request)
    {
 
        return Redirect::to("Usuarios/bloqueo")->with("error","No puedes agregar manualmente");

    }

    public function update(Request $request)
    {

        return Redirect::to("Usuarios/bloqueo")->with("error","No se puede actualizar manualmente");
        
    }


    public function destroy(Request $request)
    {
       
        $bloqueo= Bloqueo::where('parcela_id','=',$request->parcela_id);
        $padron = $request->padron ? $request->padron : null;
         
        if($bloqueo){
            $bloqueo->delete();
            return back()->with("success","Bloqueo desactivado")->with("parcela",$request->parcela_id);
        }

        return Redirect::to("Usuarios/bloqueo")->with("error","No se pudo desactivar");
        
    }

    public function consultar_bloqueo(Request $request){
        
        $bloqueo = Bloqueo::where('parcela_id','=',$request->parcela_id)->first();

        if($bloqueo){

            if($bloqueo->fecha != $request->fecha){

                return Response::json(
                        array(
                            "bloquear" => true
                        )
                        ,200);
            }else{
                
                return Response::json(
                    array(
                        "bloquear" => $bloqueo->fecha
                    )
                    ,200);
            }

        }else{
            
                return Response::json(
                array(
                    "bloquear" => true
                )
                ,200);
        }
        

    }

    public function mi_bloqueo(){
        
        $bloqueo = Bloqueo::where('usuario_id','=',Auth::user()->usuario_id)->first();

        return $bloqueo;

    }

    public function liberarBloqueo(Request $request){

        $bloqueo= Bloqueo::where('parcela_id','=',$request->parcela_id);
        $bloqueo->delete();
        
        $URLBASE =  str_replace($request->path(),null,URL::current());

        if(url()->previous() == $URLBASE."gestion/padron/".$request->parcela_id)
         return Redirect::to("gestion/padron");

        return back()->with("success","Bloqueo desactivado");
        
    }

}
