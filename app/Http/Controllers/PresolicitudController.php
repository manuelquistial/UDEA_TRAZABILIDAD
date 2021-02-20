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
    public $directorio_documento = "presolicitud/apoyo_economico/";
    public $directorio = "presolicitud/";
    public $path = "//public/presolicitud/"; 

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

        $apoyo_economico = Storage::disk('public')->files($this->directorio_documento);
        if($apoyo_economico){
            $apoyo_economico = $apoyo_economico[0];
        }else{
            $apoyo_economico = null;
        }
            
        return view('etapas/presolicitudView', compact('route','etapa_id','etapas','tipoTransaccion','proyecto','files','apoyo_economico'));
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
            'encargado_id' => $data['encargado_id'],
            'proyecto_id' => $this->returnNull($this->startEndSpaces($data['proyecto_id'])),
            'nombre_proyecto' => $data['nombre_proyecto'],
            'otro_proyecto' => $this->startEndSpaces($data['otro_proyecto']),
            'transaccion_id' => $this->startEndSpaces($data['transaccion_id']),
            'fecha_inicial' => $this->returnNull($this->startEndSpaces($data['fecha_inicial'])),
            'fecha_final' => $this->returnNull($this->startEndSpaces($data['fecha_final'])),
            'valor' => $this->startEndSpaces($data['valor']),
            'descripcion' => $this->startEndSpaces($data['descripcion']),
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
        return Validator::make($data, [
            'proyecto_id' => 'nullable',
            'transaccion_id' => 'sometimes|required',
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
        
        $data = $request->all();
        $data['valor'] = $this->replaceDots($data['valor']);
        $this->validator($data)->validate();

        $encargado_id = DB::table('tr_usuarios_tipostransaccion AS a')
                ->leftJoin('tr_usuarios AS b', 'b.id', '=', 'a.usuario_id')
                ->leftJoin('tr_tipostransaccion AS c', 'c.id', '=', 'a.tipo_transaccion_id')
                ->where('a.tipo_transaccion_id', $request['transaccion_id'])
                ->select('b.cedula', 'b.email', 'c.tipo_transaccion', 'b.nombre_apellido')
                ->first();

        
        $data['encargado_id'] = $encargado_id->cedula;

        if($request['proyecto_id'] != NULL){
            $nombre_proyecto = $this->getNombreProyecto($request['proyecto_id'])->nombre;
            $data['nombre_proyecto'] = $nombre_proyecto;
        }else{
            $nombre_proyecto = $request['otro_proyecto'];
            $data['nombre_proyecto'] = $nombre_proyecto;
        }

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

        $upload_files = new DocumentosController;
        $request->consecutivo = $consecutivo;
        $upload_files->uploadFile($request, $this->path.$request->consecutivo);
        
        $encargado_id->nombre_proyecto = $nombre_proyecto;

        $email_gestor = $encargado_id->email;
        

        $email_controller = new CorreosController;
        $encargado_id->gestor = false;
        $encargado_id->email = Auth::user()->email;
        $encargado_id->consecutivo = $consecutivo;
        $encargado_id->etapa_id = $this->etapa_id;
        $email_controller->email($encargado_id);

        $encargado_id->gestor = true;
        unset($encargado_id->nombre_apellido);
        $encargado_id->email = $email_gestor;
        $email_controller->email($encargado_id);

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

        $apoyo_economico = Storage::disk('public')->files($this->directorio_documento);
        if($apoyo_economico){
            $apoyo_economico = $apoyo_economico[0];
        }

        return view('etapas/presolicitudView', compact('route','etapa_id','etapas','consecutivo','data','etapa_estado','tipoTransaccion','proyecto','files','apoyo_economico'));
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

        $upload_files = new DocumentosController;
        $upload_files->uploadFile($request, $this->path.$request->consecutivo);

        $data = $request->except('_token','anexos');
        $data['valor'] = $this->replaceDots($data['valor']);

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

    public function financieroProyecto($proyecto_id){
        
        $pp_inicial  = DB::connection('mysql_sigep')
                ->table('proyectos as p')
                ->join('movimientos as m', 'm.Proyecto','=','p.codigo')
                ->join('rubros as r', 'r.codigo','=','m.Rubro')
                ->where('p.Estado', 1)
                ->where('m.habilitado', 1) // PPINICIAL 4, EGRESO 2
                ->where('p.codigo', $proyecto_id)
                ->where('m.Tipo', 4)
                ->select('m.Rubro','r.Nombre',DB::raw('sum(m.Valor)'))
                ->groupBy('m.Rubro')
                ->get();
                    
        $pp_inicial = json_decode($pp_inicial);

        $pp_total  = DB::connection('mysql_sigep')
                ->table('proyectos as p')
                ->join('movimientos as m', 'm.Proyecto','=','p.codigo')
                ->join('rubros as r', 'r.codigo','=','m.Rubro')
                ->where('p.Estado', 1)
                ->where('m.habilitado', 1) // PPINICIAL 4, EGRESO 2
                ->where('p.codigo', $proyecto_id)
                ->where('m.Tipo', 4)
                ->select(DB::raw('sum(m.Valor) pp_total'))
                ->get();
                    
        if(count($pp_total) !== 0){
            $pp_total = json_decode($pp_total)[0]->pp_total;
        }else{
            $pp_total = 0;
        }

        $total_ingreso = DB::connection('mysql_sigep')
                        ->table('proyectos as p')
                        ->join('movimientos as m', 'm.Proyecto','=','p.codigo')
                        ->join('rubros as r', 'r.codigo','=','m.Rubro')
                        ->where('p.Estado', 1)
                        ->where('m.habilitado', 1) // PPINICIAL 4, EGRESO 2
                        ->where('p.codigo', $proyecto_id)
                        ->where('m.Tipo', 1)
                        ->select(DB::raw('sum(m.Valor) ingreso'))
                        ->get();
                        
        if(count($total_ingreso) !== 0){
            $total_ingreso = json_decode($total_ingreso)[0]->ingreso;
        }else{
            $total_ingreso = 0;
        }

        $total_cuentaxcobrar = DB::connection('mysql_sigep')
                        ->table('proyectos as p')
                        ->join('movimientos as m', 'm.Proyecto','=','p.codigo')
                        ->join('rubros as r', 'r.codigo','=','m.Rubro')
                        ->where('p.Estado', 1)
                        ->where('m.habilitado', 1) // PPINICIAL 4, EGRESO 2
                        ->where('p.codigo', $proyecto_id)
                        ->where('m.Tipo', 6)
                        ->select(DB::raw('sum(m.Valor) cuentaxcobrar'))
                        ->get();
                        
        if(count($total_cuentaxcobrar) !== 0){
            $total_cuentaxcobrar = json_decode($total_cuentaxcobrar)[0]->cuentaxcobrar;
        }else{
            $total_cuentaxcobrar = 0;
        }

        $total_egreso = DB::connection('mysql_sigep')
                        ->table('proyectos as p')
                        ->join('movimientos as m', 'm.Proyecto','=','p.codigo')
                        ->join('rubros as r', 'r.codigo','=','m.Rubro')
                        ->where('p.Estado', 1)
                        ->where('m.habilitado', 1) // PPINICIAL 4, EGRESO 2
                        ->where('p.codigo', $proyecto_id)
                        ->where('m.Tipo', 2)
                        ->select(DB::raw('sum(m.Valor) egreso'))
                        ->get();
                        
        if(count($total_egreso) !== 0){
            $total_egreso = json_decode($total_egreso)[0]->egreso;
        }else{
            $total_egreso = 0;
        }

        $total_reserva = DB::connection('mysql_sigep')
                        ->table('proyectos as p')
                        ->join('movimientos as m', 'm.Proyecto','=','p.codigo')
                        ->join('rubros as r', 'r.codigo','=','m.Rubro')
                        ->where('p.Estado', 1)
                        ->where('m.habilitado', 1) // PPINICIAL 4, EGRESO 2
                        ->where('p.codigo', $proyecto_id)
                        ->where('m.Tipo', 3)
                        ->select(DB::raw('sum(m.Valor) reserva'))
                        ->get();

        if(count($total_reserva) !== 0){
            $total_reserva = json_decode($total_reserva)[0]->reserva;
        }else{
            $total_reserva = 0;
        }

        foreach ($pp_inicial as $rubro) {

            $egreso = DB::connection('mysql_sigep')
                            ->table('proyectos as p')
                            ->join('movimientos as m', 'm.Proyecto','=','p.codigo')
                            ->join('rubros as r', 'r.codigo','=','m.Rubro')
                            ->where('p.Estado', 1)
                            ->where('m.habilitado', 1) // PPINICIAL 4, EGRESO 2
                            ->where('p.codigo', $proyecto_id)
                            ->where('m.Rubro', $rubro->Rubro)
                            ->where('m.Tipo', 2)
                            ->select(DB::raw('sum(m.Valor) egreso'))
                            ->get();
                            
            if(count($egreso) !== 0){
                $rubro->egreso = json_decode($egreso)[0]->egreso;
            }else{
                $rubro->egreso = 0;
            }

            $reserva = DB::connection('mysql_sigep')
                            ->table('proyectos as p')
                            ->join('movimientos as m', 'm.Proyecto','=','p.codigo')
                            ->join('rubros as r', 'r.codigo','=','m.Rubro')
                            ->where('p.Estado', 1)
                            ->where('m.habilitado', 1) // PPINICIAL 4, EGRESO 2
                            ->where('p.codigo', $proyecto_id)
                            ->where('m.Rubro', $rubro->Rubro)
                            ->where('m.Tipo', 3)
                            ->select(DB::raw('sum(m.Valor) reserva'))
                            ->get();

            if(count($reserva) !== 0){
                $rubro->reserva = json_decode($reserva)[0]->reserva;
            }else{
                $rubro->reserva = 0;
            }
        }

        return response()->json(['pp_inicial'=>$pp_inicial, 'pp_total' => $pp_total, 'total_egreso' => $total_egreso, 'total_ingreso' => $total_ingreso, 'total_reserva' => $total_reserva, 'total_cuentaxcobrar' => $total_cuentaxcobrar]);
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
        if($this->returnNull($id)){
            return DB::connection('mysql_sigep')
                    ->table('proyectos')
                    ->where('Estado', 1)
                    ->where('codigo', $id)
                    ->select('nombre')
                    ->first();
        }
        return NULL;
    }

    public function replaceDots($value){
        return preg_replace('/\./m', '', $value);
    }
}
