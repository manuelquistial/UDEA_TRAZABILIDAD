<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Usuario;
use Auth;

class UsuarioController extends Controller
{
    public $usuarios = 'tr_usuarios';
    public $columna = 'apellidos';
    public $numeroDatos = 5;

    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $opcion = "usuarios"; 
        $usuarios;
        try {
            $usuarios = DB::table($this->usuarios)
                            ->orderBy($this->columna)
                            ->paginate($this->numeroDatos);
        } catch(Exception $e) {
            $usuarios = "error";
        }
    
        return view('configuration.usuariosView', compact('opcion', 'usuarios'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return \App\Usuario
     */
    public function create()
    {
        $opcion = "nuevo_usuario";
        $etapas;
        $roles;

        try {
            $etapas = DB::table('tr_etapas')
                            ->where('habilitador', 1)
                            ->get();
        } catch(Exception $e) {
            $etapas = "error";
        }
        
        try {
            $roles = DB::table('tr_roles')
                            ->get();
        } catch(Exception $e) {
            $roles = "error";
        }

        return view('configuration.nuevoUsuarioView', compact('opcion','etapas','roles'));
    }

    /**
     * Get data from form.
     *
     * @param  array  $data
     * @return \App\Usuario
     */
    public function form(array $data)
    {
        $usuario = Usuario::create([
            'nombre' => $data['nombre'],
            'apellidos' => $data['apellidos'],
            'email' => $data['email'],
            'telefono' => $data['telefono'],
            'cedula' => $data['cedula'],
            'password' => Hash::make($data['cedula'], [
                'rounds' => 12,
            ])
        ]);

        if(!empty($data['tipos_transaccion'])){
            $usuario
                ->tiposTransaccion()
                //->attach([implode(',',[$data['tipos_transaccion']])]);
                ->attach($data['tipos_transaccion']);
        }

        if($data['etapa'] !== 'on'){
            $usuario
                ->etapa()
                ->attach($data['etapa']);
        }

        if(!empty($data['role'])){
            $usuario
                ->role()
                ->attach($data['role']);
        }

        return $usuario;
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
            'nombre' => 'required|string',
            'apellidos' => 'required|string',
            'email' => 'required|email',
            'telefono' => 'required|numeric'
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

        $usuario = $this->form($request->all());
        $usuario->save();
        $request->session()->flash('status', 'status');
        return redirect()->route('nuevo_usuario');
        //return response()->json([''=>$request['etapa']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Display the all resources.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        $usuarios = DB::table('tr_usuarios')->select('id', 'nombre', 'apellidos')->get();
        return json_encode($usuarios);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $usuario_id = Auth::user()->id;
        $opcion = "perfil";
        $data;
        try {
            $data = DB::table($this->usuarios)
                            ->where('id',$usuario_id)
                            ->select('nombre','apellidos','email','cedula','telefono')
                            ->first();
        } catch(Exception $e) {
            $data = "error";
        }
        return view('configuration.nuevoUsuarioView', compact('opcion','data'));
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
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateEstado(Request $request)
    {
        $queryStatus;
        $columna;
        if($request->columna == "habilitar"){
            $columna = 'estado_id';
        }
        try {
            DB::table($this->usuarios)
                ->where('id', $request->id)
                ->update([$columna => $request->item]);
            $queryStatus = "ok";
        } catch(Exception $e) {
            $queryStatus = "error";
        }
        return response()->json(['data'=>$queryStatus]);
    }
}
