@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">

            <div class="col-md-12" ng-controller="Managing_projects">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><strong>Vrijwilligersoverzicht</strong></div>
                    <div class="panel-body">
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Achternaam</th>
                                    <th>Voornaam</th>
                                    <th>Geboortedatum</th>
                                    <th>Geslacht</th>
                                    <th>Aantal projecten</th>
                                    <th>Admin</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($volunteers as $volunteer)
                                <tr>
                                    <td>{{$volunteer->last_name}}</td>
                                    <td>{{$volunteer->first_name}}</td>
                                    <td>{{date("d-m-Y", strtotime($volunteer->birth_date))}}</td>
                                    <td>{{$volunteer->gender}}</td>
                                    <td>{{count($volunteer->accepted_projects)}}</td>
                                    <td>{{$volunteer->is_admin}}</td>
                                    <td><span class="glyphicon glyphicon-trash"></span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>

        </div>

    </div>

    </div>
@endsection