@component('mail::message')
<div style="background-color:transparent">
    <div style="min-width:320px;max-width:500px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:#ffffff">
        <div style="border-bottom: 1px solid #e9ecef;">
            <h4>Tramite con consecutivo <div style="float:right !important"><strong>{{ $consecutivo }}</strong></div></h4>
        </div>
        <div style="padding:1rem; font-size:1em">
            <p style="margin: 0px">
                Programa, proyecto y líneas misionales: {{ $nombre_proyecto }}
                <br>
                Tipo de transaccion: {{ $tipo_transaccion }}
                <br>
                <br>
                @yield('content')
            </p>
        </div>
    </div>
</div>
@endcomponent