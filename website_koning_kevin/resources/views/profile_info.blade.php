@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{url('/css/profile-info.css')}}">
@stop
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><strong>INLOGGEN</strong></div>
                <div class="panel-body">
            <h1>Dashboard</h1>
            <p>Profiel info</p>
            <div class="col-md-12  ">
                <div class="col-md-12">
                    <img class="profile-info-image" src="{{asset('images/profile_pictures/1479247671anton CV foto.jpg' /*. Auth::user()->url*/ ) }}">
                </div>
                <div class="col-md-12 profile-info-header">
                    <h1 class="">{{$user->first_name}} {{$user->last_name}}</h1>
                </div>
            </div>
            <div class="col-md-6">

                {{$user->first_name}}
                {{$user->last_name}}<br>
                {{$user->email}}<br>
                {{$user->address}}<br>
                {{$user->country}}<br>
                {{$user->birth_date}}<br>
                {{$user->birth_place}}<br>
                {{$user->job}}<br>
                {{$user->job_function}}<br>
            </div>
            <div class="col-md-6">
                Adminstratieve gegevens -> checken of er al administratieve gegevens aan deze user gelinkt zijn
            </div>
            </div>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection