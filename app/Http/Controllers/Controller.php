<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Bloqueo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function GetIPRemote()
   {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
          $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
          $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
   }

   public function audit_string()
   {
        return $this->CCGetUserID()."|".$this->GetIPRemote()."|".Route::currentRouteName();
   }
   
   public function CCGetUserID()
   {
        return Auth::user()->usuario_id;
   }

   public function CCGetUserNombre()
   {
        return Auth::user()->usuario_nombre;
   }

   public function CCGetGroupID()
   {
        return Auth::user()->idrol;
   }

   public function protocolo()
   {
     if(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
          return 'https://';
     }else{
          return 'http://';
     }
   }

   public function bloqueoPadron($parcela_id)
   {                 
          $bloqueo_otro = Bloqueo::select('usuario_nombre')->leftJoin('usuarios','uso_session.usuario_id','=','usuarios.usuario_id')->where('parcela_id','=',$parcela_id)->where('uso_session.usuario_id','<>',$this->CCGetUserID())->first('usuario_nombre');
          $bloqueo_yo = Bloqueo::select('usuario_nombre')->leftJoin('usuarios','uso_session.usuario_id','=','usuarios.usuario_id')->where('parcela_id','=',$parcela_id)->where('uso_session.usuario_id','=',$this->CCGetUserID())->first('usuario_nombre');
          ($bloqueo_otro)? $existe_otro = true: $existe_otro = false;
          ($bloqueo_yo)? $existe_yo = true: $existe_yo = false;
          $usuario_bloqueo = "(<font color='blue'><b>LIBRE</b></font>)";//esto no beria aparecer, ya que cuando se consulta debe estar bloquedado
          $bloquear = false;
          if($existe_otro && !$existe_yo){//bloquedo por otra persona
               $usuario_bloqueo = "Padron en uso por <font color='red'><b>".$bloqueo_otro->usuario_nombre."</b></font>";
               $bloquear = true;
          }elseif(!$existe_otro && $existe_yo){//bloquedo por mi
               //$usuario_bloqueo = "<font color='green'><b>".$bloqueo_yo->usuario_nombre."</b></font>";
               $usuario_bloqueo = "";
          }
          $retorno = array('usuario' => $usuario_bloqueo, 'bloquear' => $bloquear );//usar bloqueo solo para usuarios del rol operador, el de consulta ni debe modificar
          return $retorno;
   }
}