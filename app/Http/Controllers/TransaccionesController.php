<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\TiposTransaccion;
use Auth;

class TransaccionesController extends Controller
{
    public $numeroDatos = 4;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.;
     *
     * @return \Illuminate\Http\Response
     */
    public function showConsultaUsuario()
    {
        $consulta = false;

        $transacciones = DB::table('tr_presolicitud AS a')
                ->leftJoin('tr_tipostransaccion AS e', 'e.id', '=', 'a.transaccion_id')
                ->join('tr_actual_etapa_estado AS b', 'b.consecutivo', '=', 'a.consecutivo')
                ->join('tr_etapas AS c', 'c.etapa_id', '=', 'b.etapa_id')
                ->join('tr_estados AS d', 'd.estado_id', '=', 'b.estado_id')
                ->where('a.usuario_id', Auth::user()->cedula)
                ->select('a.consecutivo', 'c.etapa', 'd.estado', 'e.tipo_transaccion', 'd.estado_id', 'c.endpoint')
                ->orderBy('b.fecha_estado', 'desc')
                ->paginate($this->numeroDatos);
        
        return view('transaccionesView', compact('consulta','transacciones'));
        //return response()->json(['data'=>$transacciones]);
    }

    /**
     * Display a listing of the resource.;
     *
     * @return \Illuminate\Http\Response
     */
    public function showConsultaGestores()
    {
        $consulta = true;
        $tipoTransaccion;

        //SIGEP
        if(Auth::user()->hasOneCargo(2) | Auth::user()->hasOneRole("Administrador")){
            $tipoTransaccion = TiposTransaccion::get();
        }else{
            $tipoTransaccion = Auth::user()->tiposTransaccion;
        }

        $transacciones = DB::table('tr_presolicitud AS a')
                ->join('tr_actual_etapa_estado AS b', 'b.consecutivo', '=', 'a.consecutivo')
                ->join('tr_etapas AS c', 'c.etapa_id', '=', 'b.etapa_id')
                ->join('tr_estados AS d', 'd.estado_id', '=', 'b.estado_id')
                ->where('a.transaccion_id', '=' ,$tipoTransaccion->first()->id)
                ->select('a.consecutivo', 'c.etapa', 'd.estado', 'c.endpoint', 'd.estado_id')
                ->orderBy('b.fecha_estado', 'desc')
                ->paginate($this->numeroDatos);
        
        return view('transaccionesView', compact('consulta','tipoTransaccion','transacciones'));
        //return response()->json(['data'=>$transacciones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $consulta = true;
        $tipoTransaccion;

        //SIGEP
        if(Auth::user()->hasOneCargo(2) | Auth::user()->hasOneRole("Administrador")){
            $tipoTransaccion = TiposTransaccion::get();
        }else{
            $tipoTransaccion = Auth::user()->tiposTransaccion;
        }

        $transacciones = DB::table('tr_presolicitud AS a')
                ->join('tr_actual_etapa_estado AS b', 'b.consecutivo', '=', 'a.consecutivo')
                ->join('tr_etapas AS c', 'c.etapa_id', '=', 'b.etapa_id')
                ->join('tr_estados AS d', 'd.estado_id', '=', 'b.estado_id')
                ->where('a.transaccion_id', $id)
                ->select('a.consecutivo', 'c.etapa', 'd.estado', 'c.endpoint', 'd.estado_id')
                ->orderBy('b.fecha_estado', 'desc')
                ->paginate($this->numeroDatos);

        return view('transaccionesView', compact('consulta','tipoTransaccion','transacciones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
