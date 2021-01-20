@extends('layouts.lateralMenu.etapasView')

@section('content')
<div class="card-body">
    @switch($route)
        @case("index")
            <form action="{{ route('save_autorizado') }}" method="post"> 
            {!! csrf_field() !!}
            @break
        @case("edit")
            <form action="{{ route('update_autorizado') }}" method="post"> 
            {!! csrf_field() !!}
            @break
        @default
            @break
    @endswitch 
        <input type="hidden" name="consecutivo" value="{{ $consecutivo }}">
        <div class="form-group">
            <label for="codigo_sigep">{{ Lang::get('strings.autorizado.codigo_sigep') }}</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="codigo_sigep" value="{{ $etapas ? old('codigo_sigep') : $data->codigo_sigep }}">
            </div>
            @if ($errors->has('codigo_sigep'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('codigo_sigep') }}</small></strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="descripcion_pendiente">{{ Lang::get('strings.autorizado.descripcion_pendiente') }}</label>
            <textarea class="form-control" name="descripcion_pendiente" rows="2">{{ $etapas ? old('descripcion_pendiente') : $data->descripcion_pendiente}}</textarea>
            @if(session('empty'))
                <span class="text-danger">
                    <strong><small>{{ Lang::get('strings.notes.empty_codigo_sigep') }}</small></strong>
                </span>
            @endif
            <small class="form-text text-muted">
                {!! Lang::get('strings.notes.descripcion_pendiente') !!}
            </small>
        </div>
        @switch($route)
            @case("index")
                <div class="float-left"><button type="submit" class="btn btn-primary">{{ Lang::get('strings.general.guardar') }}</button></div>
                @break
            @case("edit")
                <div class="float-left"><button type="submit" class="btn btn-primary">{{ Lang::get('strings.general.actualizar') }}</button></div>
                @break
            @default
                @break
        @endswitch
    </form>
</div>
@stop