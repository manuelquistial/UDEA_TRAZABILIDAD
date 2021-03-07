@extends('layouts.lateralMenu.tipoTransaccionView')

@section('content')
<div class="modal-header">
    <div class="col-6 conf-header">
        @if($consulta) 
            <h5>{{ Lang::get('strings.menu_superior.consulta_gestores') }}</h5>
        @else
            <h5>{{ Lang::get('strings.menu_superior.consulta_usuario') }}</h5>
        @endif
    </div>
    <div class="col-6 text-right conf-header">
        @if(!$consulta & Auth::user()->hasTipoTransaccion())
            <a class="info-header" href="{{route('consulta_gestores')}}">{{ Lang::get('strings.menu_superior.consulta_gestores') }}</a>
        @elseif(!$consulta & Auth::user()->hasOneRole("Administrador"))
            <a class="info-header" href="{{route('consulta_gestores')}}">{{ Lang::get('strings.menu_superior.consulta_gestores') }}</a>
        @elseif($consulta)
            <a class="info-header" href="{{route('consulta_usuario')}}">{{ Lang::get('strings.menu_superior.consulta_usuario') }}</a>
        @endif
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
                    <th>{{ Lang::get('strings.general.estado') }}</th>
                </tr>
            </thead>
            <tbody id="items_tabla">
                @foreach ($transacciones as $transaccion)
                <tr>
                    <td>
                    @if($consulta)
                        @if($transaccion->estado_id == '1' && $transaccion->endpoint != 'presolicitud')
                            <a href="{{ route('edit_'.$transaccion->endpoint, $transaccion->consecutivo) }}">{{ $transaccion->consecutivo }}</a>
                        @else
                            <a href="{{ route('show_'.$transaccion->endpoint, $transaccion->consecutivo) }}">{{ $transaccion->consecutivo }}</a>
                        @endif
                    @else
                        @if($transaccion->estado_id == '1')
                            <a href="{{ route('edit_presolicitud', $transaccion->consecutivo) }}">{{ $transaccion->consecutivo }}</a>
                        @else
                            <p class="titulo-header">{{ $transaccion->consecutivo }}</p>
                        @endif
                    @endif
                    </td>
                    <td>{{ $transaccion->tipo_transaccion }}</td>
                    <td>{{ $transaccion->etapa }}</td>
                    <td>{{ $transaccion->estado }}</td>
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
    <script type="module" src="{{ asset('js/transacciones.js') }}" crossorigin="anonymous"></script>
@stop