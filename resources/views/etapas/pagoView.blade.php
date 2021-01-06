@extends('layouts.lateralMenu.etapasView')

@section('content')
<div class="card-body">
    <div class="info-body">
        <input type="hidden" name="consecutivo" value="{{ $consecutivo }}">
        <div class="form-group">
            <label for="crp">{{ Lang::get('strings.general.crp') }}</label>
            <input type="text" class="form-control" name="crp" value="" disabled>
        </div>
        <div class="form-group">
            <label for="valor_egreso">{{ Lang::get('strings.pago.valor_egreso') }}</label>
            <input type="text" class="form-control" name="valor_egreso" value="" disabled>
        </div>
    </div>
</div>
@stop