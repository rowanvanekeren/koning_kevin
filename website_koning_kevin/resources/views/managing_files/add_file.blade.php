@extends('layouts.app')

@section('content')
    <div class="container" ng-controller="Managing_file">
        <h1>@{{ title }}</h1>
        <p>Voor deze pagina moet je geregistreerd + active gebruiker + admin zijn</p>

        @if(Session::has('success'))
            <h1>
                {{ Session::get('success')}}
            </h1>
        @endif
        <div class="row">
            <div class="col-md-12">
                {{Form::open(array('url'=>'/add_file','files' => true))}}
                <div class="form-group{{ $errors->has('title') ? 'has-error' : '' }}">
                    <div class="col-md-12">
                        {{ Form::label('title', 'Titel van het bestand', array('class' => 'control-label col-md-12'))}}
                        {{Form::text('title', old('title'),array('class'=>'form-control'))}}
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('description') ? 'has-error' : '' }}">
                    <div class="col-md-12">
                        {{ Form::label('description', 'Beschrijving', array('class' => 'control-label col-md-12'))}}
                        {{Form::textarea('description', old('description'),array('class'=>'form-control','size' => '30x5'))}}
                        @if ($errors->has('description'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <fieldset class="form-group col-md-12">
                    <legend>Kies een bestand of voeg een link toe</legend>
                    <div class="col-md-6">
                        {{ Form::label('url', 'Google docs url', array('class' => 'control-label col-md-12'))}}
                        {{Form::text('url', old('url'),array('class'=>'form-control'))}}
                        @if ($errors->has('url'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('file', 'Kies een bestand', array('class' => 'control-label col-md-12'))}}
                        {{Form::file('file',array('class' => 'form-control'))}}
                        @if ($errors->has('file'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                        @endif
                    </div>
                </fieldset>
                <fieldset class="form-group col-md-6">
                    <legend>Categorieen</legend>
                    @if ($errors->has('categories'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('categories') }}</strong>
                                    </span>
                    @endif
                    @foreach($categories as $key=>$category)
                        <div class="form-check col-md-12">
                            <label class="form-check-label">
                                {{--($key == '0'? true:null)--}}
                                {{ Form::checkbox('categories[]',$category->id ,0 , ['class' => 'field']) }}
                                {{$category->type}}
                            </label>
                        </div>
                    @endforeach
                </fieldset>
                <fieldset class="form-group col-md-6">
                    <legend>Rol</legend>
                    @if ($errors->has('roles'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('roles') }}</strong>
                                    </span>
                    @endif
                    @foreach($roles as $key=>$role)
                        <div class="form-check col-md-12">
                            <label class="form-check-label">
                                {{--($key == '0'? true:null)--}}
                                {{ Form::checkbox('roles[]',$role->id,0, ['class' => 'field']) }}
                                {{$role->type}}
                            </label>
                        </div>
                    @endforeach
                </fieldset>
            </div>
            <fieldset class="form-group col-md-12">
                <legend>Hoe belangerijk is het bestand?</legend>
                <div class="form-check col-md-4">
                    <label class="form-check-label">
                        {{Form::radio('priority', 0,true,array('class'=>'form-check-input'))}}
                        Vrij tijd lezing.
                    </label>
                </div>
                <div class="form-check col-md-4">
                    <label class="form-check-label">
                        {{Form::radio('priority', 1,null,array('class'=>'form-check-input'))}}
                        Hey denk er aan, deze bestand moet je gelezen hebben.
                    </label>
                </div>
                <div class="form-check col-md-4">
                    <label class="form-check-label">
                        {{Form::radio('priority', 2,null,array('class'=>'form-check-input'))}}
                        Lat alles liggen, deze moet je nu lezen.
                    </label>
                </div>
            </fieldset>
            <div class="col-md-6">
                {{ Form::label('tags', 'Voeg hiet enkele tags', array('class' => 'control-label col-md-12'))}}
                {{Form::text('tags', old('tags'),array('class'=>'form-control','ng-model'=>'tags','ng-keypress'=>'(($event.keyCode === 32)?tags_enter(tags):"0")'))}}
                @if ($errors->has('tags'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('tags') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-md-12">
                {{Form::submit('Bestand toevoegen')}}
            </div>

            {{Form::close()}}
        </div>
    </div>
@endsection