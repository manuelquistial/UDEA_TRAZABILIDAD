@extends('layouts.app')

@section('etapasView')
    @if ($etapa_id > 0)
    <ul class="nav flex-column nav-pills" id="stages-menu" aria-orientation="vertical">
        @foreach($etapa_estado as $etapa)
        <li class="nav-item lateral-nav-item">
            @if($etapa->endpoint == "presolicitud")
                @switch($etapa->estado_id)
                    @case(0)
                        <a class="nav-link lateral-nav-link" href="{{ route('show_'.$etapa->endpoint, $consecutivo) }}">{{ $etapa->etapa }}</a>
                        @break
                    @case(1)
                        <a class="lateral-inprogress nav-link lateral-nav-link" href="{{ route('show_'.$etapa->endpoint, $consecutivo) }}">{{ $etapa->etapa }}</a>
                        @break
                    @case(2)
                        <a class="lateral-done nav-link lateral-nav-link" href="{{ route('show_'.$etapa->endpoint, $consecutivo) }}">{{ $etapa->etapa }}</a>
                        @break
                    @default
                        <a class="lateral-cancel nav-link lateral-nav-link" href="{{ route('show_'.$etapa->endpoint, $consecutivo) }}">{{ $etapa->etapa }}</a>
                @endswitch
            @else
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
            @endif
        </li>
        @endforeach
    </ul>
    @endif
@stop

@section('general')
    <div class="col-8">  
        <div class="info-body">
            <div class="modal-header">
                @if($etapa_id > 0)
                <div class="col-6 conf-header">
                    <h5 id="title-etapa">{{ $etapa_estado[$etapa_id-1]->etapa }}</h5>
                </div>
                <div class="col-6 text-right conf-header">
                    <p id="title-etapa-right">{{ Lang::get('strings.general.consecutivo') }}: {{ $consecutivo }}</p>
                </div>
                @else
                <div class="col-6 conf-header">
                    <h5>{{ Lang::get('strings.etapas.presolicitud') }}</h5>
                </div>
                @endif
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
                    
                