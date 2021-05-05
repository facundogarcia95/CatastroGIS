<?php

namespace App\Observers;

use App\Auditoria;
use App\Http\Controllers\Controller;
use App\Mejora;
use App\Parcela;
use App\Events\ModificarPH;
use App\UnionDesglose;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ParcelaAuditoria
{
    
    
     /**
     * Handle the parcela "created" event.
     *
     * @param  \App\Parcela  $parcela
     * @return void
     */
    public static function show(Parcela $parcela)
    {
        $registro = Auditoria::where('usuario_id','=',Auth::user()->usuario_id)
        ->where('auditoria_registro_id','=',$parcela->parcela_id)
        ->where('auditoria_script','=','gestion/padron/{padron}')
        ->where('auditoria_fecha','LIKE', Carbon::now()->format('Y-m-d').'%')
        ->first();

        if(empty($registro)){

            $auditoria = new Auditoria();
            $auditoria->auditoria_script = request()->route()->uri(); 
            $auditoria->auditoria_host = Controller::GetIPRemote();
            $auditoria->aud_tip_id = 6;
            $auditoria->usuario_id = Auth::user()->usuario_id;
            $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
            $auditoria->auditoria_tabla = 'parcelas';
            $auditoria->auditoria_registro_id = $parcela->parcela_id;
            $auditoria->auditoria_descripcion = 'Acceso al Padrón';
            $auditoria->auditoria_detalle_old = null;
            $auditoria->auditoria_detalle_new = json_encode(array("parcela_id"=>$parcela->parcela_id,"padron"=>$parcela->parcela_padron));
            $auditoria->save();
            
        }else{

            $registro->auditoria_fecha = date("Y-m-d H:i:s");
            $registro->save();
            
        }
    }


    public static function reporte(Parcela $parcela){

        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 6;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'parcelas';
        $auditoria->auditoria_registro_id = $parcela->parcela_id;
        $auditoria->auditoria_descripcion = 'Generación de reporte';
        $auditoria->auditoria_detalle_old = null;
        $auditoria->auditoria_detalle_new = json_encode(array("parcela_id"=>$parcela->parcela_id,"padron"=>$parcela->parcela_padron));
        $auditoria->save();
        
    }


    /**
     * Handle the parcela "created" event.
     *
     * @param  \App\Parcela  $parcela
     * @return void
     */
    public function created(Parcela $parcela)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 3;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'parcelas';
        $auditoria->auditoria_registro_id = $parcela->parcela_id;
        $auditoria->auditoria_descripcion = 'Creación de Padrón';
        $auditoria->auditoria_detalle_old = null;
        $auditoria->auditoria_detalle_new = json_encode($parcela->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the parcela "updated" event.
     *
     * @param  \App\Parcela  $parcela
     * @return void
     */
    public function updating(Parcela $parcela)
    {
          
            $datos_old = $parcela->getOriginal();
            $datos_new = $parcela->getAttributes();

            unset($datos_old["geom"]);
            unset($datos_new["geom"]);

            $auditoria = new Auditoria();
            $auditoria->auditoria_script = request()->route()->uri(); 
            $auditoria->auditoria_host = Controller::GetIPRemote();
            $auditoria->aud_tip_id = 5;
            $auditoria->usuario_id = Auth::user()->usuario_id;
            $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
            $auditoria->auditoria_tabla = 'parcelas';
            $auditoria->auditoria_registro_id = request()->parcela_id;
            $auditoria->auditoria_descripcion = 'Actualización de datos de Padrón';
            $auditoria->auditoria_detalle_old = json_encode($datos_old);
            $auditoria->auditoria_detalle_new = json_encode($datos_new);
            $auditoria->save();


            $mejoraph = Mejora::leftJoin('tipos_mejoras_destinos','mejoras.tipo_mejora_destino_id','=','tipos_mejoras_destinos.tipo_mejora_destino_id')
                ->leftJoin('tipos_mejoras_usos','mejoras.tipo_mejora_uso_id','=','tipos_mejoras_usos.tipo_mejora_uso_id')
                ->leftJoin('tipos_mejoras','mejoras.tipo_mejora_id','=','tipos_mejoras.tipo_mejora_id')
                ->leftJoin('tipos_mejoras_categorias','mejoras.tipo_mejora_categoria_id','=','tipos_mejoras_categorias.tipo_mejora_categoria_id')
                ->where("parcela_id","=",$datos_old["parcela_id"])->where('tipos_mejoras_categorias.cubierta','=',1)
                ->orderBy('tipos_mejoras_categorias.cubierta','desc')->count();

                if($mejoraph > 0){

                    $destinos = UnionDesglose::leftJoin('parcelas','uniones_desgloses.parcela_destino_id', '=', 'parcelas.parcela_id')
                        ->leftJoin('tipos_parcelas_estados','parcelas.tipo_parcela_estado_id', '=', 'tipos_parcelas_estados.tipo_parcela_estado_id')
                        ->where('.uniones_desgloses.parcela_id','=',$datos_old["parcela_id"])->get();
                    
                    foreach ($destinos as $destino) {

                     event(new ModificarPH ($destino,$datos_new));

                    }
                
                }


    }

    /**
     * Handle the parcela "deleted" event.
     *
     * @param  \App\Parcela  $parcela
     * @return void
     */
    public function deleted(Parcela $parcela)
    {
        //
    }

    /**
     * Handle the parcela "restored" event.
     *
     * @param  \App\Parcela  $parcela
     * @return void
     */
    public function restored(Parcela $parcela)
    {
        //
    }

    /**
     * Handle the parcela "force deleted" event.
     *
     * @param  \App\Parcela  $parcela
     * @return void
     */
    public function forceDeleted(Parcela $parcela)
    {
        //
    }


}
