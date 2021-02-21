<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Reserva;
use App\Models\Aprobado;
use Auth;

class ReservaController extends Controller
{
    public $etapa_id = 7;
    public $en_proceso = 1;
    public $espacio = " ";
    public $directorio = "reserva/";
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
    public function index($consecutivo)
    {
        $route = "index";
        $etapas = true;
        $etapa_id = $this->etapa_id;
        $files = null;
        $reserva = null;

        $consultas = new MainController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        $crp = Aprobado::where('consecutivo', $consecutivo)
            ->select('crp')
            ->first();

        if(isset($crp->crp)){

            $reserva = DB::connection('mysql_sigep')
                        ->table('documentos_soporte as ds')
                        ->join('movimientos as m', 'm.codigo_operacion','=','ds.codigo_operacion')
                        ->where('m.habilitado', 1)
                        ->where('ds.tipo_documento', 33) // 33 CRP
                        ->where('ds.numero_documento', $crp->crp)
                        ->where('m.Tipo', 3)
                        ->select(DB::raw('sum(m.Valor) reserva'))
                        ->get();

            $reserva = json_decode($reserva)[0];
        }

        return view('etapas/reservaView', compact('route','etapa_id','etapas','consecutivo','etapa_estado','files','crp','reserva'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Reserva
     */
    public function create(array $data)
    {
        $reserva = Reserva::create([
            'consecutivo' => $data['consecutivo'],
            'encargado_id' => Auth::user()->cedula,
            'num_oficio' => $this->startEndSpaces($data['num_oficio']),
            'fecha_cancelacion' => $this->returnNull($this->startEndSpaces($data['fecha_cancelacion'])),
            'estado_id' => $this->en_proceso,
            'fecha_estado' => date("Y-m-d H:i:s")
        ]);

        return $reserva;
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
            'num_oficio' => 'string',
            'fecha_cancelacion' => 'date',
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

        $reserva = $this->create($request->all());
        $reserva->save();

        return redirect()->route('edit_reserva', $request->consecutivo)->with('status', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($consecutivo)
    {
        $route = "show";
        $etapas = false;
        $etapa_id = $this->etapa_id;

        $consultas = new MainController;
        $etapa_estado = $consultas->etapas()
                        ->getData()
                        ->data;

        $crp = Aprobado::where('consecutivo', $consecutivo)
                    ->select('crp')
                    ->first();

        $data = Reserva::where('consecutivo', $consecutivo)->first();

        $files = Storage::disk('public')->files($this->directorio . $consecutivo);

        return view('etapas/reservaView', compact('route','etapa_id','etapas','consecutivo','etapa_estado','data','files'));
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

        $data = Reserva::where('consecutivo', $consecutivo)->first();

        $files = Storage::disk('public')->files($this->directorio . '/' . $consecutivo);

        return view('etapas/reservaView', compact('route','etapa_id','etapas','consecutivo','etapa_estado','data','files'));
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

        $upload_files = new MainController;
        $upload_files->uploadFile($request, $this->path.$this->directorio);

        $data = $request->except('_token','anexos');

        Reserva::where('consecutivo', $request->consecutivo)
                    ->update($data);

        return redirect()->route('edit_reserva', $request->consecutivo)->with('status', true);
    }

    /**
     * Get estado of etapa
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getEstado(Request $request)
    {
        $estado = Reserva::where('consecutivo', $request->consecutivo)
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
        Reserva::where('consecutivo', $request->consecutivo)
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
}