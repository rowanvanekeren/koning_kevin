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
                    <div class="panel-body">
                    
                    @if(session('success_message'))
                    <div class="col-md-12 alert alert-success volunteered">
                        {{ session('success_message') }}
                    </div>
                    @endif
                    
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
                            
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        @if(!$volunteered)
                        <a href="{{url('volunteer/' . $project->id)}}" class="btn btn-success">Ik wil me aanmelden voor dit project</a>
                        @elseif($volunteered && $role)
                        <p>Je hebt je aangemeld voor dit project en werd geaccepteerd met de rol {{ $role }}.</p>
                        @else
                        <p>Je hebt je reeds aangemeld voor dit project, maar werd nog niet geaccepteerd.</p>
                        @endif
                    </div>
   
                    </div>
                </div>

            </div>

        </div>
        
    </div>
@endsection