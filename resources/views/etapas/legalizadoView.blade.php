@extends('layouts.lateralMenu.etapasView')

@section('content')
<div class="card-body">
    <div class="info-body">
        <div class="form-group">
            <h6>{{ Lang::get('strings.legalizado.crp') }}</h6>
            <p></p>
        </div>
        <div class="form-group">
            <h6>{{ Lang::get('strings.legalizado.valor') }}</h6>
            <p></p>
        </div>
        <form action="{{ route('save_legalizado') }}" method="post">
            {!! csrf_field() !!} 
            <div class="form-group">
                <label for="reintegro">{{ Lang::get('strings.legalizado.reintegro') }}</label>
                <input type="text" class="form-control" name="reintegro">
                @if ($errors->has('reintegro'))
                    <span class="text-danger">
                        <strong><small>{{ $errors->first('reintegro') }}</small></strong>
                    </span>
                @endif
            </div>
            <div class="float-left"><button type="submit" class="btn btn-primary">{{ Lang::get('strings.general.confirmar') }}</button></div>
        </form>
    </div>
</div>
@stop