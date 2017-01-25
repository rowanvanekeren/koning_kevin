@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{url('/css/dashboard.css')}}">
@stop
@section('content')
    <style>
        .file_row_background0 {
            padding-top: 3%;
            background-color: #fff;
        }

        .file_row_background1 {
            padding-top: 3%;
            background-color: lightcyan;
        }

        .file_row_background2 {
            padding-top: 3%;
            background-color: lightsalmon;
        }

        .btn-primary {
            border-radius: 0;
            text-align: left;
        }
    </style>
    <div class="container-fluid" ng-controller="toggleController">
        <div class="row">
            <div class="col-md-12 sub-page-banner">

                    <h1>Dashboard</h1>
          {{--      <img class="sub-header-img" src="{{asset('images/page_header/bestanden.png')}}">--}}


            </div>
        </div>
        @if(!Auth::user()->is_active)
            <div class="row">
                <div class="col-md-12 col-md-offset-2">
                    Dankjewel voor je registratie!<br>
                    Vanaf dat de administrator je geaccepteerd heeft, krijg je een bevestigingsmailtje.
                </div>
            </div>
        @endif
        @if(Auth::user()->is_active)
            <div class="row">
                @include('dashboard.rol_files')
                @endif
                <div class="col-md-6">
                    @if(Auth::user()->is_admin)
                        <div class="panel panel-default">
                            <div class="panel-heading" ng-click="togglePanel('usersDashboard')">
                                Overzicht met nieuwe vrijwilligers
                            </div>
                            <div class="panel-body" ng-controller="Dashboard" ng-show="usrdashb">
                                <div class="container col-md-12" ng-controller="Managing_users">
                                    <div class="row">
                                        <div class="col-md-12" ng-init="get_inactive_users()">

                                            <div ng-if="inactive_users.length == 0">
                                                Er hebben zich momenteel geen nieuwe vrijwilligers aangemeld.
                                            </div>
                                            <div class="row user inactive_users_dashboard"
                                                 ng-repeat="user in inactive_users">
                                                <div class="row costum-margin-tbl ">
                                                    <div class="col-md-8 text-align-middle relative inactive_user_name">
                                                        <a href="{{url('/profiel/')}}/@{{user.id}}">@{{user.first_name}} @{{user.last_name}}</a>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <a class="btn btn-primary " type="button" data-toggle="collapse"
                                                           data-target="#add_roles@{{user.id}}">Accepteer</a>
                                                        <a class="btn btn-primary " type="button" data-toggle="collapse"
                                                           data-target="#confirmation@{{user.id}}">Weiger</a>
                                                    </div>
                                                </div>
                                                <div id="add_roles@{{user.id}}" class="collapse">
                                                    <div class="col-md-12">
                                                        @foreach($roles as $role)
                                                            <input id="role{{$role->id}}" type="checkbox"
                                                                   ng-model="selected[{{$role->id}}]"
                                                                   value="test"><label
                                                                    for="role{{$role->id}}">{{$role->type}}</label>
                                                        @endforeach
                                                        <a href="#" ng-click="accept_user($event, user.id, selected)">Toevoegen</a>
                                                    </div>
                                                </div>
                                                <div id="confirmation@{{user.id}}" class="collapse">
                                                    <div class="col-md-12">
                                                        Zeker dat je deze vrijwilliger wil weigeren?
                                                        <a href="#" ng-click="decline_user($event, user.id)">Ja,
                                                            weiger</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        @if(Auth::user()->is_active)
                            <div class="panel panel-default">
                                <div class="panel-heading" ng-click="togglePanel('projectOverviewDashboard')">
                                    Projectoverzicht
                                </div>

                                <div class="panel-body" ng-controller="Dashboard" ng-show="projOvervDashb">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @foreach($projects as $project)
                                                <div class="row-title">{{ $project->name }}
                                                    op {{ $project->start }}</div>
                                                <div class="row-icons">
                                                    <a href="{{url('edit_project/'.$project->id)}}"><span
                                                                class=" glyphicon glyphicon-pencil"></span></a>
                                                    <a href="#"><span class="glyphicon glyphicon-trash"></span></a>
                                                </div>

                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif

                </div>
            </div>
    </div>

@endsection