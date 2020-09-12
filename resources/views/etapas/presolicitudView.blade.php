@extends('layouts.lateralMenu.etapasView')

@section('content')
@if(session('status') == "ok")
<div class="status alert alert-success fade show" role="alert">
{{ Lang::get('strings.etapas.presolicitud') }} {{ Lang::get('strings.general.ok') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@elseif(session('status') == "error")
<div class="status alert alert-danger fade show" role="alert">
{{ Lang::get('strings.etapas.presolicitud') }} {{ Lang::get('strings.general.error') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<div class="card-body">
    @if($etapa_id == 0)
        <form action="{{ route('save_presolicitud') }}" method="POST">
    @else
        <form action="{{ route('update_presolicitud', $data->consecutivo) }}" method="POST">
    @endif
    {!! csrf_field() !!}
        <div class="form-group">
            <label for="proyecto_id">{{ Lang::get('strings.presolicitud.proyecto') }}</label>
            <select class="form-control" name="proyecto_id">
            @if($etapa)
                @foreach( $proyecto as $proyecto )
                    <option value="{{ $proyecto->codigo }}">{{ $proyecto->nombre }}</option>
                @endforeach
            @else
                @foreach( $proyecto as $proyecto )
                    @if( $proyecto->codigo == $data->proyecto_id )
                        <option value="{{ $proyecto->codigo }}" selected>{{ $proyecto->nombre }}</option>
                    @else
                        <option value="{{ $proyecto->codigo }}">{{ $proyecto->nombre }}</option>
                    @endif
                @endforeach
            @endif
            </select>
        </div>
        <div class="form-group">
            <label for="transaccion_id">{{ Lang::get('strings.presolicitud.tipo_transaccion') }}</label>
            <div class="input-group mb-3">
                <select class="form-control" name="transaccion_id" id="transaccion_id">
                @if($etapa)
                    @foreach($tipoTransaccion as $transaccion )
                        <option value="{{ $transaccion->id }}">{{ $transaccion->tipo_transaccion }}</option>
                    @endforeach
                @else
                    @foreach( $tipoTransaccion as $transaccion )
                        @if( $transaccion->id == $data->transaccion_id )
                            <option value="{{ $transaccion->id }}" selected>{{ $transaccion->tipo_transaccion }}</option>
                        @else
                            <option value="{{ $transaccion->id }}">{{ $transaccion->tipo_transaccion }}</option>
                        @endif
                    @endforeach
                @endif
                </select>
                @if(!$etapa)
                    @if($etapa_estado[0]->estado_id == 1)
                    <div class="input-group-prepend">
                        <a class="input-group-text" id="redirect" href="#">{{ Lang::get('strings.presolicitud.redireccionar') }}</a>
                    </div>
                    @endif
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="valor">{{ Lang::get('strings.general.valor') }}</label>
            <input type="text" class="form-control" name="valor" value="{{ $etapa ? old('valor') : $data->valor}}"> 
            @if ($errors->has('valor'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('valor') }}</small></strong>
                </span>
            @endif
            <small class="form-text text-muted">
                {!! Lang::get('strings.notes.valor') !!}
            </small>
        </div>
        <div class="form-row" style="margin: 1rem 0rem;">
            <div class="form-group col-md-6" style="margin: 0px;">
                <label for="fecha_inicial">{{ Lang::get('strings.presolicitud.fecha_inicial') }}</label>
                <input type="date" class="form-control" name="fecha_inicial" value="{{ $etapa ? old('fecha_inicial') : $data->fecha_inicial}}">
                @if ($errors->has('fecha_inicial'))
                    <span class="text-danger">
                        <strong><small>{{ $errors->first('fecha_inicial') }}</small></strong>
                    </span>
                @endif
            </div>
            <div class="form-group col-md-6" style="margin: 0px;">
                <label for="fecha_final">{{ Lang::get('strings.presolicitud.fecha_final') }}</label>
                <input type="date" class="form-control" name="fecha_final" value="{{ $etapa ? old('fecha_final') : $data->fecha_final}}">
                @if ($errors->has('fecha_final'))
                    <span class="text-danger">
                        <strong><small>{{ $errors->first('fecha_final') }}</small></strong>
                    </span>
                @endif
            </div>
            <small class="form-text text-muted">
                {{ Lang::get('strings.notes.fecha') }}
            </small>
        </div>
        <div class="form-group">
            <label for="descripcion">{{ Lang::get('strings.presolicitud.descripcion') }}</label>
            <textarea class="form-control" name="descripcion" rows="3">{{ $etapa ? old('descripcion') : $data->descripcion}}</textarea>
            @if ($errors->has('descripcion'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('descripcion') }}</small></strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="exampleInputFile">{{ Lang::get('strings.general.anexos') }}</label>
            <input type="file" class="form-control-file">
            <small class="form-text text-muted">
                {!! Lang::get('strings.notes.presolicitud') !!}
            </small>
        </div>
        @if ($etapa_id == 0)
            <div class="float-left"><button type="submit" class="btn btn-primary">{{ Lang::get('strings.presolicitud.enviar') }}</button></div>
        @else
            <div class="float-left"><button type="submit" class="btn btn-primary">{{ Lang::get('strings.general.confirmar') }}</button></div>
        @endif
    </form>
</div>
@stop