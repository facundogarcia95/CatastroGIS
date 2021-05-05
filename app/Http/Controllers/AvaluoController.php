<?php

namespace App\Http\Controllers;

use App\CalculoAvaluo;
use App\Parcela;
use App\TipoParcelaRyB;
use App\Mejora;
use App\TipoCoefServ;
use App\AvaluoP;
use App\utm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use DataTables;

class AvaluoController extends Controller
{
    private $parcela_id;
    private $pe_idd;
    private $ryb_idd;
    private $cant_serv;
    private $parcela_super_mensura;
    private $lado_frente;
    private $parcela_lateral_norte;
    private $parcela_lateral_sur;
    private $parcela_lateral_este;
    private $parcela_lateral_oeste;

    public function setparcela_id($pa_id){$this->parcela_id = $pa_id;}
    public function getparcela_id(){return $this->parcela_id;}
    public function setpe_id($pe_id){$this->pe_idd = $pe_id;}
    public function getpe_id(){return $this->pe_idd;}
    public function setryb_idd($ryb_id){$this->ryb_idd = $ryb_id;}
    public function getryb_idd(){return $this->ryb_idd;}
    public function setcant_serv($c_serv){$this->cant_serv = $c_serv;}
    public function getcant_serv(){return $this->cant_serv;}
    public function setparcela_super_mensura($p_s_m){$this->parcela_super_mensura = $p_s_m;}
    public function getparcela_super_mensura(){return $this->parcela_super_mensura;}
    public function setlado_frente($l_f){$this->lado_frente = $l_f;}
    public function getlado_frente(){return $this->lado_frente;}
    public function setparcela_lateral_norte($p_l_n){$this->parcela_lateral_norte = $p_l_n;}
    public function getparcela_lateral_norte(){return $this->parcela_lateral_norte;}
    public function setparcela_lateral_sur($p_l_s){$this->parcela_lateral_sur = $p_l_s;}
    public function getparcela_lateral_sur(){return $this->parcela_lateral_sur;}
    public function setparcela_lateral_este($p_l_e){$this->parcela_lateral_este = $p_l_e;}
    public function getparcela_lateral_este(){return $this->parcela_lateral_este;}
    public function setparcela_lateral_oeste($p_l_o){$this->parcela_lateral_oeste = $p_l_o;}
    public function getparcela_lateral_oeste(){return $this->parcela_lateral_oeste;}


