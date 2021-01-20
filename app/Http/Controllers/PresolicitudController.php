<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Mail\MailController;
use App\Usuario;
use App\Presolicitud;
use App\ActualEtapaEstado;
use App\TiposTransaccion;
use App\Etapa;
use Auth;

class PresolicitudController extends Controller
{
    public $etapa_id = 1;
    public $en_proceso = 1;
    public $espacio = " ";
    public $directorio = "presolicitud/";
    public $path = "//public/"; 

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
        $route = "index";
        $etapa_id = 0;
        $files = 0;

        $tipoTransaccion = $this->tiposTransaccionWithUsuario();

        $proyecto = DB::connection('mysql_sigep')
                    ->table('proyectos')
                    ->where('Estado', 1)
                    ->select('nombre', 'codigo')
                    ->orderBy('nombre', 'asc')
                    ->get();

        return view('etapas/presolicitudView', compact('route','etapa_id','etapas','tipoTransaccion','proyecto','files'));
        //return response()->json([''=>$proyecto]);
    }

    /**
     * Create a new usuario instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Presolicitud
     */
    public function create(array $data)
    {
        $presolicitud = Presolicitud::create([
            'usuario_id' => Auth::user()->cedula,
            'encargado_id' => NULL,
            'proyecto_id' => $this->returnNull($this->startEndSpaces($data['proyecto_id'], $this->espacio)),
            'nombre_proyecto' => $data['nombre_proyecto'],
            'otro_proyecto' => $this->startEndSpaces($data['otro_proyecto'], $this->espacio),
            'transaccion_id' => $this->startEndSpaces($data['transaccion_id'], $this->espacio),
            'fecha_inicial' => $this->returnNull($this->startEndSpaces($data['fecha_inicial'], $this->espacio)),
            'fecha_final' => $this->returnNull($this->startEndSpaces($data['fecha_final'], $this->espacio)),
            'valor' => $this->startEndSpaces($data['valor'], $this->espacio),
            'descripcion' => $this->startEndSpaces($data['descripcion'], $this->espacio),
            'estado_id' => $this->en_proceso,
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
        info($data);
        return Validator::make($data, [
            'proyecto_id' => 'nullable',
            'otro_proyecto' => 'required_without:proyecto_id|string|nullable',
            'fecha_inicial' => 'date|nullable',
            'fecha_final' => 'date|nullable|after_or_equal:fecha_inicial',
            'valor' => 'required|integer',
            'descripcion' => 'required|string',
            'anexos*' => 'mimes:pdf'
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

        $encargado_id = DB::table('tr_usuarios_tipostransaccion AS a')
                ->leftJoin('tr_usuarios AS b', 'b.id', '=', 'a.usuario_id')
                ->leftJoin('tr_tipostransaccion AS c', 'c.id', '=', 'a.tipo_transaccion_id')
                ->where('a.tipo_transaccion_id', $request->transaccion_id)
                ->select('b.cedula', 'b.email', 'c.tipo_transaccion', 'b.nombre_apellido')
                ->first();

        $data = $request->all();
        $data['encargado_id'] = $encargado_id->cedula;
        
        $nombre_proyecto = $this->getNombreProyecto($request['proyecto_id']);

        $data['nombre_proyecto'] = $nombre_proyecto;
        $presolicitud = $this->create($data);
        $presolicitud->save();
        $consecutivo = $presolicitud->id;

        $actual_etapa_estado = ActualEtapaEstado::create([
            'consecutivo' => $consecutivo,
            'etapa_id' => $this->etapa_id,
            'estado_id' => $this->en_proceso,
            'fecha_estado' => date("Y-m-d H:i:s")
        ]);

        $actual_etapa_estado->save();

        $encargado_id->nombre_proyecto = $nombre_proyecto;
        $email_controller = new CorreosController;
        $email_controller->email($encargado_id, $consecutivo, $this->etapa_id);

        $upload_files = new MainController;
        $upload_files->uploadFile($request, $this->path.$this->directorio);

        return redirect('/')->with('status', true)->with('consecutivo', $consecutivo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($consecutivo)
    {
        $etapas = false;
        $route = "show";
        $etapa_id = $this->etapa_id;
        $etapa_estado;
        $data;
        $tipoTransaccion;
        $proyecto;

        $consultas = new MainController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        $data = Presolicitud::where('consecutivo', $consecutivo)->first();
        
        if($data->fecha_inicial){
            $data->fecha_inicial = date("Y-m-d", strtotime($data->fecha_inicial));
        }
        if($data->fecha_final){
            $data->fecha_final = date("Y-m-d", strtotime($data->fecha_final));
        }

        $tipoTransaccion = $this->tiposTransaccionWithUsuario();
        
        $proyecto = DB::connection('mysql_sigep')
                ->table('proyectos')
                ->where('Estado', 1)
                ->select('nombre', 'codigo')
                ->orderBy('nombre', 'asc')
                ->get();

        $files = Storage::disk('public')->files($this->directorio . $consecutivo);

        return view('etapas/presolicitudView', compact('route','etapa_id','etapas','consecutivo','data','etapa_estado','tipoTransaccion','proyecto','files'));
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
        $route = "edit";
        $etapa_id = 0;
        $etapa_estado;
        $data;
        $tipoTransaccion;
        $proyecto;

        $consultas = new MainController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        $data = Presolicitud::where('consecutivo', $consecutivo)->first();

        if($data->fecha_inicial){
            $data->fecha_inicial = date("Y-m-d", strtotime($data->fecha_inicial));
        }
        if($data->fecha_final){
            $data->fecha_final = date("Y-m-d", strtotime($data->fecha_final));
        }

        $tipoTransaccion = $this->tiposTransaccionWithUsuario();
        
        $proyecto = DB::connection('mysql_sigep')
                ->table('proyectos')
                ->where('Estado', 1)
                ->select('nombre', 'codigo')
                ->orderBy('nombre', 'asc')
                ->get(); 

        $files = Storage::disk('public')->files($this->directorio . '/' . $consecutivo);

        return view('etapas/presolicitudView', compact('route','etapa_id','etapas','consecutivo','data','etapa_estado','tipoTransaccion','proyecto','files'));
    }

    /**
     * Change Tipo de Transaccion.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function redirect(Request $request)
    {
        $redirect = 'redirect';
        $tipo_transaccion = Usuario::find(Auth::user()->id)->hasOneTipoTransaccion($request->value);
        
        Presolicitud::where('consecutivo', $request->consecutivo)
                        ->update(['transaccion_id' => $request->value]);

        if($tipo_transaccion){
            $redirect = $request->value;
        }
        //Doesn´t have the tipo de transaccion, so frontend going to redirect to Consulta de Gestores
        return response()->json(['data'=>$redirect]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validator($request->all())->validate();

        $upload_files = new MainController;
        $upload_files->uploadFile($request, $this->path.$this->directorio);

        $data = $request->except('_token','anexos');

        Presolicitud::where('consecutivo', $request->consecutivo)
                        ->update($data);

        return redirect()->route('edit_presolicitud', $request->consecutivo)->with('status', true);
    }

    /**
     * Get estado of etapa
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getEstado(Request $request)
    {
        $estado = Presolicitud::where('consecutivo', $request->consecutivo)
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
        Presolicitud::where('consecutivo', $request->consecutivo)
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

    public function returnNull($str){
        if($str == ''){
            return NULL;
        }
        return $str;
    }

    public function startEndSpaces($str){
        return trim($str, $this->espacio);
    }

    public function tiposTransaccionWithUsuario(){
        $tipos_transaccion = new Usuario();
        $tipos_transaccion = $tipos_transaccion->tipoTransaccionWithUsuarios()->get();
        return $tipos_transaccion;
    }

    public function getNombreProyecto($id){
        if(!$this->returnNull($id)){
            return DB::connection('mysql_sigep')
                    ->table('proyectos')
                    ->where('Estado', 1)
                    ->where('codigo', $id)
                    ->select('nombre')
                    ->get();
        }
        return NULL;
    }
}
