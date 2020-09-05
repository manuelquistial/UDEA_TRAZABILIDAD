@extends('layouts.app')

@section('general')
<div class="col-5">  
        <div class="info-body">
            <div class="modal-header">
                <h5 class="titulo-h">{{ Lang::get('strings.login.iniciar_sesion') }}</h5>
            </div>

            <div class="card-body">
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('cedula') ? ' has-error' : '' }}">
                        <label for="usuario" class="control-label">{{ Lang::get('strings.login.usuario') }}</label>

                        <input id="usuario" type="string" class="form-control" name="cedula" value="{{ old('cedula') }}" required autofocus>

                        @if ($errors->has('cedula'))
                            <span class="help-block">
                                <strong>{{ $errors->first('cedula') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label">{{ Lang::get('strings.login.password') }}</label>

                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
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
