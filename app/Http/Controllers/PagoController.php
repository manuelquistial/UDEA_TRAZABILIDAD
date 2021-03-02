<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Pago;
use App\Aprobado;
use App\Presolicitud;
use App\Usuario;
use App\TiposTransaccion;
use App\ActualEtapaEstado;

class PagoController extends Controller
{
    public $etapa_id = 8;
    public $confirmado = 2;
    public $en_proceso = 1;

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
        $data = Pago::where('consecutivo', $consecutivo)->first();
        if($data){
            $estado = $data->estado_id;
            if($estado['estado_id'] == 1){
                return redirect()->route('edit_pago', $consecutivo);
            }else if(($estado == 2) || ($estado == 3)){
                return redirect()->route('show_pago', $consecutivo);
            }
        }

        $route = 'index';
        $etapa_id = $this->etapa_id;
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
        }

        $proyecto = Presolicitud::where('consecutivo', $consecutivo)->select('usuario_id')->first();
        $usuario_nombre = Usuario::where('cedula',$proyecto->usuario_id)->select('nombre_apellido')->first();

        return view('etapas/pagoView', compact('route','etapa_id','consecutivo','etapa_estado','crp','egreso','usuario_nombre'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Pago
     */
    public function create(array $data)
    {
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($consecutivo)
    {
        $data = Pago::where('consecutivo', $consecutivo)->first();
        if($data){
            $estado = $data->estado_id;
            if($estado['estado_id'] == 1){
                return redirect()->route('edit_pago', $consecutivo);
            }
        }

        $route = 'show';
        $etapa_id = $this->etapa_id;
        
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
        }

        $proyecto = Presolicitud::where('consecutivo', $consecutivo)->select('usuario_id')->first();
        $usuario_nombre = Usuario::where('cedula',$proyecto->usuario_id)->select('nombre_apellido')->first();

        return view('etapas/pagoView', compact('route','etapa_id','consecutivo','etapa_estado','data','crp','usuario_nombre','egreso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $consecutivo
     * @return \Illuminate\Http\Response
     */
    public function edit($consecutivo)
    {
        $data = Pago::where('consecutivo', $consecutivo)->first();
        if($data){
            $estado = $data->estado_id;
            if(($estado == 2) || ($estado == 3)){
                return redirect()->route('show_pago', $consecutivo);
            }
        }

        $route = 'edit';
        $etapa_id = $this->etapa_id;
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
        }
        
        $proyecto = Presolicitud::where('consecutivo', $consecutivo)->select('usuario_id')->first();
        $usuario_nombre = Usuario::where('cedula',$proyecto->usuario_id)->select('nombre_apellido')->first();

        return view('etapas/pagoView', compact('route','etapa_id','consecutivo','etapa_estado','crp','usuario_nombre','egreso'));
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
     * Get estado of etapa
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getEstado(Request $request)
    {
        $estado = Pago::where('consecutivo', $request->consecutivo)
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
        Pago::where('consecutivo', $request->consecutivo)
                ->update(['estado_id' => $request->estado_id,
                        'fecha_estado' => date("Y-m-d H:i:s")
                        ]);
            
        ActualEtapaEstado::where('consecutivo', $request->consecutivo)
                ->update(['etapa_id' => $this->etapa_id,
                        'estado_id' => $request->estado_id,
                        'fecha_estado' => date("Y-m-d H:i:s")
                        ]);

        if($request->estado_id == $this->confirmado){
            $proyecto = Presolicitud::where('consecutivo', $request->consecutivo)->select('nombre_proyecto','transaccion_id','usuario_id')->first();
            $tipoTransaccion = TiposTransaccion::where('id', $proyecto->transaccion_id)->select('tipo_transaccion','cargo_id')->first();
            
            $data = (object)[];
            $data->nombre_proyecto = $proyecto->nombre_proyecto;
            $data->tipo_transaccion = $tipoTransaccion->tipo_transaccion;
            $data->consecutivo = $request->consecutivo;
            $data->etapa_id = $this->etapa_id;
            $data->gestor = false;
            $data->sap = false;

            $usuario = Usuario::where('cedula',$proyecto->usuario_id)->select('email')->first();

            $data->email = $usuario->email;
            $email_controller = new CorreosController;
            $email_controller->email($data);
        }

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
}
