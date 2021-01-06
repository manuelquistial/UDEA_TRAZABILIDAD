<?php

namespace App\Http\Controllers;

use App\Mail\MailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Correos;
use Auth;

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

    public function email($encargado, $consecutivo, $etapa_id){
        $data = (object)[];
        $data->index = $etapa_id;
        $data->consecutivo = $consecutivo;
        $data->tipo_transaccion = $encargado->tipo_transaccion;
        $data->nombre = $encargado->nombre_apellido;

        Mail::to($encargado->email)
            ->cc(Auth::user()->email)
            ->send(new MailController($data));
    }
}
