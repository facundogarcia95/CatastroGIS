<?php

namespace App\Observers;

use App\Auditoria;
use App\Http\Controllers\Controller;
use App\TipoCondicion;
use Illuminate\Support\Facades\Auth;

class TipoCondicionAuditoria
{
    /**
     * Handle the tipo condicion "created" event.
     *
     * @param  \App\TipoCondicion  $tipoCondicion
     * @return void
     */
    public function created(TipoCondicion $tipoCondicion)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 3;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'tipos_condiciones';
        $auditoria->auditoria_registro_id = $tipoCondicion->tipo_condicion_id;
        $auditoria->auditoria_descripcion = 'Creación de Tipo de Condición';
        $auditoria->auditoria_detalle_old = null;
        $auditoria->auditoria_detalle_new = json_encode($tipoCondicion->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the tipo condicion "updated" event.
     *
     * @param  \App\TipoCondicion  $tipoCondicion
     * @return void
     */
    public function updating(TipoCondicion $tipoCondicion)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 5;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'tipos_condiciones';
        $auditoria->auditoria_registro_id = request()->tipo_condicion_id;
        $auditoria->auditoria_descripcion = 'Actualización de Tipo de Condición';
        $auditoria->auditoria_detalle_old = json_encode($tipoCondicion->getOriginal());
        $auditoria->auditoria_detalle_new = json_encode($tipoCondicion->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the tipo condicion "deleted" event.
     *
     * @param  \App\TipoCondicion  $tipoCondicion
     * @return void
     */
    public function deleted(TipoCondicion $tipoCondicion)
    {
        //
    }

    /**
     * Handle the tipo condicion "restored" event.
     *
     * @param  \App\TipoCondicion  $tipoCondicion
     * @return void
     */
    public function restored(TipoCondicion $tipoCondicion)
    {
        //
    }

    /**
     * Handle the tipo condicion "force deleted" event.
     *
     * @param  \App\TipoCondicion  $tipoCondicion
     * @return void
     */
    public function forceDeleted(TipoCondicion $tipoCondicion)
    {
        //
    }
}
