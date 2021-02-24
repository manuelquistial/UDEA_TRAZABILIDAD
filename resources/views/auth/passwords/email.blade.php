@extends('layouts.app')

@section('general')
<div class="col-5">  
    <div class="info-body">
        <div class="modal-header">
            <h5 class="titulo-header">{{ Lang::get('strings.login.email_password') }}</h5>
        </div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">{{ Lang::get('strings.usuario.email') }}</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="text-danger">
                            <strong><small>{{ $errors->first('email') }}</small></strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        {{ Lang::get('strings.login.link_password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
