@extends('layouts.lateralMenu.etapasView')

@section('content')
<div class="card-body">
    <div class="info-body">
        <input type="hidden" name="consecutivo" value="{{ $consecutivo }}">
        <div class="form-group">
            <label for="crp">{{ Lang::get('strings.general.crp') }}</label>
            <input type="text" class="form-control" name="crp" value="{{ isset($crp['crp']) ? $crp['crp'] : '' }}" disabled>
        </div>
        <div class="form-group">
            <label for="valor_egreso">{{ Lang::get('strings.pago.valor_egreso') }}</label>
            @if(\App::environment() != 'production')
                <input type="text" class="form-control" name="valor_egreso" value="{{ isset($egreso->egreso) ? $egreso->egreso : '' }}" disabled>
            @else
                <?php $fmt = numfmt_create('de_DE', NumberFormatter::CURRENCY)?>
                <input type="text" class="form-control" name="valor_egreso" value="{{ isset($egreso->egreso)  ? str_replace(' €','',numfmt_format_currency($fmt, $egreso->egreso ,"EUR")) : '' }}" disabled>
            @endif
        </div>
    </div>
</div>
@stop