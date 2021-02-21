<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Preaprobado;
use App\Models\ActualEtapaEstado;
use App\Models\Presolicitud;
use App\Models\TiposTransaccion;
use App\Models\Usuario;
use Auth;

class PreaprobadoController extends Controller
{
    public $etapa_id = 5;
    public $en_proceso = 1;
    public $confirmado = 2;
    public $espacio = " ";
    public $administrador = "Administrador";
    public $sap = 3;

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

        $consultas = new MainController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        /*$role = Auth::user()->hasOneRole($this->administrador);
        $sap = Auth::user()->hasOneEtpa($this->sap);*/

        return view('etapas/preaprobadoView', compact('route','etapa_id','consecutivo','etapas','etapa_estado'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Preaprobado
     */
    public function create(array $data)
    {
        $preaprobado = Preaprobado::create([
            'consecutivo' => $data['consecutivo'],
            'encargado_id' => Auth::user()->cedula,
            'cdp' => $this->startEndSpaces($data['cdp']),
            'fecha_cdp' => $this->returnNull($data['fecha_cdp']),
            'estado_id' => $this->en_proceso,
            'fecha_estado' => date("Y-m-d H:i:s")
        ]);

        return $preaprobado;
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
            'cdp' => 'required|integer',
            'fecha_cdp' => 'required|date'
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

        $preaprobado = $this->create($request->all());
        $preaprobado->save();

        ActualEtapaEstado::where('consecutivo', $request->consecutivo)
                ->update(['etapa_id' => $this->etapa_id,
                        'estado_id' => $this->en_proceso,
                        'fecha_estado' => date("Y-m-d H:i:s")
                        ]);

        return redirect()->route('edit_preaprobado', $request->consecutivo)->with('status', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($consecutivo)
    {
        $route = 'show';
        $etapas = false;
        $etapa_id = $this->etapa_id;

        $consultas = new MainController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        $data = Preaprobado::where('consecutivo', $consecutivo)->first();

        return view('etapas/preaprobadoView', compact('route','etapa_id','consecutivo','etapas','etapa_estado','data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $consecutivo
     * @return \Illuminate\Http\Response
     */
    public function edit($consecutivo)
    {
        $route = 'edit';
        $etapas = false;
        $etapa_id = $this->etapa_id;

        $consultas = new MainController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        $data = Preaprobado::where('consecutivo', $consecutivo)->first();

        if($data->fecha_cdp){
            $data->fecha_cdp = date("Y-m-d", strtotime($data->fecha_cdp));
        }

        return view('etapas/preaprobadoView', compact('route','etapa_id','consecutivo','etapas','etapa_estado','data'));
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

        Preaprobado::where('consecutivo', $request->consecutivo)
                    ->update($data);

        return redirect()->route('edit_preaprobado', $request->consecutivo)->with('status', true);
    }

    /**
     * Get estado of etapa
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getEstado(Request $request)
    {
        $estado = Preaprobado::where('consecutivo', $request->consecutivo)
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
        Preaprobado::where('consecutivo', $request->consecutivo)
                ->update(['estado_id' => $request->estado_id,
                        'fecha_estado' => date("Y-m-d H:i:s")
                        ]);

        ActualEtapaEstado::where('consecutivo', $request->consecutivo)
                ->update(['etapa_id' => $this->etapa_id,
                        'estado_id' => $request->estado_id,
                        'fecha_estado' => date("Y-m-d H:i:s")
                        ]);

        if($request->estado_id == $this->confirmado){
            $proyecto = Presolicitud::where('consecutivo', $request->consecutivo)->select('nombre_proyecto','transaccion_id','encargado_id')->first();
            $tipoTransaccion = TiposTransaccion::where('id', $proyecto->transaccion_id)->select('tipo_transaccion')->first();

            $data = (object)[];
            $data->nombre_proyecto = $proyecto->nombre_proyecto;
            $data->tipo_transaccion = $tipoTransaccion->tipo_transaccion;
            $data->consecutivo = $request->consecutivo;
            $data->etapa_id = $this->etapa_id;
            $data->gestor = false;

            $email_controller = new CorreosController;
            $encargado = Usuario::where('cedula',$proyecto->encargado_id)->select('email')->first();

            $data->email = $encargado->email;
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
