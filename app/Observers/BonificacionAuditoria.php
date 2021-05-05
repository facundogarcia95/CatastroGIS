<?php

namespace App\Observers;

use App\Auditoria;
use App\Bonificacion;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BonificacionAuditoria
{
    /**
     * Handle the bonificacion "created" event.
     *
     * @param  \App\Bonificacion  $bonificacion
     * @return void
     */
    public function created(Bonificacion $bonificacion)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 3;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'tipos_bonificaciones';
        $auditoria->auditoria_registro_id = $bonificacion->tipo_bonificacion_id;
        $auditoria->auditoria_descripcion = 'Creación de Bonificación';
        $auditoria->auditoria_detalle_old = null;
        $auditoria->auditoria_detalle_new = json_encode($bonificacion->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the bonificacion "updated" event.
     *
     * @param  \App\Bonificacion  $bonificacion
     * @return void
     */
    public function updating(Bonificacion $bonificacion)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 5;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'tipos_bonificaciones';
        $auditoria->auditoria_registro_id = request()->tipo_bonificacion_id;
        $auditoria->auditoria_descripcion = 'Actualización de Bonificación';
        $auditoria->auditoria_detalle_old = json_encode($bonificacion->getOriginal());
        $auditoria->auditoria_detalle_new = json_encode($bonificacion->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the bonificacion "deleted" event.
     *
     * @param  \App\Bonificacion  $bonificacion
     * @return void
     */
    public function deleted(Bonificacion $bonificacion)
    {
        //
    }

    /**
     * Handle the bonificacion "restored" event.
     *
     * @param  \App\Bonificacion  $bonificacion
     * @return void
     */
    public function restored(Bonificacion $bonificacion)
    {
        //
    }

    /**
     * Handle the bonificacion "force deleted" event.
     *
     * @param  \App\Bonificacion  $bonificacion
     * @return void
     */
    public function forceDeleted(Bonificacion $bonificacion)
    {
        //
    }
}
