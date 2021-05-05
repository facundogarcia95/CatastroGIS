<?php

namespace App\Observers;

use App\Auditoria;
use App\Http\Controllers\Controller;
use App\PersonaParcela;
use Illuminate\Support\Facades\Auth;

class PersonaParcelaAuditoria
{
    /**
     * Handle the persona parcela "created" event.
     *
     * @param  \App\PersonaParcela  $personaParcela
     * @return void
     */
    public function created(PersonaParcela $personaParcela)
    {
        $datos_new = $personaParcela->getAttributes();
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 3;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'personas_parcelas';
        $auditoria->auditoria_registro_id = $personaParcela->persona_parcela_id;
        $auditoria->auditoria_descripcion = 'Creación de Persona Parcelas';
        $auditoria->auditoria_detalle_old = null;
        $auditoria->auditoria_detalle_new = json_encode($datos_new);
        $auditoria->save();
    }

    /**
     * Handle the persona parcela "updated" event.
     *
     * @param  \App\PersonaParcela  $personaParcela
     * @return void
     */
    public function updating(PersonaParcela $personaParcela)
    {
        
        $datos_old = $personaParcela->getOriginal();
        $datos_new = $personaParcela->getAttributes();
   
            $auditoria = new Auditoria();
            $auditoria->auditoria_script = request()->route()->uri(); 
            $auditoria->auditoria_host = Controller::GetIPRemote();
            $auditoria->aud_tip_id = 5;
            $auditoria->usuario_id = Auth::user()->usuario_id;
            $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
            $auditoria->auditoria_tabla = 'personas_parcelas';
            $auditoria->auditoria_registro_id = request()->persona_parcela_id;
            $auditoria->auditoria_descripcion = 'Actualización de Persona Parcelas';
            $auditoria->auditoria_detalle_old = json_encode($datos_old);
            $auditoria->auditoria_detalle_new = json_encode($datos_new);
            $auditoria->save();

    }

    /**
     * Handle the persona parcela "deleted" event.
     *
     * @param  \App\PersonaParcela  $personaParcela
     * @return void
     */
    public function deleted(PersonaParcela $personaParcela)
    {
        //
    }

    /**
     * Handle the persona parcela "restored" event.
     *
     * @param  \App\PersonaParcela  $personaParcela
     * @return void
     */
    public function restored(PersonaParcela $personaParcela)
    {
        //
    }

    /**
     * Handle the persona parcela "force deleted" event.
     *
     * @param  \App\PersonaParcela  $personaParcela
     * @return void
     */
    public function forceDeleted(PersonaParcela $personaParcela)
    {
        //
    }
}
