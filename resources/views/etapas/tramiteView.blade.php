@extends('layouts.lateralMenu.etapasView')

@section('content')
<div class="card-body">
    @switch($route)
        @case("index")
            <form action="{{ route('save_tramite') }}" method="post">
            {!! csrf_field() !!}
            @break
        @case("edit")
            <form action="{{ route('update_tramite') }}" method="post"> 
            {!! csrf_field() !!}
            @break
        @default
            @break
    @endswitch   
        <input type="hidden" name="consecutivo" value="{{ $consecutivo }}">
        <div class="form-group">
            <label for="consecutivo_sap">{{ Lang::get('strings.tramite.consecutivo_sap') }}</label>
            <input type="text" class="form-control" name="consecutivo_sap" value="{{ $etapas ? old('consecutivo_sap') : $data->consecutivo_sap}}">
            @if ($errors->has('consecutivo_sap'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('consecutivo_sap') }}</small></strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="fecha_sap">{{ Lang::get('strings.tramite.fecha_sap') }}</label>
            <input type="date" class="form-control" name="fecha_sap" value="{{ $etapas ? old('fecha_sap') : $data->fecha_sap}}">
            @if ($errors->has('fecha_sap'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('fecha_sap') }}</small></strong>
                </span>
            @endif
        </div>
        <div class="float-left"><button type="submit" class="btn btn-primary">{{ Lang::get('strings.general.guardar') }}</button></div>
    </form>
</div>
@stop