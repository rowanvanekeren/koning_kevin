@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row" ng-controller="Managing_users">

            <div class="col-md-12" ng-controller="Managing_projects">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><strong>Vrijwilligersoverzicht</strong></div>
                    <div class="panel-body">
                       
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{url('/search_volunteers')}}" method="get">
                                    <div class="col-md-10"><input type="text" name="search" id="search" class="form-control" placeholder="Zoek vrijwilligers"></div>
                                    <div class="col-md-2"><button type="submit" class="btn btn-primary vol-search-btn">Zoeken</button></div>
                                </form>
                            </div>
                        </div>
                        
                        <table class="table volunteers_overview">
                            <thead>
                                <tr>
                                    <th>Achternaam</th>
                                    <th>Voornaam</th>
                                    <th class="td-small-hide">Geboortedatum</th>
                                    <th class="td-small-hide">Geslacht</th>
                                    <th class="td-small-hide">Aantal projecten</th>
                                    <th>Admin</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($volunteers as $volunteer)
                                <tr>
                                    <td><a href="{{url('/profiel/' . $volunteer->id)}}">{{$volunteer->last_name}}</a></td>
                                    <td><a href="{{url('/profiel/' . $volunteer->id)}}">{{$volunteer->first_name}}</a></td>
                                    <td class="td-small-hide">{{date("d-m-Y", strtotime($volunteer->birth_date))}}</td>
                                    <td class="td-small-hide">{{$volunteer->gender}}</td>
                                    <td class="td-small-hide"> {{count($volunteer->accepted_projects)}}</td>
                                    <td>{{$volunteer->is_admin}}</td>
                                    <td><span class="glyphicon glyphicon-trash" data-toggle="modal" data-target="#delete_volunteer" ng-click="pass_info_to_delete($event, <?php echo($volunteer->id)?>)"></span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        {{ $volunteers->links() }}
                        
                    </div>
                </div>
            </div>
            
            <div id="delete_volunteer" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Vrijwilliger verwijderen</h4>
                      </div>
                      <div class="modal-body">
                        <p>Weet je zeker dat je <strong>"@{{volunteer_name}}"</strong> wil verwijderen?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" ng-click="delete_volunteer($event, selected_user)" data-dismiss="modal">Accepteren</button>
                      </div>
                    </div>
               </div>
            </div>

        </div>

    </div>

    </div>
@endsection