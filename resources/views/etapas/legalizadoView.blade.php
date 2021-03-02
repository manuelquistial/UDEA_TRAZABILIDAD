@extends('layouts.lateralMenu.etapasView')

@section('content')
<div class="card-body">
    <div class="info-body">

        <div class="form-group">
            <label for="crp">{{ Lang::get('strings.legalizado.crp') }}</label>
            <input type="text" class="form-control" name="crp" value="{{ isset($crp['crp']) ? $crp['crp'] : '' }}" disabled>
        </div>

        <div class="form-group">
            <label for="valor">{{ Lang::get('strings.legalizado.valor') }}</label>
            @if(\App::environment() != 'production')
                <input type="text" class="form-control" name="valor_egreso" value="{{ isset($egreso->egreso) ? $egreso->egreso : 0 }}" disabled>
            @else
                <?php $fmt = numfmt_create('de_DE', NumberFormatter::CURRENCY)?>
                <input type="text" class="form-control" name="valor_egreso" value="{{ isset($egreso->egreso)  ? str_replace(' €','',numfmt_format_currency($fmt, $egreso->egreso ,"EUR")) : 0 }}" disabled>
            @endif
        </div>

        <div class="form-group">
            <label for="valor">{{ Lang::get('strings.legalizado.valor_legalizar') }}</label>
            @if(\App::environment() != 'production')
                <input type="text" class="form-control" name="valor_legalizar" value="{{ isset($reserva->reserva) ? $reserva->reserva - $data['valor_reintegro'] : 0 - $data['valor_reintegro'] }}" disabled>
            @else
                <?php $fmt = numfmt_create('de_DE', NumberFormatter::CURRENCY)?>
                <input type="text" class="form-control" name="valor_legalizar" value="{{ isset($reserva->reserva)  ? str_replace(' €','',numfmt_format_currency($fmt, $reserva->reserva - $data['valor_reintegro'] ,"EUR")) : 0 - $data['valor_reintegro'] }}" disabled>
            @endif
        </div>

        @if(($estado != 3) || ($tipo_transaccion != 0))
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
        @endif
            <input type="hidden" name="consecutivo" value="{{ $consecutivo }}">
            <div class="form-group">
                <label for="consecutivo_reingreso">{{ Lang::get('strings.legalizado.consecutivo_reingreso') }}</label>
                <input type="number" class="form-control" name="consecutivo_reingreso" value="{{ $etapas ? old('consecutivo_reingreso') : $data->consecutivo_reingreso}}">
                @if ($errors->has('consecutivo_reingreso'))
                    <span class="text-danger">
                        <strong><small>{{ $errors->first('consecutivo_reingreso') }}</small></strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="valor_reintegro">{{ Lang::get('strings.legalizado.valor_reintegro') }}</label>
                <input type="text" class="form-control" name="valor_reintegro" id="valor" value="{{ $etapas ? old('valor_reintegro') : $data->valor_reintegro}}">
                @if ($errors->has('valor_reintegro'))
                    <span class="text-danger">
                        <strong><small>{{ $errors->first('valor_reintegro') }}</small></strong>
                    </span>
                @endif
            </div>
            @if(($estado != 3) || ($tipo_transaccion != 0))
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
</div>
@stop