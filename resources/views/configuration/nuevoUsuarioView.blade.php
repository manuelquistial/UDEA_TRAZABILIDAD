@extends('layouts.lateralMenu.configuracionView')

@section('content')
<div class="modal-header">
    <div class="col-6 conf-header" id="nuevo_usuario">
        @if($opcion == "administrador")
            <h5 id="perfil">{{ Lang::get('strings.configuracion.modal.usuarios.titulo') }}</h5>
        @elseif($opcion == "usuario")
            <h5 id="perfil">{{ Lang::get('strings.configuracion.perfil') }}</h5>
        @else
            <h5>{{ Lang::get('strings.configuracion.nuevo_usuario') }}</h5>
        @endif
    </div>
    @if(session('status'))
        <div class="status alert alert-success fade show" id="status" role="alert">
            {{ Lang::get('strings.configuracion.modal.usuarios.titulo') }} {{ Lang::get('strings.general.guardado') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</div>
<div class="card-body">
    @if($opcion == "administrador")
        <form action="{{ route('update_usuario') }}" method="post">
        <input type="hidden" name="sequence" value="{{ $data->id }}">
    @elseif($opcion == "usuario")
        <form action="{{ route('update_usuario_perfil') }}" method="post">
        <input type="hidden" name="sequence" value="{{ $data->id }}">
    @else
        <form action="{{ route('agregar_nuevo_usuario') }}" method="post">
    @endif
    {!! csrf_field() !!}
        <div class="form-group">
            <label for="nombre">{{ Lang::get('strings.usuario.nombre') }}</label>
            <input type="text" class="form-control" id="nombre" name="nombre_apellido" value="{{ $data_opcion ? $data->nombre_apellido : old('nombre_apellido')}}"> 
            @if ($errors->has('nombre_apellido'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('nombre_apellido') }}</small></strong>
                </span>
            @endif
        </div>
        @if($opcion != "usuario")
        <div class="form-group">
            <label for="email">{{ Lang::get('strings.usuario.email') }}</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $data_opcion ? $data->email : old('email')}}"> 
            @if ($errors->has('email'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('email') }}</small></strong>
                </span>
            @endif
        </div>
        @endif
        <div class="form-row">
            @if($opcion != "usuario")
            <div class="form-group col-md-6">
                <label for="cedula">{{ Lang::get('strings.usuario.cedula') }}</label>
                <input type="text" class="form-control" id="cedula" name="cedula" value="{{ $data_opcion ? $data->cedula : old('cedula')}}"> 
                @if ($errors->has('cedula'))
                    <span class="text-danger">
                        <strong><small>{{ $errors->first('cedula') }}</small></strong>
                    </span>
                @endif
            </div>
            @endif
            @if($opcion == "usuario")
            <div class="form-group col-md-6">
                <label for="email">{{ Lang::get('strings.usuario.email') }}</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $data_opcion ? $data->email : old('email')}}"> 
                @if ($errors->has('email'))
                    <span class="text-danger">
                        <strong><small>{{ $errors->first('email') }}</small></strong>
                    </span>
                @endif
            </div>
            @endif
            <div class="form-group col-md-6">
                <label for="telefono">{{ Lang::get('strings.usuario.telefono') }}</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" value="{{ $data_opcion  ? $data->telefono : old('telefono')}}"> 
                @if ($errors->has('telefono'))
                    <span class="text-danger">
                        <strong><small>{{ $errors->first('telefono') }}</small></strong>
                    </span>
                @endif
            </div>
        </div>
        @if($opcion != "usuario")
        <div class="form-group">
            <label for="tipo_transaccion">{{ Lang::get('strings.configuracion.tipo_transaccion') }}</label>
            <input type="text" class="form-control" id="tipo_transaccion" data-toggle="dropdown" placeholder="{{ Lang::get('strings.configuracion.escribir_transaccion') }}"> 
            <div class="dropdown-menu scrollable-menu tipo_transaccion" id="tipos_transaccion" aria-labelledby="tipo_transaccion">
                @if($data_opcion)
                    @foreach($tipos_transaccion_usuario as $tipo_transaccion_usuario)
                        <div class="form-check tipo_transaccion_item">
                            <input type="checkbox" class="form-check-input" name="tipos_transaccion[]" data-name="{{ $tipo_transaccion_usuario->tipo_transaccion }}" id="{{ $tipo_transaccion_usuario->tipo_transaccion }}" value="{{ $tipo_transaccion_usuario->id }}" checked>
                            <label class="form-check-label" for="{{ $tipo_transaccion_usuario->tipo_transaccion }}">{{ $tipo_transaccion_usuario->tipo_transaccion }}</label>
                        </div>
                    @endforeach
                @endif
                @foreach($tipos_transaccion as $tipo_transaccion)
                    <div class="form-check tipo_transaccion_item">
                        <input type="checkbox" class="form-check-input" name="tipos_transaccion[]" data-name="{{ $tipo_transaccion->tipo_transaccion }}" id="{{ $tipo_transaccion->tipo_transaccion }}" value="{{ $tipo_transaccion->id }}">
                        <label class="form-check-label" for="{{ $tipo_transaccion->tipo_transaccion }}">{{ $tipo_transaccion->tipo_transaccion }}</label>
                    </div>
                @endforeach
            </div>
            <div class="tipo_transaccion_badge" id="tipos_transaccion_badge">
                @if($data_opcion)
                    @foreach($tipos_transaccion_usuario as $tipo_transaccion_usuario)
                        <span class="badge badge-pill badge-info">{{ $tipo_transaccion_usuario->tipo_transaccion }}<label class="fas fa-times badge_tipo_transaccion" for="{{ $tipo_transaccion_usuario->tipo_transaccion }}" aria-hidden="true"></label></span>
                    @endforeach
                @endif
            </div>
            <small class="form-text text-muted">
                <strong>{!! Lang::get('strings.notes.usuario_tipo_transaccion') !!}</strong>
            </small>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="cargo_id">{{ Lang::get('strings.usuario.cargo') }}</label>
                <select class="form-control" name="cargo_id">
                    <option value="">{{ Lang::get('strings.usuario.seleccione_cargo') }}</option>
                    @if($data_opcion)
                        @foreach($cargos as $cargo)
                            @if($cargos_usuario)
                                @foreach($cargos_usuario as $cargo_usuario)
                                    @if($cargo_usuario->cargo_id == $cargo->cargo_id)
                                        <option value="{{ $cargo->cargo_id }}" {{old('cargo_id') == $cargo->id ? $cargo->id :''}} selected>{{ $cargo->cargo }}</option>
                                    @else
                                        <option value="{{ $cargo->cargo_id }}">{{ $cargo->cargo }}</option>
                                    @endif
                                @endforeach
                            @else
                                <option value="{{ $cargo->cargo_id }}">{{ $cargo->cargo }}</option>
                            @endif
                        @endforeach
                    @else
                        @foreach($cargos as $cargo)
                            <option value="{{ $cargo->cargo_id }}">{{ $cargo->cargo }}</option>
                        @endforeach
                    @endif
                </select>
                <small class="form-text text-muted">
                    <strong>{!! Lang::get('strings.notes.usuario_cargo') !!}</strong>
                </small>
            </div>
            <div class="form-group col-md-6">
                @if($data_opcion)
                    @foreach($roles as $role)
                        @if($roles_usuario)
                            @foreach($roles_usuario as $role_usuario)
                                @if($role_usuario->role_id == $role->role_id)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="role[]" id="{{$role->role}}" value="{{$role->id}}" checked>
                                    <label class="form-check-label" for="{{$role->role}}">{{$role->role}}</label>
                                </div>
                                @else
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="role[]" id="{{$role->role}}" value="{{$role->id}}">
                                    <label class="form-check-label" for="{{$role->role}}">{{$role->role}}</label>
                                </div>
                                @endif
                            @endforeach
                        @else
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="role[]" id="{{$role->role}}" value="{{$role->id}}">
                                <label class="form-check-label" for="{{$role->role}}">{{$role->role}}</label>
                            </div>
                        @endif
                    @endforeach
                @else
                    @foreach($roles as $role)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="role[]" id="{{$role->role}}" value="{{$role->id}}">
                            <label class="form-check-label" for="{{$role->role}}">{{$role->role}}</label>
                        </div>
                    @endforeach
                @endif
                <small class="form-text text-muted">
                    <strong>{!! Lang::get('strings.notes.usuario_administrador') !!}</strong>
                </small>
            </div>
        </div>
        @endif
        <div class="float-left"><button type="submit" class="btn btn-primary">{{ Lang::get('strings.general.guardar') }}</button></div>
    </form>
</div>
@stop

@section('scripts')
    <script type="module" src="{{ asset('js/nuevoUsuario.js') }}" crossorigin="anonymous"></script>
@stop