@extends('emails.baseEmailView')

@section('content')
    @if($sap)
        Se informa que la etapa Solicitud ha sido confirmada por el gestor, se solicita su revisión para dar inicio al trámite. 
    @endif
@stop


