@extends('layouts.lateralMenu.etapasView')

@section('content')
<div class="card-body">
    <input type="hidden" name="consecutivo" value="{{ $consecutivo }}">
    <div class="form-group">
        <h6>{{ Lang::get('strings.general.crp') }}</h6>
        <p></p>
    </div>
    <div class="form-group">
        <h6>{{ Lang::get('strings.pago.valor_egreso') }}</h6>
        <p></p>
    </div>
</div>
@stop