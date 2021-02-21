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
        <h5>{{ Lang::get('strings.configuracion.usuarios') }}</h5>
    </div>
    <div class="col-6 text-right conf-header">
        <a class="info-header" href="{{route('usuario')}}">{{ Lang::get('strings.configuracion.nuevo_usuario') }}</a>
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
                    <th>{{ Lang::get('strings.usuario.nombre') }}</th>
                    <th>{{ Lang::get('strings.configuracion.habilitado') }}</th>
                </tr>
            </thead>
            <tbody id="items_tabla">
                @foreach($usuarios as $usuario)
                <tr>
                    <td><a class="links" href="{{ route('edit_usuario', $usuario->id) }}">{{ $usuario->nombre_apellido }}</a></td>
                    <td>
                        <label class="switch">
                            <input type="checkbox" name="habilitar" value="{{ $usuario->id }}" {{ $usuario->estado_id == 4 ? 'checked' : '' }}>
                            <span class="slider round"></span>
                        </label>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation usuarios" id="paginacion">
            {{ $usuarios->links() }}
        </nav>
    </div>
</div>
@stop

@section('scripts')
    <script type="module" src="{{ asset('js/configuracion.js') }}" crossorigin="anonymous"></script>
@stop