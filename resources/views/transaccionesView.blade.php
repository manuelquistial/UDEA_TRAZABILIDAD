@extends('layouts.lateralMenu.tipoTransaccionView')

@section('content')
<div class="modal-header">
    <div class="col-6 conf-header">
        <h5>{{ Lang::get('strings.menu_superior.transaccion') }}</h5>
    </div>
</div>
<div class="card-body">
    <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ Lang::get('strings.general.consecutivo') }}</th>
                    <th>{{ Lang::get('strings.configuracion.tipo_transaccion') }}</th>
                    <th>{{ Lang::get('strings.configuracion.etapa') }}</th>
                    <th>{{ Lang::get('strings.correos.estado') }}</th>
                </tr>
            </thead>
            <tbody id="items_tabla">
                @foreach ($transacciones as $transaccion)
                <tr>
                    <td>
                    <a href="#">{{ $transaccion->consecutivo }}</a>
                    </td>
                    <td>{{ $transaccion->etapa }}</a></td>
                    <td>{{ $transaccion->estado }}</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation tipo transaccion" id="paginacion">
            {{ $transacciones->links() }}
        </nav>
    </div>
</div>
@stop

@section('scripts')
    <script type="module" src="{{ asset('js/tipoTransaccionScript.js') }}" crossorigin="anonymous"></script>
@stop