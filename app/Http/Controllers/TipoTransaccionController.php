<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoTransaccionController extends Controller
{
    public $tipoTransaccion = 'tr_tipostransaccion';
    public $columna = 'tipo_transaccion';
    public $numeroDatos = 5;
    public $en_proceso = 4;
    public $cargo_sap = 2;

    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $opcion = 'tipos_transaccion'; 
        $tiposTransaccion = DB::table($this->tipoTransaccion)
                        ->orderBy($this->columna)
                        ->paginate($this->numeroDatos);
        
        return view('configuration.tipoTransaccionView', compact('opcion', 'tiposTransaccion'));
    }

    /**
     * Display a specific page.
     *
     * @return \Illuminate\Http\Response
     */
    public function pagination()
    {
        $tiposTransaccion;
        try {
            $tiposTransaccion = DB::table($this->tipoTransaccion)
                            ->orderBy($this->columna)
                            ->paginate($this->numeroDatos);
        } catch(Exception $e) {
            $tiposTransaccion = "error";
        }
        
        return json_encode($tiposTransaccion);
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
        $queryStatus;
        $sap = null;

        if($request->value['sap']){
            $sap = $this->cargo_sap;
        }
        try {
            DB::table($this->tipoTransaccion)->insert(
                [
                    $this->columna => $request->value['item'], 
                    'cargo_id' => $sap, 
                    'estado_id' => $this->en_proceso
                ]
            );
            $queryStatus = "ok";
        } catch(Exceion $e) {
            $queryStatus = "error";
        }
        
        return response()->json(['data'=>$queryStatus]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $data
     * @return \Illuminate\Http\Response
     */
    public function show($data)
    {

        $tipoTransaccion = DB::table($this->tipoTransaccion)
            ->where($this->columna, 'like', '%'.$data.'%')
            ->orderBy($this->columna)
            ->get();
        
        return response()->json(['data'=>$tipoTransaccion]);
    }

    /**
     * Display all.
     *
     * @param  int  $data
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        $tipoTransaccion;
        try {
            $tipoTransaccion = DB::table($this->tipoTransaccion)
                ->where('estado_id', $this->en_proceso)
                ->orderBy($this->columna)
                ->get();
        } catch(Exception $e) {
            $tipoTransaccion = "error";
        }
        
        return response()->json(['data'=>$tipoTransaccion]);
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
    public function update(Request $request)
    {
        $queryStatus;
        try {
            DB::table($this->tipoTransaccion)
              ->where('id', $request->id)
              ->update([$this->columna => $request->value]);
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }
        
        return response()->json(['data' => $queryStatus]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateEstado(Request $request)
    {
        $queryStatus;
        $columna;
        if($request->columna == "sap"){
            $columna = 'cargo_id';
        }else{
            $columna = 'estado_id';
        }
        try {
            DB::table($this->tipoTransaccion)
                ->where('id', $request->id)
                ->update([$columna => $request->value]);
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }
        return response()->json(['data'=>$queryStatus]);
    }
}
