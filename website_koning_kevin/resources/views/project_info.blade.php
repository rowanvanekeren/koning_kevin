<?php

$startdate = implode("-", array_reverse(explode("-", explode(" ", $project->start)[0])));
$start_hour = substr(explode(" ", $project->start)[1], 0, 5);
$enddate = implode("-", array_reverse(explode("-", explode(" ", $project->end)[0])));
$end_hour = substr(explode(" ", $project->end)[1], 0, 5);

?>
@extends('layouts.app')

@section('content')
    <div class="container">
        
        <div class="row">
            
            <div class="col-md-12">
                <div class="panel panel-default box-shadow-default">
                    <div class="panel-heading text-center"><strong>{{$project->name}}</strong></div>
                    <div class="panel-body project_info">
                    
                    @if(session('success_message'))
                    <div class="col-md-12 alert alert-success volunteered">
                        {{ session('success_message') }}
                    </div>
                    @endif
                    
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{url('/images/project_pictures/' . $project->image)}}" alt="{{$project->name}}" width="100%">
                        </div>

                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div>
                                    <h3>Beschrijving</h3>
                                    <div>
                                        {{$project->description}}
                                    </div>
                                </div>

                                <div>
                                    <h3>Locatie</h3>
                                    <div>
                                        {{$project->address}} </br>
                                        {{$project->city}}
                                    </div>
                                </div>

                                <div>
                                    <h3>Datum</h3>
                                    <div>
                                        Start: {{$startdate}} om {{$start_hour}}</br>
                                        Eind: {{$enddate}} om {{$end_hour}}
                                    </div>
                                </div>
                                
                                @if(!$project->accepted_users->isEmpty())
                                <div>
                                    <h3>Deelnemende vrijwilligers</h3>
                                    <div class="participating_volunteers">
                                        @foreach($project->accepted_users as $volunteer)
                                        <div class="row"><i class="fa fa-check col-md-1" aria-hidden="true"></i><span class="col-md-6">{{$volunteer->first_name}} {{$volunteer->last_name}}</span><span class="col-md-5">{{$volunteer->current_role($volunteer->pivot->role_id)->type}}</span></div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    
                    <div class="row volunteer_interaction">
                        <div class="col-md-12">
                            @if(!$volunteered)
                            <a href="{{url('volunteer/' . $project->id)}}" class="btn btn-success">Ik wil mij aanmelden voor dit project !</a>
                            @elseif($volunteered && $role)
                            <p>Je hebt je aangemeld voor dit project en bent geaccepteerd met de volgende rol: {{ $role }}.</p>
                            @else
                            <p>Je hebt je reeds aangemeld voor dit project, je aanvraag moet nog geaccepteerd worden</p>
                            @endif
                        </div>
                    </div>

                        @if(Auth::user()->is_admin)
                        <div class="admin_edit_button">
                            <a href="{{url('edit_project/' . $project->id)}}" class="btn btn-primary"><span class=" glyphicon glyphicon-pencil"></span><span>Bewerken</span></a>
                        </div>
                        @endif
                    </div>
                </div>

            </div>

        </div>
        
    </div>
@endsection