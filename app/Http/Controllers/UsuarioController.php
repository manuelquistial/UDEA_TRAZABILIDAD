<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Usuario;
use App\Etapa;
use App\Roles;
use App\TiposTransaccion;
use Auth;

class UsuarioController extends Controller
{
    public $columna = 'apellidos';
    public $numeroDatos = 5;
    public $espacio = " ";

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
        $data_opcion = false;

        $usuarios = Usuario::orderBy($this->columna)
                        ->paginate($this->numeroDatos);
    
        return view('configuration.usuariosView', compact('data_opcion', 'opcion', 'usuarios'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return \App\Usuario
     */
    public function newUser()
    {
        $opcion = "nuevo_usuario";
        $data_opcion = false;

        $etapas = Etapa::where('habilitador', 1)
                        ->get();

        $roles = Roles::get();

        $tipos_transaccion = TiposTransaccion::get();

        return view('configuration.nuevoUsuarioView', compact('data_opcion', 'opcion', 'etapas', 'roles', 'tipos_transaccion'));
    }

    /**
     * Get data from form.
     *
     * @param  array  $data
     * @return \App\Usuario
     */
    public function create(array $data)
    {
        $usuario = Usuario::create([
            'nombre_apellido' => $this->startEndSpaces($data['nombre']),
            'email' => $this->startEndSpaces($data['email']),
            'telefono' => $this->startEndSpaces($data['telefono']),
            'cedula' => $this->startEndSpaces($data['cedula']),
            'password' => Hash::make($data['cedula'], [
                'rounds' => 12,
            ])
        ]);

        if(!empty($data['tipos_transaccion'])){
            $usuario
                ->tiposTransaccion()
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

        $usuario = $this->create($request->all());
        $usuario->save();
        $request->session()->flash('status', 'status');

        return redirect()->route('usuarios');
        //return response()->json([''=>$request['etapa']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $usuario_id = Auth::user()->id;
        $opcion = "usuario";
        $data_opcion = true;
        
        $data = Usuario::where('id', $usuario_id)
                        ->select('id','nombre_apellido','email','cedula','telefono')
                        ->first();

        $etapas = Etapa::where('habilitador', 1)->get();
        $roles = Roles::where('habilitador',1)->get();
        $tipos_transaccion = TiposTransaccion::where('estado_id',4)->get();
        $roles_usuario = Usuario::find($usuario_id)->role()->get();
        $etapas_usuario = Usuario::find($usuario_id)->etapa()->get();
        $tipos_transaccion_usuario = Usuario::find($usuario_id)->tiposTransaccion()->get();
        
        //return response()->json(['data'=>$roles_usuario->etapa()->get()]);
        return view('configuration.nuevoUsuarioView', compact('data_opcion', 'opcion', 'data', 'etapas', 'roles', 'tipos_transaccion', 'roles_usuario', 'etapas_usuario', 'tipos_transaccion_usuario'));
    }

    /**
     * Display the all resources.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        $usuarios = Usuario::select('id', 'nombre_apellido')->get();
        return json_encode($usuarios);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $opcion = "administrador";
        $data_opcion = true;
        
        $data = Usuario::where('id', $id)
                        ->select('id','nombre_apellido','email','cedula','telefono')
                        ->first();

        $etapas = Etapa::where('habilitador', 1)->get();
        $roles = Roles::where('habilitador',1)->get();
        $tipos_transaccion = TiposTransaccion::where('estado_id',4)->get();
        $roles_usuario = Usuario::find($id)->role()->get();
        $etapas_usuario = Usuario::find($id)->etapa()->get();
        $tipos_transaccion_usuario = Usuario::find($id)->tiposTransaccion()->get();
        
        //return response()->json(['data'=>$roles_usuario->etapa()->get()]);
        return view('configuration.nuevoUsuarioView', compact('data_opcion', 'opcion', 'data', 'etapas', 'roles', 'tipos_transaccion', 'roles_usuario', 'etapas_usuario', 'tipos_transaccion_usuario'));
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

        $usuario = Usuario::find($request->sequence);

        $usuario->update(
            ['nombre_apellido' => $this->startEndSpaces($request['nombre_apellido'])],
            ['email' => $this->startEndSpaces($request['email'])],
            ['telefono' => $this->startEndSpaces($request['telefono'])],
            ['cedula' => $this->startEndSpaces($request['cedula'])]
        );

        $usuario->tiposTransaccion()
                ->detach($usuario->tiposTransaccion()->get());

        if(!empty($request['tipos_transaccion'])){
            $usuario->tiposTransaccion()
                ->attach($request['tipos_transaccion']);
        }

        $usuario->role()
                ->detach($usuario->role()->get());

        if(!empty($request['role'])){
            $usuario->role()
                ->attach($request['role']);
        } 

        $usuario->etapa()
                ->detach($usuario->etapa()->get());

        if($request['etapa'] !== 'on'){
            $usuario->etapa()
                ->attach($request['etapa']);
        } 

        return redirect()->route('edit_usuario', $request->sequence)->with('status', true);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePerfil(Request $request)
    {
        $this->validator($request->all())->validate();

        $data = $request->except('_token', 'sequence');

        Usuario::where('id', $request->sequence)
                        ->update($data);

        return redirect()->route('show_usuario')->with('status', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateEstado(Request $request)
    {
        $columna;
        if($request->columna == "habilitar"){
            $columna = 'estado_id';
        }

        Usuario::where('id', $request->id)
            ->update([$columna => $request->value]);

        return response()->json(['data'=>true]);
    }

    public function startEndSpaces($str){
        return trim($str, $this->espacio);
    }
}
