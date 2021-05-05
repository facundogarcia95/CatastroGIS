<?php

namespace App\Http\Controllers;

use App\TipoProfesional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
USE Yajra\DataTables\DataTables;

class TipoDeProfesionalController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Administrador');
    }

    public function index(Request $request)
    {


            return view('Administracion.Parcelas.tipo_de_profesional.index');
       
    }

    public function datatable(Request $request){

        $tipos_profesionales = TipoProfesional::orderBy('tipo_profesional_descrip','asc')->get(); 
  
       return  DataTables::of($tipos_profesionales)
       ->editColumn('accion', function(TipoProfesional $tipo_profesional) {
           return ' <button type="button" class="btn btn-warning rounded text-light btn-sm" 
                        data-tipo_profesional_id="'.$tipo_profesional->tipo_profesional_id.'" 
                        data-tipo_profesional_descrip="'.$tipo_profesional->tipo_profesional_descrip.'" 
                        data-tipo_profesional_abrev="'.$tipo_profesional->tipo_profesional_abrev.'"  
                        data-toggle="modal" data-target="#editarTipoProfesional">
                            <i class="fa fa-edit fa-2x"></i> Editar
                    </button>';
       })->rawColumns(['accion'])
           ->make(true);

   }

    public function store(Request $request)
    {
        $TipoProfesional = new TipoProfesional();
        $TipoProfesional->tipo_profesional_descrip = $request->tipo_profesional_descrip;
        $TipoProfesional->tipo_profesional_abrev = $request->tipo_profesional_abrev;
        $TipoProfesional->save();   
      
        return Redirect::to("Administracion/Parcelas/tipo_de_profesional")->with("success","Agregado exitosamente");

    }

    public function update(Request $request)
    {
        $TipoProfesional= TipoProfesional::findOrFail($request->tipo_profesional_id);
        $TipoProfesional->tipo_profesional_descrip = $request->tipo_profesional_descrip;
        $TipoProfesional->tipo_profesional_abrev = $request->tipo_profesional_abrev;
        $TipoProfesional->save();   
        return Redirect::to("Administracion/Parcelas/tipo_de_profesional")->with("success","Actualizado exitosamente");
        
    }




}
