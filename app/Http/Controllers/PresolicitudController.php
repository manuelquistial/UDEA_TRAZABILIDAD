<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Presolicitud;
use App\TiposTransaccion;
use App\Etapa;
use Auth;

class PresolicitudController extends Controller
{
    public $etapa_id = 1;
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
            'proyecto_id' => $data['proyecto_id'],
            'transaccion_id' => $data['transaccion_id'],
            'fecha_inicial' => $data['fecha_inicial'],
            'fecha_final' => $data['fecha_final'],
            'valor' => $data['valor'],
            'descripcion' => $data['descripcion'],
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

        return redirect('/')->with('status', true);
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

        $tipoTransaccion = TiposTransaccion::get();
        
        $proyecto = DB::connection('mysql_sigep')
                ->table('proyectos')
                ->where('Estado', 1)
                ->select('nombre', 'codigo')
                ->orderBy('nombre', 'asc')
                ->get(); 

        return view('etapas/presolicitudView', compact('etapa_id','etapas','consecutivo','data','etapa_estado','tipoTransaccion','proyecto'));
    }

    /**
     * Change Tipo de Transaccion.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function redirect(Request $request, $consecutivo)
    {
        Presolicitud::where('consecutivo', $consecutivo)
                ->update(['transaccion_id' => $request->value]);
        
        return response()->json(['data'=>$queryStatus]);
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
        $data['estado_id'] = $this->estado_id;
        $data['fecha_estado'] = date("Y-m-d H:i:s");

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
