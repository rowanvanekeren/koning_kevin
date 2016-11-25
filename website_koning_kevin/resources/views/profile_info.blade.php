@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{url('/css/profile-info.css')}}">
@stop
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><strong>Gebruikers informatie</strong></div>
                    <div class="panel-body">
                        <div class="col-md-12  ">
                            <div class="col-md-12">
                                <img class="profile-info-image"
                                     src="{{asset('images/profile_pictures/'. Auth::user()->url ) }}">
                            </div>
                            <div class="col-md-12 profile-info-header">
                                <h1 class="">{{$user->first_name}} {{$user->last_name}}</h1>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <legend> Basis informatie</legend>
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    {{ Form::label('text', 'Voornaam', array('class' => 'control-label col-md-12'))}}
                                    {{Form::text('text', old('url'),array('class'=>'form-control'))}}
                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    {{ Form::label('text', 'Achternaam', array('class' => 'control-label col-md-12'))}}
                                    {{Form::text('text', old('url'),array('class'=>'form-control'))}}
                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    {{ Form::label('text', 'E-mail', array('class' => 'control-label col-md-12'))}}
                                    {{Form::text('text', old('url'),array('class'=>'form-control'))}}
                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    {{ Form::label('text', 'Adres', array('class' => 'control-label col-md-12'))}}
                                    {{Form::text('text', old('url'),array('class'=>'form-control'))}}
                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    {{ Form::label('text', 'Land', array('class' => 'control-label col-md-12'))}}
                                    {{Form::text('text', old('url'),array('class'=>'form-control'))}}
                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    {{ Form::label('text', 'Geboortedatum', array('class' => 'control-label col-md-12'))}}
                                    {{Form::text('text', old('url'),array('class'=>'form-control'))}}
                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    {{ Form::label('geboorteplaats', 'Geboorteplaats', array('class' => 'control-label col-md-12'))}}
                                    {{Form::text('geboorteplaats', old('url'),array('class'=>'form-control'))}}
                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    {{ Form::label('text', 'Job', array('class' => 'control-label col-md-12'))}}
                                    {{Form::text('text', old('url'),array('class'=>'form-control'))}}
                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    {{ Form::label('text', 'Job beschrijving', array('class' => 'control-label col-md-12'))}}
                                    {{Form::text('text', old('url'),array('class'=>'form-control'))}}
                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <legend> Administratieve gegevens</legend>
                            <div class="col-md-12">
                                {{ Form::label('text', 'Voornaam', array('class' => 'control-label col-md-12'))}}
                                {{Form::text('text', old('url'),array('class'=>'form-control'))}}
                                @if ($errors->has('url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12">
                                {{ Form::label('text', 'Voornaam', array('class' => 'control-label col-md-12'))}}
                                {{Form::text('text', old('url'),array('class'=>'form-control'))}}
                                @if ($errors->has('url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12">
                                {{ Form::label('text', 'Voornaam', array('class' => 'control-label col-md-12'))}}
                                {{Form::text('text', old('url'),array('class'=>'form-control'))}}
                                @if ($errors->has('url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            {{Form::submit('Aanpassen',array('class'=>'btn btn-primary btn-margin-custom') )}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection