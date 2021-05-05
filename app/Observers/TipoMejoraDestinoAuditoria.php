<?php

namespace App\Observers;

use App\Auditoria;
use App\Http\Controllers\Controller;
use App\TipoMejoraDestino;
use Illuminate\Support\Facades\Auth;

class TipoMejoraDestinoAuditoria
{
    /**
     * Handle the tipo mejora destino "created" event.
     *
     * @param  \App\TipoMejoraDestino  $tipoMejoraDestino
     * @return void
     */
    public function created(TipoMejoraDestino $tipoMejoraDestino)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 3;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'tipos_mejoras_destinos';
        $auditoria->auditoria_registro_id = $tipoMejoraDestino->tipo_mejora_destino_id;
        $auditoria->auditoria_descripcion = 'Creación de Tipo Mejora Destino';
        $auditoria->auditoria_detalle_old = null;
        $auditoria->auditoria_detalle_new = json_encode($tipoMejoraDestino->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the tipo mejora destino "updated" event.
     *
     * @param  \App\TipoMejoraDestino  $tipoMejoraDestino
     * @return void
     */
    public function updating(TipoMejoraDestino $tipoMejoraDestino)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 5;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'tipos_mejoras_destinos';
        $auditoria->auditoria_registro_id = request()->tipo_mejora_destino_id;
        $auditoria->auditoria_descripcion = 'Actualización de Tipo Mejora Destino';
        $auditoria->auditoria_detalle_old = json_encode($tipoMejoraDestino->getOriginal());
        $auditoria->auditoria_detalle_new = json_encode($tipoMejoraDestino->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the tipo mejora destino "deleted" event.
     *
     * @param  \App\TipoMejoraDestino  $tipoMejoraDestino
     * @return void
     */
    public function deleted(TipoMejoraDestino $tipoMejoraDestino)
    {
        //
    }

    /**
     * Handle the tipo mejora destino "restored" event.
     *
     * @param  \App\TipoMejoraDestino  $tipoMejoraDestino
     * @return void
     */
    public function restored(TipoMejoraDestino $tipoMejoraDestino)
    {
        //
    }

    /**
     * Handle the tipo mejora destino "force deleted" event.
     *
     * @param  \App\TipoMejoraDestino  $tipoMejoraDestino
     * @return void
     */
    public function forceDeleted(TipoMejoraDestino $tipoMejoraDestino)
    {
        //
    }
}
