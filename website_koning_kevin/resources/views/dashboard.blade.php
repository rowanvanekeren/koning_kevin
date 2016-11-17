@extends('layouts.app')

@section('content')
    @if(!Auth::user()->is_active)
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h1>Dashboard als je geaccepteerd word kan je mopjes lezen  </h1>
                    <p>wacht tot je geaccepteerd wordt. Dan pas kan je app werder gebruiken</p>

                </div>
            </div>
        </div>
    @else
        <h1 id="jock"></h1>

    @endif
    
    @if(Auth::user()->is_admin)
    <div class="container" ng-controller="Managing_users">
            <h1>Admindashboard</h1>
            <div class="row">
                <div class="col-md-6">
                    <p>hierin komt iets, ik weet nog niet wat??</p>
                </div>
                <div class="col-md-6" ng-init="get_inactive_users()">
                    hierin komt een lijst met alle personen die zich geregistreerd hebben, maar nog niet active zijn
                    {{--
                    @foreach($inactive_users as $inactive_user)
                    <div class="row user" ng-init="get_inactive_users()">
                        <div class="col-md-8">
                            <a href="{{url('/profiel/'.$inactive_user->id)}}">{{$inactive_user->first_name}} {{$inactive_user->last_name}}</a>
                        </div>
                        <div class="col-md-4">
                            <a href="#" ng-click="accept_user()">accepteer</a>
                        </div>
                    </div>
                    @endforeach
                    --}}
                    
                    <div class="row user" ng-repeat="user in inactive_users">
                        <div class="col-md-8">
                            <a href="{{url('/profiel/')}}/@{{user.id}}">@{{user.first_name}} @{{user.last_name}}</a>
                        </div>
                        <div class="col-md-4">
                            <a href="#" ng-click="accept_user($event, user.id)">accepteer</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    @endif
    
    <script>
        /*var mamjoks = ["Yo momma is so fat, I took a picture of her last Christmas and it's still printing.", 'Yo mamma is so fat, her pants size is Bitch lose some weight', 'Yo mama so stupid she got locked in a grocery store and starved', 'Yo mama so old her birth certificate says expired on it.', 'Yo mama so stupid she got hit by a parked car', 'Yo mama so stupid she thinks a quarterback is a refund', 'Yo mama is so stupid she sat on the TV and watched the couch'];
        document.getElementById('jock').innerHTML = mamjoks[Math.floor((Math.random() * mamjoks.length))];
        setInterval(function () {
            document.getElementById('jock').innerHTML = mamjoks[Math.floor((Math.random() * mamjoks.length))];
        }, 7000);*/
    </script>
@endsection
