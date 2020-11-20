@extends('layouts.lateralMenu.etapasView')

@section('content')
<div class="card-body">
    <div class="info-body">
        <div class="form-group">
            <h6>{{ Lang::get('strings.legalizado.crp') }}</h6>
            <p></p>
        </div>
        <div class="form-group">
            <h6>{{ Lang::get('strings.legalizado.valor') }}</h6>
            <p></p>
        </div>
        @switch($route)
            @case("index")
                <form action="{{ route('save_legalizado') }}" method="post"> 
                {!! csrf_field() !!}
                @break
            @case("edit")
                <form action="{{ route('update_legalizado') }}" method="post"> 
                {!! csrf_field() !!}
                @break
            @default
                @break
        @endswitch 
            <input type="hidden" name="consecutivo" value="{{ $consecutivo }}">
            <div class="form-group">
                <label for="reintegro">{{ Lang::get('strings.legalizado.reintegro') }}</label>
                <input type="text" class="form-control" name="reintegro" value="{{ $etapas ? old('reintegro') : $data->reintegro}}">
                @if ($errors->has('reintegro'))
                    <span class="text-danger">
                        <strong><small>{{ $errors->first('reintegro') }}</small></strong>
                    </span>
                @endif
            </div>
            @switch($route)
                @case("edit")
                    <div class="float-left"><button type="submit" class="btn btn-primary">{{ Lang::get('strings.general.actualizar') }}</button></div>
                    @break
                @default
                    @break
            @endswitch
        </form>
    </div>
</div>
@stop