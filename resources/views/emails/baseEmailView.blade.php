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
        <div class="container">
            <div class="row justify-content-center" id="content">
                <div class="col-8">  
                    <div class="info-body">
                        <div class="modal-header">
                            Tramite con consecutivo <strong>{{ $consecutivo }}</strong>
                        </div>
                        <div class="modal-body">
                            <p>
                                @yield('content')
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>