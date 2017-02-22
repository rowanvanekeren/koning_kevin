@extends('layouts.app')

@section('content')

    <div class="container" ng-controller="toggleController">

        <div class="row">
            <div class="col-md-12 projects_overview" ng-controller="Managing_projects">

                <div class="panel panel-default box-shadow-default z-index-fix">
                    <div class="panel-heading">
                        <strong>Projectoverzicht</strong>
                    </div>
                    <div class="panel-body" ng-controller="Dashboard" ng-show="projOvervDashb">
                        <div class="row">
                            <div class="col-md-12">
                                @foreach($projects as $project)
                                    <div class="row">
                                        <div class="row-title col-md-10">
                                            <span class="col-md-2 project_date"> {{ date_format(date_create($project->start), 'd/m/Y') }}</span>
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

        </div>

    </div>



@endsection