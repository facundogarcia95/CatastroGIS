<?php

namespace App\Observers;

use App\Auditoria;
use App\Http\Controllers\Controller;
use App\TipoMejora;
use Illuminate\Support\Facades\Auth;

class TipoMejoraAuditoria
{
    /**
     * Handle the tipo mejora "created" event.
     *
     * @param  \App\TipoMejora  $tipoMejora
     * @return void
     */
    public function created(TipoMejora $tipoMejora)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 3;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'tipos_mejoras';
        $auditoria->auditoria_registro_id = $tipoMejora->tipo_mejora_id;
        $auditoria->auditoria_descripcion = 'Creación de Tipo Mejora';
        $auditoria->auditoria_detalle_old = null;
        $auditoria->auditoria_detalle_new = json_encode($tipoMejora->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the tipo mejora "updated" event.
     *
     * @param  \App\TipoMejora  $tipoMejora
     * @return void
     */
    public function updating(TipoMejora $tipoMejora)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 5;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'tipos_mejoras';
        $auditoria->auditoria_registro_id = request()->tipo_mejora_id;
        $auditoria->auditoria_descripcion = 'Actualización de Tipo Mejora';
        $auditoria->auditoria_detalle_old = json_encode($tipoMejora->getOriginal());
        $auditoria->auditoria_detalle_new = json_encode($tipoMejora->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the tipo mejora "deleted" event.
     *
     * @param  \App\TipoMejora  $tipoMejora
     * @return void
     */
    public function deleted(TipoMejora $tipoMejora)
    {
        //
    }

    /**
     * Handle the tipo mejora "restored" event.
     *
     * @param  \App\TipoMejora  $tipoMejora
     * @return void
     */
    public function restored(TipoMejora $tipoMejora)
    {
        //
    }

    /**
     * Handle the tipo mejora "force deleted" event.
     *
     * @param  \App\TipoMejora  $tipoMejora
     * @return void
     */
    public function forceDeleted(TipoMejora $tipoMejora)
    {
        //
    }
}
