@extends('layouts.app')

@section('general')
<div class="col-5">  
        <div class="info-body">
            <div class="modal-header">
                <h5 class="titulo-header">{{ Lang::get('strings.login.iniciar_sesion') }}</h5>
            </div>

            <div class="card-body">
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('usuario') ? ' has-error' : '' }}">
                        <label for="usuario" class="control-label">{{ Lang::get('strings.login.usuario') }}</label>

                        <input id="usuario" type="string" class="form-control" name="usuario" value="{{ old('usuario') }}" required autofocus>

                        @if ($errors->has('usuario'))
                            <span class="text-danger">
                                <strong><small>{{ $errors->first('usuario') }}</small></strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label">{{ Lang::get('strings.login.password') }}</label>

                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="text-danger">
                                <strong><small>{ $errors->first('password') }}</small></strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                        {{ Lang::get('strings.login.conectar') }}
                        </button>

                        <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ Lang::get('strings.login.olvido_password') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
</div>
@endsection
