@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{url('/css/dashboard.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/css/accept_volunteer.css')}}">
@stop
@section('content')

    <img class="dashb-bg-rope1" src="{{asset('images/home_bg/rope2-double.png')}}">
    <img class="dashb-bg-rope2" src="{{asset('images/home_bg/rope1-single.png')}}">
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
      {{--  <div class="row">
            <div class="col-md-12 sub-page-banner">

                    <h1>Dashboard</h1>
          --}}{{--      <img class="sub-header-img" src="{{asset('images/page_header/bestanden.png')}}">--}}{{--


            </div>
        </div>--}}
        @if(!Auth::user()->is_active)
            <div class="row">
                <div class="col-md-8 col-md-offset-2 ">
                    <div class="panel box-shadow-default not-accepted">
                        <div class="panel-heading">
                    <h1>Dankjewel voor je registratie!</h1>
                            </div>
                        <div class="panel-body">
                   <h2> Vanaf dat de administrator je geaccepteerd heeft, krijg je een bevestigingsmailtje.</h2>
                        </div>
                        </div>
                </div>
            </div>
        @endif
        
            <div class="row" ng-controller="Managing_users">
                @if(Auth::user()->is_active)
                @include('dashboard.rol_files')
                
                <div class="col-md-6">
                    <div class="panel panel-default box-shadow-default z-index-fix">
                        <div class="panel-heading" ng-click="togglePanel('myProjectsDashboard')">
                         <strong>Mijn projecten</strong> <div  class="toggleCollapse glyphicon @{{projOvervDashb ? 'glyphicon-chevron-down' : 'glyphicon-chevron-right'}}"></div>
                        </div>

                        <div class="panel-body" ng-controller="Dashboard" ng-show="myProjDashb">
                            <div class="row">
                                <div class="col-md-12">
                                    @if(!$my_projects->isEmpty())
                                    @foreach($my_projects as $my_project)
                                        <div class="row-title">
                                            <a href="{{url('/project_info/' . $my_project->id)}}">{{ $my_project->name }}</a>
                                            op {{ $my_project->start }}</div>
                                    @endforeach
                                    @else
                                    <div>Je hebt voorlopig geen projecten</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                
                @endif
                <div class="col-md-6">
                    @if(Auth::user()->is_admin)
                        <div class="panel panel-default box-shadow-default z-index-fix " >
                            <div class="panel-heading" ng-click="togglePanel('usersDashboard')">
                               <strong> Overzicht met nieuwe vrijwilligers</strong> <div  class="toggleCollapse glyphicon @{{usrdashb ? 'glyphicon-chevron-down' : 'glyphicon-chevron-right'}}"></div>
                            </div>

                            <div class="panel-body" ng-controller="Dashboard" ng-show="usrdashb">
                                <div class="container col-md-12" >
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
                                                        <a class="btn btn-primary " type="button" data-toggle="modal"
                                               data-target="#new_volunteers_modal" ng-click="pass_modal_info(user.id)">Accepteer</a>
                                                        <a class="btn btn-primary " type="button" data-toggle="collapse"
                                                           data-target="#confirmation@{{user.id}}">Weiger</a>
                                                    </div>
                                                </div>
                                                <!--
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
                                                -->
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
                        <div class="modal fade " id="new_volunteers_modal" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content z-index-fix">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Vrijwilliger accepteren @{{selected_user}}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Welke rollen wil je aan deze vrijwilliger toekennen?</p>
                                        @foreach($roles as $role)
                                            <div class="role">
                                                <input id="role{{$role->id}}" type="checkbox" ng-model="selected[{{$role->id}}]" value="test">
                                                <label for="role{{$role->id}}">{{$role->type}} <i class="fa fa-check" aria-hidden="true"></i></label>
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" ng-click="accept_user($event, selected_user, selected)" data-dismiss="modal">Accepteren</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @if(Auth::user()->is_active)
                            <div class="panel panel-default box-shadow-default z-index-fix">
                                <div class="panel-heading" ng-click="togglePanel('projectOverviewDashboard')">
                                 <strong>Projectoverzicht</strong> <div  class="toggleCollapse glyphicon @{{projOvervDashb ? 'glyphicon-chevron-down' : 'glyphicon-chevron-right'}}"></div>
                                </div>
                                <div class="panel-body" ng-controller="Dashboard" ng-show="projOvervDashb">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @foreach($projects as $project)
                                                <div class="col-md-12">
                                                <div class="row-title">
                                                    <a href="{{url('/project_info/' . $project->id)}}">{{ $project->name }}</a>
                                                    op {{ $project->start }}</div>
                                                @if(Auth::user()->is_admin)
                                                <div class="row-icons">
                                                    <a href="{{url('edit_project/'.$project->id)}}"><span
                                                                class=" glyphicon glyphicon-pencil"></span></a>
                                                    <a href="{{url('delete_project/'.$project->id)}}"><span class="glyphicon glyphicon-trash"></span></a>
                                                </div>
                                                </div>
                                                @else
                                                </div>
                                                @endif
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