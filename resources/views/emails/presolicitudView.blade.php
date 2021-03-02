@extends('emails.baseEmailView')

@section('content')
    @if($gestor)
        Apreciado Gestor Administrativo, 
        <br>
        <br>
        Se le informa que un usuario ha creado una presolicitud de trámite. 
        <br>
        <br>
        Por favor, ingrese al aplicativo para dar inicio al proceso.
    @else
        Apreciado Usuario,
        <br>
        <br>
        Se le informa que su solicitud ha sido enviada al funcionario {{ $nombre_apellido }} que lo acompañará en el proceso. 
        <br>
        <br>Muy pronto esta persona establecerá contacto con usted. 
    @endif
@stop