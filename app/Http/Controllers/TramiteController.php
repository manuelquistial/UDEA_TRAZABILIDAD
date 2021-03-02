<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Presolicitud;
use App\Tramite;
use App\ActualEtapaEstado;
use App\TiposTransaccion;
use App\Cargos;
use App\Usuario;
use Auth;

class TramiteController extends Controller
{
    public $etapa_id = 3;
    public $en_proceso = 1;
    public $confirmado = 2;
    public $espacio = " ";
    public $cargo_sigep_id = 3;
    public $cargo_responsable_id = 4;
    public $sap = 2; 

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
        $data = Tramite::where('consecutivo', $consecutivo)->first();
        if($data){
            $estado = $data->estado_id;
            if($estado['estado_id'] == 1){
                return redirect()->route('edit_tramite', $consecutivo);
            }else if(($estado == 2) || ($estado == 3)){
                return redirect()->route('show_tramite', $consecutivo);
            }
        }

        $route = "index";
        $etapas = true;
        $etapa_id = $this->etapa_id;
        
        $consultas = new MainController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;
        
        $proyecto = Presolicitud::where('consecutivo', $consecutivo)->select('usuario_id','transaccion_id','estado_id')->first();
        $estado = $proyecto->estado_id;
        $usuario_nombre = Usuario::where('cedula',$proyecto->usuario_id)->select('nombre_apellido')->first();
        $tipoTransaccion = TiposTransaccion::where('id', $proyecto->transaccion_id)->select('cargo_id')->first();
        $cargo = Auth::user()->hasOneCargo($this->sap);
        if(($tipoTransaccion['cargo_id'] == 2) && !$cargo){
            $route = 'show';
        }

        return view('etapas/tramiteView', compact('route', 'etapa_id','etapas','consecutivo','etapa_estado','usuario_nombre','estado'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Tramite
     */
    public function create(array $data)
    {
        $tramite = Tramite::create([
            'consecutivo' => $data['consecutivo'],
            'encargado_id' => Auth::user()->cedula,
            'consecutivo_sap' => $this->startEndSpaces($data['consecutivo_sap']),
            'fecha_sap' => $this->returnNull($data['fecha_sap']),
            'estado_id' => $this->en_proceso,
            'fecha_estado' => date("Y-m-d H:i:s")
        ]);

        return $tramite;
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
            'consecutivo_sap' => 'required|string',
            'fecha_sap' => 'required|date'
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

        $tramite = $this->create($request->all());
        $tramite->save();

        ActualEtapaEstado::where('consecutivo', $request->consecutivo)
                ->update(['etapa_id' => $this->etapa_id,
                        'estado_id' => $this->en_proceso,
                        'fecha_estado' => date("Y-m-d H:i:s")
                        ]);

        return redirect()->route('edit_tramite', $request->consecutivo)->with('status', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($consecutivo)
    {
        $data = Tramite::where('consecutivo', $consecutivo)->first();
        if($data){
            $estado = $data->estado_id;
            if($estado['estado_id'] == 1){
                return redirect()->route('edit_tramite', $consecutivo);
            }
        }

        $route = "show";
        $etapas = false;
        $etapa_id = $this->etapa_id;
        
        $consultas = new MainController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        if($data->fecha_sap){
            $data->fecha_sap = date("Y-m-d", strtotime($data->fecha_sap));
        }

        $proyecto = Presolicitud::where('consecutivo', $consecutivo)->select('usuario_id','estado_id')->first();
        $estado = $proyecto->estado_id;
        $usuario_nombre = Usuario::where('cedula',$proyecto->usuario_id)->select('nombre_apellido')->first();

        return view('etapas/tramiteView', compact('route','data','etapa_id','etapas','consecutivo','etapa_estado','usuario_nombre','estado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $consecutivo
     * @return \Illuminate\Http\Response
     */
    public function edit($consecutivo)
    {
        $data = Tramite::where('consecutivo', $consecutivo)->first();
        if($data){
            $estado = $data->estado_id;
            if(($estado == 2) || ($estado == 3)){
                return redirect()->route('show_tramite', $consecutivo);
            }
        }

        $route = "edit";
        $etapas = false;
        $etapa_id = $this->etapa_id;

        $consultas = new MainController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        if($data->fecha_sap){
            $data->ffecha_sap = date("Y-m-d", strtotime($data->fecha_sap));
        }

        $proyecto = Presolicitud::where('consecutivo', $consecutivo)->select('usuario_id','transaccion_id','estado_id')->first();
        $estado = $proyecto->estado_id;
        $usuario_nombre = Usuario::where('cedula',$proyecto->usuario_id)->select('nombre_apellido')->first();

        $tipoTransaccion = TiposTransaccion::where('id', $proyecto->transaccion_id)->select('cargo_id')->first();
        $cargo = Auth::user()->hasOneCargo($this->sap);
        if(($tipoTransaccion['cargo_id'] == 2) && !$cargo){
            $route = 'show';
        }

        return view('etapas/tramiteView', compact('route','etapa_id','etapas','consecutivo','etapa_estado','data','usuario_nombre','estado'));
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

        Tramite::where('consecutivo', $request->consecutivo)
                ->update($data);

        return redirect()->route('edit_tramite', $request->consecutivo)->with('status', true);
    }

    /**
     * Get estado of etapa
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getEstado(Request $request)
    {
        $estado = Tramite::where('consecutivo', $request->consecutivo)
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
        Tramite::where('consecutivo', $request->consecutivo)
                ->update(['estado_id' => $request->estado_id,
                        'fecha_estado' => date("Y-m-d H:i:s")
                        ]);
            
        ActualEtapaEstado::where('consecutivo', $request->consecutivo)
                ->update(['etapa_id' => $this->etapa_id,
                        'estado_id' => $request->estado_id,
                        'fecha_estado' => date("Y-m-d H:i:s")
                        ]);
                        
        if($request->estado_id == $this->confirmado){
            
            $proyecto = Presolicitud::where('consecutivo', $request->consecutivo)->select('nombre_proyecto','transaccion_id')->first();
            $tipoTransaccion = TiposTransaccion::where('id', $proyecto->transaccion_id)->select('tipo_transaccion','cargo_id')->first();
            
            $data = (object)[];
            $data->nombre_proyecto = $proyecto->nombre_proyecto;
            $data->consecutivo = $request->consecutivo;
            $data->etapa_id = $this->etapa_id;
            $data->gestor = false;

            $email_controller = new CorreosController;

            $usuario_cargos = new Cargos();
            $usuario_sigep = $usuario_cargos->usuarioByCargo($this->cargo_sigep_id)->first();
            $usuario_responsable = $usuario_cargos->usuarioByCargo($this->cargo_responsable_id)->select('email')->get();
            $data->tipo_transaccion = $tipoTransaccion['tipo_transaccion'];
            
            if(isset($usuario_sigep['email'])){
                $data->email = $usuario_sigep['email'];
                $email_controller->email($data);
            }

            if(isset($usuario_responsable)){
                foreach ($usuario_responsable as &$value) {
                    $data->email = $value['email'];
                    $email_controller->email($data);
                }
            }
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
