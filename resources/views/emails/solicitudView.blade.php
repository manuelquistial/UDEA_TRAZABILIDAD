@extends('emails.baseEmailView')

@section('content')
    @if($sap)
        Apreciado Gestor Administrativo, 
        <br>
        <br>
        Se informa que la etapa Solicitud ha sido confirmada por el gestor, se solicita su revisión para dar inicio al trámite. 
    @endif
@stop


