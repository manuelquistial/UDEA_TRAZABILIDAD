<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class TransaccionesController extends Controller
{
    public $numeroDatos = 5;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.;
     *
     * @return \Illuminate\Http\Response
     */
    public function show_consulta_usuario()
    {
        $consulta = false;
        $transacciones;
        $queryStatus;

        try {
            $transacciones = DB::table('tr_presolicitud AS a')
                    ->join('tr_consecutivo_etapa_estado AS b', function($query){
                        $query->on('b.consecutivo', '=', 'a.consecutivo')
                                ->on('b.etapa_id', '=', 'a.etapa_id');  
                    })
                    ->join('tr_etapas AS c', 'c.etapa_id', '=', 'b.etapa_id')
                    ->join('tr_estados AS d', 'd.estado_id', '=', 'b.estado_id')
                    ->join('tr_tipostransaccion AS e', 'e.id', '=', 'a.transaccion_id')
                    ->where('a.usuario_id', Auth::user()->cedula)
                    ->select('a.consecutivo', 'c.etapa', 'd.estado', 'e.tipo_transaccion')
                    ->paginate($this->numeroDatos);
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }
        
        return view('transaccionesView', compact('consulta','transacciones'));
    }

    /**
     * Display a listing of the resource.;
     *
     * @return \Illuminate\Http\Response
     */
    public function show_consulta_gestores()
    {
        $tipoTransaccion;
        $transacciones;
        $queryStatus;
        $consulta = true;
        try {
            $tipoTransaccion = Auth::user()->tiposTransaccion;
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }

        try {
            $transacciones = DB::table('tr_presolicitud AS a')
                    ->join('tr_consecutivo_etapa_estado AS b', function($query){
                        $query->on('b.consecutivo', '=', 'a.consecutivo')
                                ->on('b.etapa_id', '=', 'a.etapa_id');
                    })
                    ->join('tr_etapas AS c', 'c.etapa_id', '=', 'b.etapa_id')
                    ->join('tr_estados AS d', 'd.estado_id', '=', 'b.estado_id')
                    ->where('a.transaccion_id', $tipoTransaccion->first()->id)
                    ->select('a.consecutivo', 'c.etapa', 'd.estado', 'c.endpoint')
                    ->paginate($this->numeroDatos);
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }
        
        return view('transaccionesView', compact('consulta','tipoTransaccion','transacciones'));
        //return response()->json(['data'=>$transacciones[0]->endpoint]);
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
        $transacciones;
        $queryStatus;
        try {
            $tipoTransaccion = Auth::user()->tiposTransaccion;
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }

        try {
            $transacciones = DB::table('tr_presolicitud AS a')
                    ->join('tr_consecutivo_etapa_estado AS b', function($query){
                        $query->on('b.consecutivo', '=', 'a.consecutivo')
                                ->on('b.etapa_id', '=', 'a.etapa_id');
                    })
                    ->join('tr_etapas AS c', 'c.etapa_id', '=', 'b.etapa_id')
                    ->join('tr_estados AS d', 'd.estado_id', '=', 'b.estado_id')
                    ->where('a.transaccion_id', $id)
                    ->select('a.consecutivo', 'c.etapa', 'd.estado', 'c.endpoint')
                    ->paginate($this->numeroDatos);
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function emails(){
        return view('emailsView');
    }
}
