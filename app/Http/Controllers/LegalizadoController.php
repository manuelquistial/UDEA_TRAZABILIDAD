<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Legalizado;
use App\ActualEtapaEstado;
use App\Aprobado;
use App\Presolicitud;
use App\Usuario;
use Auth;

class LegalizadoController extends Controller
{
    public $etapa_id = 9;
    public $en_proceso = 1;
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
    public function index($consecutivo)
    {
        $data = Legalizado::where('consecutivo', $consecutivo)->first();
        if($data){
            $estado = $data->estado_id;
            if($estado['estado_id'] == 1){
                return redirect()->route('edit_legalizado', $consecutivo);
            }else if(($estado == 2) || ($estado == 3)){
                return redirect()->route('show_legalizado', $consecutivo);
            }
        }

        $route = "index";
        $etapas = true;
        $etapa_id = $this->etapa_id;
        $reserva = null;
        $egreso = null;

        
        $consultas = new MainController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        $crp = Aprobado::where('consecutivo', $consecutivo)
            ->select('crp')
            ->first();
            
        if(isset($crp->crp)){

            $egreso = DB::connection('mysql_sigep')
                        ->table('documentos_soporte as ds')
                        ->join('movimientos as m', 'm.codigo_operacion','=','ds.codigo_operacion')
                        ->where('m.habilitado', 1) 
                        ->where('ds.tipo_documento', 33) // 33 CRP
                        ->where('ds.numero_documento', $crp->crp)
                        ->where('m.Tipo', 2)
                        ->select(DB::raw('sum(m.Valor) egreso'))
                        ->get();

            $egreso = json_decode($egreso)[0];

            $reserva = DB::connection('mysql_sigep')
                        ->table('documentos_soporte as ds')
                        ->join('movimientos as m', 'm.codigo_operacion','=','ds.codigo_operacion')
                        ->where('m.habilitado', 1) 
                        ->where('ds.tipo_documento', 33) // 33 CRP
                        ->where('ds.numero_documento', $crp->crp)
                        ->where('m.Tipo', 3)
                        ->select(DB::raw('sum(m.Valor) reserva'))
                        ->get();

            $reserva = json_decode($reserva)[0];
        }

        $proyecto = Presolicitud::where('consecutivo', $consecutivo)->select('usuario_id','estado_id','transaccion_id')->first();
        $tipo_transaccion = $proyecto->transaccion_id;
        if(($tipo_transaccion == 1) || ($tipo_transaccion == 3) || ($tipo_transaccion == 18) || ($tipo_transaccion == 25)){
            $tipo_transaccion = 1;
        }else{
            $tipo_transaccion = 0;
        }
        $estado = $proyecto->estado_id;
        $usuario_nombre = Usuario::where('cedula',$proyecto->usuario_id)->select('nombre_apellido')->first();

        return view('etapas/legalizadoView', compact('route','etapa_id','consecutivo','etapas','etapa_estado','crp','usuario_nombre','estado','egreso','reserva','data','tipo_transaccion'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Legalizado
     */
    public function create(array $data)
    {
        $legalizado = Legalizado::create([
            'consecutivo' => $data['consecutivo'],
            'encargado_id' => Auth::user()->cedula,
            'valor_reintegro' => $this->startEndSpaces($data['valor_reintegro']),
            'consecutivo_reingreso' => $this->startEndSpaces($data['consecutivo_reingreso']),
            'estado_id' => $this->en_proceso,
            'fecha_estado' => date("Y-m-d H:i:s")
        ]);

        return $legalizado;
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
            'valor_reintegro' => 'integer',
            'consecutivo_reingreso' => 'integer'
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
        $data = $request->all();
        $data['valor_reintegro'] = $this->replaceDots($data['valor_reintegro']);
        $this->validator($data)->validate();

        $legalizado = $this->create($request->all());
        $legalizado->save();

        ActualEtapaEstado::where('consecutivo', $request->consecutivo)
                ->update(['etapa_id' => $this->etapa_id,
                        'estado_id' => $this->en_proceso,
                        'fecha_estado' => date("Y-m-d H:i:s")
                        ]);

        return redirect()->route('edit_legalizado', $request->consecutivo)->with('status', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($consecutivo)
    {
        $data = Legalizado::where('consecutivo', $consecutivo)->first();
        if($data){
            $estado = $data->estado_id;
            if($estado['estado_id'] == 1){
                return redirect()->route('edit_legalizado', $consecutivo);
            }
        }

        $route = "show";
        $etapas = false;
        $etapa_id = $this->etapa_id;
        $reserva = null;
        $egreso = null;
        
        $consultas = new MainController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        $crp = Aprobado::where('consecutivo', $consecutivo)
            ->select('crp')
            ->first();
            
        if(isset($crp->crp)){

            $egreso = DB::connection('mysql_sigep')
                        ->table('documentos_soporte as ds')
                        ->join('movimientos as m', 'm.codigo_operacion','=','ds.codigo_operacion')
                        ->where('m.habilitado', 1) 
                        ->where('ds.tipo_documento', 33) // 33 CRP
                        ->where('ds.numero_documento', $crp->crp)
                        ->where('m.Tipo', 2)
                        ->select(DB::raw('sum(m.Valor) egreso'))
                        ->get();

            $egreso = json_decode($egreso)[0];

            $reserva = DB::connection('mysql_sigep')
                        ->table('documentos_soporte as ds')
                        ->join('movimientos as m', 'm.codigo_operacion','=','ds.codigo_operacion')
                        ->where('m.habilitado', 1) 
                        ->where('ds.tipo_documento', 33) // 33 CRP
                        ->where('ds.numero_documento', $crp->crp)
                        ->where('m.Tipo', 3)
                        ->select(DB::raw('sum(m.Valor) reserva'))
                        ->get();

            $reserva = json_decode($reserva)[0];
        }

        $proyecto = Presolicitud::where('consecutivo', $consecutivo)->select('usuario_id','estado_id','transaccion_id')->first();
        $tipo_transaccion = $proyecto->transaccion_id;
        if(($tipo_transaccion == 1) || ($tipo_transaccion == 3) || ($tipo_transaccion == 18) || ($tipo_transaccion == 25)){
            $tipo_transaccion = 1;
        }else{
            $tipo_transaccion = 0;
        }
        $estado = $proyecto->estado_id;
        $usuario_nombre = Usuario::where('cedula',$proyecto->usuario_id)->select('nombre_apellido')->first();

        return view('etapas/legalizadoView', compact('route','etapa_id','consecutivo','etapas','etapa_estado','data','crp','usuario_nombre','estado','egreso','reserva','tipo_transaccion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $consecutivo
     * @return \Illuminate\Http\Response
     */
    public function edit($consecutivo)
    {
        $data = Legalizado::where('consecutivo', $consecutivo)->first();
        if($data){
            $estado = $data->estado_id;
            if(($estado == 2) || ($estado == 3)){
                return redirect()->route('show_legalizado', $consecutivo);
            }
        }

        $route = "edit";
        $etapas = false;
        $etapa_id = $this->etapa_id;
        $reserva = null;
        $egreso = null;
        
        $consultas = new MainController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        $crp = Aprobado::where('consecutivo', $consecutivo)
            ->select('crp')
            ->first();
            
        if(isset($crp->crp)){

            $egreso = DB::connection('mysql_sigep')
                        ->table('documentos_soporte as ds')
                        ->join('movimientos as m', 'm.codigo_operacion','=','ds.codigo_operacion')
                        ->where('m.habilitado', 1) 
                        ->where('ds.tipo_documento', 33) // 33 CRP
                        ->where('ds.numero_documento', $crp->crp)
                        ->where('m.Tipo', 2)
                        ->select(DB::raw('sum(m.Valor) egreso'))
                        ->get();

            $egreso = json_decode($egreso)[0];

            $reserva = DB::connection('mysql_sigep')
                        ->table('documentos_soporte as ds')
                        ->join('movimientos as m', 'm.codigo_operacion','=','ds.codigo_operacion')
                        ->where('m.habilitado', 1) 
                        ->where('ds.tipo_documento', 33) // 33 CRP
                        ->where('ds.numero_documento', $crp->crp)
                        ->where('m.Tipo', 3)
                        ->select(DB::raw('sum(m.Valor) reserva'))
                        ->get();

            $reserva = json_decode($reserva)[0];
        }

        $$proyecto = Presolicitud::where('consecutivo', $consecutivo)->select('usuario_id','estado_id','transaccion_id')->first();
        $tipo_transaccion = $proyecto->transaccion_id;
        if(($tipo_transaccion == 1) || ($tipo_transaccion == 3) || ($tipo_transaccion == 18) || ($tipo_transaccion == 25)){
            $tipo_transaccion = 1;
        }else{
            $tipo_transaccion = 0;
        }
        $estado = $proyecto->estado_id;
        $usuario_nombre = Usuario::where('cedula',$proyecto->usuario_id)->select('nombre_apellido')->first();

        return view('etapas/legalizadoView', compact('route','etapa_id','consecutivo','etapas','etapa_estado','data','usuario_nombre','estado','crp','egreso','reserva','tipo_transaccion'));
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
        $data = $request->except('_token');
        $data['valor_reintegro'] = $this->replaceDots($data['valor_reintegro']);
        $this->validator($data)->validate();

        Legalizado::where('consecutivo', $request->consecutivo)
                    ->update($data);

        return redirect()->route('edit_legalizado', $request->consecutivo)->with('status', true);
    }

    /**
     * Get estado of etapa
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getEstado(Request $request)
    {
        $estado = Legalizado::where('consecutivo', $request->consecutivo)
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
        Legalizado::where('consecutivo', $request->consecutivo)
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

    public function startEndSpaces($str){
        return trim($str, $this->espacio);
    }

    public function replaceDots($value){
        return preg_replace('/\./m', '', $value);
    }
}
