<?php

namespace App\Http\Controllers;

use App\Parcela;
use App\UnionDesglose;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;

class unionDesgloseController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Operador');
        ini_set('memory_limit', -1);
        set_time_limit(-1);
    }


    public function union(Request $request)
    {
        //dd(session()->all());
        return view('gestion.union.index');
    }

    public function desglose(Request $request)
    {
        return view('gestion.desglose.index');
    }

    public function agregarUnion(Request $request){

        $parcela_origen = Parcela::find($request->parcela_origen_id);
        $duplicidad = UnionDesglose::where('parcela_id','=',$request->parcela_origen_id)
        ->where('parcela_destino_id','=',$request->parcela_id)->first();

        if($duplicidad){
            return back()->with('error','El padrón seleccionado ya está asosiado como Origen.');
        }

        if($parcela_origen){

            $union = new UnionDesglose();
            $union->parcela_id = $request->parcela_origen_id;
            $union->parcela_destino_id = $request->parcela_id;
            $union->tipo_union_desglose_id = 1;
            $union->union_desglose_fecha = date("Y-m-d H:i:s");
            $union->usuarios_id = Auth::user()->usuario_id;
            $union->save();

            if($union){
                return back()->with('success','Origen agregado exitosamente');
            }else{
                return back()->with('error','No se pudo agregar el Origen seleccionada al padrón');
            }

        }
    }

    public function quitarUnion(Request $request){

        $parcela = UnionDesglose::where('parcela_id','=',$request->origen)->where('parcela_destino_id','=',$request->parcela)->first()->delete();
        
      
        if($parcela>0){
            return back()->with('success','Origen quitado exitosamente');
        }else{
            return back()->with('error','No pudimos quitar el Origen seleccionado');
        }
    }

    public function agregarDestino(Request $request){

        $parcela_destino = Parcela::find($request->parcela_destino_id);
        
        $duplicidad = UnionDesglose::where('parcela_id','=',$request->parcela_id)
        ->where('parcela_destino_id','=',$request->parcela_destino_id)->first();

        if($duplicidad){
            return back()->with('error','El padrón seleccionado ya está asosiado como Destino.');
        }

        if($parcela_destino){

            $destino = new UnionDesglose();
            $destino->parcela_id = $request->parcela_id;
            $destino->parcela_destino_id = $request->parcela_destino_id;
            $destino->tipo_union_desglose_id = 2;
            $destino->union_desglose_fecha = date("Y-m-d H:i:s");
            $destino->usuarios_id = Auth::user()->usuario_id;
            $destino->save();

            if($destino){
                return back()->with('success','Destino agregado exitosamente');
            }else{
                return back()->with('error','No se pudo agregar el Destino seleccionada al padrón');
            }

        }

    }

    public function quitarDestino(Request $request){

        $parcela = UnionDesglose::where('parcela_id','=',$request->parcela)->where('parcela_destino_id','=',$request->destino)->first()->delete();
        
        if($parcela>0){
            return back()->with('success','Destino quitado exitosamente');
        }else{
            return back()->with('error','No pudimos quitar el Destino seleccionado');
        }
    }

}







