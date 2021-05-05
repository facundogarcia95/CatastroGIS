<?php

namespace App\Observers;

use App\Auditoria;
use App\Http\Controllers\Controller;
use App\TipoServicio;
use Illuminate\Support\Facades\Auth;

class TipoServicioAuditoria
{
    /**
     * Handle the tipo servicio "created" event.
     *
     * @param  \App\TipoServicio  $tipoServicio
     * @return void
     */
    public function created(TipoServicio $tipoServicio)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 3;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'tipos_servicios';
        $auditoria->auditoria_registro_id = $tipoServicio->tipo_servicio_id;
        $auditoria->auditoria_descripcion = 'Creación de Tipo de Servicio';
        $auditoria->auditoria_detalle_old = null;
        $auditoria->auditoria_detalle_new = json_encode($tipoServicio->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the tipo servicio "updated" event.
     *
     * @param  \App\TipoServicio  $tipoServicio
     * @return void
     */
    public function updating(TipoServicio $tipoServicio)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 5;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'tipos_servicios';
        $auditoria->auditoria_registro_id = request()->tipo_servicio_id;
        $auditoria->auditoria_descripcion = 'Actualización de Tipo de Servicio';
        $auditoria->auditoria_detalle_old = json_encode($tipoServicio->getOriginal());
        $auditoria->auditoria_detalle_new = json_encode($tipoServicio->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the tipo servicio "deleted" event.
     *
     * @param  \App\TipoServicio  $tipoServicio
     * @return void
     */
    public function deleted(TipoServicio $tipoServicio)
    {
        //
    }

    /**
     * Handle the tipo servicio "restored" event.
     *
     * @param  \App\TipoServicio  $tipoServicio
     * @return void
     */
    public function restored(TipoServicio $tipoServicio)
    {
        //
    }

    /**
     * Handle the tipo servicio "force deleted" event.
     *
     * @param  \App\TipoServicio  $tipoServicio
     * @return void
     */
    public function forceDeleted(TipoServicio $tipoServicio)
    {
        //
    }
}
