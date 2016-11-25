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
                    <img class="profile-info-image" src="{{asset('images/profile_pictures/1479247671anton CV foto.jpg' /*. Auth::user()->url*/ ) }}">
                </div>
                <div class="col-md-12 profile-info-header">
                    <h1 class="">{{$user->first_name}} {{$user->last_name}}</h1>
                </div>
            </div>
            <div class="col-md-6">
                <legend> Basis informatie</legend>
                <div class="col-md-6 text-right">
                    E-mail:<br>
                    Adres:<br>
                    Land:<br>
                    Geboorte datum:<br>
                    Geboorte plaats:<br>
                    Werk:<br>
                    functie<br>

                </div>
                <div class="col-md-6">

                        <strong> {{$user->email}}</strong><br>
                            <strong>{{$user->address}}</strong><br>
                                <strong>{{$user->country}}</strong><br>
                                    <strong>{{$user->birth_date}}</strong><br>
                                        <strong>{{$user->birth_place}}</strong><br>
                                            <strong> {{$user->job}}</strong><br>
                                                <strong>{{$user->job_function}}</strong><br>
                </div>
            </div>
            <div class="col-md-6">
                <legend> Administratieve gegevens</legend>
                Adminstratieve gegevens -> checken of er al administratieve gegevens aan deze user gelinkt zijn
            </div>
            </div>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection