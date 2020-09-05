@extends('layouts.app')

@section('etapasView')
    @if (!$etapas)
    <ul class="nav flex-column nav-pills" id="stages-menu" aria-orientation="vertical">
        @foreach($etapa_estado as $etapa)
        <li class="nav-item lateral-nav-item">
            @switch($etapa->estado_id)
                @case(0)
                    <a class="nav-link lateral-nav-link" href="{{ route('edit_'.$etapa->endpoint, $consecutivo) }}">{{ $etapa->etapa }}</a>
                    @break
                @case(1)
                    <a class="lateral-inprogress nav-link lateral-nav-link" href="{{ route('edit_'.$etapa->endpoint, $consecutivo) }}">{{ $etapa->etapa }}</a>
                    @break
                @case(2)
                    <a class="lateral-done nav-link lateral-nav-link" href="{{ route('edit_'.$etapa->endpoint, $consecutivo) }}">{{ $etapa->etapa }}</a>
                    @break
                @default
                    <a class="lateral-cancel nav-link lateral-nav-link" href="{{ route('edit_'.$etapa->endpoint, $consecutivo) }}">{{ $etapa->etapa }}</a>
            @endswitch
        </li>
        @endforeach
    </ul>
    @endif
@stop

@section('general')
    <div class="col-8">  
        <div class="info-body">
            <div class="modal-header">
                <div class="col-6 conf-header">
                @if(!$etapas)
                    <h5>{{ $etapa_estado[$etapa_id-1]->etapa }}</h5>
                @else
                    <h5>{{ Lang::get('strings.etapas.presolicitud') }}</h5>
                @endif
                </div>
            </div>
            @yield('content')
        </div>
    </div>
@stop

@section('modal')
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog" role="document" id="modal-content">
        </div>
    </div>
@stop

@section('scripts')
    <script type="module" src="{{ asset('js/etapas.js') }}" crossorigin="anonymous"></script>
@stop
                    
                