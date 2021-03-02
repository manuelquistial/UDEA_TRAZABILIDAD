<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\Lang;
use Illuminate\Support\Facades\Log;

class MailController extends Mailable
{
    use Queueable, SerializesModels;

    protected $index = null;
    protected $codigo_sigep = null;
    protected $codigo_sap = null;
    protected $solped = null;
    protected $consecutivo = null;
    protected $tipo_transaccion = null;
    protected $nombre_apellido = null;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data_email)
    {
        $this->index = $data_email->etapa_id;

        if($data_email->etapa_id != 'decano'){
            $this->email = array(
                'gestor' => $data_email->gestor,
                'consecutivo' => $data_email->consecutivo, 
                'nombre_proyecto' => $data_email->nombre_proyecto,
                'tipo_transaccion' => $data_email->tipo_transaccion
            );
        }else{
            $this->email['email'] = $data_email->correo;
        }
        
        if(isset($data_email->nombre_apellido)){
            $this->email['nombre_apellido'] = $data_email->nombre_apellido;
        }

        if(isset($data_email->sap)){
            $this->email['sap'] = $data_email->sap;
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = \Lang::get('strings.correo.subject');
        
        if($this->index == 1){
            $correo = $this->subject($subject)->markdown('emails.presolicitudView', $this->email);
        }else if($this->index == 2){
            $correo = $this->subject($subject)->markdown('emails.solicitudView', $this->email);
        }else if($this->index == 3){
            $correo = $this->subject($subject)->markdown('emails.tramiteView', $this->email);
        }else if($this->index == 4){
            $correo = $this->subject($subject)->markdown('emails.autorizadoView', $this->email);
        }else if($this->index == 5){
            $correo = $this->subject($subject)->markdown('emails.preaprobadoView', $this->email);
        }else if($this->index == 6){
            $correo = $this->subject($subject)->markdown('emails.aprobadoView', $this->email);
        }else if($this->index == 7){
            $correo = $this->subject($subject)->markdown('emails.reservaView', $this->email);
        }else if($this->index == 8){
            $correo = $this->subject($subject)->markdown('emails.pagoView', $this->email);
        }else if($this->index == 'decano'){
            $correo = $this->subject($subject)->markdown('emails.decanoView', $this->email);
        }

        return $correo;//->from(\Config::get('mail.username'));
    }
}
