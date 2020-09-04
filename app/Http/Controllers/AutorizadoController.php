<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Autorizado;
use Auth;

class AutorizadoController extends Controller
{
    public $etapa_id = 4;
    public $estado_id = 1;
    public $next_etapa_id = 5;
    public $next_estado_id = 2;

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Autorizado
     */
    public function create(array $data)
    {
        $autorizado = Autorizado::create([
            'consecutivo' => $data['consecutivo'],
            'encargado_id' => Auth::user()->cedula,
            'codigo_sigep' => $data['codigo_sigep'],
            'pendiente_codigo_sigep' => $data['pendiente_codigo_sigep'],
            'descripcion_pendiente' => $data['descripcion_pendiente'],
            'etapa_id' => $this->etapa_id,
            'fecha_estado' => date("Y-m-d H:i:s")
        ]);

        return $autorizado;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'codigo_sigep' => 'integer',
            'descripcion_pendiente' => 'string'
        ]);
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

        $this->validator($request->all())->validate();

        try {
            $autorizado = $this->create($request->all());
            $autorizado->save();
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }
        
        try {
            DB::table('tr_consecutivo_etapa_estado')
              ->where('consecutivo', $consecutivo)
              ->where('etapa_id', $this->etapa_id)
              ->update(['estado_id' => $this->next_estado_id],['fecha_estado', date("Y-m-d H:i:s")]) ;
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }

        try {
            DB::table('tr_consecutivo_etapa_estado')
              ->where('consecutivo', $consecutivo)
              ->where('etapa_id', $this->next_etapa_id)
              ->update(['estado_id' => $this->estado_id]);
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }

        return response()->json(['data'=>$queryStatus]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $consecutivo
     * @return \Illuminate\Http\Response
     */
    public function edit($consecutivo)
    {
        $etapas = false;
        $etapa_id = $this->etapa_id;
        $etapa_estado;

        try {
            $etapa_estado = DB::table('tr_etapas AS a')
                        ->leftJoin('tr_consecutivo_etapa_estado AS b', 'b.etapa_id', '=', 'a.etapa_id')
                        ->leftJoin('tr_estados AS c', 'c.estado_id', '=', 'b.estado_id')
                        ->where('b.consecutivo', $consecutivo)
                        ->orderBy('a.etapa_id', 'asc')
                        ->select('a.etapa', 'c.estado_id', 'a.endpoint')
                        ->get();
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }

        return view('etapas/autorizadoView', compact('etapa_id','consecutivo','etapas','etapa_estado'));
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

        $this->validator($request->all())->validate();

        $data = $request->except('_token');
        $data['etapa_id'] = $this->next_etapa_id;
        $data['fecha_estado'] = date("Y-m-d H:i:s");

        try {
            Autorizado::where('consecutivo', $consecutivo)
                        ->update($data);
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }

        return response()->json(['data'=>$data]);
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