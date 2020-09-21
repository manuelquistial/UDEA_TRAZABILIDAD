<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Legalizado;

class LegalizadoController extends Controller
{
    public $etapa_id = 9;
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

        return view('etapas/legalizadoView', compact('route','etapa_id','consecutivo','etapas','etapa_estado'));
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
            'consecutivo_id' => $data['consecutivo'],
            'encargado_id' => 1113533874,
            'reintegro' => $data['reintegro'],
            'estado_id' => $this->estado_id,
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
            'reintegro' => 'integer'
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

        $legalizado = $this->create($request->all());
        $legalizado->save();

        return redirect()->route('edit_legalizado', $request->consecutivo)->with('status', true);
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
                        ->data;

        $data = Legalizado::where('consecutivo', $consecutivo)->first();

        return view('etapas/legalizadoView', compact('route','etapa_id','consecutivo','etapas','etapa_estado','data'));
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

        $data = Legalizado::where('consecutivo', $consecutivo)->first();

        return view('etapas/legalizadoView', compact('route','etapa_id','consecutivo','etapas','etapa_estado','data'));
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
        $estado = Legalizado::where('consecutivo', $request->consecutivo)
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
