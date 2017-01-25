@extends('layouts.app')

@section('content')
    <div class="container" ng-controller="Managing_users">
        
        <div class="row">
            
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><strong>Project bewerken</strong></div>
                    <div class="panel-body">
                
                {{Form::open(array('url'=>'/edit_project/' . $project->id,'files' => true))}}
                <div class="col-md-6">

                    <div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
                        <div class="col-md-12">
                            {{ Form::label('name', 'Projectnaam:', array('class' => 'control-label col-md-12'))}}
                            {{Form::text('name', $project->name, array('class'=>'form-control', 'required' => 'required'))}}
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
                            {{Form::textarea('description', $project->description, array('class'=>'form-control','size' => '30x5', 'required' => 'required'))}}
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
                            {{Form::text('address', $project->address, array('class'=>'form-control', 'required' => 'required'))}}
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
                            {{Form::text('city', $project->city, array('class'=>'form-control', 'required' => 'required'))}}
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
                        <img src="{{url('/images/project_pictures/'.$project->image)}}" width="100%;">
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('image') ? 'has-error' : '' }}">
                            {{ Form::label('image', 'Selecteer andere foto', array('class' => 'control-label col-md-12'))}}
                            {{Form::file('image',array('class' => 'form-control'))}}
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
                                {{$document->title}}
                                <a href="{{url('edit_project/' . $project->id.'/delete/'.$document->id)}}"><span class="glyphicon glyphicon-trash pull-right"></span></a>
                            </div>
                            @endforeach
                        </div>

                    </div>
                    @include('projects.add_files_to_project.add_file')
                </div>
                

            <div class="col-md-12">
                {{Form::submit('Project updaten', array('class' => 'btn btn-primary btn-margin-custom'))}}
            </div>

            {{Form::close()}}
    </div>
                    </div>
                    
                    
                    @if(!$project->users->isEmpty())
                    <div class="panel panel-default">
                        <div class="panel-heading text-center"><strong>VRIJWILLIGERS TOEVOEGEN</strong></div>
                        <div class="panel-body">
                            @foreach($project->users as $volunteer)
                            <div class="col-md-12">
                                <div class="col-md-6"><a href="{{url('/profiel/'. $volunteer->id)}}">{{$volunteer->first_name}} {{$volunteer->last_name}}</a></div>
                                <div class="col-md-2 role{{$volunteer->id}}">
                                    <select name="role{{$volunteer->id}}">
                                        @foreach($volunteer->roles as $role)
                                        <option value="{{$role->id}}">{{$role->type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <div class="status{{$volunteer->id}}" status="{{$volunteer->pivot->is_accepted}}" ng-click="add_remove_user_to_project($event, {{$volunteer->id}})">Accepteer</div>
                                </div
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                </div>
                
                

            </div>

        </div>
        
    </div>
@endsection
@section('custom_js')
<script src="{{url('/js/managing_users.js')}}"></script>
@endsection