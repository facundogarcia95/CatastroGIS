<?php

namespace App\Observers;

use App\Auditoria;
use App\Http\Controllers\Controller;
use App\TipoInstrumento;
use Illuminate\Support\Facades\Auth;

class TipoInstrumentoAuditoria
{
    /**
     * Handle the tipo instrumento "created" event.
     *
     * @param  \App\TipoInstrumento  $tipoInstrumento
     * @return void
     */
    public function created(TipoInstrumento $tipoInstrumento)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 3;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'tipos_instrumentos';
        $auditoria->auditoria_registro_id = $tipoInstrumento->tipo_instrumento_id;
        $auditoria->auditoria_descripcion = 'Creación de Tipo de Instrumento';
        $auditoria->auditoria_detalle_old = null;
        $auditoria->auditoria_detalle_new = json_encode($tipoInstrumento->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the tipo instrumento "updated" event.
     *
     * @param  \App\TipoInstrumento  $tipoInstrumento
     * @return void
     */
    public function updating(TipoInstrumento $tipoInstrumento)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 5;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = now();
        $auditoria->auditoria_tabla = 'tipos_instrumentos';
        $auditoria->auditoria_registro_id = request()->tipo_instrumento_id;
        $auditoria->auditoria_descripcion = 'Actualización de Tipo de Instrumento';
        $auditoria->auditoria_detalle_old = json_encode($tipoInstrumento->getOriginal());
        $auditoria->auditoria_detalle_new = json_encode($tipoInstrumento->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the tipo instrumento "deleted" event.
     *
     * @param  \App\TipoInstrumento  $tipoInstrumento
     * @return void
     */
    public function deleted(TipoInstrumento $tipoInstrumento)
    {
        //
    }

    /**
     * Handle the tipo instrumento "restored" event.
     *
     * @param  \App\TipoInstrumento  $tipoInstrumento
     * @return void
     */
    public function restored(TipoInstrumento $tipoInstrumento)
    {
        //
    }

    /**
     * Handle the tipo instrumento "force deleted" event.
     *
     * @param  \App\TipoInstrumento  $tipoInstrumento
     * @return void
     */
    public function forceDeleted(TipoInstrumento $tipoInstrumento)
    {
        //
    }
}
