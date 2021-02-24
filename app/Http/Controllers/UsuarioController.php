<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Usuario;
use App\Roles;
use App\Cargos;
use App\TiposTransaccion;
use Auth;

class UsuarioController extends Controller
{
    public $usuarios = 'tr_usuarios';
    public $columna = 'nombre_apellido';
    public $numeroDatos = 5;
    public $espacio = " ";
    public $estado_habilitado = 4;

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

        $cargos = Cargos::get();

        $roles = Roles::get();

        $tipos_transaccion = new Usuario;
        $tipos_transaccion = $tipos_transaccion->tipoTransaccionWithOutUsuarios()->get();

        return view('configuration.nuevoUsuarioView', compact('data_opcion', 'opcion', 'cargos', 'roles', 'tipos_transaccion'));
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
            'nombre_apellido' => $this->startEndSpaces($data['nombre_apellido']),
            'email' => $this->startEndSpaces($data['email']),
            'telefono' => $this->startEndSpaces($data['telefono']),
            'cedula' => $this->startEndSpaces($data['cedula']),
            'usuario' => $this->startEndSpaces($data['cedula']),
            'password' => Hash::make($data['cedula'], [
                'rounds' => 12,
            ]),
            'estado_id' => $this->estado_habilitado
        ]);

        if(!empty($data['tipos_transaccion'])){
            $usuario
                ->tiposTransaccion()
                ->attach($data['tipos_transaccion']);
        }

        if($this->returnNull($data['cargo_id'])){
            $usuario
                ->cargo()
                ->attach($data['cargo_id']);
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
    protected function validator(array $data, $id)
    {
        return Validator::make($data, [
            'nombre_apellido' => 'required|string',
            'email' => 'required|email|unique:tr_usuarios,email'.($id ? ','.$id : ''),
            'cedula' => 'required|unique:tr_usuarios,cedula'.($id ? ','.$id : ''),
            'telefono' => 'required|numeric'
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator_update(array $data, $id)
    {
        return Validator::make($data, [
            'nombre_apellido' => 'required|string',
            'email' => 'required|email|unique:tr_usuarios,email'.($id ? ','.$id : ''),
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
        $this->validator($request->all(), NULL)->validate();

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

        $cargos = Cargos::get();
        $roles = Roles::where('habilitador',1)->get();
        $tipos_transaccion = new Usuario;
        $tipos_transaccion = $tipos_transaccion->tipoTransaccionWithOutUsuarios()->get();
        $roles_usuario = Usuario::find($usuario_id)->role()->get();
        $cargos_usuario = Usuario::find($usuario_id)->cargo()->get();
        $tipos_transaccion_usuario = Usuario::find($usuario_id)->tiposTransaccion()->get();
        
        //return response()->json(['data'=>$roles_usuario->cargo()->get()]);
        return view('configuration.nuevoUsuarioView', compact('data_opcion', 'opcion', 'data', 'cargos', 'roles', 'tipos_transaccion', 'roles_usuario', 'cargos_usuario', 'tipos_transaccion_usuario'));
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
     * Display a specific page.
     *
     * @return \Illuminate\Http\Response
     */
    public function pagination()
    {
        $usuarios = DB::table($this->usuarios)
                        ->orderBy($this->columna)
                        ->select('nombre_apellido','estado_id')
                        ->paginate($this->numeroDatos);

        return json_encode($usuarios);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $data
     * @return \Illuminate\Http\Response
     */
    public function showItem($data)
    {
        $usuarios = DB::table($this->usuarios)
            ->where($this->columna, 'like', '%'.$data.'%')
            ->select('nombre_apellido','estado_id')
            ->orderBy($this->columna)
            ->get();
        
        return response()->json(['data'=>$usuarios]);
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

        $cargos = Cargos::get();
        $roles = Roles::where('habilitador',1)->get();
        $tipos_transaccion = new Usuario;
        $tipos_transaccion = $tipos_transaccion->tipoTransaccionWithOutUsuarios()->get();
        
        $roles_usuario = Usuario::find($id)->role();
        if($roles_usuario->count() == 0){
            $roles_usuario = false;
        }else{
            $roles_usuario = $roles_usuario->get();
        }

        $cargos_usuario = Usuario::find($id)->cargo();
        if($cargos_usuario->count() == 0){
            $cargos_usuario = false;
        }else{
            $cargos_usuario = $cargos_usuario->get();
        }
        $tipos_transaccion_usuario = Usuario::find($id)->tiposTransaccion()->get();
        
        //return response()->json(['data'=>$roles_usuario->etapa()->get()]);
        return view('configuration.nuevoUsuarioView', compact('data_opcion', 'opcion', 'data', 'roles', 'cargos', 'tipos_transaccion', 'roles_usuario', 'cargos_usuario', 'tipos_transaccion_usuario'));
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
        $this->validator($request->all(), $request->sequence)->validate();

        $request = $request->except('_token');

        $usuario = Usuario::find($request['sequence']);

        $usuario->nombre_apellido = $this->startEndSpaces($request['nombre_apellido']);
        $usuario->email = $this->startEndSpaces($request['email']);
        $usuario->telefono = $this->startEndSpaces($request['telefono']);
        $usuario->cedula = $this->startEndSpaces($request['cedula']);
        $usuario->save();


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

        $usuario->cargo()
                ->detach($usuario->cargo()->get());

        if($this->returnNull($request['cargo_id'])){
            $usuario
                ->cargo()
                ->attach($request['cargo_id']);
        }

        return redirect()->route('edit_usuario', $request['sequence'])->with('status', true);
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
        $this->validator_update($request->all(), $request->sequence)->validate();

        $data = $request->except('_token', 'sequence');
        info($data);
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

    public function returnNull($str){
        if($str == ''){
            return NULL;
        }
        return $str;
    }
}
