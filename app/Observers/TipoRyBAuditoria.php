<?php

namespace App\Observers;

use App\Auditoria;
use App\Http\Controllers\Controller;
use App\TipoParcelaRyB;
use Illuminate\Support\Facades\Auth;

class TipoRyBAuditoria
{
    /**
     * Handle the tipo parcela "created" event.
     *
     * @param  \App\TipoParcela  $tipoParcela
     * @return void
     */
    public function created(TipoParcelaRyB $ryb)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 3;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'tipos_parcelas_ryb';
        $auditoria->auditoria_registro_id = $ryb->tipo_parcela_ryb_id;
        $auditoria->auditoria_descripcion = 'Creación de R y B de Parcela';
        $auditoria->auditoria_detalle_old = null;
        $auditoria->auditoria_detalle_new = json_encode($ryb->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the tipo parcela "updated" event.
     *
     * @param  \App\TipoParcelaRyB  $ryb
     * @return void
     */
    public function updating(TipoParcelaRyB $ryb)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 5;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'tipos_parcelas_ryb';
        $auditoria->auditoria_registro_id = request()->tipo_parcela_ryb_id;
        $auditoria->auditoria_descripcion = 'Actualización de R y B de Parcela';
        $auditoria->auditoria_detalle_old = json_encode($ryb->getOriginal());
        $auditoria->auditoria_detalle_new = json_encode($ryb->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the tipo parcela "deleted" event.
     *
     * @param  \App\TipoParcelaRyB  $ryb
     * @return void
     */
    public function deleted(TipoParcelaRyB $ryb)
    {
        //
    }

    /**
     * Handle the tipo parcela "restored" event.
     *
     * @param  \App\TipoParcelaRyB  $ryb
     * @return void
     */
    public function restored(TipoParcelaRyB $ryb)
    {
        //
    }

    /**
     * Handle the tipo parcela "force deleted" event.
     *
     * @param  \App\TipoParcelaRyB  $ryb
     * @return void
     */
    public function forceDeleted(TipoParcelaRyB $ryb)
    {
        //
    }
}
