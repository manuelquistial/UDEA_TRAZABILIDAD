@extends('layouts.lateralMenu.etapasView')

@section('content')
<div class="card-body">
    @if($estado != 3)
        @switch($route)
            @case("index")
                <form action="{{ route('save_preaprobado') }}" method="post"> 
                {!! csrf_field() !!}
                @break
            @case("edit")
                <form action="{{ route('update_preaprobado') }}" method="post"> 
                {!! csrf_field() !!}
                @break
            @default
                @break
        @endswitch  
    @endif
        <input type="hidden" name="consecutivo" value="{{ $consecutivo }}">
        <div class="form-group">
            <label for="cdp">{{ Lang::get('strings.preaprobado.cdp') }}</label>
            <input type="number" class="form-control" name="cdp" value="{{ $etapas ? old('cdp') : $data->cdp}}">
            @if ($errors->has('cdp'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('cdp') }}</small></strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="fecha_cdp">{{ Lang::get('strings.preaprobado.fecha_cdp') }}</label>
            <input type="date" class="form-control" placeholder="yyyy-mm-dd" name="fecha_cdp" value="{{ $etapas ? old('fecha_cdp') : $data->fecha_cdp}}">
            @if ($errors->has('fecha_cdp'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('fecha_cdp') }}</small></strong>
                </span>
            @endif
        </div>
        @if($estado != 3)
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
        @endif
    </form>
</div>
@stop