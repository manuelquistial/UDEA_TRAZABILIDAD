@extends('layouts.lateralMenu.etapasView')

@section('content')
<div class="card-body">
    <div class="info-body">
        <form action="{{ route('save_tramite') }}" method="post">
            {!! csrf_field() !!}    
            <input type="hidden" name="consecutivo" value="{{ $consecutivo }}">
            <div class="form-group">
                <label for="exampleControlInput1">{{ Lang::get('strings.tramite.consecutivo_sap') }}</label>
                <input type="text" class="form-control" name="consecutivo_sap">
                @if ($errors->has('consecutivo_sap'))
                    <span class="text-danger">
                        <strong><small>{{ $errors->first('consecutivo_sap') }}</small></strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="example-date-input">{{ Lang::get('strings.tramite.fecha_sap') }}</label>
                <input type="date" class="form-control" name="fecha_sap">
                @if ($errors->has('fecha_sap'))
                    <span class="text-danger">
                        <strong><small>{{ $errors->first('fecha_sap') }}</small></strong>
                    </span>
                @endif
            </div>
            <div class="float-left"><button type="submit" class="btn btn-primary">{{ Lang::get('strings.general.confirmar') }}</button></div>
        </form>
    </div>
</div>
@stop