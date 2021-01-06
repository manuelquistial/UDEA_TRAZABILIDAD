<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\Lang;

class MailController extends Mailable
{
    use Queueable, SerializesModels;

    protected $index;
    protected $codigo_sigep;
    protected $codigo_sap;
    protected $solpe;
    protected $consecutivo;
    protected $tipo_transaccion;
    protected $nombre;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($info_email)
    {
        $this->index = $info_email->index;
        if($info_email->index == 1){
            $this->consecutivo = $info_email->consecutivo;
            $this->nombre = $info_email->nombre_apellido;
        }else{
            $this->index = $info_email->index;
            $this->consecutivo = $info_email->consecutivo;
            $this->codigo_sigep = $info_email->codigo_sigep;
            $this->codigo_sap = $info_email->codigo_sap;
            $this->solpe = $info_email->solpe;
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->index == 1){
            $subject = \Lang::get('strings.subjects.presolicitud');
            return $this->subject($subject)->view('emails.presolicitudView', array(
                'consecutivo' => $this->consecutivo, 
                'nombre' => $this->nombre
            ));
        }else if($this->index == 3){
            $subject = \Lang::get('strings.subjects.presolicitud');
            return $this->subject($subject)->view('emails.tramiteView', array(
                'consecutivo' => $this->consecutivo, 
                'nombre' => $this->nombre
            ));
        }
    }
}
