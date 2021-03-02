@extends('emails.baseEmailView')

@section('content')
    @if($gestor)
        Apreciado gestor,
        <br>
        <br>
        Se informa que la etapa Preaprobado Presupuesto ha sido confirmada y pasa al estado Aprobado presupuesto, 
        debe ingresar al aplicativo para registrar la información requerida.
    @else
        Apreciado Usuario,
            <br>
            <br>
        @if($sap)
            Se informa que su solicitud ha sido aprobada por Presupuesto, puede iniciar el proceso de contratación o adquisición de servicios. 
            Es importante mencionar que el proceso de contratación en la UdeA
            está sujeto al cumplimento de los requisitos establecidos su Estatuto de Contratación y 
            en todos los casos la fecha de inicio de las actividades o para la adquisición de servicios, 
            está sujeta al cumplimiento del requisito de Certificado de Registro Presupuestal - CRP. 
            Debe ponerse en contacto con el Gestor que lo está asesorando para continuar la fase siguiente del proceso.
        @else
            Se informa que su solicitud ha sido aprobada por Presupuesto, 
            en los próximos días la Tesorería de la Universidad hará efectivo el desembolso de este recurso en la cuenta bancaria que usted haya registrado.
        @endif
    @endif
@stop