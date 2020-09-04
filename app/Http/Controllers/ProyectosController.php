<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProyectosController extends Controller
{
    public $proyecto = 'tr_proyectos';
    public $columna = 'proyecto';
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
        $opcion = 'proyectos'; 
        $proyectos;
        try{
            $proyectos = DB::table($this->proyecto)
                                ->orderBy($this->columna)
                                ->paginate($this->numeroDatos);
        } catch(Exception $e) {
            $proyectos = "error";
        }
        return view('configuration.proyectosView', compact('opcion', 'general', 'proyectos'));
    }

    /**
     * Display a specific page.
     *
     * @return \Illuminate\Http\Response
     */
    public function pagination()
    {
        $proyectos;
        try{
            $proyectos = DB::table($this->proyecto)
                            ->orderBy($this->columna)
                            ->paginate($this->numeroDatos);
        } catch(Exception $e) {
            $proyectos = "error";
        }
        return json_encode($proyectos);
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
            DB::table($this->proyecto)->insert(
                [$this->columna => $request->value]
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
        $proyecto;
        try {
            $proyecto = DB::table($this->proyecto)
                    ->where($this->columna, 'like', $data.'%')
                    ->orderBy($this->columna)
                    ->get();
        } catch(Exception $e) {
            $proyecto = "error";
        }
        return response()->json(['data'=>$proyecto]);
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
            DB::table($this->proyecto)
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
    public function change_estado(Request $request)
    {
        $queryStatus;
        $columna;
        if($request->columna == "habilitar"){
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
