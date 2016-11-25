@extends('layouts.app')
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1>Dashboard</h1>
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
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Bestanden volges jouw rol
                        </div>
                        <div class="panel-body" ng-controller="Dashboard">
                            <uib-accordion close-others="oneAtATime">
                                <div uib-accordion-group class="panel-default" is-open="status.open"
                                     ng-repeat="rol in rol_files">
                                    <uib-accordion-heading>
                                        @{{ rol.role.type }} <i class="pull-right glyphicon"
                                                                ng-class="{'glyphicon-chevron-down': status.open, 'glyphicon-chevron-right': !status.open}"></i>
                                    </uib-accordion-heading>
                                    <div ng-repeat="file in rol.files"
                                         class="row file_row_background@{{file.priority}}">
                                        <p uib-popover="@{{file.description}}"
                                           popover-trigger="'mouseenter'"
                                           popover-placement="bottom-left" class="col-md-9" data-toggle="modal"
                                           data-target="#myModal" ng-click="ang_modal(file.id)">
                                            @{{file.title}}
                                        </p>
                                        <a   href="@{{ file.url}}"><span
                                                    class="col-md-1 glyphicon glyphicon-download-alt"></span>
                                        </a>
                                        <a href="#"><span
                                                    class="col-md-1 glyphicon glyphicon-pencil"></span></a>
                                        <a href="#"><span ng-click="delete_document(file.id)"
                                                          class="col-md-1 glyphicon glyphicon-trash"></span></a>
                                    </div>
                                </div>
                            </uib-accordion>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content" ng-if="file_info">
                                        <div class="modal-header" ng-if="file_info">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">@{{ file_info.file.title }}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5>Beschrijving</h5>
                                                    <p>@{{ file_info.file.title }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <h5>Categorieen</h5>
                                                    <p ng-repeat="category in file_info.categories">
                                                        @{{ category.type }}
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <h5>Rollen</h5>
                                                    <p ng-repeat="rol in file_info.roles" >
                                                        @{{ rol.type }}
                                                    </p>
                                                </div>
                                                <div class="col-md-12">
                                                    <h5>Tags</h5>
                                                    <p ng-repeat="tag in file_info.tags" >
                                                        <span ng-if="tag.type">#</span>@{{ tag.type }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>
                                    <div class="modal-content" ng-if="!file_info">
                                        <div class="modal-header" ng-if="file_info">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Er ging iets mis, maak een printscreen van deze pagina
                                                en stuur door aan de moderator.</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="row" ng-repeat="rol in rol_files">--}}
                            {{--<a class="btn btn-primary col-md-12 col-xs-12" type="button"--}}
                            {{--data-toggle="collapse"--}}
                            {{--data-target="#@{{ $index }}" aria-expanded="false"--}}
                            {{--aria-controls="@{{ $index }}">--}}
                            {{--@{{ rol.role.type }}--}}
                            {{--</a>--}}
                            {{--<div class="collapse col-md-12" id="@{{ $index }}">--}}
                            {{--<div class="card card-block">--}}
                            {{--<div ng-repeat="file in rol.files"--}}
                            {{--class="row file_row_background@{{file.priority}}">--}}
                            {{--<p uib-popover="@{{file.description}}"--}}
                            {{--popover-trigger="'mouseenter'"--}}
                            {{--popover-placement="bottom-left" class="col-md-9">--}}
                            {{--@{{file.title}}--}}
                            {{--</p>--}}
                            {{--<a href="@{{ file.url}}"><span--}}
                            {{--class="col-md-1 glyphicon glyphicon-download-alt"></span>--}}
                            {{--</a>--}}
                            {{--<a href="#"><span--}}
                            {{--class="col-md-1 glyphicon glyphicon-pencil"></span></a>--}}
                            {{--<a href="#"><span ng-click="delete_document(file.id)"--}}
                            {{--class="col-md-1 glyphicon glyphicon-trash"></span></a>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-10"><p>@{{file.description}}</p></div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
                @endif
                <div class="col-md-6">
                    @if(Auth::user()->is_admin)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Overzicht met nieuwe vrijwilligers
                            </div>
                            <div class="panel-body" ng-controller="Dashboard">
                                <div class="container col-md-12" ng-controller="Managing_users">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @foreach($projects as $project)
                                                <p>{{ $project->name }} op {{ $project->start }}</p>
                                            @endforeach
                                        </div>
                                        <div class="col-md-12" ng-init="get_inactive_users()">
                                            {{--
            @foreach($inactive_users as $inactive_user)
            <div class="row user" ng-init="get_inactive_users()">
                <div class="col-md-6">
                    <a href="{{url('/profiel/'.$inactive_user->id)}}">{{$inactive_user->first_name}} {{$inactive_user->last_name}}</a>
                </div>
                <div class="col-md-3">
                    <a href="#" ng-click="accept_user()">accepteer</a>
                </div>
                <div class="col-md-3">
                    <a href="#">Verwijder</a>
                </div>
            </div>
            @endforeach
            --}}
                                            <div ng-if="inactive_users.length == 0">
                                                Er hebben zich momenteel geen nieuwe vrijwilligers aangemeld.
                                            </div>
                                            <div class="row user" ng-repeat="user in inactive_users">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <a href="{{url('/profiel/')}}/@{{user.id}}">@{{user.first_name}} @{{user.last_name}}</a>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <a class="btn btn-primary btn-margin-custom" type="button" data-toggle="collapse"
                                                           data-target="#add_roles@{{user.id}}">Accepteer</a>
                                                        <a class="btn btn-primary btn-margin-custom" type="button" data-toggle="collapse"
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
                                                        <a href="#" ng-click="decline_user($event, user.id)">Ja, weiger</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                </div>
            </div>
    </div>

@endsection