@extends('layouts.lateralMenu.etapasView')

@section('content')
<div class="card-body">
    <div class="form-group">
        <label for="fecha_envio_documento">{{ Lang::get('strings.aprobado.fecha_envio_documento') }}</label>
        <div class="input-group mb-3">
            <input type="date" class="form-control" name="fecha_envio_documento" value="{{ $etapas ? old('fecha_envio_documento') : $data->fecha_envio_documento}}">
            @if($route !== "show")
            <div class="input-group-prepend">
                <a class="input-group-text" id="redirect" >{{ Lang::get('strings.general.guardar') }}</a>
            </div>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="fecha_envio_decanatura">{{ Lang::get('strings.aprobado.fecha_envio_decanatura') }}</label>
        <div class="input-group mb-3">
            <input type="date" class="form-control" name="fecha_envio_decanatura" value="{{ $etapas ? old('fecha_envio_decanatura') : $data->fecha_envio_decanatura}}">
            @if($route !== "show")
            <div class="input-group-prepend">
                <a class="input-group-text" id="redirect" >{{ Lang::get('strings.general.guardar') }}</a>
            </div>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="fecha_envio_presupuestos">{{ Lang::get('strings.aprobado.fecha_envio_presupuestos') }}</label>
        <div class="input-group mb-3">
            <input type="date" class="form-control" name="fecha_envio_presupuestos" value="{{ $etapas ? old('fecha_envio_presupuestos') : $data->fecha_envio_presupuestos}}">
            @if($route !== "show")
            <div class="input-group-prepend">
                <a class="input-group-text" id="redirect" >{{ Lang::get('strings.general.guardar') }}</a>
            </div>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="solpe">{{ Lang::get('strings.aprobado.solpe') }}</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="solpe" value="{{ $etapas ? old('solpe') : $data->solpe }}"> 
            @if($route !== "show")
            <div class="input-group-prepend">
                <a class="input-group-text" id="redirect" >{{ Lang::get('strings.general.guardar') }}</a>
            </div>
            @endif
        </div>
    </div>
    @switch($route)
        @case("index")
            <form action="{{ route('save_aprobado') }}" method="post"> 
            {!! csrf_field() !!}
            @break
        @case("edit")
            <form action="{{ route('update_aprobado') }}" method="post"> 
            {!! csrf_field() !!}
            @break
        @default
            @break
    @endswitch 
        <input type="hidden" name="consecutivo" value="{{ $consecutivo }}">
        <div class="form-group">
            <label for="crp">{{ Lang::get('strings.general.crp') }}</label>
            <input type="text" class="form-control" name="crp" value="{{ $etapas ? old('crp') : $data->crp }}">
            @if ($errors->has('crp'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('crp') }}</small></strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="fecha_crp_pedido">{{ Lang::get('strings.aprobado.fecha_crp_pedido') }}</label>
            <input type="date" class="form-control" name="fecha_crp_pedido" value="{{ $etapas ? old('fecha_crp_pedido') : $data->fecha_crp_pedido }}">
            @if ($errors->has('fecha_crp_pedido'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('fecha_crp_pedido') }}</small></strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="valor_final_crp">{{ Lang::get('strings.aprobado.valor_final_crp') }}</label>
            <input type="text" class="form-control" name="valor_final_crp" value="{{ $etapas ? old('valor_final_crp') : $data->valor_final_crp }}">
            @if ($errors->has('valor_final_crp'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('valor_final_crp') }}</small></strong>
                </span>
            @endif
        </div>
        <div class="form-row" style="margin: 1rem 0rem;">
            <div class="form-group col-md-6" style="margin: 0px; padding-left: 0px;">
                <label for="nombre_tercero">{{ Lang::get('strings.aprobado.nombre_tercero') }}</label>
                <input type="text" class="form-control" name="nombre_tercero" value="{{ $etapas ? old('nombre_tercero') : $data->nombre_tercero }}">
                @if ($errors->has('nombre_tercero'))
                    <span class="text-danger">
                        <strong><small>{{ $errors->first('nombre_tercero') }}</small></strong>
                    </span>
                @endif
            </div>
            <div class="form-group col-md-6" style="margin: 0px; padding-right: 0px;">
                <label for="identificacion_tercero">{{ Lang::get('strings.aprobado.identificacion_tercero') }}</label>
                <input type="text" class="form-control" name="identificacion_tercero" value="{{ $etapas ? old('identificacion_tercero') : $data->identificacion_tercero }}">
                @if ($errors->has('identificacion_tercero'))
                    <span class="text-danger">
                        <strong><small>{{ $errors->first('identificacion_tercero') }}</small></strong>
                    </span>
                @endif
            </div>
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