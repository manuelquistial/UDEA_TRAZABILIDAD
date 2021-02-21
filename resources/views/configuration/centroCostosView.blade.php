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
        <h5>{{ Lang::get('strings.configuracion.centro_costos') }}</h5>
    </div>
    <div class="col-6 text-right conf-header">
        <a class="info-header links"  id="nuevo_item">{{ Lang::get('strings.configuracion.nuevo_centro_costo') }}</a>
    </div>
</div>
<div class="card-body">
    <div class="input-group">
        <input type="text" class="form-control" id="buscar_item" placeholder="{{ $buscar }}">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="buscar_button">{{ Lang::get('strings.configuracion.buscar') }}</button>
        </div>
    </div>
    <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th id="one_column">{{ Lang::get('strings.configuracion.centro_costos') }}</th>
                    <th>{{ Lang::get('strings.configuracion.habilitado') }}</th>
                </tr>
            </thead>
            <tbody id="items_tabla">
                @foreach($centro_costos as $centro_costo)
                <tr>
                    <td class="links" data-id="{{ $centro_costo->id }}">{{ $centro_costo->centro_costo }}</td>
                    <td>
                        <label class="switch">
                            <input type="checkbox" name="habilitar" value="{{ $centro_costo->id }}" {{ $centro_costo->estado_id == '4' ? 'checked' : '' }}>
                            <span class="slider round"></span>
                        </label>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation tipo transaccion" id="paginacion">
            {{ $centro_costos->links() }}
        </nav>
    </div>
</div>
@stop

@section('scripts')
    @if ($general == 2)
        <script type="module" src="{{ asset('js/configuracion.js') }}" crossorigin="anonymous"></script>
    @endif
@stop