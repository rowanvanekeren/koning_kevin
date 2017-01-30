<?php

$user_role_ids = [];
foreach($user->roles as $role) {
    //
    array_push($user_role_ids, $role->id);
    //var_dump($user_role_ids);
}


?>


@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{url('/css/profile-info.css')}}">
@stop
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default box-shadow-default">
                    <div class="panel-heading text-center"><strong>Gebruikers informatie</strong></div>
                    <div class="panel-body">
                       
                        @if(session('success_message'))
                        <div class="col-md-12 alert alert-success volunteered">
                            {{ session('success_message') }}
                        </div>
                        @endif
                       
                        <div class="col-md-12  ">
                            <div class="col-md-12">
                                <img class="profile-info-image"
                                     src="{{asset('images/profile_pictures/'. $user->url ) }}">
                            </div>
                            <div class="col-md-12 profile-info-header">
                                <h1 class="">{{$user->first_name}} {{$user->last_name}}</h1>
                            </div>
                        </div>
                        {{Form::open(array('url'=>'/edit_profile','files' => true))}}
                        <div class="col-md-6">
                            <legend> Basis informatie</legend>

                            <div class="col-md-12">
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                <div class="col-md-12">
                                    {{ Form::label('text', 'Voornaam', array('class' => 'control-label col-md-12'))}}
                                    {{Form::text('first_name', $user->first_name,array('required' => 'required', 'class'=>'form-control'))}}
                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    {{ Form::label('text', 'Achternaam', array('class' => 'control-label col-md-12'))}}
                                    {{Form::text('last_name', $user->last_name,array('required' => 'required', 'class'=>'form-control'))}}
                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    {{ Form::label('text', 'E-mail', array('class' => 'control-label col-md-12'))}}
                                    {{Form::text('email', $user->email,array('required' => 'required', 'class'=>'form-control'))}}
                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    {{ Form::label('text', 'Adres', array('class' => 'control-label col-md-12'))}}
                                    {{Form::text('address', $user->address,array('required' => 'required', 'class'=>'form-control'))}}
                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    {{ Form::label('text', 'Land', array('class' => 'control-label col-md-12'))}}
                                    {{Form::text('country', $user->country,array('required' => 'required', 'class'=>'form-control'))}}
                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    {{ Form::label('text', 'Geboortedatum', array('class' => 'control-label col-md-12'))}}
                                    {{Form::text('birth_date', $user->birth_date,array('required' => 'required', 'class'=>'form-control'))}}
                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    {{ Form::label('geboorteplaats', 'Geboorteplaats', array('class' => 'control-label col-md-12'))}}
                                    {{Form::text('birth_place', $user->birth_place,array('required' => 'required', 'class'=>'form-control'))}}
                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    {{ Form::label('text', 'Job', array('class' => 'control-label col-md-12'))}}
                                    {{Form::text('job', $user->job,array('class'=>'form-control'))}}
                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    {{ Form::label('text', 'Job beschrijving', array('class' => 'control-label col-md-12'))}}
                                    {{Form::text('job_function', $user->job_function,array('class'=>'form-control'))}}
                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <legend> Administratieve gegevens</legend>
                                <div class="col-md-12">
                                    {{ Form::label('text', 'Rekeningnummer (BE00 0000 0000 0000)', array('class' => 'control-label col-md-12'))}}
                                    {{Form::text('bank_account', $user->administrative_details->bank_account_number,array('placeholder'=>'BE00 0000 0000 0000','class'=>'form-control', 'pattern'=>'BE[0-9]{2}\s[0-9]{4}\s[0-9]{4}\s[0-9]{4}'))}}
                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('url') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    {{ Form::label('text', 'Rijksregisternummer (00.00.00-000.00)', array('class' => 'control-label col-md-12'))}}
                                    {{Form::text('national_insurance', $user->administrative_details->national_insurance_number,array('placeholder'=>'00.00.00-000.00', 'class'=>'form-control', 'pattern'=>'\\d{2}\.\\d{2}\\.\\d{2}-\\d{3}\\.\\d{2}'))}}
                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('url') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    {{ Form::label('text', 'Identiteitskaartnummer (000-0000000-00)', array('class' => 'control-label col-md-12'))}}
                                    {{Form::text('identity', $user->administrative_details->identity_number,array('placeholder'=>'000-0000000-00','class'=>'form-control', 'pattern'=>'\\d{3}-\\d{7}-\\d{2}'))}}
                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('url') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            @if(!Auth::user()->is_admin)
                            <div class="row">
                                <legend>Jouw rollen</legend>
                                <div class="col-md-12 my_roles">
                                    @if(!$user->roles->isEmpty())
                                    @foreach($user->roles as $role)
                                    <div><i class="fa fa-check" aria-hidden="true"></i> {{$role->type}}</div>
                                    @endforeach
                                    @else
                                    <div>Je hebt nog geen rollen toegewezen gekregen</div>
                                    @endif
                                </div>
                            </div>
                            @endif
                            
                            @if(Auth::user()->is_admin)
                            <div class="row">
                                <legend>Rollen toevoegen aan deze persoon</legend>
                                <div class="col-md-12 add_roles">
                                    @foreach($roles as $role)
                                    <div>
                                        <input type="checkbox" name="new_roles[]" id="new_role{{$role->id}}" value="{{$role->id}}" <?php if(in_array($role->id,$user->roles->pluck('id')->toArray())) {echo("checked");} ?> >
                                        <label for="new_role{{$role->id}}">{{$role->type}}<i class="fa fa-check" aria-hidden="true"></i></label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            
                        </div>
                        <div class="col-md-12">
                            {{Form::submit('Aanpassen',array('class'=>'btn btn-primary btn-margin-custom') )}}
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection