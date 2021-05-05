<?php

namespace App\Http\Controllers;

use App\CalculoAvaluo;
use App\TipoParcelaEstado;
use App\TipoParcelaRyB;
use App\CalculosAvaluosAuto;
use App\CalculosAvaluosImp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DataTables;

class CalculoAvaluoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Administrador');
    }

    public function index(Request $request)
    {
        $calculo_avaluo = CalculoAvaluo::get();
        $tipoparcelaestado = TipoParcelaEstado::where('tipo_estado_id','=','1')->orderBy('tipo_parcela_estado_codigo','asc')->get();
        $tipoparcelarybs = TipoParcelaRyB::orderBy('tipo_parcela_ryb_codigo','asc')->get();
        $calculosavaluosautos = CalculosAvaluosAuto::get();
        $calculosavaluosimps = CalculosAvaluosImp::get();
        return view('Administracion.Avaluo.config_calc_avaluo.index',[
            "calculo_avaluo"=>$calculo_avaluo,
            "tipoparcelaestados"=>$tipoparcelaestado,
            "tipoparcelarybs"=>$tipoparcelarybs,
            "calculosavaluosautos"=>$calculosavaluosautos,
            "calculosavaluosimps"=>$calculosavaluosimps
            ]);
    }

    public function datatable(Request $request){
        $calculo_avaluo = CalculoAvaluo::select('*')
       ->leftJoin('tipos_parcelas_ryb','calculos_avaluo.tipo_parcela_ryb_id','=','tipos_parcelas_ryb.tipo_parcela_ryb_id')
       ->leftJoin('tipos_parcelas_estados','calculos_avaluo.tipo_parcela_estado_id','=','tipos_parcelas_estados.tipo_parcela_estado_id')
       ->leftJoin('calculos_avaluos_auto','calculos_avaluo.calculo_avaluo_auto','=','calculos_avaluos_auto.calculo_avaluo_auto_id')
       ->leftJoin('calculos_avaluos_imp','calculos_avaluo.calculo_avaluo_imp','=','calculos_avaluos_imp.calculo_avaluo_imp_id')
       ->orderBy('calculo_avaluo_auto','asc')->get();

       return DataTables::of($calculo_avaluo)
        ->editColumn('parcela_ryb', function(CalculoAvaluo $calculo_avaluo) {
            return $calculo_avaluo->tipo_parcela_ryb_codigo."-".$calculo_avaluo->tipo_parcela_ryb_descrip;
        })
        ->editColumn('automatico', function(CalculoAvaluo $calculo_avaluo) {
            return $calculo_avaluo->calculo_avaluo_auto_descr;
        })
        ->editColumn('importe', function(CalculoAvaluo $calculo_avaluo) {
            return $calculo_avaluo->calculo_avaluo_imp_descr;
        })
        ->editColumn('utm', function(CalculoAvaluo $calculo_avaluo) {
            if($calculo_avaluo->calculo_avaluo_imp == 3){
                return $calculo_avaluo->tipo_parcela_utm;
            }else{
                return "";
            }
        })
        ->editColumn('fecha_desde', function(CalculoAvaluo $calculo_avaluo) {
            if($calculo_avaluo->calculo_avaluo_imp == 3){
                return \Carbon\Carbon::parse($calculo_avaluo->utm_fecha_desde)->format('d/m/Y');
            }else{
                return "";
            }
        })
        ->editColumn('fecha_hasta', function(CalculoAvaluo $calculo_avaluo) {            
            if($calculo_avaluo->calculo_avaluo_imp == 3){
                return \Carbon\Carbon::parse($calculo_avaluo->utm_fecha_hasta)->format('d/m/Y');
            }else{
                return "";
            }            
        })
        ->editColumn('parcela_estado', function(CalculoAvaluo $calculo_avaluo) {
            return $calculo_avaluo->tipo_parcela_estado_codigo."-".$calculo_avaluo->tipo_parcela_estado_descrip;
        })
        ->editColumn('edicion', function(CalculoAvaluo $calculo_avaluo) {
            $tipoparcelaryb = TipoParcelaRyB::where('tipo_parcela_ryb_id','=',$calculo_avaluo->tipo_parcela_ryb_id)->first();
            return '<button type="button" class="btn btn-warning rounded text-light btn-sm" 
                                data-calculo_avaluo_id="'.$calculo_avaluo->calculo_avaluo_id.'" 
                                data-tipo_parcela_estado_id="'.$calculo_avaluo->tipo_parcela_estado_id.'" 
                                data-tipo_parcela_ryb_id="'.$calculo_avaluo->tipo_parcela_ryb_id.'" 
                                data-calculo_avaluo_auto="'.$calculo_avaluo->calculo_avaluo_auto.'" 
                                data-calculo_avaluo_imp="'.$calculo_avaluo->calculo_avaluo_imp.'"
                                data-tipo_parcela_utm="'.$tipoparcelaryb->tipo_parcela_utm.'"
                                data-utm_fecha_desde="'.$tipoparcelaryb->utm_fecha_desde.'"
                                data-utm_fecha_hasta="'.$tipoparcelaryb->utm_fecha_hasta.'"
                                data-toggle="modal" 
                                data-target="#editarCalculoAvaluo">
                        <i class="fa fa-edit fa-2x"></i>
                    </button> ';
        })
        ->editColumn('eliminar', function(CalculoAvaluo $calculo_avaluo) {
            return '<button type="button" class="btn btn-danger rounded text-light btn-sm" 
                                data-calculo_avaluo_id="'.$calculo_avaluo->calculo_avaluo_id.'"
                                data-toggle="modal" 
                                data-target="#eliminarCalculoAvaluo">
                        <i class="fa fa-times fa-2x"></i>
                    </button> ';
        })->rawColumns(['parcela_ryb','automatico','importe','utm','fecha_desde','fecha_hasta','parcela_estado','edicion','eliminar'])
        ->make(true);
    }

    public function store(Request $request)
    {     
        $CalculoAvaluo = CalculoAvaluo::where('tipo_parcela_estado_id','=',$request->tipo_parcela_estado_id)
        ->where('tipo_parcela_ryb_id','=',$request->tipo_parcela_ryb_id)
        ->where('calculo_avaluo_auto','=',$request->calculo_avaluo_auto)
        ->where('calculo_avaluo_imp','=',$request->calculo_avaluo_imp)
        ->first();
        if($CalculoAvaluo){
            return Redirect::to("Administracion/Avaluo/config_calc_avaluo")->with("error","Ya existe el calculo de avaluo para este RyB y este estado");
        }else{
            $CalculoAvaluo = new CalculoAvaluo();
            $CalculoAvaluo->tipo_parcela_estado_id = $request->tipo_parcela_estado_id;
            $CalculoAvaluo->tipo_parcela_ryb_id = $request->tipo_parcela_ryb_id;
            $CalculoAvaluo->calculo_avaluo_auto = $request->calculo_avaluo_auto;
            $CalculoAvaluo->calculo_avaluo_imp = $request->calculo_avaluo_imp;
            $CalculoAvaluo->save();
            if($request->calculo_avaluo_imp == 3){
                $TipoParcelaRyB = TipoParcelaRyB::find($CalculoAvaluo->tipo_parcela_ryb_id);
                $TipoParcelaRyB->tipo_parcela_utm = $request->tipo_parcela_utm;
                $TipoParcelaRyB->utm_fecha_desde = $request->utm_fecha_desde;
                $TipoParcelaRyB->utm_fecha_hasta = $request->utm_fecha_hasta;
                $TipoParcelaRyB->save();
            }
            return Redirect::to("Administracion/Avaluo/config_calc_avaluo")->with("success","Agregado exitosamente");
        }
    }
        
    public function update(Request $request)
    {
        $CalculoAvaluo = CalculoAvaluo::find($request->calculo_avaluo_id);
        if($CalculoAvaluo){
            $CalculoAvaluo->tipo_parcela_estado_id = $request->tipo_parcela_estado_id;
            $CalculoAvaluo->tipo_parcela_ryb_id = $request->tipo_parcela_ryb_id;
            $CalculoAvaluo->calculo_avaluo_auto = $request->calculo_avaluo_auto;
            $CalculoAvaluo->calculo_avaluo_imp = $request->calculo_avaluo_imp;
            $CalculoAvaluo->save();
            if($request->calculo_avaluo_imp == 3){//si es VALOR FIJO actualiza RyB
                $TipoParcelaRyB = TipoParcelaRyB::find($CalculoAvaluo->tipo_parcela_ryb_id);
                if($TipoParcelaRyB){
                    $TipoParcelaRyB->tipo_parcela_utm = $request->tipo_parcela_utm;
                    $TipoParcelaRyB->utm_fecha_desde = $request->utm_fecha_desde;
                    $TipoParcelaRyB->utm_fecha_hasta = $request->utm_fecha_hasta;
                    $TipoParcelaRyB->save();
                }
            }            
            return Redirect::to("Administracion/Avaluo/config_calc_avaluo")->with("success","Actualizado exitosamente");
        }else{
            return Redirect::to("Administracion/Avaluo/config_calc_avaluo")->with("error","El registro no existe, ha sido eliminado");
        }
    }

    public function destroy(Request $request){
        //dd($request->calculo_avaluo_id);
        $CalculoAvaluo = CalculoAvaluo::find($request->calculo_avaluo_id);
        $CalculoAvaluo->delete();
        return Redirect::to("Administracion/Avaluo/config_calc_avaluo")->with("success","Registro Eliminado Exitosamente");
    }
}