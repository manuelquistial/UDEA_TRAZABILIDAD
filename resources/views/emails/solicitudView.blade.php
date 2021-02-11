@extends('emails.baseEmailView')

@section('content')
    @if($sap)
        Se informa que la etapa Solicitud ha sido confirmada por el gestor, se solicita su revisión para dar inicio al trámite. 
    @else
        Apreciado usuario se le informa que la etapa Solicitud ha sido confirmada y pasa a la etapa Trámite.
    @endif
@stop


