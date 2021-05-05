<?php

namespace App\Observers;

use App\Auditoria;
use App\Direccion;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DireccionAuditoria
{
    /**
     * Handle the direccion "created" event.
     *
     * @param  \App\Direccion  $direccion
     * @return void
     */
    public function created(Direccion $direccion)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 3;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'direcciones';
        $auditoria->auditoria_registro_id = $direccion->direccion_id;
        $auditoria->auditoria_descripcion = 'Creación de Dirección';
        $auditoria->auditoria_detalle_old = null;
        $auditoria->auditoria_detalle_new = json_encode($direccion->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the direccion "updated" event.
     *
     * @param  \App\Direccion  $direccion
     * @return void
     */
    public function updating(Direccion $direccion)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 5;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'direcciones';
        $auditoria->auditoria_registro_id = request()->direccion_id;
        $auditoria->auditoria_descripcion = 'Actualización de Dirección';
        $auditoria->auditoria_detalle_old = json_encode($direccion->getOriginal());
        $auditoria->auditoria_detalle_new = json_encode($direccion->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the direccion "deleted" event.
     *
     * @param  \App\Direccion  $direccion
     * @return void
     */
    public function deleted(Direccion $direccion)
    {
        //
    }

    /**
     * Handle the direccion "restored" event.
     *
     * @param  \App\Direccion  $direccion
     * @return void
     */
    public function restored(Direccion $direccion)
    {
        //
    }

    /**
     * Handle the direccion "force deleted" event.
     *
     * @param  \App\Direccion  $direccion
     * @return void
     */
    public function forceDeleted(Direccion $direccion)
    {
        //
    }
}
