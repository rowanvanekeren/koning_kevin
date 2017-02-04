@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{url('/css/dashboard.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/css/accept_volunteer.css')}}">
@stop
@section('content')

    <div class="img_anims">
        <img class="dashb-bg-rope1" src="{{asset('images/home_bg/rope2-double.png')}}">
        <img class="dashb-bg-rope2" src="{{asset('images/home_bg/rope1-single.png')}}">
    </div>

    <div class="container" ng-controller="toggleController">

        @if(!Auth::user()->is_active)
            <div class="row">
                <div class="col-md-12 ">
                    <div class="panel box-shadow-default not-accepted">
                        <div class="panel-heading">
                            <h1>Dankjewel voor je registratie!</h1>
                        </div>
                        <div class="panel-body">

                            <style>
                                .inleiding-text {
                                    text-align: left;
                                    font-size: 18px;
                                }
                            </style>
                            <div class="inleiding-text">
                                <h1>Proficiat!</h1>
                                <p>Je hebt de weg gevonden naar het vrijwilligersplatform. We hebben je aanmelding goed
                                    ontvangen.<br><br>
                                    Graag nog een beetje geduld zodat we je registratie kunnen verwerken. Hou je mailbox
                                    in de gaten, want wanneer dit gebeurd is krijg je hier een bevestigingsmail van en
                                    kan je het platform gaan ontdekken.<br><br>

                                    Wat kan je nu allemaal terugvinden op dit platform?<br><br>
                                    Begeleiden, koken, coördineren, met de camionette rijden,....
                                    je kan op enorm veel manieren vrijwilliger zijn bij Koning Kevin.
                                    Voor alles wat je doet bestaan er bij Koning Kevin heel wat informatie
                                    die is neergeschreven in heel wat bestanden. Deze documenten kan je hier
                                    overzichtelijk terugvinden. Naar gelang welke rol je opneemt als vrijwilliger
                                    ga je hier de documenten terugvinden die je kunnen helpen bij het uitvoeren van je
                                    engagement.<br><br>

                                    Daarnaast vind je hier ook een overzicht terug van de projecten waar je bij Koning
                                    Kevin mee bezig bent. (Vb. een vakantie die je begeleidt, een cursus waar je
                                    gaat koken,...). Bij al deze projecten ga je de nodige informatie terugvinden om er
                                    een knalproject van te maken.<br><br>

                                    Nog vragen? Meer info? Of gewoon een goede mop? Twijfel niet om contact op te
                                    nemen met Koning Kevin op info@koningkevin.be of via 016 350 550. Wij horen graag
                                    van jullie.<br><br>

                                    Royale groeten!<br><br>
                                    Koning Kevin

                                </p>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row" ng-controller="Managing_users">
            @if(Auth::user()->is_active)
                    <!-- left side -> role files -->
                    @include('dashboard.rol_files')

                            <!-- right side -->
                    <div class="my_projects col-md-6" ng-controller="Managing_projects">

                        @if(Auth::user()->is_admin)
                            <div class="panel panel-default box-shadow-default z-index-fix ">
                                <div class="panel-heading" ng-click="togglePanel('usersDashboard')">
                                    <strong> Overzicht met nieuwe vrijwilligers</strong>
                                    <div class="toggleCollapse glyphicon @{{usrdashb ? 'glyphicon-chevron-down' : 'glyphicon-chevron-right'}}"></div>
                                </div>

                                <div class="panel-body" ng-controller="Dashboard" ng-show="usrdashb">
                                    <div class="container col-md-12">

                                        <div class="row">
                                            <div class="col-md-12 alert alert-success" ng-show="show_accept_message">
                                                De vrijwilliger werd succesvol geaccepteerd!
                                            </div>
                                        </div>

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
                                                            <a class="btn btn-primary " type="button"
                                                               data-toggle="modal"
                                                               data-target="#new_volunteers_modal"
                                                               ng-click="pass_modal_info(user.id)">Accepteer</a>
                                                            <a class="btn btn-primary " type="button"
                                                               data-toggle="modal"
                                                               data-target="#decline_volunteer_modal"
                                                               ng-click="pass_info_to_decline_user($event, user.id, user.first_name, user.last_name)">Weiger</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        @endif
                        <div class="modal fade " id="new_volunteers_modal" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content z-index-fix">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Vrijwilliger accepteren <!-- @{{selected_user}}--></h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Welke rollen wil je aan deze vrijwilliger toekennen?</p>
                                        @foreach($roles as $role)
                                            <div class="role">
                                                <input id="role{{$role->id}}" type="checkbox"
                                                       ng-model="selected[{{$role->id}}]" value="test">
                                                <label for="role{{$role->id}}">{{$role->type}} <i class="fa fa-check"
                                                                                                  aria-hidden="true"></i></label>
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default"
                                                ng-click="accept_user($event, selected_user, selected)"
                                                data-dismiss="modal">Accepteren
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal fade " id="decline_volunteer_modal" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content z-index-fix">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Vrijwilliger weigeren</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Ben je zeker dat je <strong>"@{{ user_name }}"</strong> wil weigeren?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default"
                                                ng-click="decline_user($event, user_id)" data-dismiss="modal">Ja, weiger
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="panel panel-default box-shadow-default z-index-fix">
                            <div class="panel-heading" ng-click="togglePanel('myProjectsDashboard')">
                                <strong>Mijn projecten</strong>
                                <div class="toggleCollapse glyphicon @{{myProjDashb ? 'glyphicon-chevron-down' : 'glyphicon-chevron-right'}}"></div>
                            </div>

                            <div class="panel-body" ng-controller="Dashboard" ng-show="myProjDashb">
                                <div class="row">
                                    <div class="col-md-12">
                                        @if(!$my_projects->isEmpty())
                                            @foreach($my_projects as $my_project)
                                                <div class="row">
                                                    <div class="row-title col-md-10">
                                                        <span class="col-md-2 project_date"> {{ date_format(date_create($my_project->start), 'd/m') }}</span>
                                                        <a class="col-md-6 project_name" href="{{url('/project_info/' . $my_project->id)}}">{{ $my_project->name }}</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div>Je hebt voorlopig geen projecten</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="panel panel-default box-shadow-default z-index-fix">
                            <div class="panel-heading" ng-click="togglePanel('projectOverviewDashboard')">
                                <strong>Projectoverzicht</strong>
                                <div class="toggleCollapse glyphicon @{{projOvervDashb ? 'glyphicon-chevron-down' : 'glyphicon-chevron-right'}}"></div>
                            </div>
                            <div class="panel-body" ng-controller="Dashboard" ng-show="projOvervDashb">
                                <div class="row">
                                    <div class="col-md-12">
                                        @foreach($projects as $project)
                                            <div class="row">
                                                <div class="row-title col-md-10">
                                                    <span class="col-md-2 project_date"> {{ date_format(date_create($project->start), 'd/m') }}</span>
                                                    <a class="col-md-6 project_name" href="{{url('/project_info/' . $project->id)}}">{{ $project->name }}</a>
                                                    @if(Auth::user()->is_admin && count($project->accepting_users) > 0)
                                                        <a href="{{url('edit_project/'.$project->id)}}"><span class="col-md-2 new_volunteers">({{count($project->accepting_users)}})</span></a>
                                                    @endif
                                                </div>
                                                @if(Auth::user()->is_admin)
                                                    <div class="row-icons col-md-2">
                                                        <a href="{{url('edit_project/'.$project->id)}}"><span
                                                                    class=" glyphicon glyphicon-pencil"></span></a>
                                                        <a href="" data-toggle="modal"
                                                           data-target="#delete_project_modal"
                                                           ng-click="pass_info_to_delete_project($event, {{$project->id}}, '{{$project->name}}')"><span
                                                                    class="glyphicon glyphicon-trash"></span></a>
                                                    </div>
                                            </div>
                                            @else
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="modal fade " id="delete_project_modal" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Project verwijderen</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Zeker dat je het project <strong>"@{{ project_name }}"</strong>wil
                                            verwijderen?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default"
                                                ng-click="delete_project($event, project_id)" data-dismiss="modal">Ja,
                                            verwijderen
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>

            @endif


        </div>
    </div>
    </div>

@endsection