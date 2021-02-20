@extends('layouts.lateralMenu.etapasView')

@section('content')
<div class="card-body">
    @switch($route)
        @case("index")
            <form action="{{ route('save_presolicitud') }}" method="post" enctype="multipart/form-data"> 
            {!! csrf_field() !!}
            @break
        @case("edit")
            <form action="{{ route('update_presolicitud') }}" method="post" enctype="multipart/form-data"> 
            {!! csrf_field() !!}
            @break
        @default
            @break
    @endswitch
        @if(!$etapas)
            <input type="hidden" name="consecutivo", value="{{ $consecutivo }}">
        @endif
        <div class="form-group">
            <label for="proyecto_id">{{ Lang::get('strings.presolicitud.proyecto') }}</label>
            <select class="form-control" name="proyecto_id" id="proyecto_id">
                <option value="">{{ Lang::get('strings.presolicitud.seleccione_proyecto') }}</option>
            @if($etapas)
                @foreach( $proyecto as $proyecto )
                    <option value="{{ $proyecto->codigo }}" {{old('proyecto_id') == $proyecto->codigo ? 'selected':''}}>{{ $proyecto->nombre }}</option>
                @endforeach
            @else
                @foreach( $proyecto as $proyecto )
                    @if( $proyecto->codigo == $data->proyecto_id )
                        <option value="{{ $proyecto->codigo }}" selected>{{ $proyecto->nombre }}</option>
                    @else
                        <option value="{{ $proyecto->codigo }}">{{ $proyecto->nombre }}</option>
                    @endif
                @endforeach
            @endif
            </select>
        </div>
        <div class="form-group">
            <label for="otro_proyecto">{{ Lang::get('strings.notes.otro_proyecto') }}</label>
            <input type="text" class="form-control" name="otro_proyecto" value="{{ $etapas ? old('otro_proyecto') : $data->otro_proyecto}}"> 
            @if ($errors->has('otro_proyecto'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('otro_proyecto') }}</small></strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="transaccion_id">{{ Lang::get('strings.presolicitud.tipo_transaccion') }}</label>
            <div class="input-group">
                <select class="form-control" name="transaccion_id" id="transaccion_id">
                    <option value="">{{ Lang::get('strings.presolicitud.seleccione_transaccion') }}</option>
                @if($etapas)
                    @foreach($tipoTransaccion as $transaccion )
                        @if($transaccion->id == 28)
                            <option value="{{ $transaccion->id }}" {{old('transaccion_id') == $transaccion->id ? 'selected':''}} id="first-item">{{ $transaccion->tipo_transaccion }}</option>
                        @else
                            <option value="{{ $transaccion->id }}" {{old('transaccion_id') == $transaccion->id ? 'selected':''}}>{{ $transaccion->tipo_transaccion }}</option>
                        @endif
                    @endforeach
                @else
                    @foreach( $tipoTransaccion as $transaccion )
                        @if( $transaccion->id == $data->transaccion_id )
                            @if($transaccion->id == 28)
                                <option value="{{ $transaccion->id }}" selected id="first-item">{{ $transaccion->tipo_transaccion }}</option>
                            @else
                                <option value="{{ $transaccion->id }}" selected>{{ $transaccion->tipo_transaccion }}</option>
                            @endif
                        @else
                            @if($transaccion->id == 28)
                                <option value="{{ $transaccion->id }}" id="first-item">{{ $transaccion->tipo_transaccion }}</option>
                            @else
                                <option value="{{ $transaccion->id }}">{{ $transaccion->tipo_transaccion }}</option>
                            @endif
                        @endif
                    @endforeach
                @endif
                </select>
                @if(!$etapas)
                    @if($route == "show" && $data->etapa_id == '1')
                    <div class="input-group-prepend">
                        <a class="input-group-text" id="redirect">{{ Lang::get('strings.presolicitud.redireccionar') }}</a>
                    </div>
                    @endif
                @endif
            </div>
            @if ($errors->has('transaccion_id'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('transaccion_id') }}</small></strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="valor">{{ Lang::get('strings.general.valor') }}</label>
            <small class="form-text text-muted">
                <strong>{!! Lang::get('strings.notes.valor') !!}</strong>
            </small>
            @if(\App::environment() != 'production')
                <input type="text" class="form-control" id="valor" name="valor" value="{{ $etapas ? (old('valor')) : $data->valor}}"> 
            @else
                <?php $fmt = numfmt_create('de_DE', NumberFormatter::CURRENCY)?>
                <input type="text" class="form-control" name="valor" id="valor" value="{{ $etapas ? (str_replace(' €','',numfmt_format_currency($fmt, old('valor'),"EUR")) == '0,00' ? '':'') : str_replace(' €','',numfmt_format_currency($fmt, $data->valor,"EUR")) }}">
            @endif
            @if ($errors->has('valor'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('valor') }}</small></strong>
                </span>
            @endif
        </div>
        <div class="form-row" style="margin: 1rem 0rem;">
            <div class="form-group col-md-6" style="margin: 0px;">
                <label for="fecha_inicial">{{ Lang::get('strings.presolicitud.fecha_inicial') }}</label>
                <input type="date" class="form-control" name="fecha_inicial" placeholder="yyyy-mm-dd" value="{{ $etapas ? old('fecha_inicial') : $data->fecha_inicial }}">
                @if ($errors->has('fecha_inicial'))
                    <span class="text-danger">
                        <strong><small>{{ $errors->first('fecha_inicial') }}</small></strong>
                    </span>
                @endif
            </div>
            <div class="form-group col-md-6" style="margin: 0px;">
                <label for="fecha_final">{{ Lang::get('strings.presolicitud.fecha_final') }}</label>
                <input type="date" class="form-control" name="fecha_final" placeholder="yyyy-mm-dd" value="{{ $etapas ? old('fecha_final') : $data->fecha_final }}">
                @if ($errors->has('fecha_final'))
                    <span class="text-danger">
                        <strong><small>{{ $errors->first('fecha_final') }}</small></strong>
                    </span>
                @endif
            </div>
            <small class="form-text text-muted">
                <strong>{{ Lang::get('strings.notes.fecha') }}</strong>
            </small>
        </div>
        <div class="form-group">
            <label for="descripcion">{{ Lang::get('strings.presolicitud.descripcion') }}</label>
            <textarea class="form-control" name="descripcion" rows="3">{{ $etapas ? old('descripcion') : $data->descripcion}}</textarea>
            @if ($errors->has('descripcion'))
                <span class="text-danger">
                    <strong><small>{{ $errors->first('descripcion') }}</small></strong>
                </span>
            @endif
        </div>
        @if($route != "show")
            <div class="form-group">
                <label for="anexos">{{ Lang::get('strings.general.anexos') }}</label>
                <input type="file" class="form-control-file" name="anexos[]" multiple>
                @if ($errors->has('anexos'))
                    <span class="text-danger">
                        <strong><small>{{ $errors->first('anexos') }}</small></strong>
                    </span>
                @endif
                <small class="form-text text-muted">
                    <strong>
                        @if($apoyo_economico)
                            {!! Lang::get('strings.notes.presolicitud',['documento'=>"href=".route('descargar_documentos','path='.$apoyo_economico)]) !!}
                        @else
                            {!! Lang::get('strings.notes.presolicitud',['documento'=>""]) !!}
                        @endif
                    </strong>
                </small>
            </div>
        @endif
        @if($files)
            <div class="form-group">
                <label for="anexos_guardados">{{ Lang::get('strings.general.anexos_guardados') }}</label>
                @foreach($files as $file)
                    <div class="input-group mb-3" id="documento_button">
                        @if($route != "show")
                            <button type="button" class="btn btn-light fas fa-trash-alt"></button>
                        @endif
                        <a class="nav-link" href="{{route('descargar_documentos','path='.$file)}}" target="_blank">{{ basename($file) }}</a>
                    </div>
                @endforeach
            </div>
        @endif
        @switch($route)
            @case("index")
                <div class="float-left"><button type="submit" class="btn btn-primary">{{ Lang::get('strings.presolicitud.enviar') }}</button></div>
                @break
            @case("edit")
                <div class="float-left"><button type="submit" class="btn btn-primary">{{ Lang::get('strings.general.actualizar') }}</button></div>
                @break
            @default
        @endswitch
    </form>
