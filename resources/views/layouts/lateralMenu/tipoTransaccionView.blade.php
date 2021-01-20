@extends('layouts.app')

@section('tipoTransaccionView')
    @if($consulta)  
    <ul class="nav flex-column nav-pills" aria-orientation="vertical">
        @if(Auth::user()->hasOneEtapa(3))
            <li class="nav-item lateral-nav-item">
                <a class="nav-link lateral-nav-link" href="{{ route('show_sap') }}">{{ Lang::get('strings.configuracion.sap') }}</a>
            </li>
        @elseif(Auth::user()->hasOneEtapa(4))
            <li class="nav-item lateral-nav-item">
                <a class="nav-link lateral-nav-link" href="{{ route('show_sigep') }}">{{ Lang::get('strings.configuracion.sigep') }}</a>
            </li>
        @endif
        @foreach ($tipoTransaccion as $transaccion)
        <li class="nav-item lateral-nav-item">
            <a class="nav-link lateral-nav-link" href="{{ route('show_gestores',$transaccion->id) }}">{{ $transaccion->tipo_transaccion }}</a>
        </li>
        @endforeach
    </ul>
    @endif
@stop

@section('general')
    <div class="col-8">  
        <div class="info-body">
            @yield('content')
        </div>
    </div>
@stop