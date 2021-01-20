<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ Lang::get('strings.menu_superior.titulo') }}</title>
        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    </head>
    <body>
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
    </body>
</html>