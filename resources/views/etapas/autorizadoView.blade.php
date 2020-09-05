@extends('layouts.lateralMenu.etapasView')

@section('content')
<div class="card-body">
    <form action="{{ route('save_autorizado') }}" method="post">
        {!! csrf_field() !!} 
        <div class="form-group">
            <label for="exampleControlInput1">{{ Lang::get('strings.autorizado.codigoRegistroSigep') }}</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="codigo_sigep">
                @if(!$etapas)
                    @if($etapa_estado[3]->estado_id == 0)
                    <div class="input-group-prepend">
                        <a class="input-group-text" id="redirect" href="#">{{ Lang::get('strings.autorizado.pendiente') }}</a>
                    </div>
                    @endif
                @endif
            </div>
            @if ($errors->has('codigo_sigep'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('codigo_sigep') }}</small></strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="exampleControlTextarea1">{{ Lang::get('strings.autorizado.descripcion') }}</label>
            <textarea class="form-control" rows="3" name="descripcion"></textarea>
            @if ($errors->has('descripcion'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('descripcion') }}</small></strong>
                </span>
            @endif
            <small class="form-text text-muted">
                {!! Lang::get('strings.notes.autorizado') !!}
            </small>
        </div>
        <div class="float-left"><button type="submit" class="btn btn-primary">{{ Lang::get('strings.general.confirmar') }}</button></div>
    </form>
</div>
@stop