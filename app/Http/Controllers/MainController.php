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
use App\ConsecutivoEtapaEstado;

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

    public function downloads(Request $request){
        return response()->file(storage_path('app/public/'.$request->path));
    }

    public function uploadFile($request, $path){
        if($request->hasFile('anexos')) {
            foreach($request['anexos'] as $file) {
                $file_name = str_replace(' ', '_', $file->getClientOriginalName());
                $path = $file->storeAs($path. $request->consecutivo . '/', $file_name);
                info($path);
            }
        }
    }
}