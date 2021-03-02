@extends('layouts.app')

@section('etapasView')
    @if($etapa_id > 0)
        <ul class="nav flex-column nav-pills lateral-column" id="etapas-menu" aria-orientation="vertical">
            @foreach($etapa_estado as $etapa)
                <li class="nav-item lateral-nav-item">
                    <a class="nav-link lateral-nav-link" id="{{ $etapa->endpoint }}" href="">{{ $etapa->etapa }}</a>
                </li>
            @endforeach
        </ul>
    @endif
@stop

@section('general')
    <div class="col-md-8">  
        <div class="info-body">
            <div class="modal-header">
                @if($etapa_id > 0)
                    @if(session('status'))
                        <div class="status alert alert-success fade show" id="status" role="alert">
                            {{ $etapa_estado[$etapa_id-1]->etapa }} {{ Lang::get('strings.general.guardada') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="col-6 conf-header">
                        <h5 id="title-etapa">{{ $etapa_estado[$etapa_id-1]->etapa }}</h5>
                    </div>
                    <div class="col-6 text-right conf-header">
                        <a class="actual-cambio-estado" id="cambio-estado">{{ Lang::get('strings.general.consecutivo') }}: {{ $consecutivo }}</a>
                        <h6 style="margin: 0px;font-size: 12px;">{{ $usuario_nombre->nombre_apellido }}</h6>
                    </div>
                @else
                    @if(session('status'))
                        <div class="status alert alert-success fade show" id="status" role="alert">
                            {{ Lang::get('strings.etapas.presolicitud') }} <strong>{{ session('consecutivo') }}</strong> {{ $route == 'edit' ? Lang::get('strings.general.guardada') : Lang::get('strings.general.generada')  }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                <div class="col-6 conf-header">
                    <h5>{{ Lang::get('strings.etapas.presolicitud') }}</h5>
                </div>
                    @if($route == 'edit')
                        <div class="col-6 text-right conf-header">
                            <p class="actual-cambio-estado">{{ Lang::get('strings.general.consecutivo') }}: {{ $consecutivo }}</p>
                        </div>
                    @endif
                @endif
            </div>
            @yield('content')
        </div>
    </div>
@stop

@section('modal')
    @if((($etapa_id == 0) | ($etapa_id == 1) || ($etapa_id == 2) || ($etapa_id == 7)) & ($route != "index"))
    <div class="modal" id="modal_documento" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar documento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal_content">
                    <p class="text-justify" style="margin: 0px">¿Desea eliminar este archivo de forma permanente?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="aceptar">Aceptar</button>
                    <button type="button" class="btn btn-danger" id="cancelar">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    @endif

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
                        <th scope="col">{{ Lang::get('strings.general.etapas') }}</th>
                        <th scope="col">{{ Lang::get('strings.general.confirmar') }}</th>
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
                    
                