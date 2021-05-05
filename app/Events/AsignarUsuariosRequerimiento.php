<?php

namespace App\Events;

use App\RequerimientoAsignado;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;


class AsignarUsuariosRequerimiento
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $requerimiento;
    public $asignados;

    public function __construct($requerimiento, $asignados)
    {
        $this->requerimiento = $requerimiento;
        $this->asignados = $asignados;

        $borrar = RequerimientoAsignado::where('requerimiento','=',$requerimiento->noticia_id)->delete();

        for ($i=0; $i<count($asignados); $i++) {

            $asignado = new RequerimientoAsignado();
            $asignado->requerimiento = $requerimiento->noticia_id;
            $asignado->usuario_id = $asignados[$i];
            $asignado->save();

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
