<?php

namespace App\Http\Controllers;

use App\Seccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class SeccionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Operador');
    }

    public function index(Request $request)
    {

            return view('Usuarios.seccion.index');
        
    }

    
    public function datatable(Request $request){

        $secciones = Seccion::orderBy('seccion_descrip','asc')->get(); 
  
       return  DataTables::of($secciones)
       ->editColumn('afectacion', function(Seccion $seccion) {
          
        if($seccion->afectacion=="1"){
            $afectacion = '<button type="button" class="btn btn-success rounded btn-sm" 
            data-id_seccion="'.$seccion->seccion_id.'" 
            data-toggle="modal" data-target="#cambiarAfectacion">
                <i class="fa fa-check fa-2x"></i> SI
            </button>';
        }else{
            $afectacion = '<button type="button" class="btn btn-danger rounded btn-sm" 
            data-id_seccion="'.$seccion->seccion_id.'" 
            data-toggle="modal" data-target="#cambiarAfectacion">
                <i class="fa fa-times fa-2x"></i> NO
            </button>';
        }
            return $afectacion;

        })->editColumn('estado', function(Seccion $seccion) {
            if($seccion->tipo_estado_id=="1"){
         
                $estado = '<label  class="text-success ">
                            <i class="fa fa-check "></i> Activo
                        </label>';
            }else{

                $estado = '<label class="text-danger ">
                            <i class="fa fa-check "></i> Desactivado
                        </label>';

            }
            return $estado;
        })->editColumn('acciones', function(Seccion $seccion) {

            $acciones = ' <button type="button" class="btn btn-warning rounded text-light btn-sm" 
                            data-id_seccion="'.$seccion->seccion_id.'" 
                            data-seccion_descrip="'.$seccion->seccion_descrip.'"  
                            data-toggle="modal" data-target="#abrirmodalEditarSeccion">
                            <i class="fa fa-edit fa-2x"></i> Editar
                        </button>  &nbsp;';

            if($seccion->tipo_estado_id=="1"){

                $acciones .= ' <button type="button" class="btn btn-danger rounded  btn-sm" 
                                data-id_seccion="'.$seccion->seccion_id.'" 
                                data-toggle="modal" data-target="#cambiarEstado">
                                    <i class="fa fa-times fa-2x"></i> Desactivar
                                </button>';
            }else{

                $acciones .= ' <button type="button" class="btn btn-success rounded  btn-sm" 
                                data-id_seccion="'.$seccion->seccion_id.'" 
                                data-toggle="modal" data-target="#cambiarEstado">
                                    <i class="fa fa-times fa-2x"></i> Activar
                                </button>';
            }

           return $acciones;

       })->rawColumns(['afectacion','estado','acciones'])
           ->make(true);

   }


    public function store(Request $request)
    {
        $seccion= new Seccion();
        $seccion->seccion_descrip = $request->nombre;
        $seccion->afectacion = 0;
        $seccion->tipo_estado_id = 1;
        $seccion->save();  
      
        return Redirect::to("Usuarios/seccion")->with("success","Agregado exitosamente");

    }

    public function update(Request $request)
    {
        $seccion= Seccion::findOrFail($request->seccion_id);
        $seccion->seccion_descrip = $request->nombre;
        $seccion->save();   

        return Redirect::to("Usuarios/seccion")->with("success","Actualizado exitosamente");
        
    }


    public function destroy(Request $request)
    {
        $seccion= Seccion::findOrFail($request->seccion_id);
         
        if($seccion->tipo_estado_id=="1"){

               $seccion->tipo_estado_id= '0';
               $seccion->save();
               return Redirect::to("Usuarios/seccion")->with("success","Sección Desactivada");

          }else{

               $seccion->tipo_estado_id= '1';
               $seccion->save();
               return Redirect::to("Usuarios/seccion")->with("success","Sección Activada");

           }
        
    }

    public function afectacion(Request $request)
    {
        $seccion= Seccion::findOrFail($request->seccion_id);
         
        if($seccion->afectacion == 1){

               $seccion->afectacion = 0;
               $seccion->save();
               return Redirect::to("Usuarios/seccion")->with("success","Afectación Desactivada");

          }else{

               $seccion->afectacion = 1;
               $seccion->save();
               return Redirect::to("Usuarios/seccion")->with("success","Afectación Activada");

           }
        
    }


}
