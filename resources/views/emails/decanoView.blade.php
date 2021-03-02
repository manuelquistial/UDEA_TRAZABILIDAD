@component('mail::message')
<div style="background-color:transparent">
    <div style="min-width:320px;max-width:500px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:#ffffff">
        <div style="padding:1rem; font-size:1em">
            <p style="margin: 0px">
                Cordial saludo Sr. Decano  
                <br>
                <br>
                A continuación relaciono las solicitudes pendientes por aprobar:
                <br>
                <br>
                <table class="table">
                    <tbody id="items_tabla">
                        @if(count($email->sap) !== 0)
                            <tr>
                                <td><strong>SAP</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Precompromiso</strong></td>
                                <td></td>
                                <td><strong>SIGEP</strong></td>
                            </tr>
                            @foreach ($email->sap as $item)
                                <tr>
                                    <td>{{ $item[0] }}</td>
                                    <td></td>
                                    <td>
                                        @if($item[1] == 0)
                                            {{ Lang::get('strings.correos.pendiente') }}
                                        @else
                                            {{ $item[1] }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                        @endif

                        @if(count($email->solped) !== 0)
                            <tr>
                                <td><strong>Solped</strong></td>
                            </tr>
                            @foreach ($email->solped as $item)
                                <tr>
                                    <td>{{ $item }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                        @endif

                        @if(count($email->sigep) !== 0)
                            <tr>
                                <td><strong>PORTAL</strong></td>
                                <td></td>
                                <td><strong>SIGEP</strong></td>
                            </tr>
                            @foreach ($email->sigep as $item)
                                <tr>
                                    <td>{{ $item[0] }}</td>
                                    <td>{{ $item[1] }}</strong></td>
                                    <td>
                                        @if($item[2] == 0)
                                            {{ Lang::get('strings.correos.pendiente') }}
                                        @else
                                            {{ $item[2] }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <br>
                <br>
                Muchas gracias,
            </p>
        </div>
    </div>
</div>
@endcomponent