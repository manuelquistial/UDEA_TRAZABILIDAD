<?php

namespace App\Http\Controllers;

use App\Mail\MailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Correos;
use App\Presolicitud;
use App\TiposTransaccion;
use App\Tramite;
use App\Cargos;
use App\Usuario;
use Auth;
use Swift_SmtpTransport;

class CorreosController extends Controller
{
    public $numeroDatos = 5;
    public $decano_id = 1;
    public $cargo_sap_id = 2;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display correos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consulta = false;
        $correos = Correos::orderBy('enviado', 'ASC')
                ->paginate($this->numeroDatos);

        return view('correosView', compact('consulta','correos'));
    }

    public function correoDecano(Request $request){

        $correo = $request->data;

        $cargos = new Cargos();
        $decano = $cargos->usuarioByCargo($this->decano_id)->first();
        //$usuario = Usuario::where('cedula',$proyecto->usuario_id)->select('email')->first();
        $sap = $cargos->usuarioByCargo($this->cargo_sap_id)->first();

        $data = (object)[];
        $data->etapa_id = 'decano';
        $data->email = $decano['email'];
        $data->correo = (object)[];
        $data->correo->sap = [];
        $data->correo->solped = [];
        $data->correo->sigep = [];
        $data->cc = [];

        if($sap['email'] != null){
            array_push($data->cc, $sap['email']);
        }

        foreach($correo['consecutivos'] as $consecutivo){
            $proyecto = Presolicitud::where('consecutivo', $consecutivo['consecutivo'])->select('transaccion_id')->first();
            $tipoTransaccion = TiposTransaccion::where('id', $proyecto->transaccion_id)->select('tipo_transaccion','cargo_id')->first();
            $tramite = Tramite::where('consecutivo', $consecutivo['consecutivo'])->select('consecutivo_sap')->first();

            if($consecutivo['etapa'] == 4){
                if($tipoTransaccion->cargo_id == 2){
                    array_push($data->correo->sap, [$tramite['consecutivo_sap'], $consecutivo['codigo']]);
                }else{
                    if(isset($tramite->consecutivo_sap)){
                        $tramie = $tramite->consecutivo_sap;
                    }else{
                        $tramite = "";
                    }
                    array_push($data->correo->sigep, [$tipoTransaccion->tipo_transaccion, $tramite, $consecutivo['codigo']]);
                }
            }else{
                array_push($data->correo->solped, $consecutivo['codigo']);
            }
        }

        Correos::whereIn('id', $correo['ids'])
            ->update(['enviado' => 1, 
                'fecha_envio' => date("Y-m-d H:i:s")
            ]);

        $this->email($data);

        return response()->json(['data'=>true]);
    }

    public function email($data){
        /*try {
            // Create the Transport
            $transport = (new \Swift_SmtpTransport('172.19.0.101', 25, false))
              ->setUsername('manuel.quistial@udea.edu.co')
              ->setPassword('MaxIn84296!')
            ;
         
            // Create the Mailer using your created Transport
            $mailer = new \Swift_Mailer($transport);
         
            // Create a message
            $body = 'Hello, <p>Email sent through <span style="color:red;">Swift Mailer</span>.</p>';
         
            $message = (new \Swift_Message('Email Through Swift Mailer'))
              ->setFrom(['manuel.quistial@udea.edu.co' => 'FROM_NAME'])
              ->setTo(['manuel.quistialj@gmail.com'])
              ->setBody($body)
              ->setContentType('text/html')
            ;
         
            // Send the message
            $mailer->send($message);
         
            info('Email has been sent.');
        } catch(Exception $e) {
            info($e->getMessage());
        }*/
        
        if(isset($data->cc)){
            Mail::to($data->email)
                ->cc($data->cc)
                ->send(new MailController($data));
        }else{
            Mail::to($data->email)
                ->send(new MailController($data));
        }
    }
}
