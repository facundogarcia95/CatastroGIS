<?php

namespace App\Events;

use App\Auditoria;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Auth;

class LoginLogout
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct(User $user = null,$tipo,$opcional = null)
    {
        $descripcion = 'Inicio de sesión de Usuario';

        if($tipo == 2){ $descripcion = 'Cierre de sesión de Usuario'; }
        
        $auditoria_script = request()->route()->uri();

        if($opcional){
            $auditoria_script = $opcional;
        }
        if($user){
            $auditoria = new Auditoria();
            $auditoria->auditoria_script = $auditoria_script; 
            $auditoria->auditoria_host = Controller::GetIPRemote();
            $auditoria->aud_tip_id = $tipo;
            $auditoria->usuario_id = $user->usuario_id;
            $auditoria->auditoria_fecha = date("Y-m-d H:i:s");
            $auditoria->auditoria_tabla = '-';
            $auditoria->auditoria_registro_id = $user->usuario_id;
            $auditoria->auditoria_descripcion = $descripcion;
            $auditoria->auditoria_detalle_old = null;
            $auditoria->auditoria_detalle_new = null;
            $auditoria->save();
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
