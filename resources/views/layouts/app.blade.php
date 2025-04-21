<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Рецепти</title>
    <link href="{{ asset ('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('css/offcanvas.css')  }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <nav class="navbar navbar-fixed-top navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ route('home') }}">Рецепти</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="{{ Route::currentRouteName()== 'home' ? 'active' : '' }}">
                        <a href="{{ route('home')}}">Начало</a>
                    </li>

                    @guest
                        <li class="{{ Route::currentRouteName() == 'login' ? 'active' : '' }}">
                            <a href="{{ route('login')}}">Вход</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'register' ? 'active' : '' }}">
                            <a href="{{ route('register')}}">Регистрация</a>
                        </li>
                    @else
                        <li class="{{ Request::is('recipes*') ? 'active' : '' }}">
                            <a href="{{ route('recipes.index')}}">Рецепти</a>
                        </li>
                        <li>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Изход ({{ Auth::user()->name }})
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row row-offcanvas row-offcanvas-right">
            <div class="col-xs-12 col-sm-9">
                <p class="pull-right visible-xs">
                    <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
                </p>
                <div class="jumbotron">
                    @section('maincontent')
                    Добре дошли в нашата кулинарна общност! <br>
                    Открийте и споделете с един клик своите любими рецепти.
                    @show
                </div>
            </div>
        </div>
        <footer>
        </footer>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/offcanvas.js') }}"></script>
</body>

</html>