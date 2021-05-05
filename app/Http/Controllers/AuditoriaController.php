<?php

namespace App\Http\Controllers;

use App\Auditoria;
use App\AuditoriaTipo;
use App\Parcela;
use Illuminate\Http\Request;
use App\User;
use DateTime;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use DB;

class AuditoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Administrador');
        ini_set('memory_limit', -1);

    }

    public function index(Request $request)
    {    

        $query = Auditoria::orderBy('auditoria_fecha','desc');
      
        if($request->fechaDesde){ 
            $date = date_create($request->fechaDesde);
            date_add($date, date_interval_create_from_date_string('1 days'));
            date_format($date,'Y-m-d');
            $query->where('auditoria_fecha','>=', $date);
        }
        if($request->fechaHasta){
            $date = date_create($request->fechaHasta);
            date_add($date, date_interval_create_from_date_string('1 days'));
            date_format($date,'Y-m-d');
            $query->where('auditoria_fecha','<=', $date);
        }


        if($request->usuarios) $query->where('usuario_id', $request->usuarios);  
        if($request->tipo) $query->where('aud_tip_id', $request->tipo);  
        if($request->padron){
            
            $parcela = Parcela::where('parcela_padron','=',$request->padron)->first();
            
            if($parcela){
                $parcela_id = $parcela->parcela_id;                
                $query->where('auditoria_registro_id', $parcela_id);  
                $query->where('auditoria_tabla', 'parcelas');  
            }
        }
        if($request->relevantes){
            $query->where('aud_tip_id','!=',1)->where('aud_tip_id','!=',2)->where('aud_tip_id','!=',6);
        }
        $auditorias = $query->paginate(10);

        $usuarios = User::get();
        $tipos = AuditoriaTipo::get();

        return view('auditorias.index',["auditorias"=>$auditorias, "usuarios"=>$usuarios, "tipos"=>$tipos]);       

    }
}