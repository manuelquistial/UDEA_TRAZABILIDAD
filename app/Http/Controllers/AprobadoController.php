<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use DateTime;
use App\Aprobado;
use App\ActualEtapaEstado;
use Auth;

class AprobadoController extends Controller
{
    public $etapa_id = 6;
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
        $route = "index";
        $etapas = true;
        $etapa_id = $this->etapa_id;
        
        $consultas = new MainController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        $data = Aprobado::where('consecutivo', $consecutivo)->first();

        return view('etapas/aprobadoView', compact('route','etapa_id','consecutivo','etapas','etapa_estado','data'));
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
            'crp' => $this->startEndSpaces($data['crp']),
            'fecha_crp_pedido' => $this->returnNull($data['fecha_crp_pedido']),
            'valor_final_crp' => $this->startEndSpaces($data['valor_final_crp']),
            'nombre_tercero' => $this->startEndSpaces($data['nombre_tercero']),
            'identificacion_tercero' => $this->startEndSpaces($data['identificacion_tercero']),
            'estado_id' => $this->en_proceso,
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
            'crp' => 'required|integer',
            'fecha_crp_pedido' => 'required|date',
            'valor_final_crp' => 'required|integer',
            'nombre_tercero' => 'required|string',
            'identificacion_tercero'  => 'required|integer'
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
        $data = Aprobado::where('consecutivo', $request->consecutivo)->first();

        if($data == NULL){
            $aprobado = $this->create($request->all());
            $aprobado->save();
        }else{
            $data = $request->except('_token');
            Aprobado::where('consecutivo', $request->consecutivo)
                    ->update($data);
        }

        ActualEtapaEstado::where('consecutivo', $request->consecutivo)
                ->update(['etapa_id' => $this->etapa_id,
                        'estado_id' => $this->en_proceso,
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
        
        $consultas = new MainController;
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
        
        $consultas = new MainController;
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
        $data = null;
        info($request);
        if($request->columna == 'solped'){
            $data = $request->data;
        }else{
            $data = $this->isValidDate($request->data);
        }

        if($data){
            $aprobado = Aprobado::where('consecutivo', $request->consecutivo)->first();

            if ($aprobado !== null) {
                $aprobado->update(
                    [$request->columna => $request->data]
                );
                
            } else {
                $aprobado = Aprobado::create([
                    'encargado_id' => Auth::user()->cedula,
                    'consecutivo' => $request->consecutivo,
                    'nombre_tercero' => NULL,
                    'identificacion_tercero' => NULL,
                    'estado_id' => $this->en_proceso,
                    'fecha_estado' => date("Y-m-d H:i:s"),
                    $request->columna => $request->data,
                ]);
            }
            return response()->json(['data'=>'ok']);
        }else{
            return response()->json(['data'=>$request->columna]);
        }
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
     * Set estado of etapa
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setEstado(Request $request)
    {
        Aprobado::where('consecutivo', $request->consecutivo)
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

    public function isValidDate($date){
        try {
            $fTime = new DateTime($date);
            $fTime->format('Y-m-d');
            return true;
        }catch (\Exception $ex) {
            return false;
        }
        catch (Throwable $e) {
            return false;
        }
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
