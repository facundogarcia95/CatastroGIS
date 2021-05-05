<?php

namespace App\Observers;

use App\Auditoria;
use App\Http\Controllers\Controller;
use App\Persona;
use Illuminate\Support\Facades\Auth;

class PersonaAuditoria
{
    /**
     * Handle the persona "created" event.
     *
     * @param  \App\Persona  $persona
     * @return void
     */
    public function created(Persona $persona)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 3;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'personas';
        $auditoria->auditoria_registro_id = $persona->persona_id;
        $auditoria->auditoria_descripcion = 'Creación de Persona';
        $auditoria->auditoria_detalle_old = null;
        $auditoria->auditoria_detalle_new = json_encode($persona->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the persona "updated" event.
     *
     * @param  \App\Persona  $persona
     * @return void
     */
    public function updating(Persona $persona)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 5;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'personas';
        $auditoria->auditoria_registro_id = request()->persona_id;
        $auditoria->auditoria_descripcion = 'Actualización de Persona';
        $auditoria->auditoria_detalle_old = json_encode($persona->getOriginal());
        $auditoria->auditoria_detalle_new = json_encode($persona->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the persona "deleted" event.
     *
     * @param  \App\Persona  $persona
     * @return void
     */
    public function deleted(Persona $persona)
    {
        //
    }

    /**
     * Handle the persona "restored" event.
     *
     * @param  \App\Persona  $persona
     * @return void
     */
    public function restored(Persona $persona)
    {
        //
    }

    /**
     * Handle the persona "force deleted" event.
     *
     * @param  \App\Persona  $persona
     * @return void
     */
    public function forceDeleted(Persona $persona)
    {
        //
    }
}
