<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Usuario;
use App\Presolicitud;
use App\ActualEtapaEstado;
use App\TiposTransaccion;
use App\Etapa;
use Auth;

class PresolicitudController extends Controller
{
    public $etapa_id = 1;
    public $estado_id = 1;
    public $espacio = " ";

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
        $etapas = true;
        $route = "index";
        $etapa_id = 0;

        $tipoTransaccion = TiposTransaccion::get();

        $proyecto = DB::connection('mysql_sigep')
                    ->table('proyectos')
                    ->where('Estado', 1)
                    ->select('nombre', 'codigo')
                    ->orderBy('nombre', 'asc')
                    ->get();

        return view('etapas/presolicitudView', compact('route','etapa_id','etapas','tipoTransaccion','proyecto'));
        //return response()->json([''=>$proyecto]);
    }

    /**
     * Create a new usuario instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Presolicitud
     */
    public function create(array $data)
    {
        $presolicitud = Presolicitud::create([
            'usuario_id' => Auth::user()->cedula,
            'encargado_id' => NULL,
            'proyecto_id' => $this->startEndSpaces($data['proyecto_id'], $this->espacio),
            'otro_proyecto' => $this->startEndSpaces($data['otro_proyecto'], $this->espacio),
            'transaccion_id' => $this->startEndSpaces($data['transaccion_id'], $this->espacio),
            'fecha_inicial' => $this->returnNull($this->startEndSpaces($data['fecha_inicial'], $this->espacio)),
            'fecha_final' => $this->returnNull($this->startEndSpaces($data['fecha_final'], $this->espacio)),
            'valor' => $this->startEndSpaces($data['valor'], $this->espacio),
            'descripcion' => $this->startEndSpaces($data['descripcion'], $this->espacio),
            'estado_id' => $this->estado_id,
            'fecha_estado' => date("Y-m-d H:i:s")
        ]);

        return $presolicitud;
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
            'otro_proyecto' => 'string|nullable',
            'fecha_inicial' => 'date|nullable',
            'fecha_final' => 'date|nullable|after_or_equal:fecha_inicial',
            'valor' => 'required|integer',
            'descripcion' => 'required|string'
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
        $etapa_items;
        $consecutivo;

        $etapa_array = [];
        $this->validator($request->all())->validate();

        $presolicitud = $this->create($request->all());
        $presolicitud->save();
        $consecutivo = $presolicitud->id;

        $actual_etapa_estado = ActualEtapaEstado::create([
            'consecutivo' => $consecutivo,
            'etapa_id' => $this->etapa_id,
            'estado_id' => $this->estado_id,
            'fecha_estado' => date("Y-m-d H:i:s")
        ]);

        $actual_etapa_estado->save();

        return redirect('/')->with('status', true)->with('consecutivo', $consecutivo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($consecutivo)
    {
        $etapas = false;
        $route = "show";
        $etapa_id = $this->etapa_id;
        $etapa_estado;
        $data;
        $tipoTransaccion;
        $proyecto;

        $consultas = new ConsultasController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        $data = Presolicitud::where('consecutivo', $consecutivo)->first();
        
        if($data->fecha_inicial){
            $data->fecha_inicial = date("Y-m-d", strtotime($data->fecha_inicial));
        }
        if($data->fecha_final){
            $data->fecha_final = date("Y-m-d", strtotime($data->fecha_final));
        }

        $tipoTransaccion = TiposTransaccion::get();
        
        $proyecto = DB::connection('mysql_sigep')
                ->table('proyectos')
                ->where('Estado', 1)
                ->select('nombre', 'codigo')
                ->orderBy('nombre', 'asc')
                ->get();

        return view('etapas/presolicitudView', compact('route','etapa_id','etapas','consecutivo','data','etapa_estado','tipoTransaccion','proyecto'));
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
        $route = "edit";
        $etapa_id = 0;
        $etapa_estado;
        $data;
        $tipoTransaccion;
        $proyecto;

        $consultas = new ConsultasController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        $data = Presolicitud::where('consecutivo', $consecutivo)->first();

        if($data->fecha_inicial){
            $data->fecha_inicial = date("Y-m-d", strtotime($data->fecha_inicial));
        }
        if($data->fecha_final){
            $data->fecha_final = date("Y-m-d", strtotime($data->fecha_final));
        }

        $tipoTransaccion = TiposTransaccion::get();
        
        $proyecto = DB::connection('mysql_sigep')
                ->table('proyectos')
                ->where('Estado', 1)
                ->select('nombre', 'codigo')
                ->orderBy('nombre', 'asc')
                ->get(); 

        return view('etapas/presolicitudView', compact('route','etapa_id','etapas','consecutivo','data','etapa_estado','tipoTransaccion','proyecto'));
    }

    /**
     * Change Tipo de Transaccion.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function redirect(Request $request)
    {
        $redirect = 'redirect';
        $tipo_transaccion = Usuario::find(Auth::user()->id)->hasOneTipoTransaccion($request->value);
        
        Presolicitud::where('consecutivo', $request->consecutivo)
                        ->update(['transaccion_id' => $request->value]);

        if($tipo_transaccion){
            $redirect = $request->value;
        }
        //Doesn´t have the tipo de transaccion, so frontend goint to redirecto to Consulta de Gestores
        return response()->json(['data'=>$redirect]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validator($request->all())->validate();

        $data = $request->except('_token');

        Presolicitud::where('consecutivo', $request->consecutivo)
                        ->update($data);

        return redirect()->route('edit_presolicitud', $request->consecutivo)->with('status', true);
    }

    /**
     * Get estado of etapa
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getEstado(Request $request)
    {
        $estado = Presolicitud::where('consecutivo', $request->consecutivo)
                ->select('estado_id')
                ->first();
            
        return response()->json(['data'=>$estado]);
    }

    /**
     * Set estado of etapa
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setEstado(Request $request)
    {
        Presolicitud::where('consecutivo', $request->consecutivo)
                ->update(['estado_id' => $request->estado_id,
                        'fecha_estado' => date("Y-m-d H:i:s")
                        ]);
            
        ActualEtapaEstado::where('consecutivo', $request->consecutivo)
                ->update(['etapa_id' => $this->etapa_id,
                        'estado_id' => $request->estado_id,
                        'fecha_estado' => date("Y-m-d H:i:s")
                        ]);
                        
        return response()->json(['data'=>true]);
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

    public function returnNull($str){
        if($str == ''){
            return NULL;
        }
        return $str;
    }

    public function startEndSpaces($str){
        return trim($str, $this->espacio);
    }
}
