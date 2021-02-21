<?php

namespace App\Http\Controllers;

use App\Mail\MailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Correos;
use Auth;
//use Swift_SmtpTransport;

class CorreosController extends Controller
{
    public $numeroDatos = 5;
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
        $correos = Correos::orderBy('enviado', 'DESC')
                ->orderBy('id', 'DESC')
                ->paginate($this->numeroDatos);

        //return response()->json(['data'=>$correos]);
        return view('correosView', compact('consulta','correos'));
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

        Mail::to($data->email)
            ->send(new MailController($data));
    }
}
