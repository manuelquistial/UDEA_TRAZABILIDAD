<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Etapa;
use App\Models\Presolicitud;
use App\Models\Solicitud;
use App\Models\Tramite;
use App\Models\Autorizado;
use App\Models\Preaprobado;
use App\Models\Aprobado;
use App\Models\Reserva;
use App\Models\Pago;
use App\Models\Legalizado;
use App\Models\ConsecutivoEtapaEstado;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display etapas with estados
     *
     * @return \Illuminate\Http\Response
     */
    public function etapaEstado($consecutivo)
    {
        $etapa_estado = DB::table('tr_etapas AS a')
                    ->leftJoin('tr_consecutivo_etapa_estado AS b', 'b.etapa_id', '=', 'a.etapa_id')
                    ->leftJoin('tr_estados AS c', 'c.estado_id', '=', 'b.estado_id')
                    ->where('b.consecutivo', $consecutivo)
                    ->orderBy('a.etapa_id', 'asc')
                    ->select('a.etapa', 'c.estado_id', 'a.endpoint')
                    ->get();

        return $etapa_estado;
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
