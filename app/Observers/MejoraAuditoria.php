<?php

namespace App\Observers;

use App\Auditoria;
use App\Http\Controllers\Controller;
use App\Mejora;
use Illuminate\Support\Facades\Auth;

class MejoraAuditoria
{
    /**
     * Handle the mejora "created" event.
     *
     * @param  \App\Mejora  $mejora
     * @return void
     */
    public function created(Mejora $mejora)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 3;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'mejoras';
        $auditoria->auditoria_registro_id = $mejora->mejora_id;
        $auditoria->auditoria_descripcion = 'Creación de Mejora';
        $auditoria->auditoria_detalle_old =null;
        $auditoria->auditoria_detalle_new = json_encode($mejora->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the mejora "updated" event.
     *
     * @param  \App\Mejora  $mejora
     * @return void
     */
    public function updating(Mejora $mejora)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 5;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'mejoras';
        $auditoria->auditoria_registro_id = request()->mejora_id;
        $auditoria->auditoria_descripcion = 'Actualización de Mejora';
        $auditoria->auditoria_detalle_old = json_encode($mejora->getOriginal());
        $auditoria->auditoria_detalle_new = json_encode($mejora->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the mejora "deleted" event.
     *
     * @param  \App\Mejora  $mejora
     * @return void
     */
    public function deleted(Mejora $mejora)
    {
        //
    }

    /**
     * Handle the mejora "restored" event.
     *
     * @param  \App\Mejora  $mejora
     * @return void
     */
    public function restored(Mejora $mejora)
    {
        //
    }

    /**
     * Handle the mejora "force deleted" event.
     *
     * @param  \App\Mejora  $mejora
     * @return void
     */
    public function forceDeleted(Mejora $mejora)
    {
        //
    }
}
