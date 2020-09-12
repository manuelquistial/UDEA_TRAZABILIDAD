<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CentroCostosController extends Controller
{
    public $centro_costos = 'tr_centro_costos';
    public $columna = 'centro_costo';
    public $numeroDatos = 5;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:Administrador']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $general = 2;
        $opcion = 'centro_costos'; 
        $centro_costos;
        try{
            $centro_costos = DB::table($this->centro_costos)
                                ->orderBy($this->columna)
                                ->paginate($this->numeroDatos);
        }catch(Exception $e) {
            $centro_costos = "error";
        }
        return view('configuration.centroCostosView', compact('opcion', 'general', 'centro_costos'));
    }

    /**
     * Display a specific page.
     *
     * @return \Illuminate\Http\Response
     */
    public function pagination()
    {
        $centro_costos;
        try{
            $centro_costos = DB::table($this->centro_costos)
                            ->orderBy($this->columna)
                            ->paginate($this->numeroDatos);
        } catch(Exception $e) {
            $centro_costos = "error";
        }
        return json_encode($centro_costos);
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
        try {
            DB::table($this->centro_costos)->insert(
                [$this->columna => $request->item]
            );
            $queryStatus = "ok";
        } catch(Exception $e) {
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
        $centro_costos;
        try {
            $centro_costos = DB::table($this->centro_costos)
                    ->where($this->columna, 'like', $data.'%')
                    ->orderBy($this->columna)
                    ->get();
        } catch(Exception $e) {
            $centro_costos = "error";
        }
        return response()->json(['data'=>$centro_costos]);
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
        $queryStatus;
        try {
            DB::table($this->centro_costos)
              ->where('id', $id)
              ->update([$this->columna => $request->value]);
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }
        
        return response()->json(['data'=>$queryStatus]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_estado(Request $request)
    {
        $queryStatus;
        $columna;
        if($request->columna == "habilitar"){
            $columna = 'estado_id';
        }
        try {
            DB::table($this->centro_costos)
                ->where('id', $request->id)
                ->update([$columna => $request->value]);
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }
        return response()->json(['data'=>$queryStatus]);
    }
}
