@extends('layouts.lateralMenu.tipoTransaccionView')

@section('content')
<div class="modal-header">
    <div class="col-6 conf-header">
        <h5>{{ Lang::get('strings.menu_superior.correos') }}</h5>
    </div>
    <div class="col-6 text-right conf-header">
        <button type="button" class="btn btn-primary" id="enviar_correos">{{ Lang::get('strings.correos.enviar_correos') }}</button>
    </div>
</div>
<div class="card-body">
    <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>{{ Lang::get('strings.general.consecutivo') }}</th>
                    <th>{{ Lang::get('strings.correos.codigo') }}</th>
                    <th>{{ Lang::get('strings.correos.tipo') }}</th>
                    <th>{{ Lang::get('strings.correos.enviado') }}</th>
                </tr>
            </thead>
            <tbody id="items_tabla">
                @foreach ($correos as $correo)
                    <tr>
                        <td></td>
                        <td>{{ $correo->consecutivo }}</td>
                        <td>{{ $correo->codigo }}</td>
                        <td>
                            @if($correo->etapa == '4')
                                {{ Lang::get('strings.correos.sigep') }}
                            @else
                                {{ Lang::get('strings.correos.solpe') }}
                            @endif
                        </td>
                        <td>{{ $correo->enviado }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation correos" id="paginacion">
            {{ $correos->links() }}
        </nav>
    </div>
</div>
@stop