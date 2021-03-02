<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use DateTime;
use App\Aprobado;
use App\ActualEtapaEstado;
use App\Presolicitud;
use App\TiposTransaccion;
use App\Usuario;
use App\Reserva;
use App\Pago;
use App\Legalizado;
use Auth;

class AprobadoController extends Controller
{
    public $etapa_id = 6;
    public $en_proceso = 1;
    public $confirmado = 2;
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
        $data = Aprobado::where('consecutivo', $consecutivo)->first();
        if($data){
            $estado = $data->estado_id;
            if($estado['estado_id'] == 1){
                return redirect()->route('edit_aprobado', $consecutivo);
            }else if(($estado == 2) || ($estado == 3)){
                return redirect()->route('show_aprobado', $consecutivo);
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

        return view('etapas/aprobadoView', compact('route','etapa_id','consecutivo','etapas','etapa_estado','data','usuario_nombre','estado'));
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
        $data = $request->all();
        $data['valor_final_crp'] = $this->replaceDots($data['valor_final_crp']);
        $this->validator($data)->validate();

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
     * @param  int  $consecutivo
     * @return \Illuminate\Http\Response
     */
    public function show($consecutivo)
    {
        $data = Aprobado::where('consecutivo', $consecutivo)->first();
        if($data){
            $estado = $data->estado_id;
            if($estado['estado_id'] == 1){
                return redirect()->route('edit_aprobado', $consecutivo);
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

        return view('etapas/aprobadoView', compact('route','etapa_id','etapas','consecutivo','etapa_estado','data','usuario_nombre','estado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $consecutivo
     * @return \Illuminate\Http\Response
     */
    public function edit($consecutivo)
    {
        $data = Aprobado::where('consecutivo', $consecutivo)->first();
        if($data){
            $estado = $data->estado_id;
            if(($estado == 2) || ($estado == 3)){
                return redirect()->route('show_aprobado', $consecutivo);
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

        return view('etapas/aprobadoView', compact('route','etapa_id','etapas','consecutivo','etapa_estado','data','usuario_nombre','estado'));
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
        $data['valor_final_crp'] = $this->replaceDots($data['valor_final_crp']);

        $this->validator($data)->validate();

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
                
                if($request->columna == 'solped'){
                    DB::table('tr_correos')
                        ->where('consecutivo', $request->consecutivo)
                        ->where('etapa', $this->etapa_id)
                        ->update(['codigo' => $request->data]);
                }

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

                ActualEtapaEstado::where('consecutivo', $request->consecutivo)
                    ->update(['etapa_id' => $this->etapa_id,
                            'estado_id' => $this->en_proceso,
                            'fecha_estado' => date("Y-m-d H:i:s")
                            ]);
                
                if($request->columna == 'solped'){
                    DB::table('tr_correos')->insert(
                        [
                            'consecutivo' => $request->consecutivo, 
                            'codigo' => $request->data,
                            'etapa' => $this->etapa_id,
                            'enviado' => 0,
                            'fecha_envio' => null
                        ]
                    );
                }
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

        $reserva = Reserva::where('consecutivo', $request->consecutivo)->first();

        if($reserva == NULL){
            $reserva = Reserva::create([
                'encargado_id' => Auth::user()->cedula,
                'consecutivo' => $request->consecutivo,
                'noun_oficio' => NULL,
                'fecha_cancelacion' => NULL,
                'estado_id' => $this->en_proceso,
                'fecha_estado' => date("Y-m-d H:i:s")
            ]);
            $reserva->save();
        }

        $pago = Pago::where('consecutivo', $request->consecutivo)->first();

        if($pago == NULL){
            $pago = Pago::create([
                'encargado_id' => Auth::user()->cedula,
                'consecutivo' => $request->consecutivo,
                'estado_id' => $this->en_proceso,
                'fecha_estado' => date("Y-m-d H:i:s")
            ]);
            $pago->save();
        }

        $legalizado = Legalizado::where('consecutivo', $request->consecutivo)->first();

        if($legalizado == NULL){
            $legalizado = Legalizado::create([
                'encargado_id' => Auth::user()->cedula,
                'consecutivo' => $request->consecutivo,
                'valor_reintegro' => NULL,
                'consecutivo_reingreso' => NULL,
                'estado_id' => $this->en_proceso,
                'fecha_estado' => date("Y-m-d H:i:s")
            ]);
            $legalizado->save();
        }

        if($request->estado_id == $this->confirmado){
            $proyecto = Presolicitud::where('consecutivo', $request->consecutivo)->select('nombre_proyecto','transaccion_id','usuario_id')->first();
            $tipoTransaccion = TiposTransaccion::where('id', $proyecto->transaccion_id)->select('tipo_transaccion','cargo_id')->first();
            
            if($tipoTransaccion->cargo_id == 2){
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

    public function replaceDots($value){
        return preg_replace('/\./m', '', $value);
    }
}
