<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Presolicitud;
use App\Autorizado;
use App\ActualEtapaEstado;
use App\TiposTransaccion;
use App\Correos;
use App\Usuario;
use Auth;

class AutorizadoController extends Controller
{
    public $etapa_id = 4;
    public $en_proceso = 1;
    public $confirmado = 2;
    public $espacio = " ";
    public $cargo_sap_id = 3;

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
        $data = Autorizado::where('consecutivo', $consecutivo)->first();
        if($data){
            $estado = $data->estado_id;
            if($estado['estado_id'] == 1){
                return redirect()->route('edit_autorizado', $consecutivo);
            }else if(($estado == 2) || ($estado == 3)){
                return redirect()->route('show_autorizado', $consecutivo);
            }
        }

        $route = "index";
        $etapas = true;
        $etapa_id = $this->etapa_id;
        
        $consultas = new MainController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        $proyecto = Presolicitud::where('consecutivo', $consecutivo)->select('usuario_id','estado_id')->first();
        $estado = $proyecto->estado_id;
        $usuario_nombre = Usuario::where('cedula',$proyecto->usuario_id)->select('nombre_apellido')->first();

        return view('etapas/autorizadoView', compact('route','etapa_id','consecutivo','etapas','etapa_estado','usuario_nombre','estado'));
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
            'codigo_sigep' => $this->returnNull($this->startEndSpaces($data['codigo_sigep'])),
            'descripcion_pendiente' => $this->startEndSpaces($data['descripcion_pendiente']),
            'estado_id' => $this->en_proceso,
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
            'codigo_sigep' => 'integer|nullable'
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
        if($this->returnNull($request->descripcion_pendiente) == null & $this->returnNull($request->codigo_sigep) == null){
            return redirect()->route('autorizado', $request->consecutivo)->with('empty', true);
        }

        $this->validator($request->all())->validate();
        
        $autorizado = $this->create($request->all());
        $autorizado->save();

        ActualEtapaEstado::where('consecutivo', $request->consecutivo)
                ->update(['etapa_id' => $this->etapa_id,
                        'estado_id' => $this->en_proceso,
                        'fecha_estado' => date("Y-m-d H:i:s")
                        ]);

        DB::table('tr_correos')->insert(
            [
                'consecutivo' => $request->consecutivo, 
                'codigo' => $request->codigo_sigep,
                'etapa' => $this->etapa_id,
                'enviado' => 0,
                'fecha_envio' => null
            ]
        );

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
        $data = Autorizado::where('consecutivo', $consecutivo)->first();
        if($data){
            $estado = $data->estado_id;
            if($estado['estado_id'] == 1){
                return redirect()->route('edit_autorizado', $consecutivo);
            }
        }
        $route = "show";
        $etapas = false;
        $etapa_id = $this->etapa_id;
        
        $consultas = new MainController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        $proyecto = Presolicitud::where('consecutivo', $consecutivo)->select('usuario_id','estado_id')->first();
        $estado = $proyecto->estado_id;
        $usuario_nombre = Usuario::where('cedula',$proyecto->usuario_id)->select('nombre_apellido')->first();

        return view('etapas/autorizadoView', compact('route','etapa_id','consecutivo','etapas','etapa_estado','data','usuario_nombre','estado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $consecutivo
     * @return \Illuminate\Http\Response
     */
    public function edit($consecutivo)
    {
        $data = Autorizado::where('consecutivo', $consecutivo)->first();
        if($data){
            $estado = $data->estado_id;
            if(($estado == 2) || ($estado == 3)){
                return redirect()->route('show_autorizado', $consecutivo);
            }
        }

        $route = "edit";
        $etapas = false;
        $etapa_id = $this->etapa_id;
        
        $consultas = new MainController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        $proyecto = Presolicitud::where('consecutivo', $consecutivo)->select('usuario_id','estado_id')->first();
        $estado = $proyecto->estado_id;
        $usuario_nombre = Usuario::where('cedula',$proyecto->usuario_id)->select('nombre_apellido')->first();

        return view('etapas/autorizadoView', compact('route','etapa_id','consecutivo','etapas','etapa_estado','data','usuario_nombre','estado'));
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
        
        $data['fecha_estado'] = date("Y-m-d H:i:s");

        Autorizado::where('consecutivo', $request->consecutivo)
                ->update($data);

        DB::table('tr_correos')
            ->where('consecutivo', $request->consecutivo)
            ->where('etapa', $this->etapa_id)
            ->update(['codigo' => $request->codigo_sigep]);

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
     * Set estado of etapa
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setEstado(Request $request)
    {
        Autorizado::where('consecutivo', $request->consecutivo)
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
            $tipoTransaccion = TiposTransaccion::where('id', $proyecto->transaccion_id)->select('tipo_transaccion')->first();

            /*$usuario_sap = new Cargos();
            $usuario_sap = $usuario_sap->usuarioByCargo($this->cargo_sap_id)->first();*/
            $usuario = Usuario::where('cedula',$proyecto->usuario_id)->select('email')->first();

            $data = (object)[];
            $data->email = $usuario->email;
            $data->consecutivo = $request->consecutivo;
            $data->etapa_id = $this->etapa_id;
            $data->nombre_proyecto = $proyecto->nombre_proyecto;
            $data->tipo_transaccion = $tipoTransaccion->tipo_transaccion;
            $data->gestor = false;

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
