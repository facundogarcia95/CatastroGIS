<?php

namespace App\Observers;

use App\Auditoria;
use App\Http\Controllers\Controller;
use App\TipoPersonaParcela;
use Illuminate\Support\Facades\Auth;

class TipoPersonaParcelaAuditoria
{
    /**
     * Handle the tipo persona parcela "created" event.
     *
     * @param  \App\TipoPersonaParcela  $tipoPersonaParcela
     * @return void
     */
    public function created(TipoPersonaParcela $tipoPersonaParcela)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 3;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'tipos_personas_parcelas';
        $auditoria->auditoria_registro_id = $tipoPersonaParcela->tipo_persona_parcela_id;
        $auditoria->auditoria_descripcion = 'Creación de Tipo de titularidad de Parcela';
        $auditoria->auditoria_detalle_old = null;
        $auditoria->auditoria_detalle_new = json_encode($tipoPersonaParcela->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the tipo persona parcela "updated" event.
     *
     * @param  \App\TipoPersonaParcela  $tipoPersonaParcela
     * @return void
     */
    public function updating(TipoPersonaParcela $tipoPersonaParcela)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 5;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'tipos_personas_parcelas';
        $auditoria->auditoria_registro_id = request()->tipo_persona_parcela_id;
        $auditoria->auditoria_descripcion = 'Actualización de Tipo de titularidad de Parcela';
        $auditoria->auditoria_detalle_old = json_encode($tipoPersonaParcela->getOriginal());
        $auditoria->auditoria_detalle_new = json_encode($tipoPersonaParcela->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the tipo persona parcela "deleted" event.
     *
     * @param  \App\TipoPersonaParcela  $tipoPersonaParcela
     * @return void
     */
    public function deleted(TipoPersonaParcela $tipoPersonaParcela)
    {
        //
    }

    /**
     * Handle the tipo persona parcela "restored" event.
     *
     * @param  \App\TipoPersonaParcela  $tipoPersonaParcela
     * @return void
     */
    public function restored(TipoPersonaParcela $tipoPersonaParcela)
    {
        //
    }

    /**
     * Handle the tipo persona parcela "force deleted" event.
     *
     * @param  \App\TipoPersonaParcela  $tipoPersonaParcela
     * @return void
     */
    public function forceDeleted(TipoPersonaParcela $tipoPersonaParcela)
    {
        //
    }
}
