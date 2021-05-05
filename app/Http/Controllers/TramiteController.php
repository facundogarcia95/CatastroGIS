<?php

namespace App\Http\Controllers;

use App\Tramite;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;



class TramiteController extends Controller
{

   public function __construct()
   {
       $this->middleware('auth');

   }

   public function index(Request $request)
   {           
        return view('gestion.padron.tramites.index');  
   }

   public function datatable(Request $request){

      $tramites = Tramite::where('parcela_id','=',$request->parcela_id)->orderBy('tramite_id','DESC')->get();

      return  DataTables::of($tramites)
      ->editColumn('id', function(Tramite $tramite) {
         return $tramite->tramite_id;
      })    
      ->editColumn('fecha', function(Tramite $tramite) {
           return Carbon::parse($tramite->tramite_fecha_exp)->format('d/m/Y');
      })
      ->editColumn('nro_exp', function(Tramite $tramite) {
           return $tramite->tramite_nro_exp;
      })
      ->editColumn('letra_exp', function(Tramite $tramite) {
           return $tramite->tramite_letra_exp;
      })->editColumn('tipo_tramite', function(Tramite $tramite) {
           return $tramite->tipo_tramite->tipo_tramite_descrip;
      })->editColumn('estado', function(Tramite $tramite) {
           if($tramite->tipo_estado_id == 1){
                return "<label class='text-success'>".$tramite->estado->tipo_estado_descrip."</label>";
           }else{
               return "<label class='text-danger'>".$tramite->estado->tipo_estado_descrip."</label>";
           }
      })->editColumn('usuario', function(Tramite $tramite) {
         if(empty($tramite->usuario)){
            return 'SIN USUARIO';
         }else{
            return $tramite->usuario->usuario_nombre;
         }
      })->editColumn('observacion', function(Tramite $tramite) {
      return $tramite->tramite_observacion;

      })->rawColumns(['id','fecha','nro_exp','letra_exp','tipo_tramite','estado','usuario','observacion'])
      ->make(true);

   }

   public function store(Request $request)
   {   
      $this->middleware('Operador');

      $this->validate($request,[
         'parcela_id' => 'required',
         'tramite_fecha_exp' => 'required',
         'tipo_tramite' => 'required',
         'tramite_nro_exp' => 'required'
     ]);


     $tramite = new Tramite();
     $tramite->parcela_id = $request->parcela_id;
     $tramite->tramite_fecha_exp = $request->tramite_fecha_exp;
     $tramite->tipo_tramite_id = $request->tipo_tramite;
     $tramite->tramite_nro_exp = $request->tramite_nro_exp;
     $tramite->tramite_letra_exp = $request->tramite_letra_exp;
     $tramite->tramite_superficie = $request->tramite_superficie;
     $tramite->tramite_f_alta = now();
     $tramite->usuario_id = Auth::user()->usuario_id;
     $tramite->tipo_estado_id = 1;
     $tramite->save();

     session(['redirectElement' => 'tramites']);

     return back()->with("success","Trámite agregado exitosamente");

   }

   public function update(Request $request)
   {
   }

   public function destroy(Request $request)
   {
   }


}