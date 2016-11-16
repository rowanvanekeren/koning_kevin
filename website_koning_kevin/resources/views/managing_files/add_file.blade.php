@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Show projects</h1>
        <p>Voor deze pagina moet je geregistreerd + active gebruiker + admin zijn</p>
        <div class="row">
            <div class="col-md-12">

                {{Form::open(array('url'=>'/add_file','files' => true))}}


                <div class="form-group{{ $errors->has('title') ? 'has-error' : '' }}">
                    <div class="col-md-6">
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
                    <div class="col-md-6">
                        {{ Form::label('description', 'Beschrijving', array('class' => 'control-label col-md-12'))}}
                        {{Form::text('description', old('description'),array('class'=>'form-control'))}}
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
                        @if ($errors->has('url'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                        @endif
                    </div>
                </fieldset>
            </div>
            <div class="form-group{{ $errors->has('category') ? 'has-error' : '' }}">
                <div class="col-md-6">
                    {{ Form::label('category', 'Kiez een categorie', array('class' => 'control-label col-md-12'))}}
                    {{Form::select('category', array('L' => 'Large', 'S' => 'Small'), 'S',array('class'=>'form-control'))}}
                    @if ($errors->has('category'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('category') ? 'has-error' : '' }}">
                <div class="col-md-6">
                    {{ Form::label('category', 'Kiez een categorie', array('class' => 'control-label col-md-12'))}}
                    {{Form::select('category', $categorys, '4',array('class'=>'form-control'))}}
                    @if ($errors->has('category'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                    @endif
                </div>
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
            {{Form::submit('Bestand toevoegen')}}
            {{Form::close()}}
        </div>
    </div>
@endsection