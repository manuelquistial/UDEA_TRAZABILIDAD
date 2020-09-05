@extends('layouts.lateralMenu.configuracionView')

@section('content')
<div class="modal-header">
    <div class="col-6 conf-header" id="nuevo_usuario">
        @if($opcion != "perfil")
            <h5>{{ Lang::get('strings.configuracion.nuevo_usuario') }}</h5>
        @else
            <h5 id="perfil">{{ Lang::get('strings.configuracion.perfil') }}</h5>
        @endif
    </div>
</div>
<div class="card-body">
    <form action="{{ route('agregar_nuevo_usuario') }}" method="post">
    {!! csrf_field() !!}
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nombre">{{ Lang::get('strings.usuario.nombre') }}</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $opcion == "perfil" ? $data->nombre : old('nombre')}}"> 
                @if ($errors->has('nombre'))
                    <span class="text-danger">
                        <strong><small>{{ $errors->first('nombre') }}</small></strong>
                    </span>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="apellidos">{{ Lang::get('strings.usuario.apellidos') }}</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ $opcion == "perfil" ? $data->apellidos : old('apellidos')}}"> 
                @if ($errors->has('apellidos'))
                    <span class="text-danger">
                        <strong><small>{{ $errors->first('apellidos') }}</small></strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="email">{{ Lang::get('strings.usuario.email') }}</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $opcion == "perfil" ? $data->email : old('email')}}"> 
            @if ($errors->has('email'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('email') }}</small></strong>
                </span>
            @endif
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="cedula">{{ Lang::get('strings.usuario.cedula') }}</label>
                <input type="text" class="form-control" id="cedula" name="cedula" value="{{ $opcion == "perfil" ? $data->cedula : old('cedula')}}"> 
                @if ($errors->has('cedula'))
                    <span class="text-danger">
                    </span>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="telefono">{{ Lang::get('strings.usuario.telefono') }}</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" value="{{ $opcion == "perfil" ? $data->telefono : old('telefono')}}"> 
                @if ($errors->has('telefono'))
                    <span class="text-danger">
                        <strong><small>{{ $errors->first('telefono') }}</small></strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="tipo_transaccion">{{ Lang::get('strings.configuracion.tipo_transaccion') }}</label>
            <input type="text" class="form-control" id="tipo_transaccion" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" placeholder="{{ Lang::get('strings.configuracion.escribir_transaccion') }}"> 
            <div class="dropdown-menu tipo_transaccion" id="tipos_transaccion" aria-labelledby="dropdownMenuButton">
            </div>
            <div class="tipo_transaccion_badge" id="tipos_transaccion_badge">
            </div>
            <small class="form-text text-muted">
                {!! Lang::get('strings.notes.usuario_tipo_transaccion') !!}
            </small>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="etapa" id="ninguno" value="" selected>
                    <label class="form-check-label" for="ninguno">{!! Lang::get('strings.usuario.etapas.ninguno') !!}</label>
                </div>
                @if($opcion == "perfil")
                @else
                    @foreach($etapas as $etapa)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="etapa" id="{{$etapa->id}}" value="{{$etapa->id}}">
                        <label class="form-check-label" for="{{$etapa->id}}">{{$etapa->etapa}}</label>
                    </div>
                    @endforeach
                @endif
                <small class="form-text text-muted">
                    {!! Lang::get('strings.notes.usuario_etapa') !!}
                </small>
            </div>
            <div class="form-group col-md-6">
                @if($opcion == "perfil")
                @else
                    @foreach($roles as $role)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="role[]" id="{{$role->id}}" value="{{$role->id}}">
                        <label class="form-check-label" for="{{$role->id}}">{{$role->role}}</label>
                    </div>
                    @endforeach
                @endif
                <small class="form-text text-muted">
                    {!! Lang::get('strings.notes.usuario_administrador') !!}
                </small>
            </div>
        </div>
        <div class="float-left"><button type="submit" class="btn btn-primary">{{ Lang::get('strings.usuario.guardar') }}</button></div>
    </form>
</div>
@stop

@section('scripts')
    <script type="module" src="{{ asset('js/nuevoUsuarioScript.js') }}" crossorigin="anonymous"></script>
@stop