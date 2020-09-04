<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Presolicitud;
use Auth;

class PresolicitudController extends Controller
{
    public $etapa_id = 1;
    public $estado_id = 1;
    public $next_etapa_id = 2;
    public $next_estado_id = 2;

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
        $etapa_id = 0;
        $tipoTransaccion = DB::table('tr_tipostransaccion')->get();
        $proyecto = DB::connection('mysql_sigep')
                    ->table('proyectos')
                    ->where('Estado', 1)
                    ->select('nombre')
                    ->get();
        //$proyecto = DB::table('tr_proyectos')->get();
        return view('etapas/presolicitudView', compact('etapa_id','etapas','tipoTransaccion','proyecto'));
        //return response()->json([''=>$proyecto]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Presolicitud
     */
    public function create(array $data)
    {
        $presolicitud = Presolicitud::create([
            'user_id' => Auth::user()->cedula,
            'encargado_id' => NULL,
            'consecutivo' => 2,
            'proyecto_id' => $data['proyecto_id'],
            'transaccion_id' => $data['transaccion_id'],
            'fecha_inicial' => $data['fecha_inicial'],
            'fecha_final' => $data['fecha_final'],
            'valor' => $data['valor'],
            'descripcion' => $data['descripcion'],
            'etapa_id' => $this->etapa_id,
            'fecha_creacion' => date("Y-m-d H:i:s"),
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
        $queryStatus;
        $etapa_items;

        $etapa_array = [];
        $this->validator($request->all())->validate();

        try {
            $presolicitud = $this->create($request->all());
            $presolicitud->save();
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }
    
        try {
            $etapa_items = DB::table('tr_etapas')
                        ->select('etapa_id')
                        ->get();

            foreach ($etapa_items as &$value) {
                if($value->etapa_id == $this->etapa_id){
                    array_push($etapa_array, array('consecutivo'=>2, 'etapa_id'=>$value->etapa_id, 'estado_id'=>$this->estado_id, 'fecha_estado'=>date("Y-m-d H:i:s")));
                }else{
                    array_push($etapa_array, array('consecutivo'=>2, 'etapa_id'=>$value->etapa_id, 'estado_id'=>null, 'fecha_estado'=>null));
                }
            }
            
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }

        try {
            DB::table('tr_consecutivo_etapa_estado')
                ->insert($etapa_array);
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }
        
        return response()->json([''=>$etapa_array]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $presolicitud;
        $queryStatus;
        try {
            $presolicitud = DB::table('tr_presolicitud AS a')
                            ->where('a.consecutivo', $id)
                            ->join('tr_usuarios AS b', 'a.user_id', '=', 'b.cedula')
                            ->join('tr_tipostransaccion AS c', 'c.id', '=', 'a.transaccion_id')
                            ->select('c.tipo_transaccion','a.*', 'b.nombre', 'b.apellidos')
                            ->get()
                            ->first();
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }
        
        return json_encode($presolicitud);
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
        $etapa_id = $this->etapa_id;
        $etapa_estado;
        $data;
        $tipoTransaccion;
        $proyecto;
        $queryStatus;

        try {
            $etapa_estado = DB::table('tr_etapas AS a')
                        ->leftJoin('tr_consecutivo_etapa_estado AS b', 'b.etapa_id', '=', 'a.etapa_id')
                        ->leftJoin('tr_estados AS c', 'c.estado_id', '=', 'b.estado_id')
                        ->where('b.consecutivo', $consecutivo)
                        ->orderBy('a.etapa_id', 'asc')
                        ->select('a.etapa', 'c.estado_id', 'a.endpoint')
                        ->get();
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }

        try {
            $data = DB::table('tr_presolicitud')->where('consecutivo', $consecutivo)->first();
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }

        try {
            $tipoTransaccion = DB::table('tr_tipostransaccion')->get();
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }
        
        try {
            $proyecto = DB::table('tr_proyectos')->get();
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }   

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
        $queryStatus;

        try {
            DB::table('tr_presolicitud')
              ->where('consecutivo', $consecutivo)
              ->update(['transaccion_id' => $request->value]);
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }
        
        return response()->json(['data'=>$queryStatus]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $consecutivo)
    {
        $queryStatus;

        $this->validator($request->all())->validate();

        $data = $request->except('_token');
        $data['etapa_id'] = $this->next_etapa_id;
        $data['fecha_estado'] = date("Y-m-d H:i:s");

        try {
            Presolicitud::where('consecutivo', $consecutivo)
                        ->update($data);
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }

        try {
            DB::table('tr_consecutivo_etapa_estado')
              ->where('consecutivo', $consecutivo)
              ->where('etapa_id', $this->etapa_id)
              ->update(['estado_id' => $this->next_estado_id],['fecha_estado', date("Y-m-d H:i:s")]) ;
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }

        try {
            DB::table('tr_consecutivo_etapa_estado')
              ->where('consecutivo', $consecutivo)
              ->where('etapa_id', $this->next_etapa_id)
              ->update(['estado_id' => $this->estado_id]);
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }

        return response()->json(['data'=>$data]);
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
