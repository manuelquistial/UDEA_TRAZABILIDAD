@extends('layouts.lateralMenu.etapasView')

@section('content')
<div class="card-body">
    <form action="{{ route('save_preaprobado') }}" method="post">
        {!! csrf_field() !!} 
        <div class="form-group">
            <label for="cdp">{{ Lang::get('strings.preaprobado.cdp') }}</label>
            <input type="text" class="form-control" name="cdp">
            @if ($errors->has('cdp'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('cdp') }}</small></strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="fecha_cdp">{{ Lang::get('strings.preaprobado.fecha_cdp') }}</label>
            <input type="date" class="form-control" name="fecha_cdp">
            @if ($errors->has('fecha_cdp'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('fecha_cdp') }}</small></strong>
                </span>
            @endif
        </div>
        <div class="float-left"><button type="submit" class="btn btn-primary">{{ Lang::get('strings.general.confirmar') }}</button></div>
    </form>
</div>
@stop