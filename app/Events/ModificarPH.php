<?php

namespace App\Events;

use App\Parcela;
use App\UnionDesglose;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ModificarPH
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(UnionDesglose $unionDesglose, $datos_new)
    {
      //  echo json_encode($unionDesglose->parcela_destino_id);
        
        $parcela = Parcela::find($unionDesglose->parcela_destino_id);
        if($parcela){
            $parcela->parcela_nomenclatura = substr($datos_new["parcela_nomenclatura"],0,16).$parcela->parcela_subparcela.$parcela->parcela_dig_veri;
            $parcela->parcela_distrito = $datos_new["parcela_distrito"];
            $parcela->parcela_seccion = $datos_new["parcela_seccion"];
            $parcela->parcela_manzana = $datos_new["parcela_manzana"];
            $parcela->parcela_parcela = $datos_new["parcela_parcela"];
            $parcela->parcela_x = $datos_new["parcela_seccion"];
            $parcela->parcela_y = $datos_new["parcela_seccion"];
            $parcela->save();
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
