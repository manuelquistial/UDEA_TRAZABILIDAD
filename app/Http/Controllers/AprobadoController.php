<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Aprobado;
use App\ActualEtapaEstado;
use Auth;

class AprobadoController extends Controller
{
    public $etapa_id = 6;
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

        return view('etapas/aprobadoView', compact('route','etapa_id','consecutivo','etapas','etapa_estado'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Aprobado
     */
    public function create(array $data)
    {
        $aprobado = Aprobado::create([
            'consecutivo' => $data['consecutivo'],
            'encargado_id' => Auth::user()->cedula,
            'crp' => $data['crp'],
            'fecha_crp_pedido' => $data['fecha_crp_pedido'],
            'valor_final_crp' => $data['valor_final_crp'],
            'nombre_tercero' => $data['nombre_tercero'],
            'identificacion_tercero' => $data['identificacion_tercero'],
            'estado_id' => $this->estado_id,
            'fecha_estado' => date("Y-m-d H:i:s")
        ]);

        return $aprobado;
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
            'fecha_envio_documento' => 'date',
            'fecha_envio_decanatura' => 'date',
            'fecha_envio_presupuestos' => 'date',
            'solpe' => 'integer',
            'crp' => 'required|integer',
            'fecha_crp_pedido' => 'required|date',
            'valor_final_crp' => 'required|integer',
            'nombre_tercero' => 'string|nullable',
            'identificacion_tercero'  => 'integer|nullable'
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

        $aprobado = $this->create($request->all());
        $aprobado->save();

        ActualEtapaEstado::where('consecutivo', $request->consecutivo)
                ->update(['etapa_id' => $this->etapa_id,
                        'estado_id' => $this->estado_id,
                        'fecha_estado' => date("Y-m-d H:i:s")
                        ]);

        return redirect()->route('edit_aprobado', $request->consecutivo)->with('status', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $route = "show";
        $etapas = false;
        $etapa_id = $this->etapa_id;
        
        $consultas = new ConsultasController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;;

        $data = Aprobado::where('consecutivo', $consecutivo)->first();

        return view('etapas/aprobadoView', compact('route','etapa_id','etapas','consecutivo','etapa_estado','data'));
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

        $data = Aprobado::where('consecutivo', $consecutivo)->first();

        return view('etapas/aprobadoView', compact('route','etapa_id','etapas','consecutivo','etapa_estado','data'));
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

        Aprobado::where('consecutivo', $request->consecutivo)
                    ->update($data);

        return redirect()->route('edit_aprobado', $request->consecutivo)->with('status', true);
    }

    /**
     * Update the specified item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_items(Request $request)
    {
        $this->validator($request->all())->validate();   
        $data = $request->except('_token'); 

        Aprobado::where('consecutivo', $request->consecutivo)
                    ->update($data);

    }

    /**
     * Get estado of etapa
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getEstado(Request $request)
    {
        $estado = Aprobado::where('consecutivo', $request->consecutivo)
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
