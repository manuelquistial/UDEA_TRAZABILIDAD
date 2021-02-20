<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use App\Presolicitud;
use App\Solicitud;
use App\ActualEtapaEstado;
use App\CentroCostos;
use App\Cargos;
use App\TiposTransaccion;
use App\Usuario;
use Auth;

class SolicitudController extends Controller
{
    public $etapa_id = 2;
    public $en_proceso = 1;
    public $confirmado = 2;
    public $espacio = " ";
    public $directorio = "solicitud/";
    public $path = "//public/solicitud/"; 
    public $cargo_sap_id = 2;

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
        $files = 0;
        $centro_costos;
        
        $consultas = new MainController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        $proyecto = Presolicitud::where('consecutivo', $consecutivo)->select('proyecto_id')->first();
        $centro_costos = CentroCostos::get();

        return view('etapas/solicitudView', compact('route','etapa_id','etapas','etapa_estado','consecutivo','centro_costos','proyecto','files'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Presolicitud
     */
    public function create(array $data)
    {
        $solicitud = Solicitud::create([
            'encargado_id' => Auth::user()->cedula,
            'consecutivo' => $data['consecutivo'],
            'centro_costos_id' => $this->startEndSpaces($data['centro_costos_id']),
            'codigo_sigep_id' => $this->startEndSpaces($data['codigo_sigep_id']),
            'fecha_conveniencia' => $this->returnNull($data['fecha_conveniencia']),
            'concepto' => $this->startEndSpaces($data['concepto']),
            'estado_id' => $this->en_proceso,
            'fecha_estado' => date("Y-m-d H:i:s")
        ]);

        return $solicitud;
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
            'fecha_conveniencia' => 'date|nullable',
            'centro_costos_id' => 'required|integer',
            'codigo_sigep_id' => 'required|integer',
            'concepto' => 'required|string',
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

        $solicitud = $this->create($request->all());
        $solicitud->save();

        ActualEtapaEstado::where('consecutivo', $request->consecutivo)
                ->update(['etapa_id' => $this->etapa_id,
                        'estado_id' => $this->en_proceso,
                        'fecha_estado' => date("Y-m-d H:i:s")
                        ]);
    
        $upload_files = new DocumentosController;
        $upload_files->uploadFile($request, $this->path.$request->consecutivo);

        return redirect()->route('edit_solicitud', $request->consecutivo)->with('status', true);
        //return response()->json(['data'=>$queryStatus]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $consecutivo
     * @return \Illuminate\Http\Response
     */
    public function show($consecutivo)
    {
        $route = "show";
        $etapas = false;
        $etapa_id = $this->etapa_id;
        $data;
        $centro_costo;
        
        $consultas = new MainController;

        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        $data = Solicitud::where('consecutivo', $consecutivo)->first();
        if($data->fecha_conveniencia){
            $data->fecha_conveniencia = date("Y-m-d", strtotime($data->fecha_conveniencia));
        }

        $proyecto = Presolicitud::where('consecutivo', $consecutivo)->select('proyecto_id')->first();
        $centro_costos = CentroCostos::get();

        $files = Storage::disk('public')->files($this->directorio . $consecutivo);

        return view('etapas/solicitudView', compact('route','data','etapa_id','etapas','consecutivo','etapa_estado','centro_costos','proyecto','files'));
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
        $data;
        $centro_costo;
        
        $consultas = new MainController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        $data = Solicitud::where('consecutivo', $consecutivo)->first();
        if($data->fecha_conveniencia){
            $data->fecha_conveniencia = date("Y-m-d", strtotime($data->fecha_conveniencia));
        }
        $proyecto = Presolicitud::where('consecutivo', $consecutivo)->select('proyecto_id')->first();
        $centro_costos = CentroCostos::get();

        $files = Storage::disk('public')->files($this->directorio . $consecutivo);
        
        return view('etapas/solicitudView', compact('route','data','etapa_id','etapas','consecutivo','etapa_estado','centro_costos','proyecto','files'));
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

        Solicitud::where('consecutivo', $request->consecutivo)
                ->update($data);

        return redirect()->route('edit_solicitud', $request->consecutivo)->with('status', true);
    }

    /**
     * Get estado of etapa
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getEstado(Request $request)
    {
        $estado = Solicitud::where('consecutivo', $request->consecutivo)
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
        Solicitud::where('consecutivo', $request->consecutivo)
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
            $tipoTransaccion = TiposTransaccion::where('id', $proyecto->transaccion_id)->select('tipo_transaccion','cargo_id')->first();
            
            $data = (object)[];
            $data->nombre_proyecto = $proyecto->nombre_proyecto;
            $data->consecutivo = $request->consecutivo;
            $data->etapa_id = $this->etapa_id;
            $data->gestor = false;

            $email_controller = new CorreosController;

            $usuario_sap = new Cargos();
            $usuario_sap = $usuario_sap->usuarioByCargo($this->cargo_sap_id)->first();

            $data->tipo_transaccion = $tipoTransaccion['tipo_transaccion'];
            
            if(($tipoTransaccion['cargo_id'] != null) & isset($usuario_sap['email'])){
                $data->email = $usuario_sap['email'];
                $data->sap = true;
                info($data->email);
                $email_controller->email($data);
            }

            /*$data->sap = false;
            $encargado = Usuario::where('cedula',$proyecto->encargado_id)->select('email')->first();

            $data->email = $encargado['email'];
            info($data->email);
            $email_controller->email($data);*/
        
        }
                        
        return response()->json(['data'=>true]);
    }

    /**
     * Get SIGEP code from a proyecto to a Solicitud
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getRubros(Request $request){

        $proyecto_id = $request->proyecto;

        $query = DB::connection('mysql_sigep')
                ->table('proyectos as p')
                ->join('movimientos as m', 'm.Proyecto','=','p.codigo')
                ->join('rubros as r', 'r.codigo','=','m.Rubro')
                ->where('p.Estado', 1)
                ->where('m.habilitado', 1) // PPINICIAL 4, EGRESO 2
                ->where('p.codigo', $proyecto_id)
                ->where('m.Tipo', 4)
                ->select('m.Rubro', DB::raw('sum(m.Valor) pp_inicial'))
                ->groupBy('m.Rubro')
                ->get();
        
        $pp_inicial = json_decode($pp_inicial);

        foreach ($pp_inicial as $rubro) {

            $info = DB::connection('mysql_sigep')
                            ->table('proyectos as p')
                            ->join('movimientos as m', 'm.Proyecto','=','p.codigo')
                            ->join('rubros as r', 'r.codigo','=','m.Rubro')
                            ->where('p.Estado', 1)
                            ->where('m.habilitado', 1) // PPINICIAL 4, EGRESO 2
                            ->where('p.codigo', $proyecto_id)
                            ->where('m.Rubro', $rubro->Rubro)
                            ->where('m.Tipo', 4)
                            ->select('m.Codigo', 'r.Nombre','m.CentroCosto')
                            ->get();

            $info = json_decode($info)[0];

            $rubro->Codigo = $info->Codigo;
            $rubro->Nombre = $info->Nombre;
            $rubro->CentroCosto = $info->CentroCosto;

            $egreso = DB::connection('mysql_sigep')
                            ->table('proyectos as p')
                            ->join('movimientos as m', 'm.Proyecto','=','p.codigo')
                            ->join('rubros as r', 'r.codigo','=','m.Rubro')
                            ->where('p.Estado', 1)
                            ->where('m.habilitado', 1) // PPINICIAL 4, EGRESO 2
                            ->where('p.codigo', $proyecto_id)
                            ->where('m.Rubro', $rubro->Rubro)
                            ->where('m.Tipo', 2)
                            ->select('m.CentroCosto', DB::raw('sum(m.Valor) egreso'))
                            ->groupBy('m.CentroCosto')
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
                            ->select('m.CentroCosto', DB::raw('sum(m.Valor) reserva'))
                            ->groupBy('m.CentroCosto')
                            ->get();

            if(count($reserva) !== 0){
                $rubro->reserva = json_decode($reserva)[0]->reserva;
            }else{
                $rubro->reserva = 0;
            }
        }

        return response()->json(['data'=>$pp_inicial]);
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