    public function getall(){
        $arreglo = [
            $this->parcela_id,
            $this->pe_idd,
            $this->ryb_idd,
            $this->cant_serv,
            $this->parcela_super_mensura,
            $this->lado_frente,
            $this->parcela_lateral_norte,
            $this->parcela_lateral_sur,
            $this->parcela_lateral_este,
            $this->parcela_lateral_oeste
        ];
        return $arreglo;
    }

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Administrador');
    }

    public function precarga_avaluo($parcela_id)
    {   
        $parcela = Parcela::where("parcela_id","=",$parcela_id)->first();
        if($parcela){
            $pe_id = $parcela->tipo_parcela_estado_id;
            $ryb_id = $parcela->tipo_parcela_ryb_id;
            $parcela_super_mensura = $parcela->parcela_super_mensura;
            $lado_frente = $parcela->parcela_lado_frente;
            $parcela_lateral_norte = $parcela->parcela_lateral_norte;
            $parcela_lateral_sur = $parcela->parcela_lateral_sur;
            $parcela_lateral_este = $parcela->parcela_lateral_este;
            $parcela_lateral_oeste = $parcela->parcela_lateral_oeste;
            $cantser = count($parcela->servicios());
            $this->setparcela_id($parcela_id);            
            $this->setpe_id($pe_id);
            $this->setryb_idd($ryb_id);            
            $this->setcant_serv($cantser);            
            $this->setparcela_super_mensura($parcela_super_mensura);            
            $this->setlado_frente($lado_frente);            
            $this->setparcela_lateral_norte($parcela_lateral_norte);            
            $this->setparcela_lateral_sur($parcela_lateral_sur);            
            $this->setparcela_lateral_este($parcela_lateral_este);            
            $this->setparcela_lateral_oeste($parcela_lateral_oeste);
            return true;
        }else{
            return false;
        }
    }
    public function avaluo_js($utm_valor)
    {
        if(!$utm_valor){//sino tiene valor, buscar el ultimo
            $utm = utm::where('tipo_estado_id','=',1)->first();
            $utm_valor = $utm->utm_valor;
        }

        $calculoavaluo = CalculoAvaluo::whereRaw('tipo_parcela_estado_id = ? AND tipo_parcela_ryb_id = ?',[$this->pe_idd,$this->ryb_idd])->first();
        $calculo_avaluo_imp = $calculoavaluo->calculo_avaluo_imp;
        $calculo_avaluo_auto = $calculoavaluo->calculo_avaluo_auto;
        if(!$calculo_avaluo_imp) $calculo_avaluo_imp = 1;
        if(!$calculo_avaluo_auto) $calculo_avaluo_auto = 1;
        $aval = $this->avaluo(  $this->parcela_id,
                                $this->pe_idd,
                                $this->ryb_idd,
                                $calculo_avaluo_imp,
                                $calculo_avaluo_auto,
                                $this->cant_serv,
                                $this->parcela_super_mensura,
                                $this->lado_frente,
                                $this->parcela_lateral_norte,
                                $this->parcela_lateral_sur,
                                $this->parcela_lateral_este,
                                $this->parcela_lateral_oeste);

        $impoutm = $this->importe( $calculo_avaluo_imp,
                                    $aval,
                                    $this->ryb_idd,
                                    $utm_valor
                                );

        $valor = $impoutm['pesos'];
        $utm = $impoutm['utm'];

        $parcela = Parcela::where('parcela_id','=',$this->parcela_id)->first();
        $valorv = $parcela->parcela_avaluo_imp;
        $utmparcela = $parcela->parcela_avaluo_utm;
        $avaluov = $parcela->parcela_avaluo;

        if(number_format($valorv,2,',','.') <> number_format($valor,2,',','.')){
            $dif['dif']="SI";
        }else{
            $dif['dif']="NO";
        }

        if($this->pe_idd == 19){
            $tipoparcelaryb = TipoParcelaRyB::where('tipo_parcela_ryb_id','=',$this->ryb_idd)->first();
            $coef_b = $tipoparcelaryb->normal_coeficiente;
            $utm_b = $tipoparcelaryb->normal_utm;
            $pesos_b = $tipoparcelaryb->normal_pesos;
            $dif['calculado']=$valor*$pesos_b;
            $dif['grabado']=$valorv*$pesos_b;	
            $dif['calculadoa']=$aval*$coef_b;
            $dif['grabadoa']=$avaluov*$coef_b;
            $dif['calculadob']=$utm*$utm_b;
            $dif['grabadob']=$utmparcela*$utm_b;
        }else{
            $dif['calculado']=0;	
            $dif['grabado']=0;	
            $dif['calculadoa']=0;	
            $dif['grabadoa']=0;	
            $dif['calculadob']=0;	
            $dif['grabadob']=0;	
        }
        $diff = json_encode($dif);

        return $diff;
    }

    public function avaluo( $parcela_id,$pe_idd,$ryb_idd,$calculo_avaluo_imp,$calculo_avaluo_auto,$cant_serv,$parcela_super_mensura,$lado_frente,$parcela_lateral_norte,$parcela_lateral_sur,$parcela_lateral_este,$parcela_lateral_oeste)
    {
        
        $mejora = Mejora::leftJoin('tipos_mejoras_categorias', 'tipos_mejoras_categorias.tipo_mejora_categoria_id', '=', 'mejoras.tipo_mejora_categoria_id')
        ->whereRaw('mejoras.parcela_id = ? AND (mejoras.tipo_estado_id = ? OR mejoras.tipo_estado_id IS NULL) AND tipos_mejoras_categorias.tipo_mejora_categoria_codigo = ?',[$parcela_id,1,11])
        ->get();
        
        $ph = count($mejora);
        $valor = 0;
        if($calculo_avaluo_auto == 1){
            // es ph
            if($ph){//si tiene mejora en ph
                $mejoras = Mejora::leftJoin('parcelas', 'parcelas.parcela_id', '=', 'mejoras.parcela_id')
                ->leftJoin('tipos_mejoras_categorias', 'tipos_mejoras_categorias.tipo_mejora_categoria_id', '=', 'mejoras.tipo_mejora_categoria_id')
                ->whereRaw('mejoras.parcela_id = ? AND (mejoras.tipo_estado_id = ? OR mejoras.tipo_estado_id IS NULL)',[$parcela_id,1])
                ->groupBy('mejoras.parcela_id')
                ->get([
                    DB::raw('sum(mejoras.mejora_sup_cub * tipos_mejoras_categorias.tipo_mejora_categoria_coeficiente) AS mej'),
                    DB::raw('mejoras.mejora_sup_cub AS mejora_sup_cub'),
                    DB::raw('tipos_mejoras_categorias.tipo_mejora_categoria_coeficiente AS tipo_mejora_categoria_coeficiente'),
                    DB::raw('tipos_mejoras_categorias.tipo_mejora_categoria_codigo AS tipo_mejora_categoria_codigo'),
                    DB::raw('tipos_mejoras_categorias.tipo_mejora_categoria_descrip AS tipo_mejora_categoria_descrip'),
                    DB::raw('mejoras.mejora_porc_dominio AS mejora_porc_dominio'),
                    DB::raw('mejora_sup_comun_ph'),
                    DB::raw('SUM(((mejora_sup_comun_ph * mejora_porc_dominio * tipo_mejora_categoria_coeficiente) / 100)) AS valor2'),
                    DB::raw('SUM(((parcelas.parcela_super_mensura * mejora_porc_dominio * tipo_mejora_categoria_coeficiente) / 100)) AS valor1')
                    ]
                );
                $valor1 = 0;
                $valor2 = 0;
                foreach($mejoras as $mejora){
                    $valor1 = $mejora->valor1;
                    $valor2 = $mejora->valor2;
                }
                $valor = $valor1 + $valor2;
            }else{
                $tipocoefserv = TipoCoefServ::where('tipo_coef_serv_cant','=',$cant_serv)->first();
                if($tipocoefserv){
                    $coef =$tipocoefserv->tipo_coef_serv_coef;
                    $valor = $parcela_super_mensura * $coef;
                    $mejoras = Mejora::leftJoin('tipos_mejoras_categorias', 'tipos_mejoras_categorias.tipo_mejora_categoria_id', '=', 'mejoras.tipo_mejora_categoria_id')
                    ->whereRaw('mejoras.parcela_id = ? AND (mejoras.tipo_estado_id = ? OR mejoras.tipo_estado_id IS NULL)',[$parcela_id,1])
                    ->groupBy('mejoras.parcela_id')
                    ->get([
                        DB::raw('sum(mejoras.mejora_sup_cub * tipos_mejoras_categorias.tipo_mejora_categoria_coeficiente) AS mej'),
                        DB::raw('mejoras.mejora_sup_cub AS mejora_sup_cub'),
                        DB::raw('tipos_mejoras_categorias.tipo_mejora_categoria_coeficiente AS tipo_mejora_categoria_coeficiente'),
                        DB::raw('tipos_mejoras_categorias.tipo_mejora_categoria_codigo AS tipo_mejora_categoria_codigo'),
                        DB::raw('tipos_mejoras_categorias.tipo_mejora_categoria_descrip AS tipo_mejora_categoria_descrip')
                        ]
                    );
                    foreach($mejoras as $mejora){
                        $valor = $valor + $mejora->mej;
                    }
                    $valor = round ($valor,2);
                }
            }
        }
        return $valor;
    }

    public function importe($calculo_avaluo_imp,$coeficiente,$ryb_idd,$utm_valor)
    {
        //calcula el IMPORTE con los datos recividos
        //if ($calculo_avaluo_imp == 2) $utm = 0; // no calcular
        $utm = 0;
        if ($calculo_avaluo_imp == 1){            
            $tipooarcelaryb = TipoParcelaRyB::where('tipo_parcela_ryb_id','=',$ryb_idd)->first();
            if($tipooarcelaryb){
                $tipo = $tipooarcelaryb->tipo_parcela_ryb_tipo;
            }else{
                $tipo = "";
            }
            $coeficiente = round($coeficiente,0);
            if ($tipo == "ED") {
                $avaluop = AvaluoP::whereRaw("avaluo_p.minimo <= ? AND avaluo_p.maximo >= ? AND avaluo_p.tipo_estado_id = ?",[$coeficiente,$coeficiente,1])->first();
                if($avaluop){
                    $utm = $avaluop->ED_TOTAL;
                }
            }
            if ($tipo == "BSC") {
                $avaluop = AvaluoP::whereRaw("avaluo_p.minimo <= ? AND avaluo_p.maximo >= ? AND avaluo_p.tipo_estado_id = ?",[$coeficiente,$coeficiente,1])->first();
                if($avaluop){
                    $utm = $avaluop->SC_TOTAL;
                }
            } 
            if ($tipo == "BCC") {
                $avaluop = AvaluoP::whereRaw("avaluo_p.minimo <= ? AND avaluo_p.maximo >= ? AND avaluo_p.tipo_estado_id = ?",[$coeficiente,$coeficiente,1])->first();
                if($avaluop){
                    $utm = $avaluop->CC_TOTAL;
                }
            }		
            if ($tipo == "CUL") {
                $avaluop = AvaluoP::whereRaw("avaluo_p.minimo <= ? AND avaluo_p.maximo >= ? AND avaluo_p.tipo_estado_id = ?",[$coeficiente,$coeficiente,1])->first();
                if($avaluop){
                    $utm = $avaluop->CU_TOTAL;
                }                
            }
        }elseif($calculo_avaluo_imp == 3){
            $tipooarcelaryb = TipoParcelaRyB::where('tipo_parcela_ryb_id','=',$ryb_idd)->first();
            if($tipooarcelaryb){
                $utm = $tipooarcelaryb->tipo_parcela_utm;
            }
        }
        if($utm_valor){
            $valorutm = $utm_valor;
        }else{
            $valorutm = 0;
        }        
        $importea['utm']=$utm;	
        $importea['pesos']=($valorutm * $utm);	
        $importea['pesosutm']=$valorutm;	

        return $importea;
    }
}