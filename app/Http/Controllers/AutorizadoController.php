<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Autorizado;
use App\ConsecutivoEtapaEstado;
use Auth;

class AutorizadoController extends Controller
{
    public $etapa_id = 4;
    public $estado_id = 1;

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($consecutivo)
    {
        $route = "index";
        $etapas = true;
        $etapa_id = $this->etapa_id;
        
        $consultas = new ConsultasController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        return view('etapas/autorizadoView', compact('route','etapa_id','consecutivo','etapas','etapa_estado'));
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
            'pendiente_codigo_sigep' => NULL,
            'descripcion_pendiente' => NULL,
            'estado_id' => $this->estado_id,
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
        $this->validator($request->all())->validate();

        $autorizado = $this->create($request->all());
        $autorizado->save();


        return redirect()->route('edit_autorizado', $request->consecutivo)->with('status', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($consecutivo)
    {
        $route = "show";
        $etapas = false;
        $etapa_id = $this->etapa_id;
        
        $consultas = new ConsultasController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        $data = Autorizado::where('consecutivo', $consecutivo)->first();

        return view('etapas/autorizadoView', compact('route','etapa_id','consecutivo','etapas','etapa_estado','data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $consecutivo
     * @return \Illuminate\Http\Response
     */
    public function edit($consecutivo)
    {
        $route = "edit";
        $etapas = false;
        $etapa_id = $this->etapa_id;
        
        $consultas = new ConsultasController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        $data = Autorizado::where('consecutivo', $consecutivo)->first();

        return view('etapas/autorizadoView', compact('route','etapa_id','consecutivo','etapas','etapa_estado','data'));
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
        $this->validator($request->all())->validate();

        $data = $request->except('_token');
        $data['etapa_id'] = $this->next_etapa_id;
        $data['fecha_estado'] = date("Y-m-d H:i:s");

        Autorizado::where('consecutivo', $request->consecutivo)
                ->update($data);

        return redirect()->route('edit_autorizado', $request->consecutivo)->with('status', true);
    }

    /**
     * Get estado of etapa
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getEstado(Request $request)
    {
        $estado = Autorizado::where('consecutivo', $request->consecutivo)
                ->select('estado_id')
                ->first();
            
        return response()->json(['data'=>$estado]);
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
