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
        <h5>{{ Lang::get('strings.configuracion.documentos') }}</h5>
    </div>
</div>
<div class="card-body">
    <p>Formato solicitud de apoyo economico</p>
    <form action="{{ route('subir_documentos') }}" method="post" enctype="multipart/form-data"> 
        {!! csrf_field() !!}
        <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file" class="form-control-file" name="anexos[]">
            </div>
            <button class="btn btn-outline-secondary" type="submit" >{{ Lang::get('strings.general.guardar') }}</button>
        </div>
    </form>
    @if($apoyo_economico)
        <div class="form-group">
            <label for="anexo_guardado">{{ Lang::get('strings.general.anexo_guardado') }}</label>
            @foreach($apoyo_economico as $file )
                <a class="nav-link" href="{{route('descargar_documentos','path='.$file)}}" target="_blank">{{ basename($file) }}</a>
            @endforeach
        </div>
    @endif
</div>
@stop

@section('scripts')
    @if ($general == 2)
        <script type="module" src="{{ asset('js/configuracion.js') }}" crossorigin="anonymous"></script>
    @endif
@stop