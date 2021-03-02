@extends('layouts.lateralMenu.tipoTransaccionView')

@section('content')
<div class="modal-header">
    <div class="col-6 conf-header">
        <h5>{{ Lang::get('strings.menu_superior.correos') }}</h5>
    </div>
    <div class="col-6 text-right conf-header">
        <button type="button" class="btn btn-primary btn-sm" id="enviar_correos" disabled>{{ Lang::get('strings.correos.enviar_correos') }}</button>
    </div>
</div>
<div class="card-body">
    <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th><input type="checkbox" class="form-check-input checkbox_table" name="correos" id="correos"></th>
                    <th>{{ Lang::get('strings.general.consecutivo') }}</th>
                    <th>{{ Lang::get('strings.correos.codigo') }}</th>
                    <th>{{ Lang::get('strings.correos.tipo') }}</th>
                    <th>{{ Lang::get('strings.correos.enviado') }}</th>
                    <th>{{ Lang::get('strings.correos.fecha_envio') }}</th>
                </tr>
            </thead>
            <tbody id="items_tabla">
                @foreach ($correos as $correo)
                    <tr>
                        <td>
                            @if($correo->enviado == '0')
                                <input type="checkbox" class="form-check-input checkbox_table" name="correo[]" id="correo" data-id={{ $correo->id }} data-consecutivo="{{ $correo->consecutivo }}" data-etapa="{{ $correo->etapa }}" data-codigo="{{ $correo->codigo }}">
                            @else
                                <input type="checkbox" class="form-check-input checkbox_table" name="correo[]" id="correo" disabled>
                            @endif
                              </td>
                        <td>{{ $correo->consecutivo }}</td>
                        <td>
                            @if($correo->codigo == 0)
                                {{ Lang::get('strings.correos.pendiente') }}
                            @else
                                {{ $correo->codigo }}
                            @endif
                        </td>
                        <td>
                            @if($correo->etapa == '4')
                                {{ Lang::get('strings.correos.sigep') }}
                            @else
                                {{ Lang::get('strings.correos.solped') }}
                            @endif
                        </td>
                        <td>
                            @if($correo->enviado != '0')
                                <i class="fas fa-check-circle"></i>
                            @else
                                <i class="far fa-check-circle"></i>
                            @endif
                        </td>
                        <td>
                            @if($correo->fecha_envio == 0)
                                -
                            @else
                                {{ $correo->fecha_envio }}
                            @endif
                        </td>
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

@section('scripts')
    <script type="module" src="{{ asset('js/correos.js') }}" crossorigin="anonymous"></script>
@stop