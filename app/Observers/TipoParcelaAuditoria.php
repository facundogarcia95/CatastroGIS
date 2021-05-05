<?php

namespace App\Observers;

use App\Auditoria;
use App\Http\Controllers\Controller;
use App\TipoParcela;
use Illuminate\Support\Facades\Auth;

class TipoParcelaAuditoria
{
    /**
     * Handle the tipo parcela "created" event.
     *
     * @param  \App\TipoParcela  $tipoParcela
     * @return void
     */
    public function created(TipoParcela $tipoParcela)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 3;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'tipos_parcelas';
        $auditoria->auditoria_registro_id = $tipoParcela->tipo_parcela_id;
        $auditoria->auditoria_descripcion = 'Creación de Tipo de Parcela';
        $auditoria->auditoria_detalle_old = null;
        $auditoria->auditoria_detalle_new = json_encode($tipoParcela->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the tipo parcela "updated" event.
     *
     * @param  \App\TipoParcela  $tipoParcela
     * @return void
     */
    public function updating(TipoParcela $tipoParcela)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 5;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'tipos_parcelas';
        $auditoria->auditoria_registro_id = request()->tipo_parcela_id;
        $auditoria->auditoria_descripcion = 'Actualización de Tipo de Parcela';
        $auditoria->auditoria_detalle_old = json_encode($tipoParcela->getOriginal());
        $auditoria->auditoria_detalle_new = json_encode($tipoParcela->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the tipo parcela "deleted" event.
     *
     * @param  \App\TipoParcela  $tipoParcela
     * @return void
     */
    public function deleted(TipoParcela $tipoParcela)
    {
        //
    }

    /**
     * Handle the tipo parcela "restored" event.
     *
     * @param  \App\TipoParcela  $tipoParcela
     * @return void
     */
    public function restored(TipoParcela $tipoParcela)
    {
        //
    }

    /**
     * Handle the tipo parcela "force deleted" event.
     *
     * @param  \App\TipoParcela  $tipoParcela
     * @return void
     */
    public function forceDeleted(TipoParcela $tipoParcela)
    {
        //
    }
}
