<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Etapa;
use App\Presolicitud;
use App\Solicitud;
use App\Tramite;
use App\Autorizado;
use App\Preaprobado;
use App\Aprobado;
use App\Reserva;
use App\Pago;
use App\Legalizado;

class ConsultasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get etapas
     *
     * @return \Illuminate\Http\Response
     */
    public function etapas()
    {
        $etapas = Etapa::select('etapa','endpoint')
                ->get();

        return response()->json(['data'=>$etapas]);
    }
}