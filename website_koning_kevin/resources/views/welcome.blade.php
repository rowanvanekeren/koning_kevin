@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{url('/css/home.css')}}">
@stop
@section('content')

    <div ng-controller="Add_file_to_project">
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"
                ng-click="add_file()">Kies bestanden
        </button>

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Kiez bestanden</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="home-bg-image"></div>
    <div class="container-fluid ">

        <div class="row  ">
            <div class="col-md-12 home-margin-header home-header-gradient">
                <img class="img-responsive center-block" src="{{url('/images/kk/logo.png')}}">
            </div>
        </div>
        {{--        <div id="home-login" class="container">
                    <div class="row home-margin-content">
                        <div class="col-md-12 col-md-offset-">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading text-center"><strong>REGISTREREN</strong></div>
                                    <div class="panel-body">
                                    <h1>sdfasasdfasdfafs sdfasasdfasdfafs sdfasasdfasdfafs sdfasasdfasdfafssdfasasdfasdfafssdfasasdfasdfafssdfasasdfasdfafs sdfasasdfasdfafs sdfasasdfasdfafs</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>--}}
        <div class="row home-margin-content">
            <div class="col-md-4 col-md-offset-1 text-center home-insp-text">
                {{--<h3>@{{title}}</h3>--}}
                <h1>Onze vrijwilligers app speciaal voor onze vrijwilligers</h1>
            </div>
            @if (Auth::guest())
                <div class="col-md-3 col-md-offset-2">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading text-center"><strong>INLOGGEN</strong></div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" method="POST"
                                      action="{{ url('/login') }}">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">


                                        <div class="col-md-8 col-md-offset-2">
                                            <img class="home-input-icons" src="./images/icons/login.png">
                                            <input id="email" type="email" class="form-control home-input-padding"
                                                   name="email"
                                                   value="{{ old('email') }}" required autofocus>


                                        </div>
                                        <div class="col-md-8 col-md-offset-2">
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">


                                        <div class="col-md-8 col-md-offset-2">
                                            <img class="home-input-icons" src="./images/icons/password.png">
                                            <input id="password" type="password" class="form-control home-input-padding"
                                                   name="password" required>


                                        </div>
                                        <div class="col-md-8 col-md-offset-2">
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    {{--       <div class="form-group">
                                               <div class="col-md-6 col-md-offset-4">
                                                   <div class="checkbox">
                                                       <label>
                                                           <input type="checkbox" name="remember"> Remember Me
                                                       </label>
                                                   </div>
                                               </div>
                                           </div>--}}

                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-2 text-center">
                                            <button style="width:100%" type="submit" class="btn btn-primary">
                                                Login
                                            </button>
                                            <p class="home-or">of</p>
                                            <a class="btn btn-link" href="{{ url('/register') }}">Registeer</a>
                                            <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                                Wachtwoord vergeten?
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-md-3 col-md-offset-2">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading text-center"><strong>U bent al ingelogd</strong></div>
                            <div class="panel-body">
                                <div class="col-md-8 col-md-offset-2 text-center">
                                    <button style="width:100%" onclick="window.location.href='./dashboard'"
                                            class="btn btn-primary">
                                        Ga naar dashboard
                                    </button>
                                    <p class="home-or">of</p>
                                    <a class="btn btn-link" href="./logout">Log uit</a>
                                </div>
                                <div>
                                </div>

                            </div>

                            @endif
                        </div>
                    </div>
                </div>
@endsection
