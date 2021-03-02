@extends('layouts.lateralMenu.etapasView')

@section('content')
<div class="card-body">
    @if($estado != 3)
        @switch($route)
            @case("index")
                <form action="{{ route('save_solicitud') }}" method="post" enctype="multipart/form-data"> 
                {!! csrf_field() !!}
                @break
            @case("edit")
                <form action="{{ route('update_solicitud') }}" method="post" enctype="multipart/form-data"> 
                {!! csrf_field() !!}
                @break
            @default
                @break
        @endswitch
    @endif
        <input type="hidden" name="consecutivo", value="{{ $consecutivo }}">
        <div class="form-group">
            <label for="centro_costos_id">{{ Lang::get('strings.solicitud.centro_costos') }}</label>
            <select class="form-control" name="centro_costos_id">
            @if($etapas)
                @foreach( $centro_costos as $centro_costo )
                    <option value="{{ $centro_costo->id }}">{{ $centro_costo->centro_costo }}</option>
                @endforeach
            @else
                @foreach( $centro_costos as $centro_costo )
                    @if( $centro_costo->id == $data->centro_costos_id )
                        <option value="{{ $centro_costo->id }}" selected>{{ $centro_costo->centro_costo }}</option>
                    @else
                        <option value="{{ $centro_costo->id }}">{{ $centro_costo->centro_costo }}</option>
                    @endif
                @endforeach
            @endif
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_conveniencia">{{ Lang::get('strings.solicitud.fecha_conveniencia') }}</label>
            <input type="date" class="form-control" placeholder="yyyy-mm-dd" name="fecha_conveniencia" value="{{ $etapas ? old('fecha_conveniencia') : $data->fecha_conveniencia}}">
            @if ($errors->has('fecha_conveniencia'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('fecha_conveniencia') }}</small></strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="codigo_sigep_id">{{ Lang::get('strings.solicitud.codigo_sigep') }}</label>
            <input type="number" class="form-control" id="codigo_sigep_id" name="codigo_sigep_id" value="{{ $etapas ? old('codigo_sigep_id') : $data->codigo_sigep_id}}">
            @if ($errors->has('codigo_sigep_id'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('codigo_sigep_id') }}</small></strong>
                </span>
            @endif
            <small class="form-text text-muted">
                <strong>{!! Lang::get('strings.notes.codigo_sigep', array('project' => $proyecto['proyecto_id'])) !!}</strong>
            </small>
        </div>
        <div class="form-group">
            <label for="concepto">{{ Lang::get('strings.solicitud.concepto') }}</label>
            <textarea class="form-control" name="concepto" rows="3">{{ $etapas ? old('concepto') : $data->concepto}}</textarea>
            @if ($errors->has('concepto'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('concepto') }}</small></strong>
                </span>
            @endif
        </div>
        <div class="form-row" style="margin: 1rem 0rem;">
            <div class="form-group col-md-6" style="margin: 0px; padding-left: 0px;">
                <label for="nombre_tercero">{{ Lang::get('strings.aprobado.nombre_tercero') }}</label>
                <input type="text" class="form-control" name="nombre_tercero" value="{{ $etapas  ? old('nombre_tercero') : ($data->nombre_tercero == NULL ? old('nombre_tercero') : $data->nombre_tercero) }}">
                @if ($errors->has('nombre_tercero'))
                    <span class="text-danger">
                        <strong><small>{{ $errors->first('nombre_tercero') }}</small></strong>
                    </span>
                @endif
            </div>
            <div class="form-group col-md-6" style="margin: 0px; padding-right: 0px;">
                <label for="identificacion_tercero">{{ Lang::get('strings.aprobado.identificacion_tercero') }}</label>
                <input type="number" class="form-control" name="identificacion_tercero" value="{{ $etapas  ? old('identificacion_tercero') : ($data->identificacion_tercero == NULL ? old('identificacion_tercero') : $data->identificacion_tercero) }}">
                @if ($errors->has('identificacion_tercero'))
                    <span class="text-danger">
                        <strong><small>{{ $errors->first('identificacion_tercero') }}</small></strong>
                    </span>
                @endif
            </div>
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
                    <strong>{!! Lang::get('strings.notes.solicitud') !!}</strong>
                </small>
            </div>
        @endif
        @if($files)
            <div class="form-group">
                <label for="anexos_guardados">{{ Lang::get('strings.general.anexos_guardados') }}</label>
                @foreach($files as $file)
                    <div class="input-group mb-3" id="documento_button">
                        @if($route != "show")
                            <button type="button" class="btn btn-light fas fa-trash-alt"></button>
                        @endif
                        <a class="nav-link" href="{{route('descargar_documentos','path='.$file)}}" target="_blank">{{ basename($file) }}</a>
                    </div>
                @endforeach
            </div>
        @endif
        @if($estado != 3)
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
        @endif
    </form>
</div>

<div class="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span id="titulo"></span>{{ Lang::get('strings.solicitud.codigo_sigep') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">{{ Lang::get('strings.solicitud.codigo_sigep') }}</th>
                            <th scope="col">{{ Lang::get('strings.solicitud.rubro_egreso') }}</th>
                            <th scope="col">{{ Lang::get('strings.solicitud.centro_costos') }}</th>
                            <th scope="col">{{ Lang::get('strings.general.presupuesto_inicial') }}</th>
                            <th scope="col">{{ Lang::get('strings.general.egreso') }}</th>
                            <th scope="col">{{ Lang::get('strings.etapas.reserva') }}</th>
                            <th scope="col">{{ Lang::get('strings.general.disponible') }}</th>
                        </tr>
                    </thead>
                    <tbody id="table_sigep">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
    <script type="module" src="{{ asset('js/etapas.js') }}" crossorigin="anonymous"></script>
    <script type="module" src="{{ asset('js/solicitud.js') }}" crossorigin="anonymous"></script>
@stop