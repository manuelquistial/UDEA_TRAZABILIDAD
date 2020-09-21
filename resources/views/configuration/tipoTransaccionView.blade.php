@extends('layouts.lateralMenu.configuracionView')

@section('content')
<?php
    $titulo = e(Lang::get('strings.configuracion.modal.'.$opcion.'.titulo'));
    $buscar = e(Lang::get('strings.configuracion.modal.'.$opcion.'.placeholder'));
    $deshabilitar = e(Lang::get('strings.configuracion.modal.'.$opcion.'.deshabilitar'));
    $escribir_item = e(Lang::get('strings.configuracion.modal.'.$opcion.'.escribir_item'));
?>
<div class="modal-header">
    <div class="col-6 conf-header">
        <h5>{{ Lang::get('strings.configuracion.tipos_transaccion') }}</h5>
    </div>
    <div class="col-6 text-right conf-header">
        <a class="info-header"  id="nuevo_item">{{ Lang::get('strings.configuracion.nuevo_tipo_transaccion') }}</a>
    </div>
</div>
<div class="card-body">
    <div class="form-group">
        <input type="text" class="form-control" id="buscar_item" placeholder="{{ $buscar }}">
    </div>
    <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th id="one_column">{{ Lang::get('strings.configuracion.tipo_transaccion') }}</th>
                    <th>{{ Lang::get('strings.configuracion.sap') }}</th>
                    <th>{{ Lang::get('strings.configuracion.habilitado') }}</th>
                </tr>
            </thead>
            <tbody id="items_tabla">
                @foreach($tiposTransaccion as $tipo_transaccion)
                <tr>
                    <td><a href="#{{ $tipo_transaccion->id }}">{{ $tipo_transaccion->tipo_transaccion }}</a></td>
                    <td>
                        <label class="switch">
                            <input type="checkbox" name="sap" value="{{ $tipo_transaccion->id }}" >
                            <span class="slider round"></span>
                        </label>
                    </td>
                    <td>
                        <label class="switch">
                            <input type="checkbox" name="habilitar" value="{{ $tipo_transaccion->id }}" >
                            <span class="slider round"></span>
                        </label>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation tipo transaccion" id="paginacion">
            {{ $tiposTransaccion->links() }}
        </nav>
    </div>
</div>
@stop

@section('scripts')
    <script type="module" src="{{ asset('js/configuracion.js') }}" crossorigin="anonymous"></script>
@stop