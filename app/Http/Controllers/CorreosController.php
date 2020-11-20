<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
