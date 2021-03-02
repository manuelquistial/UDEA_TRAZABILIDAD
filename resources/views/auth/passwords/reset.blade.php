@extends('layouts.app')

@section('general')
<div class="col-5">  
    <div class="info-body">
        <div class="modal-header">
            <h5 class="titulo-header">{{ Lang::get('strings.login.change_password') }}</h5>
        </div>

        <div class="card-body">
            <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">{{ Lang::get('strings.usuario.email') }}</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="text-danger">
                            <strong><small>{{ $errors->first('email') }}</small></strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label">{{ Lang::get('strings.login.password') }}</label>
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="text-danger">
                            <strong><small>{{ $errors->first('password') }}</small></strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm" class="control-label">{{ Lang::get('strings.login.confirm_password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger">
                            <strong><small>{{ $errors->first('password_confirmation') }}</small></strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        {{ Lang::get('strings.login.change_password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
