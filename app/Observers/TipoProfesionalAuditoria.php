<?php

namespace App\Observers;

use App\Auditoria;
use App\Http\Controllers\Controller;
use App\TipoProfesional;
use Illuminate\Support\Facades\Auth;

class TipoProfesionalAuditoria
{
    /**
     * Handle the tipo profesional "created" event.
     *
     * @param  \App\TipoProfesional  $tipoProfesional
     * @return void
     */
    public function created(TipoProfesional $tipoProfesional)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 3;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'tipos_profesionales';
        $auditoria->auditoria_registro_id = $tipoProfesional->tipo_profesional_id;
        $auditoria->auditoria_descripcion = 'Creación de Tipo de Profesional';
        $auditoria->auditoria_detalle_old = null;
        $auditoria->auditoria_detalle_new = json_encode($tipoProfesional->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the tipo profesional "updated" event.
     *
     * @param  \App\TipoProfesional  $tipoProfesional
     * @return void
     */
    public function updating(TipoProfesional $tipoProfesional)
    {
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 5;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'tipos_profesionales';
        $auditoria->auditoria_registro_id = request()->tipo_profesional_id;
        $auditoria->auditoria_descripcion = 'Actualización de Tipo de Profesional';
        $auditoria->auditoria_detalle_old = json_encode($tipoProfesional->getOriginal());
        $auditoria->auditoria_detalle_new = json_encode($tipoProfesional->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the tipo profesional "deleted" event.
     *
     * @param  \App\TipoProfesional  $tipoProfesional
     * @return void
     */
    public function deleted(TipoProfesional $tipoProfesional)
    {
        //
    }

    /**
     * Handle the tipo profesional "restored" event.
     *
     * @param  \App\TipoProfesional  $tipoProfesional
     * @return void
     */
    public function restored(TipoProfesional $tipoProfesional)
    {
        //
    }

    /**
     * Handle the tipo profesional "force deleted" event.
     *
     * @param  \App\TipoProfesional  $tipoProfesional
     * @return void
     */
    public function forceDeleted(TipoProfesional $tipoProfesional)
    {
        //
    }
}