</div>

<div class="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span id="titulo"></span>{{ Lang::get('strings.solicitud.codigo_sigep') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="card card-default">
                        <div class="card-header modal-header">
                            <div class="col-6 conf-header">
                                <a><strong>{{ Lang::get('strings.presolicitud.modal.disponible_recursos') }}</strong></a>
                            </div>
                            <div class="col-6 text-right conf-header">
                                <a class="navbar-nav navbar-right" style="padding-right: 20px;"><strong id="dis"></strong></a>
                             </div>
                        </div>
                        <div class="card-body">
                            <table class="table tableGeneral">
                                <tbody>
                                    <tr class="table-style">
                                        <td colspan="6"><strong>{{ Lang::get('strings.presolicitud.modal.resumen_presupuestal') }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>{{ Lang::get('strings.presolicitud.modal.ingresos') }}</td>
                                        <td id="ingreso"></td>
                                        <td>{{ Lang::get('strings.presolicitud.modal.egresos') }}</td>
                                        <td id="egreso"></td>
                                        <td>{{ Lang::get('strings.presolicitud.modal.reservas') }}</td>
                                        <td id="reserva"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ Lang::get('strings.presolicitud.modal.cuentaxcobrar') }}</td>
                                        <td id="cuentapc"></td>
                                        <td>{{ Lang::get('strings.presolicitud.modal.disponibilidad_efectiva') }}</td>
                                        <td id="dispEfec"></td>
                                        <td>{{ Lang::get('strings.presolicitud.modal.disponibilidad_real') }}</td>
                                        <td id="dispReal">-</td>
                                    </tr>
                                    <tr>
                                        <td>{{ Lang::get('strings.presolicitud.modal.presupuesto_total') }}</td>
                                        <td id="pTotal"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-header modal-header">
                            <div class="col-6 conf-header">
                                <a role="tab" id="headingOne" data="" href="#collapseOne" data-toggle="collapse" data-parent="#accordion" aria-expanded="true" aria-controls="collapseOne" class=""><strong>{{ Lang::get('strings.presolicitud.modal.vista_general') }}</strong></a>
                            </div>
                        </div>
                      
                        <div id="collapseOne" class="card-collapse collapse in" role="tabcard" aria-labelledby="headingOne" aria-expanded="true" style="">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr class="table-style">
                                            <th scope="col">{{ Lang::get('strings.presolicitud.modal.nombre_egreso') }}</th>
                                            <th scope="col">{{ Lang::get('strings.presolicitud.modal.pp_inicial') }}</th>
                                            <th scope="col">{{ Lang::get('strings.presolicitud.modal.reservas') }}</th>
                                            <th scope="col">{{ Lang::get('strings.presolicitud.modal.egresos') }}</th>
                                            <th scope="col">{{ Lang::get('strings.presolicitud.modal.disponible') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_sigep">
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-body">
                                <table class="table text-center table-center">
                                    <tbody><tr class="table-style">
                                        <td><strong>{{ Lang::get('strings.presolicitud.modal.disponibilidad_recursos') }}</strong></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>{{ Lang::get('strings.presolicitud.modal.total_in_neto') }}</td>
                                        <td id="inNeto_3t"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ Lang::get('strings.presolicitud.modal.reserva_egreso') }}</td>
                                        <td id="reEg"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ Lang::get('strings.presolicitud.modal.recursos_disponibles') }}</td>
                                        <td id="reDi"></td>
                                    </tr>
                                </tbody></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop