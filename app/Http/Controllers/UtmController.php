<?php

namespace App\Http\Controllers;

use App\utm;
use App\Parcela;
use App\CalculoAvaluo;
use App\AvaluoTiempos;
use App\Http\Controllers\AvaluoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Http;
use DataTables;

class UtmController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Administrador');
    }

    public function index(Request $request)
    {
        $avaluotiempos = AvaluoTiempos::first([DB::raw('MAX(avaluo_tiempo_min_trans) AS tiempo')]);
        $utms = utm::orderBy("utm_fecha_ini","desc")->get();
        return view('Administracion.Avaluo.config_utm.index',["utms"=>$utms,"tiempo_estimado"=>$avaluotiempos->tiempo]);
    }

    public function datatable(Request $request){
        $utm = utm::select('*')
        ->leftJoin('tipos_estados','utm.tipo_estado_id','=','tipos_estados.tipo_estado_id')->get();
        return DataTables::of($utm)
        ->editColumn('fecha_desde', function(utm $utm){
            if($utm->utm_fecha_ini){
                return \Carbon\Carbon::parse($utm->utm_fecha_ini)->format('d/m/Y');
            }else{
                return "";
            }
        })
        ->editColumn('fecha_hasta', function(utm $utm) {     
            if($utm->utm_fecha_fin){
                return \Carbon\Carbon::parse($utm->utm_fecha_fin)->format('d/m/Y');
            }else{
                return "";
            }
        })
        ->editColumn('valor', function(utm $utm) {
            return $utm->utm_valor;
        })
        ->editColumn('estado', function(utm $utm) {
            return $utm->tipo_estado_descrip;
        })
        ->rawColumns(['fecha_desde','fecha_hasta','valor','estado'])->make(true);
    }

    public function store(Request $request)
    {
        //actualiza el ultimo activo
        $utm_fecha_ini = $request->utm_fecha_ini;
        $utms = utm::where('tipo_estado_id','=','1')->get();
        foreach($utms as $utm){
            $utm_update = utm::where('utm_id','=',$utm->utm_id)->first();
            $utm_update->utm_fecha_fin = date("Y-m-d", strtotime("$utm_fecha_ini -1 day"));//fin para el ultimo registro activo que se da de baja en día antes del inicio del nuevo
            $utm_update->tipo_estado_id = 2;
            $utm_update->save();
        }
        $utm = new utm();
        $utm->utm_fecha_ini = $request->utm_fecha_ini;
        $utm->utm_valor = $request->utm_valor;
        $utm->tipo_estado_id = 1;
        $utm->save();
        return Redirect::to("Administracion/Avaluo/config_utm")->with("success","Actualizado exitosamente");
    }
        
    public function update(Request $request)
    {        
        $utm = utm::where('utm_id','=',$request->utm_id)->first();
        $date = \Carbon\Carbon::now();
        $parcelas = Parcela::whereRaw('tipo_parcela_estado_id = ? AND (tipo_parcela_ryb_id = ? OR tipo_parcela_ryb_id = ? OR tipo_parcela_ryb_id = ?)', [19,5,6,7])->get();
        $cantidad_parcelas = count($parcelas);
        foreach($parcelas as $parcela){
            $parcela_id = $parcela->parcela_id;
            /*
            //--------------------------VERSION CON LLAMADA A URL-----------------------------------
            $pe_id = $parcela->tipo_parcela_estado_id;
            $ryb_id = $parcela->tipo_parcela_ryb_id;
            $parcela_super_mensura = $parcela->parcela_super_mensura;
            $lado_frente = $parcela->parcela_lado_frente;
            $parcela_lateral_norte = $parcela->parcela_lateral_norte;
            $parcela_lateral_sur = $parcela->parcela_lateral_sur;
            $parcela_lateral_este = $parcela->parcela_lateral_este;
            $parcela_lateral_oeste = $parcela->parcela_lateral_oeste;
            $parcela_avaluo = floatval($parcela->parcela_avaluo);
            if(!$parcela_avaluo){
                $parcela_avaluo = 0;
            }
            $cantser = count($parcela->servicios());           
            $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $url = explode("Administracion", $url);
            $url = $url[0].'avaluo_js?parcela_id=' . $parcela_id . "&pe_id=" . $pe_id . "&ryb_id=" . $ryb_id . "&cantser=" . $cantser . "&parcela_super_mensura=" . $parcela_super_mensura . "&lado_frente=" . $lado_frente . "&parcela_lateral_norte=" . $parcela_lateral_norte . "&parcela_lateral_sur=" . $parcela_lateral_sur . "&parcela_lateral_este=" . $parcela_lateral_este . "&parcela_lateral_oeste=" . $parcela_lateral_oeste;
            $client = new \GuzzleHttp\Client();
            //$response = $client->request('GET', $url, ['query' => 'parcela_id=3']);
            //$response = $client->request('GET', $url);
            $response = $client->get('http://echo.jsontest.com/key/value/one/two');
            $request = $response->getBody();        
            //---------------------------------------------------------------------------------------
            */
            $AvaluoController = new AvaluoController();
            $AvaluoController->precarga_avaluo($parcela_id);
            $output = json_decode($AvaluoController->avaluo_js($utm->utm_valor), true);
            $output_parcela_avaluo = floatval($output["calculadoa"]);
            $output_parcela_avaluo_utm = $output["calculadob"];
            $output_parcela_avaluo_imp = $output["calculado"];
            
            if($output_parcela_avaluo > 0 && $output_parcela_avaluo && $output_parcela_avaluo_utm && $output_parcela_avaluo_imp && $parcela_id){
                $parcela_update = Parcela::where("parcela_id","=",$parcela_id)->first();
                $parcela_update->parcela_avaluo = $output_parcela_avaluo;
                $parcela_update->parcela_avaluo_utm = $output_parcela_avaluo_utm;
                $parcela_update->parcela_avaluo_imp = $output_parcela_avaluo_imp;
                $parcela_update->save();
            }
        }

        //calcula el valor en $
        //en codecharge trae el activo, al listbox no le interesa
        //$valor = CCDLookUp("utm_valor","utm","utm.tipo_estado_id = 1",$dba3);

        //PARA VALORES FIJOS
        $calculoavaluos = CalculoAvaluo::join("parcelas",function($join){
            $join->on("parcelas.tipo_parcela_ryb_id","=","calculos_avaluo.tipo_parcela_ryb_id")
                ->on("parcelas.tipo_parcela_estado_id","=","calculos_avaluo.tipo_parcela_estado_id");
        })
        ->join('tipos_parcelas_ryb','tipos_parcelas_ryb.tipo_parcela_ryb_id','=','parcelas.tipo_parcela_ryb_id')
        ->whereRaw('calculos_avaluo.calculo_avaluo_imp = ? AND parcelas.tipo_parcela_estado_id = ? AND tipos_parcelas_ryb.tipo_parcela_utm IS NOT NULL',[3,19])
        ->get([DB::raw('parcelas.parcela_id AS parcela_id'),DB::raw('tipos_parcelas_ryb.tipo_parcela_utm AS utm_actual')]);
        foreach($calculoavaluos as $calculoavaluo){
            if(intval($calculoavaluo->utm_actual) > 0){		
                $importe = intval($calculoavaluo->utm_actual) * $utm->utm_valor;
                if($importe){
                    $parcela_update = Parcela::where("parcela_id","=",$calculoavaluo->parcela_id)->first();
                    $parcela_update->parcela_avaluo_imp = $importe;
                    $parcela_update->save();
                }
            }
        }       
        
        //PARA VALORES EN SI
        $calculoavaluos = CalculoAvaluo::join("parcelas",function($join){
            $join->on("parcelas.tipo_parcela_ryb_id","=","calculos_avaluo.tipo_parcela_ryb_id")
                ->on("parcelas.tipo_parcela_estado_id","=","calculos_avaluo.tipo_parcela_estado_id");
        })
        ->join('tipos_parcelas_ryb','tipos_parcelas_ryb.tipo_parcela_ryb_id','=','parcelas.tipo_parcela_ryb_id')
        ->whereRaw('calculos_avaluo.calculo_avaluo_imp = ? AND parcelas.tipo_parcela_estado_id = ? AND tipos_parcelas_ryb.tipo_parcela_utm IS NOT NULL',[1,19])
        ->get([DB::raw('parcelas.parcela_id AS parcela_id'),DB::raw('IF(tipos_parcelas_ryb.tipo_parcela_utm = 0,parcelas.parcela_avaluo_utm,tipos_parcelas_ryb.tipo_parcela_utm) AS utm_actual')]);
        foreach($calculoavaluos as $calculoavaluo){
            if(intval($calculoavaluo->utm_actual) > 0){		
                $importe = intval($calculoavaluo->utm_actual) * $utm->utm_valor;
                if($importe){
                    $parcela_update = Parcela::where("parcela_id","=",$calculoavaluo->parcela_id)->first();
                    $parcela_update->parcela_avaluo_imp = $importe;
                    $parcela_update->save();
                }
            }
        }
        
        $now = \Carbon\Carbon::now();        
        $diff = $date->diffForHumans($now);     
        $diff_min = $date->diffInMinutes($now);
        $diff = str_replace("antes","",$diff);

        $avaluotiempos = new AvaluoTiempos();
        $avaluotiempos->avaluo_tiempo_cant_parcelas = $cantidad_parcelas;
        $avaluotiempos->avaluo_tiempo_min_trans = $$diff_min;
        $avaluotiempos->avaluo_tiempo_fecha = date('Y-m-d H:i:s');
        $avaluotiempos->save();

        return Redirect::to("Administracion/Avaluo/config_utm")->with("success","Actualizado exitosamente | Tiempo transcurrido: $diff");
    }
}