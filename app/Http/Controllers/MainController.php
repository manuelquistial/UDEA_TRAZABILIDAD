<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
use App\ActualEtapaEstado;

class MainController extends Controller
{
    public $estado_id = 3;

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

    public function declinarProceso(Request $request){

        $fecha_estado = date("Y-m-d H:i:s");
        
        ActualEtapaEstado::where('consecutivo', $request->consecutivo)
            ->update(['estado_id' => $this->estado_id,
                    'fecha_estado' => $fecha_estado
                     ]);

        Presolicitud::where('consecutivo', $request->consecutivo)
            ->update(['estado_id' => $this->estado_id,
                    'fecha_estado' => $fecha_estado
                    ]);

        Solicitud::where('consecutivo', $request->consecutivo)
            ->update(['estado_id' => $this->estado_id,
                    'fecha_estado' => $fecha_estado
                    ]);

        Tramite::where('consecutivo', $request->consecutivo)
                ->update(['estado_id' => $this->estado_id,
                        'fecha_estado' => $fecha_estado
                        ]);

        Autorizado::where('consecutivo', $request->consecutivo)
            ->update(['estado_id' => $this->estado_id,
                    'fecha_estado' => $fecha_estado
                    ]);
        
        Preaprobado::where('consecutivo', $request->consecutivo)
            ->update(['estado_id' => $this->estado_id,
                    'fecha_estado' => $fecha_estado
                    ]);

        Aprobado::where('consecutivo', $request->consecutivo)
            ->update(['estado_id' => $this->estado_id,
                    'fecha_estado' => $fecha_estado
                    ]);

        Reserva::where('consecutivo', $request->consecutivo)
            ->update(['estado_id' => $this->estado_id,
                    'fecha_estado' => $fecha_estado
                    ]);

        Pago::where('consecutivo', $request->consecutivo)
            ->update(['estado_id' => $this->estado_id,
                    'fecha_estado' => $fecha_estado
                    ]);

        Legalizado::where('consecutivo', $request->consecutivo)
            ->update(['estado_id' => $this->estado_id,
                    'fecha_estado' => $fecha_estado
                    ]);

        return response()->json(['data'=>true]);
    }              
}