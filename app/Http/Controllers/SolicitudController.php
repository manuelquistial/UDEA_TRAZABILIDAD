<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Solicitud;
use App\ConsecutivoEtapaEstado;
use App\CentroCostos;
use Auth;

class SolicitudController extends Controller
{
    public $etapa_id = 2;
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
        $centro_costos;
        
        $consultas = new ConsultasController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        $centro_costos = CentroCostos::get();

        return view('etapas/solicitudView', compact('route','etapa_id','etapas','etapa_estado','consecutivo','centro_costos'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Presolicitud--
     */
    public function create(array $data)
    {
        $solicitud = Solicitud::create([
            'encargado_id' => Auth::user()->cedula,
            'consecutivo' => $data['consecutivo'],
            'centro_costos_id' => $data['centro_costos_id'],
            'codigo_sigep_id' => $data['codigo_sigep_id'],
            'fecha_conveniencia' => $data['fecha_conveniencia'],
            'concepto' => $data['concepto'],
            'estado_id' => $this->estado_id,
            'fecha_estado' => date("Y-m-d H:i:s")
        ]);

        return $solicitud;
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
            'fecha_conveniencia' => 'required|date',
            'centro_costos_id' => 'required|integer',
            'codigo_sigep_id' => 'required|integer',
            'concepto' => 'required|string'
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

        $solicitud = $this->create($request->all());
        $solicitud->save();
    
        return redirect()->route('edit_solicitud', $request->consecutivo)->with('status', true);
        //return response()->json(['data'=>$queryStatus]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $consecutivo
     * @return \Illuminate\Http\Response
     */
    public function show($consecutivo)
    {
        $route = "show";
        $etapas = false;
        $etapa_id = $this->etapa_id;
        $data;
        $centro_costo;
        
        $consultas = new ConsultasController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        $data = Solicitud::where('consecutivo', $consecutivo)->first();

        $centro_costos = CentroCostos::get();
        
        return view('etapas/solicitudView', compact('route','data','etapa_id','etapas','consecutivo','etapa_estado','centro_costos'));
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
        $data;
        $centro_costo;
        
        $consultas = new ConsultasController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        $data = Solicitud::where('consecutivo', $consecutivo)->first();

        $centro_costos = CentroCostos::get();
        
        return view('etapas/solicitudView', compact('route','data','etapa_id','etapas','consecutivo','etapa_estado','centro_costos'));
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

        Solicitud::where('consecutivo', $request->consecutivo)
                ->update($data);

        return redirect()->route('edit_solicitud', $request->consecutivo)->with('status', true);
    }

    /**
     * Get estado of etapa
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getEstado(Request $request)
    {
        $estado = Solicitud::where('consecutivo', $request->consecutivo)
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
