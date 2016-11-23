<!DOCTYPE html>
<html lang="be">
<head>
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Koning kevin</title>

    <!-- Styles -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <link href="{{url('/css/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{url('/css/custom.css')}}">
    @yield('styles')
    <script src="{{url('/js/app.js')}}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.2/angular.min.js"></script>
    <script src="{{url('/js/ui-bootstrap-tpls-2.2.0.min.js')}}"></script>
    <script src="{{url('/js/angular.js')}}"></script>
    <script src="{{url('/js/managing_file.js')}}"></script>
    <script src="{{url('/js/managing_users.js')}}"></script>
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
                            <li class="{{ Request::is('profiel') ? 'active' : '' }}">
                                <a href="{{ url('/profiel') }}">Profiel</a>
                            </li>
                            <li class="{{ Request::is('bestanden') ? 'active' : '' }}">
                                <a href="{{ url('/bestanden') }}">Bestanden</a>
                            </li>
                        @endif
                        @if(Auth::user()->is_admin)
                            <li class="{{ Request::is('add_file') ? 'active' : '' }}">
                                <a href="{{ url('/add_file') }}">Bestand toevoegen</a>
                            </li>
                            <li class="{{ Request::is('add_project') ? 'active' : '' }}">
                                <a href="{{ url('/add_project') }}">Project aanmaken</a>
                            </li>
                        @endif
                        <li class="dropdown custom-dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->first_name }}
                                <img id="nav-profile-picture" src="{{asset('images/profile_pictures/' . Auth::user()->url ) }}">
                                <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu custom-dropdown-menu" role="menu">
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
    <div ng-controller="PrimeController">

        @yield('content')
    </div>
</div>
</body>
</html>
