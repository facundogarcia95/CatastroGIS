<?php

namespace App\Observers;

use App\Auditoria;
use App\Http\Controllers\Controller;
use App\TipoAfectacion;
use Illuminate\Support\Facades\Auth;

class TipoAfectacionAuditoria
{
    /**
     * Handle the tipo afectacion "created" event.
     *
     * @param  \App\TipoAfectacion  $tipoAfectacion
     * @return void
     */
    public function created(TipoAfectacion $tipoAfectacion)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 3;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'tipos_afectaciones';
        $auditoria->auditoria_registro_id = $tipoAfectacion->tipo_afectacion_id;
        $auditoria->auditoria_descripcion = 'Creación de Afectación';
        $auditoria->auditoria_detalle_old = null;
        $auditoria->auditoria_detalle_new = json_encode($tipoAfectacion->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the tipo afectacion "updated" event.
     *
     * @param  \App\TipoAfectacion  $tipoAfectacion
     * @return void
     */
    public function updating(TipoAfectacion $tipoAfectacion)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 5;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'tipos_afectaciones';
        $auditoria->auditoria_registro_id = request()->tipo_afectacion_id;
        $auditoria->auditoria_descripcion = 'Actualización de Afectación';
        $auditoria->auditoria_detalle_old = json_encode($tipoAfectacion->getOriginal());
        $auditoria->auditoria_detalle_new = json_encode($tipoAfectacion->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the tipo afectacion "deleted" event.
     *
     * @param  \App\TipoAfectacion  $tipoAfectacion
     * @return void
     */
    public function deleted(TipoAfectacion $tipoAfectacion)
    {
        //
    }

    /**
     * Handle the tipo afectacion "restored" event.
     *
     * @param  \App\TipoAfectacion  $tipoAfectacion
     * @return void
     */
    public function restored(TipoAfectacion $tipoAfectacion)
    {
        //
    }

    /**
     * Handle the tipo afectacion "force deleted" event.
     *
     * @param  \App\TipoAfectacion  $tipoAfectacion
     * @return void
     */
    public function forceDeleted(TipoAfectacion $tipoAfectacion)
    {
        //
    }
}
