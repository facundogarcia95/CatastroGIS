<?php

namespace App\Http\Controllers;

use App\TipoParcela;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class TipoDeParcelaController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Administrador');
    }

    public function index(Request $request)
    {

            return view('Administracion.Parcelas.tipo_de_parcela.index');     
       
    }


    public function datatable(Request $request){

        $tipos_parcelas = TipoParcela::orderBy('tipo_parcela_descrip','asc')->get(); 
  
       return  DataTables::of($tipos_parcelas)
       ->editColumn('accion', function(TipoParcela $tipo_parcela) {
           return '      <button type="button" class="btn btn-warning rounded text-light btn-sm" 
                            data-tipo_parcela_id="'.$tipo_parcela->tipo_parcela_id.'" 
                            data-tipo_parcela_descrip="'.$tipo_parcela->tipo_parcela_descrip.'" 
                            data-tipo_parcela_abrev="'.$tipo_parcela->tipo_parcela_abrev.'"  
                            data-toggle="modal" data-target="#editarTipoParcela">
                                <i class="fa fa-edit fa-2x"></i> Editar
                         </button> ';
       })->rawColumns(['accion'])
           ->make(true);

   }

    public function store(Request $request)
    {
        $TipoParcela = new TipoParcela();
        $TipoParcela->tipo_parcela_descrip = $request->tipo_parcela_descrip;
        $TipoParcela->tipo_parcela_abrev = $request->tipo_parcela_abrev;
        $TipoParcela->save();   
      
        return Redirect::to("Administracion/Parcelas/tipo_de_parcela")->with("success","Agregado exitosamente");

    }

    public function update(Request $request)
    {
        $TipoParcela= TipoParcela::findOrFail($request->tipo_parcela_id);
        $TipoParcela->tipo_parcela_descrip = $request->tipo_parcela_descrip;
        $TipoParcela->tipo_parcela_abrev = $request->tipo_parcela_abrev;
        $TipoParcela->save();   
        return Redirect::to("Administracion/Parcelas/tipo_de_parcela")->with("success","Actualizado exitosamente");
        
    }




}
