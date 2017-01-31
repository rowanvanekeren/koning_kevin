@extends('layouts.app')

@section('content')
    <div class="container" ng-controller="Managing_users">

        <div class="row">

            <div class="col-md-12" ng-controller="Managing_projects">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><strong>Project bewerken</strong></div>
                    <div class="panel-body">

                        @if(session('success_message'))
                            <div class="col-md-12 alert alert-success">
                                {{ session('success_message') }}
                            </div>
                        @endif
                        
                        @if (count($errors) > 0)
                            <div class="col-md-12 alert alert-danger">
                                Niet alle gegevens werden correct ingevuld ! 
                            </div>
                        @endif


                        {{Form::open(array('url'=>'/edit_project/' . $project->id,'files' => true))}}
                        <div class="col-md-6">

                            <div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
                                <div class="col-md-12">
                                    {{ Form::label('name', 'Projectnaam:', array('class' => 'control-label col-md-12'))}}
                                    {{Form::text('name', $project->name, array('class'=>'form-control'))}}
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('description') ? 'has-error' : '' }}">
                                <div class="col-md-12">
                                    {{ Form::label('description', 'Beschrijving:', array('class' => 'control-label col-md-12'))}}
                                    {{Form::textarea('description', $project->description, array('class'=>'form-control','size' => '30x5'))}}
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('address') ? 'has-error' : '' }}">
                                <div class="col-md-12">
                                    {{ Form::label('address', 'Adres:', array('class' => 'control-label col-md-12'))}}
                                    {{Form::text('address', $project->address, array('class'=>'form-control'))}}
                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('city') ? 'has-error' : '' }}">
                                <div class="col-md-6">
                                    {{ Form::label('city', 'Stad:', array('class' => 'control-label col-md-12'))}}
                                    {{Form::text('city', $project->city, array('class'=>'form-control'))}}
                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('country') ? 'has-error' : '' }}">
                                <div class="col-md-12">
                                    {{ Form::label('country', 'Land:', array('class' => 'control-label col-md-12'))}}
                                    {{Form::select('country', [ 'België' => 'België',
                                                                'Duitsland' => 'Duitsland',
                                                                'Frankrijk' => 'Frankrijk',
                                                                'Nederland' => 'Nederland',
                                                                'Spanje' => 'Spanje',
                                                                'Verenigd Koninkrijk' => 'Verenigd Koninkrijk',
                                                                'Zweden' => 'Zweden'], $project->country,array('class'=>'form-control', 'required' => 'required'), old('country'))}}
                                    @if ($errors->has('country'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('country') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('startdate') ? 'has-error' : '' }}">
                                    {{ Form::label('startdate', 'Startdatum:', array('class' => 'control-label col-md-12'))}}
                                    {{Form::date('startdate', (new DateTime($project->start))->format('Y-m-d'),array('class'=>'form-control col-md-3', 'required' => 'required'))}}
                                    @if ($errors->has('startdate'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('startdate') }}</strong>
                                </span>
                                    @endif
                                    {{Form::time('starttime', (new DateTime($project->start))->format('H:i:s'),array('class'=>'form-control col-md-3', 'required' => 'required'))}}
                                    @if ($errors->has('starttime'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('starttime') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('enddate') ? 'has-error' : '' }}">
                                    {{ Form::label('enddate', 'Einddatum:', array('class' => 'control-label col-md-12'))}}
                                    {{Form::date('enddate', (new DateTime($project->end))->format('Y-m-d'),array('class'=>'form-control', 'required' => 'required'))}}
                                    @if ($errors->has('enddate'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('enddate') }}</strong>
                                </span>
                                    @endif
                                    {{Form::time('endtime', (new DateTime($project->end))->format('H:i:s'),array('class'=>'form-control col-md-3', 'required' => 'required'))}}
                                    @if ($errors->has('endtime'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('endtime') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('active') ? 'has-error' : '' }}">
                                    {{ Form::label('active', 'Zet dit project zichtbaar:', array('class' => 'control-label col-md-6'))}}
                                    {{Form::checkbox('active', old('active'),$project->active)}}
                                    @if ($errors->has('active'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('active') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="col-md-12">
                                <img id="project_img" src="{{url('/images/project_pictures/'.$project->image)}}"
                                     width="100%;">
                            </div>

                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('image') ? 'has-error' : '' }}">
                                    {{ Form::label('image', 'Selecteer andere foto', array('class' => 'control-label col-md-12'))}}
                                    {{Form::file('image',array('class' => 'form-control', 'id' => 'project_image'))}}
                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div>
                                    Reeds toegevoegde bestanden:
                                </div>
                                <div>
                                    @foreach($project->documents as $document)
                                        <div>
                                            <a href="{{url('/')}}{{$document->url}}">
                                                {{$document->title}}
                                            </a>
                                            <a href="{{url('edit_project/' . $project->id.'/delete/'.$document->id)}}"><span
                                                        class="glyphicon glyphicon-trash pull-right"></span></a>
                                        </div>
                                    @endforeach
                                    @foreach($project->extra_documents as $document)
                                        <div>
                                            <a href="{{url('/')}}{{$document->url}}">
                                                {{$document->title}}
                                            </a>
                                            <a href="{{url('edit_project/' . $project->id.'/delete_extra_documents/'.$document->id)}}"><span
                                                        class="glyphicon glyphicon-trash pull-right"></span></a>
                                        </div>
                                    @endforeach

                                </div>

                            </div>
                            @include('projects.add_files_to_project.add_file')
                            @include('projects.add_files_to_project.add_extra_files_to_oroject')
                        </div>


                        <div class="col-md-12">
                            {{Form::submit('Project updaten', array('class' => 'btn btn-primary btn-margin-custom'))}}
                        </div>

                        {{Form::close()}}
                    </div>
                </div>


                @if(!$project->users->isEmpty())
                    <div class="col-md-6" ng-init="get_volunteers()">
                        <div class="panel panel-default">
                            <div class="panel-heading text-center"><strong>Reeds toegevoegde vrijwilligers</strong>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="col-md-12 alert alert-success" ng-show="show_accept_message">
                                        De vrijwilliger werd succesvol aanvaard!
                                    </div>
                                    <table class="table volunteers_overview">

                                        <tr>
                                            <th>
                                                <strong>Naam</strong>
                                            </th>
                                            <th>
                                                <strong>Toegekende rol</strong>
                                            </th>
                                        </tr>

                                        <tr ng-repeat="ok_volunt in accepted_volunteers">
                                            <td>
                                                 <a href="#">@{{ok_volunt.first_name}} @{{ok_volunt.last_name}}</a>
                                            </td>
                                            <td ng-repeat="role in ok_volunt.roles" ng-show="role.id == ok_volunt.pivot.role_id">
                                                @{{role.type}}
                                            </td>
                                        </tr>

                                        {{--
                                        @foreach($project->users as $volunteer)
                                            @if($volunteer->pivot->is_accepted)
                                        <tr>
                                              <td>  <a href="{{url('/profiel/'. $volunteer->id)}}">{{$volunteer->first_name}} {{$volunteer->last_name}}</a></td>
                                            <td>
                                                @foreach($volunteer->roles as $role)
                                                    @if($volunteer->pivot->role_id == $role->id)
                                                        {{$role->type}}
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                        @endif

                                        @endforeach
                                        --}}
                                        </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading text-center"><strong>Vrijwilligers toevoegen</strong></div>
                            <div class="panel-body add_volunteers">
                               
                               
                                <div class="row vol-add-proj" ng-repeat="appl_volunt in applied_volunteers">
                                    <div class="col-md-4 vol-add-proj"><a
                                                href="#">@{{appl_volunt.first_name}} @{{appl_volunt.last_name}}</a>
                                    </div>
                                    <div class="col-md-4 role@{{appl_volunt.id}}">
                                        <select name="role@{{appl_volunt.id}}">
                                            <option ng-repeat="role in appl_volunt.roles" value="@{{role.id}}">@{{role.type}}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 confirm-marks">
                                        <div class="status@{{appl_volunt.id}} btn exit-mark"
                                             status="@{{appl_volunt.pivot.is_accepted}}"
                                             ng-click="add_remove_user_to_project($event, 'x', 'x')"><i
                                                    class="fa fa-times" aria-hidden="true"></i></div>
                                        <div class="status@{{appl_volunt.id}} btn check-mark"
                                             status="@{{appl_volunt.pivot.is_accepted}}"
                                             ng-click="add_remove_user_to_project($event, appl_volunt.id, {{$project->id}})">
                                            <i class="fa fa-check" aria-hidden="true"></i></div>


                                    </div>
                                </div>
                               
                                {{--
                                @foreach($project->users as $volunteer)
                                    @if(!$volunteer->pivot->is_accepted)
                                        <div class="row vol-add-proj">
                                            <div class="col-md-4 vol-add-proj"><a
                                                        href="{{url('/profiel/'. $volunteer->id)}}">{{$volunteer->first_name}} {{$volunteer->last_name}}</a>
                                            </div>
                                            <div class="col-md-4 role{{$volunteer->id}}">
                                                <select name="role{{$volunteer->id}}">
                                                    @foreach($volunteer->roles as $role)
                                                        <option value="{{$role->id}}">{{$role->type}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 confirm-marks">
                                                <div class="status{{$volunteer->id}} btn exit-mark"
                                                     status="{{$volunteer->pivot->is_accepted}}"
                                                     ng-click="add_remove_user_to_project($event, 'x', 'x')"><i
                                                            class="fa fa-times" aria-hidden="true"></i></div>
                                                <div class="status{{$volunteer->id}} btn check-mark"
                                                     status="{{$volunteer->pivot->is_accepted}}"
                                                     ng-click="add_remove_user_to_project($event, {{$volunteer->id}}, {{$project->id}})">
                                                    <i class="fa fa-check" aria-hidden="true"></i></div>


                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                --}}

                                <div class="row button">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary" ng-click="show_volunteers_list()">
                                            Manueel vrijwilligers toevoegen
                                        </button>
                                    </div>
                                </div>

                                <div class="row volunteers">
                                    <div class="col-md-11"><input type="text" name="search" id="search_volunteers"
                                                                  class="form-control" placeholder="Zoek vrijwilligers"
                                                                  ng-keyup="search_volunteers()"></div>

                                    <div class="col-md-12 available_volunteers">
                                        <div class="row" ng-repeat="volunteer in volunteers">
                                            <div class="col-md-4">
                                                @{{volunteer.first_name}} @{{ volunteer.last_name }}
                                            </div>
                                            <div class="col-md-4 role@{{volunteer.id}}">
                                                <select name="role@{{volunteer.id}}">
                                                    <option ng-repeat="role in volunteer.roles"
                                                            value="@{{role.id}}">@{{role.type}}</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="status@{{volunteer.id}} btn btn-success"
                                                     ng-click="manually_add_remove_user_to_project($event, volunteer.id, {{$project->id}})">
                                                    <i class="fa fa-check" aria-hidden="true"></i></div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="status@{{volunteer.id}} btn btn-danger"
                                                     ng-click="add_remove_user_to_project($event, 'x', 'x')"><i
                                                            class="fa fa-times" aria-hidden="true"></i></div>
                                            </div>
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
@endsection
@section('custom_js')
    <script src="{{url('/js/managing_users.js')}}"></script>
@endsection