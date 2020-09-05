@extends('layouts.lateralMenu.etapasView')

@section('content')
<div class="card-body">
    <div class="form-group">
        <label for="fecha_envio_documento">{{ Lang::get('strings.aprobado.fecha_envio_documento') }}</label>
        <div class="input-group mb-3">
            <input type="date" class="form-control" name="fecha_envio_documento">
            <div class="input-group-prepend">
                <a class="input-group-text" id="redirect" href="#">{{ Lang::get('strings.general.guardar') }}</a>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="fecha_envio_decanatura">{{ Lang::get('strings.aprobado.fecha_envio_decanatura') }}</label>
        <div class="input-group mb-3">
            <input type="date" class="form-control" name="fecha_envio_decanatura">
            <div class="input-group-prepend">
                <a class="input-group-text" id="redirect" href="#">{{ Lang::get('strings.general.guardar') }}</a>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="fecha_envio_presupuestos">{{ Lang::get('strings.aprobado.fecha_envio_presupuestos') }}</label>
        <div class="input-group mb-3">
            <input type="date" class="form-control" name="fecha_envio_presupuestos">
            <div class="input-group-prepend">
                <a class="input-group-text" id="redirect" href="#">{{ Lang::get('strings.general.guardar') }}</a>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="solpe">{{ Lang::get('strings.aprobado.solpe') }}</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="solpe"> 
            <div class="input-group-prepend">
                <a class="input-group-text" id="redirect" href="#">{{ Lang::get('strings.general.guardar') }}</a>
            </div>
        </div>
    </div>
    <form action="{{ route('save_aprobado') }}" method="post">
        {!! csrf_field() !!} 
        <div class="form-group">
            <label for="crp">{{ Lang::get('strings.general.crp') }}</label>
            <input type="text" class="form-control" name="crp">
        </div>
        <div class="form-group">
            <label for="fecha_crp_pedido">{{ Lang::get('strings.aprobado.fecha_crp_pedido') }}</label>
            <input type="date" class="form-control" name="fecha_crp_pedido">
        </div>
        <div class="form-group">
            <label for="valor_final_crp">{{ Lang::get('strings.aprobado.valor_final_crp') }}</label>
            <input type="text" class="form-control" name="valor_final_crp">
        </div>
        <div class="form-row" style="margin: 1rem 0rem;">
            <div class="form-group col-md-6" style="margin: 0px; padding-left: 0px;">
                <label for="nombre_tercero">{{ Lang::get('strings.aprobado.nombre_tercero') }}</label>
                <input type="text" class="form-control" name="nombre_tercero">
            </div>
            <div class="form-group col-md-6" style="margin: 0px; padding-right: 0px;">
                <label for="identificacion_tercero">{{ Lang::get('strings.aprobado.identificacion_tercero') }}</label>
                <input type="text" class="form-control" name="identificacion_tercero">
            </div>
        </div>
        <div class="float-left"><button type="submit" class="btn btn-primary">{{ Lang::get('strings.general.confirmar') }}</button></div>
    </form>
</div>
@stop