<?php

namespace App\Observers;

use App\Auditoria;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class UsuarioAuditoria
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {

        unset($user->password);
        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 3;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'usuarios';
        $auditoria->auditoria_registro_id = $user->usuario_id;
        $auditoria->auditoria_descripcion = 'Creación de Usuario';
        $auditoria->auditoria_detalle_old = null;
        $auditoria->auditoria_detalle_new = json_encode($user->getAttributes());
        $auditoria->save();
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updating(User $user)
    {
        $datos_old = $user->getOriginal();
        $datos_new = $user->getAttributes();

        unset($datos_old["password"]);
        unset($datos_new["password"]);
    

        if($datos_old["condicion"] == 1){
            $datos_old["condicion"] = "Activo";
        }else{
            $datos_old["condicion"] = "Inactivo";
        }

        if($datos_new["condicion"] == 1){
            $datos_new["condicion"] = "Activo";
        }else{
            $datos_new["condicion"] = "Inactivo";
        }

        $datos_old["idrol"] = $user->rol->grupo_nombre;
        $datos_new["idrol"] = $user->rol->grupo_nombre;

        $datos_old["idseccion"] = $user->seccion->seccion_descrip;
        $datos_new["idseccion"] = $user->seccion->seccion_descrip;

        $auditoria = new Auditoria();
        $auditoria->auditoria_script = request()->route()->uri(); 
        $auditoria->auditoria_host = Controller::GetIPRemote();
        $auditoria->aud_tip_id = 5;
        $auditoria->usuario_id = Auth::user()->usuario_id;
        $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
        $auditoria->auditoria_tabla = 'usuarios';
        $auditoria->auditoria_registro_id = request()->usuario_id;
        $auditoria->auditoria_descripcion = 'Actualización de Usuario';
        $auditoria->auditoria_detalle_old = json_encode($datos_old);
        $auditoria->auditoria_detalle_new = json_encode($datos_new);
        $auditoria->save();
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
