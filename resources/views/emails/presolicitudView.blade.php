@extends('emails.baseEmailView')

@section('content')
    Apreciado usuario se le informa que su solicitud ha sido enviada al funcionario {{ $nombre_apellido }} que lo acompañará en el proceso. 
    <br>
    <br>Muy pronto esta persona establecerá contacto con usted. 
@stop