@extends('layouts.app')

@section('configuracionView')
    @if($opcion != "perfil")
    <ul class="nav flex-column nav-pills" aria-orientation="vertical">
        @foreach(Lang::get('strings.configuracion.menu_lateral') as $configuracion)
        <li class="nav-item lateral-nav-item">
            <a class="nav-link lateral-nav-link" {{ $opcion == $configuracion[0] ? "id=active_opcion" : '' }} href="{{ route($configuracion[0]) }}">{{ $configuracion[1] }}</a>
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

@section('modal')
    @if($opcion != "perfil" && $opcion != "nuevo_usuario")
    <div class="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="titulo"></span> {{ $titulo }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal_content">
                    <div class="form-group">
                        <div class="input-group" id="input_group">
                            <input type="hidden" id="item_id" name="item_id">
                            <input type="text" class="form-control" id="item_value" placeholder="{{ $escribir_item }}">
                        </div>
                    </div>
                    @if($opcion == "tipos_transaccion")
                    <div class="form-group" id="sap-switch">
                        <label class="switch">
                            <input type="checkbox" name="sap" id="sap">
                            <span class="slider round"></span>
                        </label>
                        <label id="label-sap" for="sap">Requiere codigo de SAP</label>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-primary" id="modificar" ></a>
                </div>
            </div>
        </div>
    </div>
    @endif
@stop