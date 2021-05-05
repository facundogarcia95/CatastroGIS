<?php

namespace App\Observers;

use App\Auditoria;
use App\Http\Controllers\Controller;
use App\Tramite;
use Illuminate\Support\Facades\Auth;

class TramiteAuditoria
{
    /**
     * Handle the tipo servicio "created" event.
     *
     * @param  \App\TipoServicio  $tipoServicio
     * @return void
     */
    public function created(Tramite $tramite)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 3;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'tramites';
        $auditoria->auditoria_registro_id = $tramite->tipo_tramite_id;
        $auditoria->auditoria_descripcion = 'Creación de Trámite';
        $auditoria->auditoria_detalle_old = null;
        $auditoria->auditoria_detalle_new = json_encode($tramite->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the tipo servicio "updated" event.
     *
     * @param  \App\Tramite  $tipoServicio
     * @return void
     */
    public function updating(Tramite $tramite)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 5;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'tramites';
        $auditoria->auditoria_registro_id = request()->tipo_servicio_id;
        $auditoria->auditoria_descripcion = 'Actualización de Trámite';
        $auditoria->auditoria_detalle_old = json_encode($tramite->getOriginal());
        $auditoria->auditoria_detalle_new = json_encode($tramite->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the tipo servicio "deleted" event.
     *
     * @param  \App\Tramite  $tipoServicio
     * @return void
     */
    public function deleted(Tramite $tipoServicio)
    {
        //
    }

    /**
     * Handle the tipo servicio "restored" event.
     *
     * @param  \App\Tramite  $tipoServicio
     * @return void
     */
    public function restored(Tramite $tipoServicio)
    {
        //
    }

    /**
     * Handle the tipo servicio "force deleted" event.
     *
     * @param  \App\Tramite  $tipoServicio
     * @return void
     */
    public function forceDeleted(Tramite $tipoServicio)
    {
        //
    }
}
