@extends('emails.baseEmailView')

@section('content')
    @if($gestor)
        Se informa que se ha creado un tramite.
    @else
        Apreciado usuario se le informa que su solicitud ha sido enviada al funcionario {{ $nombre_apellido }} que lo acompañará en el proceso. 
        <br>
        <br>Muy pronto esta persona establecerá contacto con usted. 
    @endif
@stop