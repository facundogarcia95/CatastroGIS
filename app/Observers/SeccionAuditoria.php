<?php

namespace App\Observers;

use App\Auditoria;
use App\Http\Controllers\Controller;
use App\Seccion;
use Illuminate\Support\Facades\Auth;

class SeccionAuditoria
{
    /**
     * Handle the seccion "created" event.
     *
     * @param  \App\Seccion  $seccion
     * @return void
     */
    public function created(Seccion $seccion)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 3;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'secciones';
        $auditoria->auditoria_registro_id = $seccion->seccion_id;
        $auditoria->auditoria_descripcion = 'Creación de Sección';
        $auditoria->auditoria_detalle_old = null;
        $auditoria->auditoria_detalle_new = json_encode($seccion->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the seccion "updated" event.
     *
     * @param  \App\Seccion  $seccion
     * @return void
     */
    public function updating(Seccion $seccion)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 5;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'secciones';
        $auditoria->auditoria_registro_id = request()->seccion_id;
        $auditoria->auditoria_descripcion = 'Actualización de Sección';
        $auditoria->auditoria_detalle_old = json_encode($seccion->getOriginal());
        $auditoria->auditoria_detalle_new = json_encode($seccion->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the seccion "deleted" event.
     *
     * @param  \App\Seccion  $seccion
     * @return void
     */
    public function deleted(Seccion $seccion)
    {
        //
    }

    /**
     * Handle the seccion "restored" event.
     *
     * @param  \App\Seccion  $seccion
     * @return void
     */
    public function restored(Seccion $seccion)
    {
        //
    }

    /**
     * Handle the seccion "force deleted" event.
     *
     * @param  \App\Seccion  $seccion
     * @return void
     */
    public function forceDeleted(Seccion $seccion)
    {
        //
    }
}
