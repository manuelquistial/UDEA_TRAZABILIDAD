@extends('layouts.lateralMenu.etapasView')

@section('content')
<div class="card-body">
    <div class="form-group">
        <h6>{{ Lang::get('strings.general.crp') }}</h6>
        <p></p>
    </div>
    <div class="form-group">
        <h6>{{ Lang::get('strings.reserva.saldo') }}</h6>
        <p></p>
    </div>

    @switch($route)
        @case("index")
            <form action="{{ route('save_reserva') }}" method="post"> 
            {!! csrf_field() !!}
            @break
        @case("edit")
            <form action="{{ route('update_reserva') }}" method="post"> 
            {!! csrf_field() !!}
            @break
        @default
            @break
    @endswitch  
        <input type="hidden" name="consecutivo" value="{{ $consecutivo }}">
        <div class="form-group">
            <label for="num_oficio">{{ Lang::get('strings.reserva.num_oficio') }}</label>
            <input type="text" class="form-control" name="num_oficio" value="{{ $etapas ? old('num_oficio') : $data->num_oficio}}">
            @if ($errors->has('num_oficio'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('num_oficio') }}</small></strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="fecha_cancelacion">{{ Lang::get('strings.reserva.fecha_cancelacion') }}</label>
            <input type="date" class="form-control" name="fecha_cancelacion" value="{{ $etapas ? old('fecha_cancelacion') : $data->fecha_cancelacion}}">
            @if ($errors->has('fecha_cancelacion'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('fecha_cancelacion') }}</small></strong>
                </span>
            @endif
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