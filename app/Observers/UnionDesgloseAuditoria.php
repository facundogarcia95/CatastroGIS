<?php

namespace App\Observers;

use App\Auditoria;
use App\UnionDesglose;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UnionDesgloseAuditoria
{
    /**
     * Handle the = barrio "created" event.
     *
     * @param  \App\=Barrio  $=Barrio
     * @return void
     */
    public function created(UnionDesglose $unionDesglose)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 3;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'uniones_desgloses';
        $auditoria->auditoria_registro_id = $unionDesglose->union_desglose_id;
        if($unionDesglose->tipo_union_desglose_id == 1){
            $auditoria->auditoria_descripcion = 'Creación de relación de Unión';
        }else{
            $auditoria->auditoria_descripcion = 'Creación de relación de Destino';
        }
        $auditoria->auditoria_detalle_old = null;
        $auditoria->auditoria_detalle_new = json_encode($unionDesglose->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the = unionDesglose "updated" event.
     *
     * @param  \App\=unionDesglose  $=unionDesglose
     * @return void
     */
    public function updating(UnionDesglose $unionDesglose)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 5;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'uniones_desgloses';
        $auditoria->auditoria_registro_id = request()->union_desglose_id;
        if($unionDesglose->tipo_union_desglose_id == 1){
           $auditoria->auditoria_descripcion = 'Actualización de relación de Unión';
        }else{
         $auditoria->auditoria_descripcion = 'Actualización de relación de Destino';
        }
        $auditoria->auditoria_detalle_old = json_encode($unionDesglose->getOriginal());
        $auditoria->auditoria_detalle_new = json_encode($unionDesglose->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the = barrio "deleted" event.
     *
     * @param  \App\=Barrio  $=Barrio
     * @return void
     */
    public function deleting(UnionDesglose $unionDesglose)
    {
        
         $auditoria = new Auditoria();
         $auditoria->auditoria_script = request()->route()->uri(); 
         $auditoria->auditoria_host = Controller::GetIPRemote();
         $auditoria->aud_tip_id = 4;
         $auditoria->usuario_id = Auth::user()->usuario_id;
         $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
         $auditoria->auditoria_tabla = 'uniones_desgloses';
         $auditoria->auditoria_registro_id = $unionDesglose->union_desglose_id;
         if($unionDesglose->tipo_union_desglose_id == 1){
            $auditoria->auditoria_descripcion = 'Eliminación de relación de Unión';
         }else{
            $auditoria->auditoria_descripcion = 'Eliminación de relación de Destino';
         }
         $auditoria->auditoria_detalle_old = json_encode($unionDesglose->getOriginal());
         $auditoria->auditoria_detalle_new = null;
         $auditoria->save();
    }

    /**
     * Handle the = barrio "restored" event.
     *
     * @param  \App\=Barrio  $=Barrio
     * @return void
     */
    public function restored(UnionDesglose $unionDesglose)
    {
        //
    }

    /**
     * Handle the = barrio "force deleted" event.
     *
     * @param  \App\=Barrio  $=Barrio
     * @return void
     */
    public function forceDeleted(UnionDesglose $unionDesglose)
    {
       
    }
}
