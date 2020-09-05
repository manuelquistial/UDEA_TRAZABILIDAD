@extends('layouts.lateralMenu.etapasView')

@section('content')
<div class="card-body">
    @if($etapas)
        <form action="{{ route('save_presolicitud') }}" method="POST">
    @else
        <form action="{{ route('update_presolicitud', $data->consecutivo) }}" method="POST">
    @endif
    {!! csrf_field() !!}
        <div class="form-group">
            <label for="proyecto_id">{{ Lang::get('strings.presolicitud.proyecto') }}</label>
            <select class="form-control" name="proyecto_id">
            @if($etapas)
                @foreach( $proyecto as $proyecto )
                    <option value="{{ $proyecto->id }}">{{ $proyecto->nombre }}</option>
                @endforeach
            @else
                @foreach( $proyecto as $proyecto )
                    @if( $proyecto->id == $data->proyecto_id )
                        <option value="{{ $proyecto->id }}" selected>{{ $proyecto->nombre }}</option>
                    @else
                        <option value="{{ $proyecto->id }}">{{ $proyecto->nombre }}</option>
                    @endif
                @endforeach
            @endif
            </select>
        </div>
        <div class="form-group">
            <label for="transaccion_id">{{ Lang::get('strings.presolicitud.tipo_transaccion') }}</label>
            <div class="input-group mb-3">
                <select class="form-control" name="transaccion_id" id="transaccion_id">
                @if($etapas)
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
                @if(!$etapas)
                    @if($etapa_estado[0]->estado_id == 0)
                    <div class="input-group-prepend">
                        <a class="input-group-text" id="redirect" href="#">{{ Lang::get('strings.presolicitud.redireccionar') }}</a>
                    </div>
                    @endif
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="valor">{{ Lang::get('strings.general.valor') }}</label>
            <input type="text" class="form-control" name="valor" {{ $etapas ? '' : 'value='.$data->valor }}> 
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
                <input type="date" class="form-control" name="fecha_inicial" {{ $etapas ? '' : 'value='.$data->fecha_inicial }}>
                @if ($errors->has('fecha_inicial'))
                    <span class="text-danger">
                        <strong><small>{{ $errors->first('fecha_inicial') }}</small></strong>
                    </span>
                @endif
            </div>
            <div class="form-group col-md-6" style="margin: 0px;">
                <label for="fecha_final">{{ Lang::get('strings.presolicitud.fecha_final') }}</label>
                <input type="date" class="form-control" name="fecha_final" {{ $etapas ? '' : 'value='.$data->fecha_final }}>
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
            <textarea class="form-control" name="descripcion" rows="3">{{ $etapas ? '' : $data->descripcion }}</textarea>
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
        @if ($etapas)
            <div class="float-left"><button type="submit" class="btn btn-primary">{{ Lang::get('strings.presolicitud.enviar') }}</button></div>
        @else
            <div class="float-left"><button type="submit" class="btn btn-primary">{{ Lang::get('strings.presolicitud.tramitar') }}</button></div>
        @endif
    </form>
</div>
@stop