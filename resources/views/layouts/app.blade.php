<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        <!-- Js -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/580972a967.js" crossorigin="anonymous"></script>
        
    </head>
    <body>
        <div class="container">
            <ul class="row nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Tramites</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="far fa-bell"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Manuel Quistial</a>
                </li>
            </ul>
            <div class="row">
                <div class="nav-side-menu col-3">
                    <div class="brand">UDEA</div>
                    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
                    <div class="menu-list">
                        <ul id="menu-content" class="menu-content collapse out">
                            <li data-toggle="collapse" data-target="#firstItem" class="collapsed active">
                                <a href="#">{{Lang::get('lateralMenuStrings')}}<span class="arrow"></span></a>
                            </li>
                            <ul class="sub-menu collapse" id="firstItem">
                                <li class="active"><a href="#">{{Lang::get('lateralMenuStrings')}}</a></li>
                                <li><a href="#">{{Lang::get('lateralMenuStrings')}}</a></li>
                            </ul>
                            <li data-toggle="collapse" data-target="#secondItem" class="collapsed">
                                <a href="#">{{Lang::get('lateralMenuStrings')}}<span class="arrow"></span></a>
                            </li>  
                            <ul class="sub-menu collapse" id="secondItem">
                                <li><a href="#">{{Lang::get('lateralMenuStrings')}}</a></li>
                            </ul>
                            <li data-toggle="collapse" data-target="#thirdItem" class="collapsed">
                                <a href="#">{{Lang::get('lateralMenuStrings')}}<span class="arrow"></span></a>
                            </li>  
                            <ul class="sub-menu collapse" id="thirdItem">
                                <li><a href="#">{{Lang::get('lateralMenuStrings')}}</a></li>
                            </ul>
                            <li data-toggle="collapse" data-target="#forthItem" class="collapsed">
                                <a href="#">{{Lang::get('lateralMenuStrings')}}<span class="arrow"></span></a>
                            </li>  
                            <ul class="sub-menu collapse" id="forthItem">
                                <li><a href="#">{{Lang::get('lateralMenuStrings')}}</a></li>
                            </ul>
                            <li data-toggle="collapse" data-target="#fifthItem" class="collapsed">
                                <a href="#">{{Lang::get('lateralMenuStrings')}}<span class="arrow"></span></a>
                            </li>  
                            <ul class="sub-menu collapse" id="fifthItem">
                                <li><a href="#">{{Lang::get('lateralMenuStrings')}}</a></li>
                            </ul>
                            <li data-toggle="collapse" data-target="#sixthItem" class="collapsed">
                                <a href="#">{{Lang::get('lateralMenuStrings')}}<span class="arrow"></span></a>
                            </li>  
                            <ul class="sub-menu collapse" id="sixthItem">
                                <li><a href="#">{{Lang::get('lateralMenuStrings')}}</a></li>
                            </ul>
                        </ul>
                    </div>
                </div>
                <div class="col-8">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Library</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                    </ol>
                    </nav>
                    @yield('content')
                </div>
            </div>
        </div>
    </body>
</html>