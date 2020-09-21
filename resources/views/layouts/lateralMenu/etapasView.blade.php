@extends('layouts.app')

@section('etapasView')
    @if($etapa_id > 0)
    <ul class="nav flex-column nav-pills" id="etapas-menu" aria-orientation="vertical">
        @foreach($etapa_estado as $etapa)
        <li class="nav-item lateral-nav-item">
            <a class="nav-link lateral-nav-link" id="{{ $etapa->endpoint }}" href="">{{ $etapa->etapa }}</a>
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
                    @if(session('status'))
                        <div class="status alert alert-success fade show" role="alert">
                        {{ $etapa_estado[$etapa_id-1]->etapa }} {{ Lang::get('strings.general.ok') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                    @endif
                <div class="col-6 conf-header">
                    <h5 id="title-etapa">{{ $etapa_estado[$etapa_id-1]->etapa }}</h5>
                </div>
                <div class="col-6 text-right conf-header">
                    <a id="consecutivo-cambio-estado">{{ Lang::get('strings.general.consecutivo') }}: {{ $consecutivo }}</a>
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

    @if($etapa_id > 0)
    <div class="modal fade" id="cambio_estado" tabindex="-1" aria-labelledby="cambio_estado" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ Lang::get('strings.cambio_estado.titulo') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Etapas</th>
                    <th scope="col">Confirmar</th>
                    </tr>
                </thead>
                <tbody id="etapas-confirmar-declinar">
                    @foreach($etapa_estado as $etapa)
                    <tr>
                        <td>
                            <label class="form-check-label" for="{{ $etapa->endpoint }}_checkbox">
                                {{ $etapa->etapa }}
                            </label>
                        </td>
                        <td>
                            <input class="form-check-input" type="checkbox" value="" id="{{ $etapa->endpoint }}_checkbox">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-danger" id="declinar">{{ Lang::get('strings.cambio_estado.declinar') }}</a>
            </div>
            </div>
        </div>
    </div>
    @endif
@stop

@section('scripts')
    <script type="module" src="{{ asset('js/etapas.js') }}" crossorigin="anonymous"></script>
@stop
                    
                