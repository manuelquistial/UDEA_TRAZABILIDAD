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
    protected $solped;
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
        //if($info_email->index == 1){
            $this->consecutivo = $info_email->consecutivo;
            $this->nombre_apellido = $info_email->nombre_apellido;
            $this->nombre_proyecto = $info_email->nombre_proyecto;
            $this->tipo_transaccion = $info_email->tipo_transaccion;
        /*}else{
            $this->index = $info_email->index;
            $this->consecutivo = $info_email->consecutivo;
            $this->codigo_sigep = $info_email->codigo_sigep;
            $this->codigo_sap = $info_email->codigo_sap;
            $this->solped = $info_email->solped;
        }*/
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = \Lang::get('strings.correo.subject');
        $data_email = array(
            'consecutivo' => $this->consecutivo, 
            'nombre_apellido' => $this->nombre_apellido,
            'nombre_proyecto' => $this->nombre_proyecto,
            'tipo_transaccion' => $this->tipo_transaccion
        );
        if($this->index == 1){
            return $this->subject($subject)->view('emails.presolicitudView', $data_email);
        }else if($this->index == 2){
            return $this->subject($subject)->view('emails.solicitudView', $data_email);
        }else if($this->index == 3){
            return $this->subject($subject)->view('emails.tramiteView', $data_email);
        }
    }
}
