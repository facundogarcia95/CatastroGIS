<?php

namespace App\Observers;

use App\Auditoria;
use App\Http\Controllers\Controller;
use App\TipoDocumento;
use Illuminate\Support\Facades\Auth;

class TipoDocumentoAuditoria
{
    /**
     * Handle the tipo documento "created" event.
     *
     * @param  \App\TipoDocumento  $tipoDocumento
     * @return void
     */
    public function created(TipoDocumento $tipoDocumento)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 3;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'tipos_documentos';
        $auditoria->auditoria_registro_id = $tipoDocumento->tipo_documento_id;
        $auditoria->auditoria_descripcion = 'Creación de Tipo de Documentos';
        $auditoria->auditoria_detalle_old = null;
        $auditoria->auditoria_detalle_new = json_encode($tipoDocumento->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the tipo documento "updated" event.
     *
     * @param  \App\TipoDocumento  $tipoDocumento
     * @return void
     */
    public function updating(TipoDocumento $tipoDocumento)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 5;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'tipos_documentos';
        $auditoria->auditoria_registro_id = request()->tipo_documento_id;
        $auditoria->auditoria_descripcion = 'Actualización de Tipo de Documentos';
        $auditoria->auditoria_detalle_old = json_encode($tipoDocumento->getOriginal());
        $auditoria->auditoria_detalle_new = json_encode($tipoDocumento->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the tipo documento "deleted" event.
     *
     * @param  \App\TipoDocumento  $tipoDocumento
     * @return void
     */
    public function deleted(TipoDocumento $tipoDocumento)
    {
        //
    }

    /**
     * Handle the tipo documento "restored" event.
     *
     * @param  \App\TipoDocumento  $tipoDocumento
     * @return void
     */
    public function restored(TipoDocumento $tipoDocumento)
    {
        //
    }

    /**
     * Handle the tipo documento "force deleted" event.
     *
     * @param  \App\TipoDocumento  $tipoDocumento
     * @return void
     */
    public function forceDeleted(TipoDocumento $tipoDocumento)
    {
        //
    }
}
