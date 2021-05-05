<?php

namespace App\Observers;

use App\Auditoria;
use App\Barrio;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BarrioAuditoria
{
    /**
     * Handle the = barrio "created" event.
     *
     * @param  \App\=Barrio  $=Barrio
     * @return void
     */
    public function created(Barrio $Barrio)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 3;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'barrios';
        $auditoria->auditoria_registro_id = $Barrio->barrio_id;
        $auditoria->auditoria_descripcion = 'Creación de Barrio';
        $auditoria->auditoria_detalle_old = null;
        $auditoria->auditoria_detalle_new = json_encode($Barrio->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the = barrio "updated" event.
     *
     * @param  \App\=Barrio  $=Barrio
     * @return void
     */
    public function updating(Barrio $Barrio)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 5;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'barrios';
        $auditoria->auditoria_registro_id = request()->barrio_id;
        $auditoria->auditoria_descripcion = 'Actualización de Barrio';
        $auditoria->auditoria_detalle_old = json_encode($Barrio->getOriginal());
        $auditoria->auditoria_detalle_new = json_encode($Barrio->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the = barrio "deleted" event.
     *
     * @param  \App\=Barrio  $=Barrio
     * @return void
     */
    public function deleted(Barrio $Barrio)
    {
        //
    }

    /**
     * Handle the = barrio "restored" event.
     *
     * @param  \App\=Barrio  $=Barrio
     * @return void
     */
    public function restored(Barrio $Barrio)
    {
        //
    }

    /**
     * Handle the = barrio "force deleted" event.
     *
     * @param  \App\=Barrio  $=Barrio
     * @return void
     */
    public function forceDeleted(Barrio $Barrio)
    {
        //
    }
}
