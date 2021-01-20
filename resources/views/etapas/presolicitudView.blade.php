@extends('layouts.lateralMenu.etapasView')

@section('content')
<div class="card-body">
    @switch($route)
        @case("index")
            <form action="{{ route('save_presolicitud') }}" method="post" enctype="multipart/form-data"> 
            {!! csrf_field() !!}
            @break
        @case("edit")
            <form action="{{ route('update_presolicitud') }}" method="post" enctype="multipart/form-data"> 
            {!! csrf_field() !!}
            @break
        @default
            @break
    @endswitch
        @if(!$etapas)
        <input type="hidden" name="consecutivo", value="{{ $consecutivo }}">
        @endif
        <div class="form-group">
            <label for="proyecto_id">{{ Lang::get('strings.presolicitud.proyecto') }}</label>
            <select class="form-control" name="proyecto_id">
                <option value="">{{ Lang::get('strings.presolicitud.seleccione_proyecto') }}</option>
            @if($etapas)
                @foreach( $proyecto as $proyecto )
                    <option value="{{ $proyecto->codigo }}" {{old('proyecto_id') == $proyecto->codigo ? 'selected':''}}>{{ $proyecto->nombre }}</option>
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
            <label for="otro_proyecto">{{ Lang::get('strings.notes.otro_proyecto') }}</label>
            <input type="text" class="form-control" name="otro_proyecto" value="{{ $etapas ? old('otro_proyecto') : $data->otro_proyecto}}"> 
            @if ($errors->has('otro_proyecto'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('otro_proyecto') }}</small></strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="transaccion_id">{{ Lang::get('strings.presolicitud.tipo_transaccion') }}</label>
            <div class="input-group mb-3">
                <select class="form-control" name="transaccion_id" id="transaccion_id">
                @if($etapas)
                    @foreach($tipoTransaccion as $transaccion )
                        <option value="{{ $transaccion->id }}" {{old('transaccion_id') == $transaccion->id ? 'selected':''}}>{{ $transaccion->tipo_transaccion }}</option>
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
                    @if($route == "show" && $data->etapa_id == '1')
                    <div class="input-group-prepend">
                        <a class="input-group-text" id="redirect">{{ Lang::get('strings.presolicitud.redireccionar') }}</a>
                    </div>
                    @endif
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="valor">{{ Lang::get('strings.general.valor') }}</label>
            <input type="number" step="any" class="form-control" name="valor" value="{{ $etapas ? old('valor') : $data->valor}}"> 
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
                <input type="date" class="form-control" name="fecha_inicial" placeholder="yyyy-mm-dd" value="{{ $etapas ? old('fecha_inicial') : $data->fecha_inicial }}">
                @if ($errors->has('fecha_inicial'))
                    <span class="text-danger">
                        <strong><small>{{ $errors->first('fecha_inicial') }}</small></strong>
                    </span>
                @endif
            </div>
            <div class="form-group col-md-6" style="margin: 0px;">
                <label for="fecha_final">{{ Lang::get('strings.presolicitud.fecha_final') }}</label>
                <input type="date" class="form-control" name="fecha_final" placeholder="yyyy-mm-dd" value="{{ $etapas ? old('fecha_final') : $data->fecha_final }}">
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
            <textarea class="form-control" name="descripcion" rows="3">{{ $etapas ? old('descripcion') : $data->descripcion}}</textarea>
            @if ($errors->has('descripcion'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('descripcion') }}</small></strong>
                </span>
            @endif
        </div>
        @if($route != "show")
            <div class="form-group">
                <label for="anexos">{{ Lang::get('strings.general.anexos') }}</label>
                <input type="file" class="form-control-file" name="anexos[]" multiple>
                @if ($errors->has('anexos'))
                    <span class="text-danger">
                        <strong><small>{{ $errors->first('anexos') }}</small></strong>
                    </span>
                @endif
                <small class="form-text text-muted">
                    {!! Lang::get('strings.notes.presolicitud') !!}
                </small>
            </div>
        @endif
        @if($files)
            <div class="form-group">
                <label for="anexos_guardados">{{ Lang::get('strings.general.anexos_guardados') }}</label>
                <div>
                    @foreach($files as $file )
                        <a class="nav-link" href="{{route('descargar_documentos','path='.$file)}}" target="_blank">{{ basename($file) }}</a>
                    @endforeach
                </div>
            </div>
        @endif
        @switch($route)
            @case("index")
                <div class="float-left"><button type="submit" class="btn btn-primary">{{ Lang::get('strings.presolicitud.enviar') }}</button></div>
                @break
            @case("edit")
                <div class="float-left"><button type="submit" class="btn btn-primary">{{ Lang::get('strings.general.actualizar') }}</button></div>
                @break
            @default
        @endswitch
    </form>
</div>
@stop