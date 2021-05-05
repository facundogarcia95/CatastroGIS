<?php

namespace App\Listeners;

use App\Mail\SistemaDeAvisoCatastro;
use App\User;
use Exception;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class EnviarNotificacion 
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

        if(isset($event->requerimiento)){

            $usuarios = User::select('usuarios.email')->join('requerimientos_asignados','requerimientos_asignados.usuario_id','=','usuarios.usuario_id')
            ->where('requerimientos_asignados.requerimiento','=',$event->requerimiento->noticia_id)->get();
            
            foreach ($usuarios as $key => $email) {
                $correos[$key] = $email->email;
            }
            
            try{
                Mail::to($correos)->send(new SistemaDeAvisoCatastro($event->requerimiento));      
            }catch(Exception $e){
                return Redirect::to("home")->with('erros','No pudimos notificar.'); 
            }
        
        }
       
    }
}
