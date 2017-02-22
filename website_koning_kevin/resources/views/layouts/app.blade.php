<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Koning kevin</title>
    <link rel="shortcut icon" href="{{asset('images/icons/favicon.ico')}}" type="image/vnd.microsoft.icon">
    <!-- Styles -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          crossorigin="anonymous">

    <link href="{{url('/css/app_new.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{url('/css/custom_new.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/css/accept_volunteer.css')}}">
    @yield('styles')
    <script src="{{url('/js/app.js')}}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.2/angular.min.js"></script>
    <script src="{{url('/js/ui-bootstrap-tpls-2.2.0.min.js')}}"></script>
    <script src="{{url('/js/angular.js')}}"></script>
    <script src="{{url('/js/managing_file.js')}}"></script>
    <script src="{{url('/js/managing_users.js')}}"></script>
    <script src="{{url('/js/managing_projects.js')}}"></script>
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body ng-app="myapp">
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img id="layout-brand-image" src="{{asset('images/kk/logo.png')}}">
                    {{--{{ config('app.name', 'Laravel') }}--}}
                </a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li class="{{ Request::is('login') ? 'active' : '' }}"><a href="{{ url('/login') }}">Login</a>
                        </li>
                        <li class="{{ Request::is('register') ? 'active' : '' }}"><a href="{{ url('/register') }}">Register</a>
                        </li>
                    @else
                        <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                            <a href="{{ url('/dashboard') }}">Dashboard</a>
                        </li>
                        @if(Auth::user()->is_active)
                            <li class="{{ Request::is('projectoverzicht') ? 'active' : '' }}">
                                <a href="{{ url('/projectoverzicht') }}">Projectoverzicht</a>
                            </li>
                       {{--     <li class="{{ Request::is('bestanden') ? 'active' : '' }}">
                                <a href="{{ url('/bestanden') }}">Bestanden</a>
                            </li>--}}
                        @endif
                        @if(Auth::user()->is_admin)
                            {{--<li class="{{ Request::is('add_file') ? 'active' : '' }}">--}}
                                {{--<a href="{{ url('/add_file') }}">Bestand toevoegen</a>--}}
                            {{--</li>--}}
                            <li class=" dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" >
                                    Bestanden<span class="caret"></span>
                                </a>
                                    <ul class="dropdown-menu custom-dropdown-menu">
                                        <li class="{{ Request::is('bestanden') ? 'active' : '' }}">
                                            <a href="{{ url('/bestanden') }}">Overzicht</a>
                                        </li>
                                        <li class="{{ Request::is('add_file') ? 'active' : '' }}">
                                            <a href="{{ url('/add_file') }}">Nieuw Bestand</a>
                                        </li>
                                        <li class="{{ Request::is('registratiebestand') ? 'active' : '' }}">
                                            <a href="{{ url('/registratiebestand') }}">Registratiebestand</a>
                                        </li>
                                    </ul>
                            </li>






                            <li class="{{ Request::is('add_project') ? 'active' : '' }}">
                                <a href="{{ url('/add_project') }}">Project aanmaken</a>
                            </li>
                            <li class="{{ Request::is('vrijwilligersoverzicht') ? 'active' : '' }}">
                                <a href="{{ url('/vrijwilligersoverzicht') }}">Vrijwilligers</a>
                            </li>
                        @endif
                        @if(Auth::user()->is_active)
                            <li class="{{ Request::is('contact') ? 'active' : '' }}">
                                <a href="{{ url('/contact') }}">Contact</a>
                            </li>
                        @endif
                        <li class="dropdown custom-dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->first_name }}
                                <img id="nav-profile-picture"
                                     src="{{asset('images/profile_pictures/' . Auth::user()->url ) }}">
                                <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu custom-dropdown-menu" role="menu">
                                @if(Auth::user()->is_active)
                                    <li class="{{ Request::is('profiel') ? 'active' : '' }}">
                                        <a href="{{ url('/profiel') }}">Profiel</a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="main-content" ng-controller="PrimeController">

        @yield('content')


    </div>
    <div class="row footer">
        <div class="col-md-12 footer-main">
            <div class="footer-content">
                <div class="footer-content-left"><p>Koning Kevin vzw is een landelijk georganiseerde <br>
                        jeugdwerkorganisatie, erkend door en met de <br>
                        steun van de Vlaamse Gemeenschap. <br>
                        Alle inhoud &copy; {{ date("Y") }} Koning Kevin. <br></p></div>
            </div>
            <div class="footer-border"></div>
            <div class="footer-content">
                <div class="footer-content-middle">
                    <h2>Koning Kevin vzw</h2>
                    <p>
                        Kapellekensweg 2 3010 Kessel-Lo<br>
                        T 016 350 550<br>
                        <a href="mailto:info@koningkevin.be?Subject=Contact bericht">info@koningkevin.be</a><br></p>
                </div>
            </div>

            <div class="footer-content">
                <div class="footer-content-last"><img src="{{asset('/images/icons/vloverheid.png')}}"></div>
            </div>


        </div>
    </div>
</div>

@yield('custom_js')


</body>
</html>
