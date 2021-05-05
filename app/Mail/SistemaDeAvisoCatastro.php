<?php

namespace App\Mail;

use App\Requerimiento;
use App\RequerimientoAsignado;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SistemaDeAvisoCatastro extends Mailable 
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $requerimiento;

    public function __construct($dato)
    {
        if($dato instanceof Requerimiento){

            $this->requerimiento = $dato;
            
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->requerimiento != null){
            return $this->view('Mails.requerimiento');
        }
    }
}
