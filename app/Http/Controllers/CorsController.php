<?php

namespace App\Http\Controllers;

use App\Parcela;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class CorsController extends Controller
{


      public function verificarSession(Request $request){

            if(Auth::user() != null){
            return Response::json(
                  array(
                        "session" => true
                  )
                  ,200);
            }else{
            return Response::json(
                  array(
                        "session" => false
                  )
                  ,200);
            }

      }

      public static function ultimo_padron(){

            $parcela = Parcela::select(DB::raw('MAX(parcela_padron) as parcela'));
   
            $parcela = $parcela->first();
            

            if($parcela->parcela >= 999999){
                  return null;
            }

            if($parcela->parcela) {

                  $existencia = false;
                  $padron = $parcela->parcela;

                  do{
                        $padron++;
                        $existencia = CorsController::verificarExistencia($padron);

                  }while($existencia);

                  return $padron;

            }else{

                  return null;
            }
           
      
      }

      public static function padronlibresobre200000(){
            $libre = 200000;
            for($i=$libre;true;$i++){
                  $parcela = Parcela::select(DB::raw('COUNT(parcela_id) as existe'))->where('parcela_padron','=',$i)->first();
                  if(!$parcela->existe){//si el padron no esta usado
                        return $libre;
                        break;
                  }
            }
            return $libre;
      }

      public static function verificarExistencia($padron){

            $parcela = Parcela::where('parcela_padron','=',$padron)->first();

            if($parcela){
                  return true;
            }

            return false;

      }
      
      public function web_service_padron($padron){

            $padron = Parcela::where('parcela_padron','=',$padron)->first();

            return Response::json(
                array(
                    "mensaje" => "Información del padrón",
                    "respuesta" => $padron
                )
                ,200,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);

      }
}


