@extends('layouts.app')

@section('content')
    <div class="container">
        
        <div class="row">
            
            <div class="col-md-12">
                
                
                {{Form::open(array('url'=>'/add_project','files' => true))}}
                <div class="col-md-6">
                    
                    <div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
                        <div class="col-md-12">
                            {{ Form::label('name', 'Projectnaam:', array('class' => 'control-label col-md-12'))}}
                            {{Form::text('name', old('name'),array('class'=>'form-control', 'required' => 'required'))}}
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
                            {{Form::textarea('description', old('description'),array('class'=>'form-control','size' => '30x5', 'required' => 'required'))}}
                            @if ($errors->has('description'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('startdate') ? 'has-error' : '' }}">
                            {{ Form::label('startdate', 'Startdatum:', array('class' => 'control-label col-md-6'))}}
                            {{Form::date('startdate', old('startdate'),array('class'=>'form-control', 'required' => 'required'))}}
                            @if ($errors->has('startdate'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('startdate') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('enddate') ? 'has-error' : '' }}">
                            {{ Form::label('enddate', 'Einddatum:', array('class' => 'control-label col-md-6'))}}
                            {{Form::date('enddate', old('enddate'),array('class'=>'form-control', 'required' => 'required'))}}
                            @if ($errors->has('enddate'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('enddate') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('active') ? 'has-error' : '' }}">
                            {{ Form::label('active', 'Zet dit project zichtbaar:', array('class' => 'control-label col-md-6'))}}
                            {{Form::checkbox('active', old('active'),array('class'=>'form-control', 'required' => 'required'))}}
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
                        <div class="form-group{{ $errors->has('image') ? 'has-error' : '' }}">
                            {{ Form::label('image', 'Selecteer foto', array('class' => 'control-label col-md-12'))}}
                            {{Form::file('image',array('class' => 'form-control', 'required' => 'required'))}}
                            @if ($errors->has('image'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    
                    
                </div>
                

            <div class="col-md-12">
                {{Form::submit('Project toevoegen')}}
            </div>

            {{Form::close()}}
                
            </div>
            
        </div>
        
    </div>
@endsection