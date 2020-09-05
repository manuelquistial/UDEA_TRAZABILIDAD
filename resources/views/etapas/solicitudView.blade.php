@extends('layouts.lateralMenu.etapasView')

@section('content')
<div class="card-body">
    <form action="{{ route('save_solicitud') }}" method="post"> 
        <div class="form-group">
            <label for="centro_costos_id">{{ Lang::get('strings.solicitud.centro_costos') }}</label>
            <select class="form-control" name="centro_costos_id">
            @if($etapas)
                @foreach( $centro_costo as $centro_costo )
                    <option value="{{ $centro_costo->id }}">{{ $centro_costo->centro_costo }}</option>
                @endforeach
            @else
                @foreach( $centro_costo as $centro_costo )
                    @if( $centro_costo->id == $data->centro_costo_id )
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
            <input type="date" class="form-control" name="fecha_conveniencia">
        </div>
        <div class="form-group">
            <label for="codigo_sigep_id">{{ Lang::get('strings.solicitud.codigo_sigep') }}</label>
            <select class="form-control" name="codigo_sigep_id">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            </select>
        </div>
        <div class="form-group">
            <label for="concepto">{{ Lang::get('strings.solicitud.concepto') }}</label>
            <textarea class="form-control" name="concepto" rows="3"></textarea>
            @if ($errors->has('concepto'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('concepto') }}</small></strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="anexos">{{ Lang::get('strings.general.anexos') }}</label>
            <input type="file" class="form-control-file" name="anexos"> 
            <small class="form-text text-muted">
            {{ Lang::get('strings.notes.solicitud') }}
            </small>
        </div>
        <div class="float-left"><button type="submit" class="btn btn-primary">{{ Lang::get('strings.general.confirmar') }}</button></div>
    </form>
</div>
@stop