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
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $data_opcion ? $data->nombre : old('nombre')}}"> 
            @if ($errors->has('nombre'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('nombre') }}</small></strong>
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
            <input type="text" class="form-control" id="tipo_transaccion" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" placeholder="{{ Lang::get('strings.configuracion.escribir_transaccion') }}"> 
            <div class="dropdown-menu tipo_transaccion" id="tipos_transaccion" aria-labelledby="tipo_transaccion">
                @if($data_opcion)
                    @foreach($tipos_transaccion as $tipo_transaccion)
                        @php $checked = ""; @endphp
                        @foreach($tipos_transaccion_usuario as $tipo_transaccion_usuario)
                            @if($tipo_transaccion_usuario->id == $tipo_transaccion->id)
                                @php $checked = "checked"; @endphp
                            @endif
                        @endforeach
                        <div class="form-check tipo_transaccion_item">
                            <input type="checkbox" class="form-check-input" name="tipos_transaccion[]" data-name="{{ $tipo_transaccion->tipo_transaccion }}" id="{{ $tipo_transaccion->tipo_transaccion }}" value="{{ $tipo_transaccion->id }}" {{$checked}}>
                            <label class="form-check-label" for="{{ $tipo_transaccion->tipo_transaccion }}">{{ $tipo_transaccion->tipo_transaccion }}</label>
                        </div>
                    @endforeach
                @else
                    @foreach($tipos_transaccion as $tipo_transaccion)
                    <div class="form-check tipo_transaccion_item">
                        <input type="checkbox" class="form-check-input" name="tipos_transaccion[]" data-name="{{ $tipo_transaccion->tipo_transaccion }}" id="{{ $tipo_transaccion->tipo_transaccion }}" value="{{ $tipo_transaccion->id }}">
                        <label class="form-check-label" for="{{ $tipo_transaccion->tipo_transaccion }}">{{ $tipo_transaccion->tipo_transaccion }}</label>
                    </div>
                    @endforeach
                @endif
            </div>
            <div class="tipo_transaccion_badge" id="tipos_transaccion_badge">
                @if($data_opcion)
                    @foreach($tipos_transaccion_usuario as $tipo_transaccion_usuario)
                        <span class="badge badge-pill badge-info">{{ $tipo_transaccion_usuario->tipo_transaccion }}<label class="fas fa-times badge_tipo_transaccion" for="{{ $tipo_transaccion_usuario->id }}" aria-hidden="true"></label></span>
                    @endforeach
                @endif
            </div>
            <small class="form-text text-muted">
                {!! Lang::get('strings.notes.usuario_tipo_transaccion') !!}
            </small>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="etapa" id="ninguno" checked>
                    <label class="form-check-label" for="ninguno">{!! Lang::get('strings.usuario.etapas.ninguno') !!}</label>
                </div>
                @if($data_opcion)
                    @foreach($etapas as $etapa)
                        @foreach($etapas_usuario as $etapa_usuario)
                            @if($etapa_usuario->etapa_id == $etapa->etapa_id)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="etapa" id="{{$etapa->id}}" value="{{$etapa->id}}" checked>
                                @if($etapa->id == '3')
                                    <label class="form-check-label" for="{{$etapa->id}}">{{ Lang::get('strings.configuracion.sap') }}</label>
                                @elseif($etapa->id == '4')
                                    <label class="form-check-label" for="{{$etapa->id}}">{{ Lang::get('strings.configuracion.sigep') }}</label>
                                @else
                                    <label class="form-check-label" for="{{$etapa->id}}">{{$etapa->etapa}}</label>
                                @endif
                            </div>
                            @else
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="etapa" id="{{$etapa->id}}" value="{{$etapa->id}}">
                                @if($etapa->id == '3')
                                    <label class="form-check-label" for="{{$etapa->id}}">{{ Lang::get('strings.configuracion.sap') }}</label>
                                @elseif($etapa->id == '4')
                                    <label class="form-check-label" for="{{$etapa->id}}">{{ Lang::get('strings.configuracion.sigep') }}</label>
                                @else
                                    <label class="form-check-label" for="{{$etapa->id}}">{{$etapa->etapa}}</label>
                                @endif
                            </div>
                            @endif
                        @endforeach
                    @endforeach
                @else
                    @foreach($etapas as $etapa)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="etapa" id="{{$etapa->id}}" value="{{$etapa->id}}">
                        @if($etapa->id == '3')
                            <label class="form-check-label" for="{{$etapa->id}}">{{ Lang::get('strings.configuracion.sap') }}</label>
                        @elseif($etapa->id == '4')
                            <label class="form-check-label" for="{{$etapa->id}}">{{ Lang::get('strings.configuracion.sigep') }}</label>
                        @else
                            <label class="form-check-label" for="{{$etapa->id}}">{{$etapa->etapa}}</label>
                        @endif
                    </div>
                    @endforeach
                @endif
                <small class="form-text text-muted">
                    {!! Lang::get('strings.notes.usuario_etapa') !!}
                </small>
            </div>
            <div class="form-group col-md-6">
                @if($data_opcion)
                    @foreach($roles as $role)
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
                    {!! Lang::get('strings.notes.usuario_administrador') !!}
                </small>
            </div>
        </div>
        @endif
        <div class="float-left"><button type="submit" class="btn btn-primary">{{ Lang::get('strings.usuario.guardar') }}</button></div>
    </form>
</div>
@stop

@section('scripts')
    <script type="module" src="{{ asset('js/nuevoUsuario.js') }}" crossorigin="anonymous"></script>
@stop