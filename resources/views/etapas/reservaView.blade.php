@extends('layouts.lateralMenu.etapasView')

@section('content')
<div class="card-body">
    <div class="form-group">
        <label for="crp">{{ Lang::get('strings.general.crp') }}</label>
        <input type="text" class="form-control" name="crp" value="{{ isset($crp['crp']) ? $crp['crp'] : '' }}" disabled>
    </div>

    <div class="form-group">
        <label for="saldo">{{ Lang::get('strings.reserva.saldo') }}</label>
        @if(\App::environment() != 'production')
            <input type="text" class="form-control" name="saldo" value="{{ isset($reserva->reserva) ? $reserva->reserva : '' }}" disabled>
        @else
            <?php $fmt = numfmt_create('de_DE', NumberFormatter::CURRENCY)?>
            <input type="text" class="form-control" name="saldo" value="{{ isset($reserva->reserva)  ? str_replace(' €','',numfmt_format_currency($fmt, $reserva->reserva ,"EUR")) : '' }}" disabled>
        @endif
    </div>

    @switch($route)
        @case("index")
            <form action="{{ route('save_reserva') }}" method="post" enctype="multipart/form-data"> 
            {!! csrf_field() !!}
            @break
        @case("edit")
            <form action="{{ route('update_reserva') }}" method="post" enctype="multipart/form-data"> 
            {!! csrf_field() !!}
            @break
        @default
            @break
    @endswitch  
        <input type="hidden" name="consecutivo" value="{{ $consecutivo }}">
        <div class="form-group">
            <label for="num_oficio">{{ Lang::get('strings.reserva.num_oficio') }}</label>
            <input type="number" class="form-control" name="num_oficio" value="{{ $etapas ? old('num_oficio') : $data->num_oficio}}">
            @if ($errors->has('num_oficio'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('num_oficio') }}</small></strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="fecha_cancelacion">{{ Lang::get('strings.reserva.fecha_cancelacion') }}</label>
            <input type="date" class="form-control" name="fecha_cancelacion" placeholder="yyyy-mm-dd" value="{{ $etapas ? old('fecha_cancelacion') : $data->fecha_cancelacion}}">
            @if ($errors->has('fecha_cancelacion'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('fecha_cancelacion') }}</small></strong>
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
                    {!! Lang::get('strings.notes.reserva') !!}
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